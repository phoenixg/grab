<?php
//header("Content-type: text/html; charset=utf-8");

$db_host = 'localhost';
$db_user = 'root';
$db_pass = '123456';
$db_name = 'relativevideo';

$connect = mysql_connect($db_host, $db_user, $db_pass);
mysql_select_db($db_name) or die(mysql_error());
mysql_query('SET NAMES UTF8');
mysql_query('UPDATE video SET rep_result='."'';") or die(mysql_error());

/* 外循环：查找出video所有字段的所有记录，针对每一行记录做处理 */
$query = 'SELECT sid,title,keyword,rep_result 
          FROM video 
          ORDER BY sid ASC;';
$result = mysql_query($query) or die(mysql_error());
while ($row = mysql_fetch_array($result,MYSQL_ASSOC)){
	$s = $row['sid'];
	$t = $row['title'];
	$k = $row['keyword'];
	
	$arr = null;
	$arr = explode(' ', $k);//$arr[0]->key1,$arr[1]->key2,...
	/* 第一层内循环：针对每一单个keyword，做处理 */
	foreach ($arr as $key=>$value){
		$inner_q = 'SELECT sid FROM video 
		            WHERE keyword like '."'%".$value."%';";
		$inner_result = mysql_query($inner_q) or die(mysql_error());
		$sids = '';
		while ($inner_row = mysql_fetch_assoc($inner_result)){
			$sids .= $inner_row['sid'].'-';
		}	
	}
	
	$update_q = 'UPDATE video SET rep_result='."'".$sids."' 
	             WHERE sid='".$s."';";
	echo $update_q .'<br/>';
	mysql_query($update_q);

	
}

mysql_free_result($result);








?>