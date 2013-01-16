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
	if (!empty($keys)){
		unset($keys);
	}
	$keys = explode(' ', $k);
	
	/* 采取sql查询方式进行关键词查找 */
	if (!empty($rep_result)){
		unset($rep_result);
	}
	foreach ($keys as $key => $value){
		$k_q = 'SELECT sid FROM video 
                WHERE keyword like '."'%".$value."%';";
		$k_r = mysql_query($k_q) or die(mysql_error());
		while ($k_row = mysql_fetch_assoc($k_r)){
			$rep_result[] = $k_row['sid'];
		}	
	}
	mysql_free_result($k_r);
	
	/* 先去掉自己的sid，再把数组转成字符串存入数据库 */
	$selfsid = array_keys($rep_result, $s);
	foreach($selfsid as $key => $value){
		unset($rep_result[$value]);
	}
	
	$rep_result_string = implode('-', $rep_result);
	
	$update_q = 'UPDATE video SET rep_result='."'".$rep_result_string."' 
                 WHERE sid='".$s."';";
	mysql_query($update_q) or die(mysql_error());
}

mysql_free_result($result);

/* 进行重复性计算 */
$query = 'SELECT sid,title,keyword,rep_result FROM video 
          ORDER BY sid;';
$result = mysql_query($query) or die(mysql_error());
while ($row = mysql_fetch_assoc($result)){
	$rep_result_arr = explode('-', $row['rep_result']);
	print_r(arsort(array_count_values($rep_result_arr)));
	echo '<br/>';
}



?>













