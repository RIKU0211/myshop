<?php
require('db_data.php');	// データベース操作準備用のファイルを読み込む

// セッション管理をする宣言（セッション変数を使うための準備）
session_start();

if($_SESSION['addres'] == 'products'){
	$a = 1;
}else if($_SESSION['addres'] == 'goods'){
	$a = 2;
}

?>

<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>買い物かご</title>
</head>
<body background="image/bg.jpg">

<center>

<a href="<?php echo $_SESSION['addres'] ?>.php">商品ページへ戻る</a>
<br><br>

現在の買い物かごの中身

<?php
$shouhin_id = $_POST['shouhin_id'];	// 買い物かごに入れる商品の商品番号（テーブルshouhinのid）を受け取る
$shouhin_item = $_POST['shouhin_item'];
$shouhin_price = $_POST['shouhin_price'];
$shouhin_qty = $_POST['shouhin_qty'];


// ----買い物かご（テーブルkago）に商品番号（$shouhin_id）と個数を入れる----
$kago_in = 'INSERT INTO kago SET shouhin_id='.$shouhin_id.', item="'.$shouhin_item.'", qty=1, price='.$shouhin_price.' ';
$kago_in_result = mysql_query($kago_in);
// -----------------------------------------------------------------------
?>

<table border='1'>
<tr>
	<th>タイトル</th>
	<th>個数</th>
	<th>金額</th>
</tr>
<?php
$sum=0;
// -----買い物かごの中身をテーブルkagoから取り出して表示する----------
$kago_list = 'SELECT * FROM kago';				// テーブルkagoから抽出するクエリ
$kago_result = mysql_query($kago_list);			// 抽出クエリの送信
$num_record = mysql_num_rows($kago_result);		// 買い物かごに入っている商品の数を数える

for ($i = 0; $i < $num_record; $i = $i + 1) {
	// 買い物かごに入っている商品番号と個数を取り出す
	$kago_rec = mysql_fetch_array($kago_result, MYSQL_ASSOC);
	// ↑で$kago_rec['shouhin_id']に商品番号、$kago_rec['qty']に商品の個数が入る

	// 商品番号$kago_rec['shouhin_id']を利用して商品情報テーブルshouhinから商品情報を取り出す
	if($a == 1){	// ゲームメニューからきたら
		$shouhin_data = 'SELECT * FROM game WHERE id='.$kago_rec['shouhin_id'];
		$shouhin_result = mysql_query($shouhin_data);
		$shouhin_rec = mysql_fetch_array($shouhin_result, MYSQL_ASSOC);
		
	}else if($a == 2){	// グッズメニューからきたら
		$shouhin_data = 'SELECT * FROM goods WHERE id='.$kago_rec['shouhin_id'];
		$shouhin_result = mysql_query($shouhin_data);
		$shouhin_rec = mysql_fetch_array($shouhin_result, MYSQL_ASSOC);
	}
	
	// 合計を計算
	$sum += $kago_rec['price'];
	
	
	
	echo '<tr>';
	echo '	<td>'.$kago_rec['item'].'</td>';	// 商品名
	echo '	<td>'.$kago_rec['qty'].'</td>';		// 個数
	echo '	<td>'.number_format($kago_rec['price']).'</td>';	// 金額
	echo '</tr>';
	
	
}
// -------------------------------------------------------------------
	echo '</table>';
	
	echo '<table border=1>';
	echo '<tr>';
	echo '	<td>合計金額</td>';	// 商品名
	echo '	<td>'.number_format($sum).'</td>';		// 個数
	echo '</tr>';
	
echo $shouhin_qty;
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
