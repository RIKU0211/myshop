<?php
require('db_data.php');	// データベース操作準備用のファイルを読み込む
?>

<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>データベース内のレコードをすべて表示</title>
</head>
<body background="image/bg.jpg">

<?php
$tables = mysql_list_tables($MySQL_db);
$num_table = mysql_num_rows($tables);
for ($k = 0; $k < $num_table; $k = $k + 1) {
	$table_name = mysql_fetch_array($tables, MYSQL_NUM);
	echo 'テーブル'.$table_name[0].'の中';
	echo '<table border>';
	$result = mysql_query('SELECT * FROM '.$table_name[0]);
	$num_field = mysql_num_fields($result);
	echo '<tr>';
	for ($i = 0; $i < $num_field; $i = $i + 1) {
		$field = mysql_field_name($result, $i);
		echo '<th>'.$field.'</th>';
	}
	echo '</tr>';
	$num_record = mysql_num_rows($result);
	for ($j = 0; $j < $num_record; $j = $j + 1) {
		$record = mysql_fetch_array($result, MYSQL_BOTH);
		echo '<tr>';
		for ($i = 0; $i < $num_field; $i = $i + 1) {
			echo '<td>'.$record[$i].'</td>';
		}
		echo '</tr>';
	}
echo '</table>';
echo '<br><hr><br>';
}


mysql_close($conn);	// MySQLサーバへの接続を切断する
?>

<a href="index.php">トップページへ戻る</a>

</body>
</html>
