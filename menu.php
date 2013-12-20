<?php
require('db_data.php');	// データベース操作準備用のファイルを読み込む


// セッション管理をする宣言（セッション変数を使うための準備）
session_start();

?>

<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>メニュー一覧</title>
</head>
<body background="image/bg.jpg">

<center>

<h1>KINGDOM HEARTS：MENU</h1>

<?php
	echo 'アカウント名：'.$_SESSION['name'];
	echo '<br>';
	if($_SESSION['name'] != ''){	
		echo '<a href="rogout.php">ログアウト</a>';
	}else if($_SESSION['name'] == ''){
		echo '<a href="rogin.php">ログイン</a>';
	}
?>

<br><br>

<table border="1">
<tr>
	<th><a href="products.php">GAME</a></th>
	<th>ゲームソフト一覧を<br>表示します。</th>
</tr>

<tr>
	<th><a href="goods.php">GOODS</a></th>
	<th>KH関連グッズ一覧を<br>表示します。</th>
</tr>
</table>

</center>

<?php
mysql_close($conn);	// MySQLサーバへの接続を切断する
?>
<br><br>
<a href="index.php">トップページに戻る</a>

</body>
</html>
