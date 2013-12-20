<?php
require('db_data.php');	// データベース操作準備用のファイルを読み込む

// セッション管理をする宣言（セッション変数を使うための準備）
session_start();
?>

<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>購入処理</title>
</head>
<body background="image/bg.jpg">

<?php
// -----購入者の名前とパスワードを受け取る----------------------------
$name = $_POST['name'];
$pass = $_POST['pass'];
// -------------------------------------------------------------------

if( $name == $_SESSION['name'] && $pass == $_SESSION['pass1'] ){
	// -----買い物かごの中身を購入情報として登録する----------------------
	$kago_list = 'SELECT * FROM kago';			// 買い物かごの中身を取り出すクエリ
	$kago_result = mysql_query($kago_list);		// クエリの送信
	$num_record = mysql_num_rows($kago_result);	// 買い物かごの中の商品の数を調べる
	for ($i = 0; $i < $num_record; $i = $i + 1) {
		$kago_rec = mysql_fetch_array($kago_result, MYSQL_ASSOC);
		// 購入者の名前と商品番号、個数をテーブルhanbaiに挿入する
		$trade_query = 'INSERT INTO hanbai SET name="'.$name.'", shouhin_id='.$kago_rec['shouhin_id'].', qty='.$kago_rec['qty'];
		$trade_result = mysql_query($trade_query);
	}
	// -------------------------------------------------------------------
	
	
	// -----テーブルkagoに記録されている買い物かごの中身を破棄する--------
	$clear_kago = 'DELETE FROM kago';
	$clear_kago_result = mysql_query($clear_kago);
	// -------------------------------------------------------------------
	
	mysql_close($conn);	// MySQLサーバへの接続を切断する
	?>
	
	購入手続きを完了致しました
	<br>
	ご利用ありがとうございました
<?php
}else{
	echo 'アカウント名、もしくはパスワードが違います。';
}

?>

<br><br>
<a href="index.php">トップページにもどる</a>

</body>
</html>
