<?php
/* 1 [function.file-get-contents]: failed to open stream: HTTP request failed! google 
 * 2 040101 [<em title="中国古代史,南京师范大学,1320,2011-04-26<br /> 未匹配到 很靠前的课程
 * 3 03 [<em title="文学,北京大学,1429,2011-04-25<br /> 同上
 * 4 0505 [<em title="逻辑学,清华大学心理学与认知科学研究中心,50987,2011-04-19<br /> 同上
 * 5 090113 [<em title="矿业工程   ">矿业工程</em>]</a>3749,煤层气资源前景与地质特征,宋  岩">宋  岩</span>, 同上以及span的问题
 * 
 * */
$num = 264; //页码
set_time_limit(0); 
for($i=1;$i<=$num;$i++){
	$page      = file_get_contents("http://www.erya100.com/ztclasslist.aspx?page=$i");
	$start     = strpos($page,'<ul class="experts_list">');
	$end       = strpos($page,'<div class="pagination lr">');
	$len       = $end-$start;
	$page      = substr($page, $start, $len); 
	
	$search = array (
					"'<[\/\!]*div[^<>]*?>'si",		//过滤空DIV标签
					"'<ul class=\"experts_list\">'si", //过滤experts_list
					"'class=\'(odd|even)\''si",		//过滤odd/even
					"'class=\"(experts_info)\"'si", //过滤expets_info
					"'<li class=\"e_img\">(.*?)<\/li>'si",	//过滤缩略图
					"'class=\"e_title\"><a target=\"_blank\" href=\"\/ztclasslist.aspx\?id='si",
					"'\"class=\"typename\"'si",
					"'<li\s+(\d+)[^>]+>'si",
					"'\s+\[<em title=\"(\S*|\s*)?\">(.*?)<\/em>\]<\/a>'si", //换成title里的内容
					"'\s+<a target=\"_blank\" href=\"\/videoinfo.aspx\?id='si",
					"'\"\s+class=\"title\" title=\''si",
					"'\'>\s+[^<]+<\/a><font>'si",
					"'\s+\[<span title=\"'si",
					"'\">(\S+)<\/span>'si",
					"'\s+<span title=\"'si",
					"'\]<\/font>\s+<\/li>'si",
					"'\s+<li class=\"e_disease\">(\S+)'si",
					"'<\/strong> <font>\s+'si",
					"'\s+<a[^>]+class=\"hide\">[\s\S]+?<strong>'si",
					"'<\/font><\/a><\/li>'si",
					"'\s+<ul >'si",
					"'\s+<\/ul>'si",
					"'\s+<li >'si",
					"'\s+<\/li>'si"

	);
	
	$replace = array (
					"",
					"",
					"",
					"",
					"",
					"",
					"",
					"$1,",				
					"$1,",
					"",
					",",
					"",
					",",
					"",
					",",
					"",
					",",
					",",
					"",
					"",
					"",
					"<br />",
					"",
					""
	);
	
	$htmlcode[]=preg_replace($search,$replace,$page); 
}

foreach ($htmlcode as $record){
	$htmlcode = str_replace("<br /><br />", "<br />", $record);
	echo $htmlcode;
}





?>


