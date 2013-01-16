<?php
//header("Content-type: text/html; charset=utf-8");

/* 设置数据库信息 */
$db_host = 'localhost';
$db_user = 'root';
$db_pass = '123456';
$db_name = 'relativevideo';

/* 设置数据库连接，清空rep_result字段 */
$connect = mysql_connect($db_host, $db_user, $db_pass);
mysql_select_db($db_name) or die(mysql_error());
mysql_query('SET NAMES UTF8');
mysql_query('UPDATE video SET rep_result='."'';") or die(mysql_error());

/* 外循环 */
$query = 'SELECT sid,title,keyword,rep_result 
          FROM video 
          ORDER BY sid ASC;';
$result = mysql_query($query) or die(mysql_error());
while ($row = mysql_fetch_array($result,MYSQL_ASSOC)){
	$s = $row['sid'];
	$t = $row['title'];
	$k = $row['keyword'];
	
	/* 将keyword字符串转成$arr数组 */

	echo $keys;
	//$keys = explode(' ', $k);
}

?>