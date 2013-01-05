<?php
//获取所有链接内容和地址
function getAllURL($code){
preg_match_all('/<a\s+href=["|\']?([^>"\' ]+)["|\']?\s*[^>]*>([^>]+)<\/a>/i',$code,$arr);
return array('link_name'=>$arr[2],'link_addr'=>$arr[1]);
}

/* eg.
 * var_dump(getAllURL('<a href="http://g.cn/">google</a>words<a href="http://baidu.com/">baidu</a>'));
 * 返回
array
  'link_name' => 
    array
      0 => string 'google' (length=6)
      1 => string 'baidu' (length=5)
  'link_addr' => 
    array
      0 => string 'http://g.cn/' (length=12)
      1 => string 'http://baidu.com/' (length=17)

 */

//获取所有的图片地址
function getImgSrc($code){
$reg = "/]*src=\"(http:\/\/(.+)\/(.+)\.(jpg|gif|bmp|bnp|png|jpeg))\"/isU";
preg_match_all($reg, $code, $img_array, PREG_PATTERN_ORDER);
return $img_array[1];
}

/* eg.
 * var_dump(getImgSrc('src="http://domain.com/test.jpg"'));
 * 返回
 *array
  	0 => string 'http://domain.com/test.jpg' (length=26)
 */

//当前的脚本网址
function getSelfURL(){
if(!empty($_SERVER["REQUEST_URI"])){
$scriptName = $_SERVER["REQUEST_URI"];
$nowurl = $scriptName;
}else{
$scriptName = $_SERVER["PHP_SELF"];
if(empty($_SERVER["QUERY_STRING"])) $nowurl = $scriptName;
else $nowurl = $scriptName."?".$_SERVER["QUERY_STRING"];
}
return $nowurl;
}

//把全角数字转为半角数字
function getAlabNum($fnum){
$nums = array("０","１","２","３","４","５","６","７","８","９");
$fnums = "0123456789";
for($i=0;$i<=9;$i++) $fnum = str_replace($nums[$i],$fnums[$i],$fnum);
$fnum = ereg_replace("[^0-9\.]|^0{1,}","",$fnum);
if($fnum=="") $fnum=0;
return $fnum;
}

//去除HTML标记
function text2Html($txt){
$txt = str_replace(" ","　",$txt);
$txt = str_replace("<","<",$txt);
$txt = str_replace(">",">",$txt);
$txt = preg_replace("/[\r\n]{1,}/isU","<br/>\r\n",$txt);
return $txt;
}

//清除HTML标记
function clearHtml($str){
$str = str_replace('<','<',$str);
$str = str_replace('>','>',$str);
return $str;
}

//相对路径转化成绝对路径
function relative2Absolute($content, $feed_url) {
preg_match('/(http|https|ftp):\/\//', $feed_url, $protocol);
$server_url = preg_replace("/(http|https|ftp|news):\/\//", "", $feed_url);
$server_url = preg_replace("/\/.*/", "", $server_url);
if ($server_url == '') {
return $content;
}
if (isset($protocol[0])) {
$new_content = preg_replace('/href="\//', 'href="'.$protocol[0].$server_url.'/', $content);
$new_content = preg_replace('/src="\//', 'src="'.$protocol[0].$server_url.'/', $new_content);
} else {
$new_content = $content;
}
return $new_content;
}

//获取指定标记中的内容
function getTagData($str, $start, $end){
if ( $start == '' || $end == '' ){
return;
}
$str = explode($start, $str);
$str = explode($end, $str[1]);
return $str[0];
}

//HTML表格的每行转为CSV格式数组
function getTrArray($table) {
$table = preg_replace("'<td[^>]*?>'si",'"',$table);
$table = str_replace("</td>",'",',$table);
$table = str_replace("</tr>","{tr}",$table);
	//去掉 HTML 标记
$table = preg_replace("'<[\/\!]*?[^<>]*?>'si","",$table);
	//去掉空白字符
$table = preg_replace("'([\r\n])[\s]+'","",$table);
$table = str_replace(" ","",$table);
$table = str_replace(" ","",$table);
$table = explode(",{tr}",$table);
array_pop($table);
return $table;
}

//将HTML表格的每行每列转为数组，采集表格数据
function getTdArray($table) {
$table = preg_replace("'<table[^>]*?>'si","",$table);
$table = preg_replace("'<tr[^>]*?>'si","",$table);
$table = preg_replace("'<td[^>]*?>'si","",$table);
$table = str_replace("</tr>","{tr}",$table);
$table = str_replace("</td>","{td}",$table);
	//去掉 HTML 标记
$table = preg_replace("'<[\/\!]*?[^<>]*?>'si","",$table);
	//去掉空白字符
$table = preg_replace("'([\r\n])[\s]+'","",$table);
$table = str_replace(" ","",$table);
$table = str_replace(" ","",$table);
$table = explode('{tr}', $table);
array_pop($table);
foreach ($table as $key=>$tr) {
$td = explode('{td}', $tr);
array_pop($td);
$td_array[] = $td;
}
return $td_array;
}

//返回字符串中的所有单词 $distinct=true 去除重复
function splitEnStr($str,$distinct=true) {
preg_match_all('/([a-zA-Z]+)/',$str,$match);
if ($distinct == true) {
$match[1] = array_unique($match[1]);
}
sort($match[1]);
return $match[1];
}




?>











