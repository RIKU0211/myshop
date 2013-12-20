<?php
require('db_data.php');	// データベース操作準備用のファイルを読み込む


// セッション管理をする宣言（セッション変数を使うための準備）
session_start();

?>

<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>ログアウト</title>
</head>
<body background="image/bg.jpg">

<center>

<h1>KINGDOM HEARTS：ログイン</h1>

<form action="rogin.php" method="post">
	ユーザ名
	<input type="text" name="name">
	
	<br>
	
	パスワード
	<input type="password" name="pass">
	
	<br><br>
	
	<input type="submit" value="確認">
	<input type="reset" value="クリア">
</form>

<?php
$name =  $_POST['name'];
$pass =  $_POST['pass'];

$user = 'SELECT * FROM user';	// ユーザ情報を抽出するクエリ
$result = mysql_query($user);		// 抽出するクエリの送信
$user_record = mysql_num_rows($result);	// テーブルuser内の数を調べる

for ($i = 0; $i < $user_record; $i = $i + 1) {		// ループ処理で商品情報を表示する
	$rec = mysql_fetch_array($result, MYSQL_ASSOC);
	// ↑で$rec['id']に商品番号、$rec['name']に商品名、
	//     $rec['price']に商品価格、$rec['photo']に商品写真のファイル名が入る
	
	if( $name != '' && $name == $rec['name'] && $pass == $rec['pass']){
		$_SESSION['name'] = $name;
		echo 'ログインしました。';
	}
	
}



?>

<br><br>



</center>

<?php
mysql_close($conn);	// MySQLサーバへの接続を切断する
?>
<br><br>
<a href="index.php">トップページに戻る</a>


</body>
</html>
