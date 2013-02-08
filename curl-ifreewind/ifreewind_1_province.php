<?php
require_once('../FirePHPCore/FirePHP.class.php');
require_once('../simplehtmldom/simple_html_dom.php');
//ob_start();
$firephp = FirePHP::getInstance(true);
//$firephp->log('test');


$cookie_file = tempnam('./temp','cookie');
$login_url = 'http://www.ifreewind.net/iFreeWind.aspx';
$post_fields = '__VIEWSTATE=%2FwEPDwULLTE3NjQ3MDc3NDQPZBYCAgMPZBYCAgEPFgIeB1Zpc2libGVoZBgBBR5fX0NvbnRyb2xzUmVxdWlyZVBvc3RCYWNrS2V5X18WAQUSUmVtZW1iZXJNZUNoZWNrQm94r57YdIUtbSps%2FGLW1PUtjxcILdE%3D&__EVENTVALIDATION=%2FwEWBQLKivfjBgLw2N3fDgLC9%2FChAwLxuKbKAgL%2BjNCfDwU6DJjH4Q2acTlGVXmDrSv2Nn4G&UserNameTextBox=306761352%40qq.com&PasswordTextBox=【密码】&LoginButton=%E7%99%BB%E9%99%86';

$ch = curl_init($login_url);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_file);
curl_setopt($ch, CURLOPT_POSTFIELDS, $post_fields);
curl_exec($ch);

$info = curl_getinfo($ch);
echo 'Took ' . $info['total_time'] . ' seconds for address: ' .$info['url'] . ' done! <br />';

curl_close($ch);

$province_arr = array(
				"00101"=>"北京",
				"00102"=>"上海",
				"00103"=>"天津",
				"00104"=>"重庆",
				"00105"=>"河北",
				"00106"=>"山西",
				"00107"=>"内蒙古",
				"00108"=>"福建",
				"00109"=>"吉林",
				"00110"=>"黑龙江",
				"00111"=>"江苏",
				"00112"=>"浙江",
				"00113"=>"安徽",
				"00114"=>"辽宁",
				"00115"=>"江西",
				"00116"=>"山东",
				"00117"=>"河南",
				"00118"=>"湖北",
				"00119"=>"湖南",
				"00120"=>"广东",
				"00121"=>"广西",
				"00122"=>"海南",
				"00123"=>"四川",
				"00124"=>"贵州",
				"00125"=>"云南",
				"00126"=>"西藏",
				"00127"=>"陕西",
				"00128"=>"甘肃",
				"00129"=>"宁夏",
				"00130"=>"青海",
				"00131"=>"新疆",
				"00150"=>"香港",
				"00151"=>"澳门",
				"00152"=>"台湾",
				"00180"=>"国外"
			);
$size = 5;
$province_arr_chunked = array_chunk($province_arr, $size, true);
$url_base = 'http://www.ifreewind.net/Users/Search.aspx?P=';
foreach ($province_arr_chunked as $piece) {
	$nodes = array();
	$codes = array();
	foreach ($piece as $code => $province) {
		$nodes[] = $url_base . $code;
		$codes[] = $code;	
	}
	$node_count = count($nodes);
	$curl_arr = array();
	$master = curl_multi_init();

	for($i = 0; $i < $node_count; $i++)
	{
		$url =$nodes[$i];
		$curl_arr[$i] = curl_init($url);
		curl_setopt($curl_arr[$i], CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl_arr[$i], CURLOPT_HEADER, 0);
		curl_setopt($curl_arr[$i], CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl_arr[$i], CURLOPT_COOKIEFILE, $cookie_file);
		curl_multi_add_handle($master, $curl_arr[$i]);
	}
	
	$running = null;
	do {
		usleep(10000);
		curl_multi_exec($master,$running);
	} while($running > 0);

	for($i = 0; $i < $node_count; $i++)
	{
		$content = curl_multi_getcontent($curl_arr[$i]);
		$html = str_get_html($content);
		$amount_registered = $html->find('span[id=ctl00_ContentPlaceHolder1_AmountLabel]',0)->innertext;
		$amount_approved = $html->find('span[id=ctl00_ContentPlaceHolder1_AmountApprovedLabel]',0)->innertext;
		echo $piece[$codes[$i]] . ':' . $amount_registered . '/' . $amount_approved . '<br />';

		$html->clear();
		unset($html);
	}
	
	curl_multi_close($master);
}









