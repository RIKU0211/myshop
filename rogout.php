<?php
require('db_data.php');	// データベース操作準備用のファイルを読み込む


// セッション管理をする宣言（セッション変数を使うための準備）
session_start();
unset($_SESSION['name']);

?>

<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>ログアウト</title>
</head>
<body background="image/bg.jpg">

<center>

<h1>KINGDOM HEARTS：ログアウト</h1>

ログアウトしました

<br><br>



</center>

<?php
mysql_close($conn);	// MySQLサーバへの接続を切断する
?>
<br><br>
<a href="index.php">トップページに戻る</a>

</body>
</html>
