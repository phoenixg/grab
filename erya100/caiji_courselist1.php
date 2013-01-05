<?php

$page      = file_get_contents('http://www.erya100.com/ztclasslist.aspx');
$start     = strpos($page,'<ul class="experts_list">');
$end       = strpos($page,'<div class="pagination lr">');
$len       = $end-$start;
$page      = substr($page, $start, $len); 

echo $page;

$search = array (
				"'<[\/\!]*div[^<>]*?>'si",		//过滤空DIV标签
				"'class=\'(odd|even)\''si",		//过滤odd/even
				"'class=\"(experts_info)\"'si", //过滤expets_info
				"'<[\/\!]*li[^<>]*?>'si",		//过滤空li标签
				"'<[\/\!]*img[^<>]*?>'si",		//过滤空img缩略图标签
				"'<a target=\"_blank\" href=\"\/ztclasslist.aspx[^<>]id='si",	//过滤分类编号前的链接信息
				"'[ \s]class=\"typename\">'si",
				"'\[<em title=\"'si",			//过滤分类编号对应的中文前的信息
				"'<\/em>\]<\/a>'si",		//过滤分类编号对应的中文后的信息
				"'<a target=\"_blank\" href=\"\/videoinfo.aspx[^<>]id='si",		//过滤课程编号前的链接信息
				


);

$replace = array ("",
				  "",
				  "",
				  "",
				  "",
			      "[",
				  "]",
				  "",
				  "",
				  "["
);

$htmlcode=preg_replace($search,$replace,$page); 
echo $htmlcode;



?>


