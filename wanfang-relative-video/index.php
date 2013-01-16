<?php
header("Content-type: text/html; charset=utf-8");
include 'config.php';

if(isset($_POST['submit'])&&($_POST['password']==PASS)){
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
function callback($data){
	return $data>1;
}
$query = 'SELECT sid,title,keyword,rep_result FROM video 
          ORDER BY sid;';
$result = mysql_query($query) or die(mysql_error());
while ($row = mysql_fetch_assoc($result)){
	$rep_result_arr = explode('-', $row['rep_result']);
	$rep_count_values = array_count_values($rep_result_arr);
	//在这里进行重复度过滤，只允许重复性>X的进行计算
	$rep_count_values = array_filter($rep_count_values,callback);
	arsort($rep_count_values);
	
	$rep_sid_value = $rep_count_values;
	$rep_sid_title = $rep_count_values;
	
	foreach ($rep_sid_value as $key => $value){
		$title_q = 'SELECT title FROM video
		            WHERE sid='."'".$key."';";
		$title_result = mysql_query($title_q) or die(mysql_error());
		while ($title_row = mysql_fetch_assoc($title_result)){
			$rep_sid_title[$key] = $title_row['title'];
		}
	}
	
	//针对每一个sid，打印序列提纲格式的结果
	echo '<dl>';
	echo '<dt>'.$row['sid'].'-'.$row['title'].'</dt>';
	foreach ($rep_sid_value as $key => $value){
		echo '<dd>'.$key.'['.$value.']'.'-'.$rep_sid_title[$key].'</dd>';
	}
	echo '</dl>';
	
}

}else{//end of submit
	echo '<form method="post" action="index.php">';
	echo '<input type="password" name="password" size="20">';
	echo '<button type="submit" name="submit">生成相关结果</button>';
	echo '</form>';
}

?>













