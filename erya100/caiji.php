<style>
.have{width:100%;float:left;heihgt:auto;}
.have dt{width:100%;background:#999;}
.have dd{width:100%;background:#ccc;}
.have dd ul{width:100%;background:#f4f4f4;}
.have dd ul li{width:100%;height:auto;list-style:none;}
.have dd ul li h3{width:100%;float:left;}
.have dd ul li em{padding:5px; list-style:none; width:90%; float:right;}
</style>
<?php   

## 只把需要的地方截出来
$a=file_get_contents("http://www.erya100.com"); //远程获取网页内容
$start=strpos($a,'所有学科分类</h2>');//截取位置开始
$end=strpos($a,'<!--banner-con开始-->');//截取位置结束
$b=$end-$start;//计算截取页面大小
$a=substr($a,strpos($a,'所有学科分类</h2>'),$b); //截取网页内容

## 利用preg_replace把$a里面满足正则的地方（比如不要的标签）替换成别的东西
$search = array ( "'<[\/\!]*div[^<>]*?>'si",		//过滤空DIV标签
								"'所有学科分类</h2>'si",	//过滤开始
								"'</a>'si",  //过滤</a>
								"'class=\"last\"'si",
								"'class=\"dropMenu\"'si",
								"'<a'si", 
								"'href=\"'si","'/ztclasslist.aspx[^<>]id='si",
								"'\" target=\"_blank\">'si",
								"'target=\"_blank\"'si",
								"'<dl class=\"have\">'si",
								"'\">'si",
								"'<dt>'si",
								"'<h3>'si",
								"'&#(\d+);'e");                     
$replace = array ("",
								"",
								"",
								"",
								"",
								"",
								"",
								"[",
								"]",
								"",
								"<dl class=\"have\" >","]",
								"<dt>●",
								"<h3>■",
								"chr(\\1)"); 

$htmlcode=preg_replace($search,$replace,$a); 
echo $htmlcode;

/**如果需要显示ID 只需要将其中的链接替换前后标记显示ID即可**/

?>   
