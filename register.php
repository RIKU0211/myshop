<?php
require('db_data.php');	// データベース操作準備用のファイルを読み込む

?>

<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>ユーザ情報登録</title>
</head>
<body background="image/bg.jpg">

<?php
// -----確認ページconfirm.phpから送られてきたデータを変数に入れる-----
$name = $_POST['name'];		// 名前
$pass = $_POST['pass'];		// パスワード
$fullAddr = $_POST['addr'];		// 住所
$fullMail = $_POST['mail'];		// メールアドレス
// -------------------------------------------------------------------


// -----入力データをテーブルuserに挿入するクエリを作って登録する----
$query = 'INSERT INTO user SET name="'.$name.'", pass="'.$pass.'", addr="'.$fullAddr.'", mail="'.$fullMail.'"';

$result = mysql_query($query);	// クエリの送信

echo $fullAddr;
echo $fullMail;

if (mysql_errno() != 0) {
	echo '登録できませんでした';
} else {
	echo 'ご登録ありがとうございました';
}
// -------------------------------------------------------------------


mysql_close($conn);	// MySQLサーバへの接続を切断する

?>
<br><br>
<a href="index.php">トップページに戻る</a>

</body>
</html>
