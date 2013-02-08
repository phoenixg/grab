<?php
function login($email,$password){
	$login=false;
	$post='member[email]='.urlencode($email).'&member[password]='.urlencode($password);
	$ch = curl_init();
	curl_setopt ($ch, CURLOPT_URL, 'http://www.ifreewind.net/iFreeWind.aspx');
	//curl_setopt($ch,CURLOPT_USERAGENT,$this->useragent);
	curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
	//POST
	curl_setopt($ch,CURLOPT_POST,4);
	curl_setopt($ch,CURLOPT_POSTFIELDS,$post);

	curl_setopt($ch, CURLOPT_HEADER, 1);
	$output=curl_exec($ch);

	//get cookies in map array
	$rows=explode("\n",$output);
	foreach($rows as $num=>$row){
		$trim=substr($row,0,5);
		$trim2=substr($row,0,29);
		if ($trim2=="Location: /public/member/home")$login=true;
		/*  if the site sends back a header redirect my login worked.*/
		if ($trim=="Set-C") {$rownum=$num;}
	}
	$cookies=$rows[$rownum];
	$cookies=substr($cookies,12);/*RAW COOKIE*/
	$cookies=explode("; ",$cookies);
	$arr=array();
	foreach ($cookies as $n=>$v){
		$s=explode("=",$v);
		$arr[$s[0]]=$s[1];
	}
	$cookies=$arr;

	$_SESSION['SN']=$cookies['PHPSESSID'];
	curl_close($ch);
	$_SESSION['auth']=$login;
	return $login;
}//end isLoggedIn












/*
curl_setopt($ch, CURLOPT_URL, $site);
curl_setopt($ch, CURLOPT_TIMEOUT, 6000);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
curl_setopt($ch, CURLOPT_HEADER, FALSE);

//curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
curl_setopt($ch, CURLOPT_POST, TRUE);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_COOKIEFILE, "cookie.txt");
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);//add	

ob_start();
return curl_exec($ch);

ob_end_clean();
curl_close($ch);
unset($ch);
*/













/* 使用说明
login("HTTPfox的URL","HTTPfox的POST DATA的raw内容");//username and password
post_data("HTTPfox的URL","HTTPfox的POST DATA的raw内容");
echo grab_page("http://site.com/");
echo grab_page("http://site.com/test.php?xx=xx");//也可以是特定页面
*/

//worked
//echo post_data("http://www.antiheresy.info/embryo3_nosmarty/issue_add.php","issue_name=curltest2&year=2011&month=01&day=02&hour=03&minute=04&submit=%E6%8F%90%E4%BA%A4");
/*
echo post_data("http://www.ifreewind.net/iFreeWind.aspx",
				"__VIEWSTATE=%2FwEPDwULLTE3NjQ3MDc3NDQPZBYCAgMPZBYCAgEPFgIeB1Zpc2libGVoZBgBBR5fX0NvbnRyb2xzUmVxdWlyZVBvc3RCYWNrS2V5X18WAQUSUmVtZW1iZXJNZUNoZWNrQm94r57YdIUtbSps%2FGLW1PUtjxcILdE%3D&__EVENTVALIDATION=%2FwEWBQLKivfjBgLw2N3fDgLC9%2FChAwLxuKbKAgL%2BjNCfDwU6DJjH4Q2acTlGVXmDrSv2Nn4G&UserNameTextBox=306761352%40qq.com&PasswordTextBox=nihaoma&LoginButton=%E7%99%BB%E9%99%86");
*/



function login($url,$data){
	$fp = fopen("cookie.txt","w");
	fclose($fp);
	$login = curl_init();
	curl_setopt($login, CURLOPT_COOKIEJAR, "cookie.txt");
	curl_setopt($login, CURLOPT_COOKIEFILE, "cookie.txt");
	curl_setopt($login, CURLOPT_TIMEOUT, 40000);
	curl_setopt($login, CURLOPT_RETURNTRANSFER, TRUE);
	curl_setopt($login, CURLOPT_URL, $url);
	curl_setopt($login, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
	curl_setopt($login, CURLOPT_FOLLOWLOCATION, TRUE);
	curl_setopt($login, CURLOPT_POST, TRUE);
	curl_setopt($login, CURLOPT_POSTFIELDS, $data);
	ob_start();
	return curl_exec($login);
	ob_end_clean();
	curl_close($login);
	unset($login);
}

function grab_page($site){
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
	curl_setopt($ch, CURLOPT_TIMEOUT, 40);
	curl_setopt($ch, CURLOPT_COOKIEFILE, "cookie.txt");
	curl_setopt($ch, CURLOPT_URL, $site);
	ob_start();
	return curl_exec($ch);
	ob_end_clean();
	curl_close($ch);
}

function post_data($site, $data){
	$datapost = curl_init();
	$headers = array("Expect:");
	curl_setopt($datapost, CURLOPT_URL, $site);
	curl_setopt($datapost, CURLOPT_TIMEOUT, 40000);
	curl_setopt($datapost, CURLOPT_HEADER, TRUE);
	curl_setopt($datapost, CURLOPT_HTTPHEADER, $headers);
	curl_setopt($datapost, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
	curl_setopt($datapost, CURLOPT_POST, TRUE);
	curl_setopt($datapost, CURLOPT_POSTFIELDS, $data);
	curl_setopt($datapost, CURLOPT_COOKIEFILE, "cookie.txt");
	curl_setopt($datapost, CURLOPT_FOLLOWLOCATION, TRUE);//add	
		
	ob_start();
	return curl_exec($datapost);
	ob_end_clean();
	curl_close($datapost);
	unset($datapost);
}
