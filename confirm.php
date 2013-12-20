<?php

// セッション管理をする宣言（セッション変数を使うための準備）
session_start();

?>

<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>ユーザ情報確認</title>
</head>
<body background="image/bg.jpg">

<?php
// -----入力ページinput.htmlで入力されたデータを変数に入れる----------
$_SESSION['name'] = $_POST['name'];		// 名前
$_SESSION['pass1'] = $_POST['pass1'];	// パスワード1
$pass2 = $_POST['pass2'];	// 確認用パスワード
$pref = $_POST['pref'];		// 都道府県
$addr = $_POST['addr'];		// 住所
$mail = $_POST['mail'];		// メールアドレス
$domain = $_POST['domain'];	// ドメイン名
// -------------------------------------------------------------------

// 何も入力されなかったら
if($_SESSION['name'] == null || $_SESSION['pass1'] == null || $addr == null || $mail == null){
	echo 'エラーが起きました。';
?>
	<form action="input.html" method="post">
	<input type="submit" value="戻る">
	</form>
<?php
}else if(mb_strlen($_SESSION['pass1']) < 6){	// パスワードが６文字より少なかったら
	echo 'パスワードは６文字以上入力してください。';
?>
	<form action="input.html" method="post">
	<input type="submit" value="戻る">
	</form>
<?php
	
}else if($_SESSION['pass1'] != $pass2){
	echo '入力したパスワードに誤りがあります。';
?>
	<form action="input.html" method="post">
	<input type="submit" value="戻る">
	</form>
<?php
	
}else{
$fullAddr = $pref.$addr;
$fullMail = $mail.$domain;
?>

入力情報をご確認ください

<br><br>

<!-- 入力されたデータの表示 -->
<table>
	<tr>
		<td>名前</td>
		<td><?php echo $_SESSION['name'] ?></td>
	</tr>
	<tr>
		<td>パスワード</td>
		<td><?php echo $_SESSION['pass1'] ?></td>
	</tr>
	<tr>
		<td>住所</td>
		<td><?php echo $fullAddr ?></td>
	</tr>
	<tr>
		<td>メールアドレス</td>
		<td><?php echo $fullMail ?></td>
	</tr>
</table>

<br>
この内容でよろしければ「登録」ボタンを押してください
<br>

<!-- 入力されたデータを登録ページregister.phpへ送る -->
<form action="register.php" method="post">
		<input type="hidden" name="name" value="<?php echo $_SESSION['name'] ?>">
		<input type="hidden" name="pass" value="<?php echo $_SESSION['pass1'] ?>">
		<input type="hidden" name="addr" value="<?php echo $fullAddr ?>">
		<input type="hidden" name="mail" value="<?php echo $fullMail ?>">
		<input type="submit" value="登録">
</form>

<!-- 入力ページへ戻る -->
<form action="input.php" method="post">
	<input type="submit" value="戻る">
</form>

<?php } ?>

</body>
</html>
