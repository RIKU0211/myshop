<?php
require('db_data.php');	// データベース操作準備用のファイルを読み込む
?>

<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>買い物かご</title>
</head>
<body background="image/bg.jpg">

<center>

<a href="products.php">商品ページへ戻る</a>
<br><br>

現在の買い物かごの中身

<?php
$shouhin_id = $_POST['shouhin_id'];	// 買い物かごに入れる商品の商品番号（テーブルshouhinのid）を受け取る

// ----買い物かご（テーブルkago）に商品番号（$shouhin_id）と個数を入れる----
$kago_in = 'INSERT INTO kago SET shouhin_id='.$shouhin_id.', qty=1';
$kago_in_result = mysql_query($kago_in);
// -----------------------------------------------------------------------
?>

<table border='1'>
<tr>
	<th>タイトル</th>
	<th>個数</th>
</tr>
<?php
$qty=0;
// -----買い物かごの中身をテーブルkagoから取り出して表示する----------
$kago_list = 'SELECT * FROM kago';				// テーブルkagoから抽出するクエリ
$kago_result = mysql_query($kago_list);			// 抽出クエリの送信
$num_record = mysql_num_rows($kago_result);		// 買い物かごに入っている商品の数を数える

$game_list = 'SELECT id FROM game';
$game_result = mysql_query($game_list);			// 抽出クエリの送信
$game_record = mysql_num_rows($game_result);		// 商品の数を数える

for ($i = 0; $i < $num_record; $i = $i + 1) {
	// 買い物かごに入っている商品番号と個数を取り出す
	$kago_rec = mysql_fetch_array($kago_result, MYSQL_ASSOC);
	// ↑で$kago_rec['shouhin_id']に商品番号、$kago_rec['qty']に商品の個数が入る

	// 商品番号$kago_rec['shouhin_id']を利用して商品情報テーブルshouhinから商品情報を取り出す
	$shouhin_data = 'SELECT * FROM game WHERE id='.$kago_rec['shouhin_id'];
	$shouhin_result = mysql_query($shouhin_data);
	$shouhin_rec = mysql_fetch_array($shouhin_result, MYSQL_ASSOC);
	
	
	//for($j = 1; $j <= $game_record; $j++){
		$num_list = 'SELECT * FROM kago WHERE shouhin_id="1"';
		$num_result1 = mysql_query($num_list);			// 抽出クエリの送信
		$num_record1 = mysql_num_rows($num_result1);		// 商品の数を数える
	//}
	
	$qty += $kago_rec['qty'];
	
	echo '<tr>';
	echo '	<td>'.$shouhin_rec['item'].'</td>';	// 商品名
	echo '	<td>'.$qty.'</td>';		// 個数
	echo '</tr>';
	
	
}
// -------------------------------------------------------------------

	echo $game_record.'<br>';
	echo $num_record1.'<br>';

?>
</table>

<br><br>

<br>
買い物かごの中身をご確認のうえ、ご登録のお名前とパスワードを入力してください
<br>

<!-- 購入処理ページへ -->
<form action="order.php" method="post">
<table>
	<tr>
		<td>名前</td>
		<td><input type="text" name="name"></td>
	</tr>
	<tr>
		<td>パスワード</td>
		<td><input type="password" name="pass"></td>
	</tr>
	<tr>
		<td></td>
		<td>
			<input type="submit" value="購入">
		</td>
	</tr>
</table>
</form>

</center>

<?php
mysql_close($conn);	// MySQLサーバへの接続を切断する
?>
</body>
</html>
