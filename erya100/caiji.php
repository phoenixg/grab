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

## ֻ����Ҫ�ĵط��س���
$a=file_get_contents("http://www.erya100.com"); //Զ�̻�ȡ��ҳ����
$start=strpos($a,'����ѧ�Ʒ���</h2>');//��ȡλ�ÿ�ʼ
$end=strpos($a,'<!--banner-con��ʼ-->');//��ȡλ�ý���
$b=$end-$start;//�����ȡҳ���С
$a=substr($a,strpos($a,'����ѧ�Ʒ���</h2>'),$b); //��ȡ��ҳ����

## ����preg_replace��$a������������ĵط������粻Ҫ�ı�ǩ���滻�ɱ�Ķ���
$search = array ( "'<[\/\!]*div[^<>]*?>'si",		//���˿�DIV��ǩ
								"'����ѧ�Ʒ���</h2>'si",	//���˿�ʼ
								"'</a>'si",  //����</a>
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
								"<dt>��",
								"<h3>��",
								"chr(\\1)"); 

$htmlcode=preg_replace($search,$replace,$a); 
echo $htmlcode;

/**�����Ҫ��ʾID ֻ��Ҫ�����е������滻ǰ������ʾID����**/

?>   
