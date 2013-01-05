<style>
a{width:100%;color:red;}
</style>
<?php
$do=$_GET["do"];
if($do == "content"){
	$url=$_GET["url"];
}
if($do == "cj"){
	@set_time_limit(0);  //设置网页运行时间，其中0为不限
	//采集首页地址
	$url=$_GET["url"];//获取采集连接地址
	$num=$_GET["num"];//获取分页数量
	$start=$_GET["start"];
	$end=$_GET["end"];
	$i=0;//分页数量初始化
	$page=$_GET["page"];
	if($page == "1"| !$page){
		$b=$url;
		$b=file_get_contents($b);
		$start=strpos($b,$start);
		$end=strpos($b,$end);
		$content=$end-$start;
		$b=substr($b,$start,$content);
		//echo $b;
		$search = array ( "'<[\/\!]*div[^<>]*?>'si",//过滤DIV标记 
                "'experts_list\">'si",
				"'<div class=\"'si",
				"'<li class=\"e_img\">.*?]</a>'si",
				"'<font[^>]*?>.*?</font>'si",
				"'<li class=\"e_disease\">.*?</li>'si",
				"'<li class=\"e_uptime\">.*?</li>'si",
				 "'<[\/\!]*li[^<>]*?>'si",//过滤DIV标记
				  "'<[\/\!]*ul[^<>]*?>'si",//过滤DIV标记
				  "'href=\"/'si",
				"'&#(\d+);'e");                     
        $replace = array ("","","","","","","","","","href=\"http://www.erya100.com/","chr(\\1)"); 
        $show_content=preg_replace($search,$replace,$b); 
       $htmlcode=preg_replace($search,$replace,$show_content); 
		preg_match_all("/href=\"(.*?)\"/is",$htmlcode,$list);
		$count = count($list[1]);
		$i=0;
		for($i=0;$i<$count;$i++){
			$curl = $list[1][$i];
			$curl =file_get_contents($curl);
			/*$start=strpos($curl,$startt);
			$end=strpos($curl,$endd);
			$countent=$endd-$startt;
			$curl=substr($curl,$startt,$countent);*/
			echo $curl;
		}
		echo"<a href=\"?do=cj&url=".$url."&page=2&num=".$num."&start=".$start."&end=$end\" target=_self>采集下一页</a>";
	}elseif($page == $num){
		$url=$url."page=".$page;
		$b=$url;
		$b=file_get_contents($b);
		$start=strpos($b,$start);
		$end=strpos($b,$end);
		$content=$end-$start;
		$b=substr($b,$start,$content);
$search = array ( "'<[\/\!]*div[^<>]*?>'si",//过滤DIV标记 
				"'所有学科分类</h2>'si",
				"'</a>'si", 
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
        $replace = array ("","","","","","","","[","]","","<dl class=\"have\" >","]","<dt>●","<h3>■","chr(\\1)"); 
        $show_content=preg_replace($search,$replace,$b); 
       $htmlcode=preg_replace($search,$replace,$show_content); 
echo $htmlcode;
		echo "信息采集完毕:<a href=\"caiji3.php\">返回采集首页</a>";
	}else{
		$spage=$page+1;
		$url=$url."page=".$page;
		$b=$url;
		$b=file_get_contents($b);
		$start=strpos($b,$start);
		$end=strpos($b,$end);
		$content=$end-$start;
		$b=substr($b,$start,$content);
$search = array ( "'<[\/\!]*div[^<>]*?>'si",//过滤DIV标记 
				"'所有学科分类</h2>'si",
				"'</a>'si", 
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
        $replace = array ("","","","","","","","[","]","","<dl class=\"have\" >","]","<dt>●","<h3>■","chr(\\1)"); 
        $show_content=preg_replace($search,$replace,$b); 
       $htmlcode=preg_replace($search,$replace,$show_content); 
echo $htmlcode;
		echo"<a href=\"?do=cj&url=".$url."&page=".$spage."&num=".$num."&start=".$start."&end=$end\" target=_self>采集下一页</a>";
	}
/*	for($i=1;$i<$num+1;$i++){
		$b=$url.$i;
		$b=file_get_contents($b);
		$start=strpos($b,$start);
		$end=strpos($b,$end);
		$content=$end-$start;
		$b=substr($b,$start,$content);
		echo $b;
	}*/
}else{
?>
<form action="?">
	<input type="hidden" name="do" value="cj" />
	请输入需要采集的页面地址：<input name="url" type="text" value="" size="200" /><br />
	请输入需要采集的分页数量：<input name="num" type="text" value="1" size="5" /><br />
	请输入需要采集的页面的起始标记字符：<input name="start" type="text" value="experts_list" size="200" /><br />
	请输入需要采集的页面的结束标记字符：<input name="end" type="text" value="pagination lr" size="200" /><br />
	<input type="submit" value="开始采集" />
</form>
<?

/*$url="http://www.erya100.com/ztclasslist.aspx?id=040101&page=";//采集连接地址（*）代表分页函数
$b=11;//分页数量
$i=0;//初始化 
for($i=1;$i<$b+1;$i++){//分页循环
$url=$url+$i;//替换采集连接地址
echo $url."<br>";
}
/*
$a=file_get_contents("http://www.erya100.com"); //远程获取网页内容
$start=strpos($a,'所有学科分类</h2>');//截取位置开始
$end=strpos($a,'<!--banner-con开始-->');//截取位置结束
$b=$end-$start;//计算截取页面大小
$a=substr($a,strpos($a,'所有学科分类</h2>'),$b); //截取网页内容
$search = array ( "'<[\/\!]*div[^<>]*?>'si",//过滤DIV标记 
				"'所有学科分类</h2>'si",
				"'</a>'si", 
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
        $replace = array ("","","","","","","","[","]","","<dl class=\"have\" >","]","<dt>●","<h3>■","chr(\\1)"); 
        $show_content=preg_replace($search,$replace,$a); 
       $htmlcode=preg_replace($search,$replace,$show_content); 
echo $htmlcode;
*/
/**如果需要显示ID 只需要将其中的链接替换前后标记显示ID即可**/

?>   
