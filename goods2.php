<?php
require('db_data.php');	// データベース操作準備用のファイルを読み込む

// セッション管理をする宣言（セッション変数を使うための準備）
session_start();
unset($_SESSION['addres']);
$_SESSION['addres'] = 'goods';
?>

<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>商品ページ:MUSIC:J-POP</title>
</head>
<body background="image/bg.jpg">

<center>

<h1>KINGDOM HEARTS：GOODS</h1>

<br>

<h2>２ページ</h2>

<a href="goods.php">１</a> / ２

<br><br>

<table border="1">
<tr>
	<th>商品</th>
	<th>タイトル</th>
	<th>価格</th>
	<th>　</th>
</tr>
<?php
// -----商品情報をテーブルshouhinから取り出して表示する-----------------
$shouhin_list = 'SELECT * FROM goods WHERE id > 5 AND id <= 10';	// 商品情報を抽出するクエリ
$result = mysql_query($shouhin_list);		// 抽出するクエリの送信
$num_record = mysql_num_rows($result);	// テーブルshouhin内の商品の数を調べる
for ($i = 0; $i < $num_record; $i = $i + 1) {		// ループ処理で商品情報を表示する
	$rec = mysql_fetch_array($result, MYSQL_ASSOC);
	// ↑で$rec['id']に商品番号、$rec['name']に商品名、
	//     $rec['price']に商品価格、$rec['photo']に商品写真のファイル名が入る

	echo '<tr>';
	echo '	<td><img src="image/'.$rec['photo'].'" width="146"></td>'; // 商品写真を表示する
	echo '	<td>'.$rec['item'].'</td>';		// 商品名を表示する
	echo '	<td>'.number_format($rec['price']).'円</td>';	// 商品価格を表示する
	echo '	<td>';
	echo '	<select name="pull_qty" size="1">';
	echo '		<option value="1">単品</option>';
	echo '		<option value="6">１箱</option>';
	echo '	</select>';
	$rec['qty'] = $pull_qty;
	
	echo '	<form action="basket.php" method="post">';							// 買い物かごページbasket.phpへ
	echo '		<input type="hidden" name="shouhin_id" value="'.$rec['id'].'">';	// 商品番号を隠しデータとして送る
	echo '		<input type="hidden" name="shouhin_item" value="'.$rec['item'].'">';
	echo '		<input type="hidden" name="shouhin_price" value="'.$rec['price'].'">';
	echo '		<input type="hidden" name="shouhin_qty" value="'.$rec['qty'].'">';
	echo '		<input type="submit" value="かごに入れる">';
	echo '	</form>';
	echo '	</td>';
	echo '</tr>';
}
// -------------------------------------------------------------------

?>
</table>

<br>
<a href="menu.php">メニューに戻る</a>
<br>
<a href="index.php">トップページに戻る</a>

</center>

<?php
mysql_close($conn);	// MySQLサーバへの接続を切断する
?>
</body>
</html>
