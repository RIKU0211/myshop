<?php
// データベース操作準備用ファイル

// このファイルはデータベース操作を行うファイルにrequire関数で読み込まれる
// （それぞれのファイルにいちいち下記の内容を書く手間が省ける）


// -----DBを操作するためのホスト名やユーザ名などを設定する------------
$MySQL_host = 'localhost';		// データベースはローカルホストにある（この行は書き換えない）
$MySQL_user = 'm0111484';		// 自分のユーザ名（学籍番号）に書き換える
$MySQL_pass = 'm0111484';		// 自分のパスワード（学籍番号）に書き換える
$MySQL_db 	= 'm0111484';			// データベース名（学籍番号）に書き換える
// -------------------------------------------------------------------


// -----MySQLサーバに接続する-----------------------------------------
$conn = mysql_connect($MySQL_host, $MySQL_user, $MySQL_pass);
if (mysql_errno() != 0) {
	die('MySQL接続に失敗しました');
} else {
	mysql_query('SET NAMES utf8');	// 文字コードにUTF-8を使う宣言
}
// -------------------------------------------------------------------


// -----データベースを選択する----------------------------------------
$selectdb = mysql_select_db($MySQL_db);
if (mysql_errno() != 0) {
	die('データベース選択に失敗しました');
}
// -------------------------------------------------------------------
?>