<?php
require_once('../FirePHPCore/FirePHP.class.php');
require_once('../simplehtmldom/simple_html_dom.php');
//ob_start();
$firephp = FirePHP::getInstance(true);
//$firephp->log('test');


$cookie_file = tempnam('./temp','cookie');
$login_url = 'http://www.ifreewind.net/iFreeWind.aspx';
$post_fields = '__VIEWSTATE=%2FwEPDwULLTE3NjQ3MDc3NDQPZBYCAgMPZBYCAgEPFgIeB1Zpc2libGVoZBgBBR5fX0NvbnRyb2xzUmVxdWlyZVBvc3RCYWNrS2V5X18WAQUSUmVtZW1iZXJNZUNoZWNrQm94r57YdIUtbSps%2FGLW1PUtjxcILdE%3D&__EVENTVALIDATION=%2FwEWBQLKivfjBgLw2N3fDgLC9%2FChAwLxuKbKAgL%2BjNCfDwU6DJjH4Q2acTlGVXmDrSv2Nn4G&UserNameTextBox=306761352%40qq.com&PasswordTextBox=°æ√‹¬Î°ø&LoginButton=%E7%99%BB%E9%99%86';

$ch = curl_init($login_url);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_file);
curl_setopt($ch, CURLOPT_POSTFIELDS, $post_fields);
curl_exec($ch);
curl_close($ch);

//$url = 'http://www.ifreewind.net/Users/Index.aspx';
$url = 'http://www.ifreewind.net/Users/Search.aspx?R=1&P=00102&AT=25&C=00102004';

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_file);

$contents = curl_exec($ch);
/* str_replace way
$search = array('<script src="/', 
				'<link href="/',
				'<a href="/',
//				'<img src="/',
				'src="/');
$d = 'http://www.ifreewind.net';
$replace = array('<script src="'.$d.'/', 
				 '<link href="'.$d.'/', 
				 '<a href="'.$d.'/', 
//				 '<img src="'.$d.'/', 
				 'src="'.$d.'/');
$result = str_replace($search, $replace, $contents);

echo $result;
*/

curl_close($ch);

$html = str_get_html($contents);

foreach ($html->find('img') as $element) {
	$element->src = 'http://www.ifreewind.net' . $element->src;
}

foreach ($html->find('script') as $element) {
	$element->src = 'http://www.ifreewind.net' . $element->src;
}

foreach ($html->find('link') as $element) {
	$element->href = 'http://www.ifreewind.net' . $element->href;
}

echo $html;





$html->clear();
unset($html);












