<style>
a{width:100%;color:red;}
</style>
<?php
$do=$_GET["do"];
if($do == "content"){
	$url=$_GET["url"];
}
if($do == "cj"){
	@set_time_limit(0);  //������ҳ����ʱ�䣬����0Ϊ����
	//�ɼ���ҳ��ַ
	$url=$_GET["url"];//��ȡ�ɼ����ӵ�ַ
	$num=$_GET["num"];//��ȡ��ҳ����
	$start=$_GET["start"];
	$end=$_GET["end"];
	$i=0;//��ҳ������ʼ��
	$page=$_GET["page"];
	if($page == "1"| !$page){
		$b=$url;
		$b=file_get_contents($b);
		$start=strpos($b,$start);
		$end=strpos($b,$end);
		$content=$end-$start;
		$b=substr($b,$start,$content);
		//echo $b;
		$search = array ( "'<[\/\!]*div[^<>]*?>'si",//����DIV��� 
                "'experts_list\">'si",
				"'<div class=\"'si",
				"'<li class=\"e_img\">.*?]</a>'si",
				"'<font[^>]*?>.*?</font>'si",
				"'<li class=\"e_disease\">.*?</li>'si",
				"'<li class=\"e_uptime\">.*?</li>'si",
				 "'<[\/\!]*li[^<>]*?>'si",//����DIV���
				  "'<[\/\!]*ul[^<>]*?>'si",//����DIV���
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
		echo"<a href=\"?do=cj&url=".$url."&page=2&num=".$num."&start=".$start."&end=$end\" target=_self>�ɼ���һҳ</a>";
	}elseif($page == $num){
		$url=$url."page=".$page;
		$b=$url;
		$b=file_get_contents($b);
		$start=strpos($b,$start);
		$end=strpos($b,$end);
		$content=$end-$start;
		$b=substr($b,$start,$content);
$search = array ( "'<[\/\!]*div[^<>]*?>'si",//����DIV��� 
				"'����ѧ�Ʒ���</h2>'si",
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
        $replace = array ("","","","","","","","[","]","","<dl class=\"have\" >","]","<dt>��","<h3>��","chr(\\1)"); 
        $show_content=preg_replace($search,$replace,$b); 
       $htmlcode=preg_replace($search,$replace,$show_content); 
echo $htmlcode;
		echo "��Ϣ�ɼ����:<a href=\"caiji3.php\">���زɼ���ҳ</a>";
	}else{
		$spage=$page+1;
		$url=$url."page=".$page;
		$b=$url;
		$b=file_get_contents($b);
		$start=strpos($b,$start);
		$end=strpos($b,$end);
		$content=$end-$start;
		$b=substr($b,$start,$content);
$search = array ( "'<[\/\!]*div[^<>]*?>'si",//����DIV��� 
				"'����ѧ�Ʒ���</h2>'si",
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
        $replace = array ("","","","","","","","[","]","","<dl class=\"have\" >","]","<dt>��","<h3>��","chr(\\1)"); 
        $show_content=preg_replace($search,$replace,$b); 
       $htmlcode=preg_replace($search,$replace,$show_content); 
echo $htmlcode;
		echo"<a href=\"?do=cj&url=".$url."&page=".$spage."&num=".$num."&start=".$start."&end=$end\" target=_self>�ɼ���һҳ</a>";
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
	��������Ҫ�ɼ���ҳ���ַ��<input name="url" type="text" value="" size="200" /><br />
	��������Ҫ�ɼ��ķ�ҳ������<input name="num" type="text" value="1" size="5" /><br />
	��������Ҫ�ɼ���ҳ�����ʼ����ַ���<input name="start" type="text" value="experts_list" size="200" /><br />
	��������Ҫ�ɼ���ҳ��Ľ�������ַ���<input name="end" type="text" value="pagination lr" size="200" /><br />
	<input type="submit" value="��ʼ�ɼ�" />
</form>
<?

/*$url="http://www.erya100.com/ztclasslist.aspx?id=040101&page=";//�ɼ����ӵ�ַ��*�������ҳ����
$b=11;//��ҳ����
$i=0;//��ʼ�� 
for($i=1;$i<$b+1;$i++){//��ҳѭ��
$url=$url+$i;//�滻�ɼ����ӵ�ַ
echo $url."<br>";
}
/*
$a=file_get_contents("http://www.erya100.com"); //Զ�̻�ȡ��ҳ����
$start=strpos($a,'����ѧ�Ʒ���</h2>');//��ȡλ�ÿ�ʼ
$end=strpos($a,'<!--banner-con��ʼ-->');//��ȡλ�ý���
$b=$end-$start;//�����ȡҳ���С
$a=substr($a,strpos($a,'����ѧ�Ʒ���</h2>'),$b); //��ȡ��ҳ����
$search = array ( "'<[\/\!]*div[^<>]*?>'si",//����DIV��� 
				"'����ѧ�Ʒ���</h2>'si",
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
        $replace = array ("","","","","","","","[","]","","<dl class=\"have\" >","]","<dt>��","<h3>��","chr(\\1)"); 
        $show_content=preg_replace($search,$replace,$a); 
       $htmlcode=preg_replace($search,$replace,$show_content); 
echo $htmlcode;
*/
/**�����Ҫ��ʾID ֻ��Ҫ�����е������滻ǰ������ʾID����**/

?>   
