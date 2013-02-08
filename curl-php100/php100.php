<?php
//header("Content-type: text/html; charset=utf-8")

/* ok
$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, "http://php.net");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 0);
$data = curl_exec($ch);
curl_close($curl);
*/

/* ok 
$user = 'admin';
$pass = 'admin100';
$curlPost = "user=$user&pass=$pass";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "http://localhost/curltest/php100_target.php");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 0);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $curlPost);
$data = curl_exec($ch);
curl_close($ch);
*/

$cookie_file = tempnam('./temp','cookie');
$login_url = 'http://bbs.php100.com/login.php';
$post_fields = 'cktime=3600&step=2&pwuser=phoenixg&pwpwd=';

$ch = curl_init($login_url);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_file);
curl_setopt($ch, CURLOPT_POSTFIELDS, $post_fields);
curl_exec($ch);
curl_close($ch);

$url = 'http://bbs.php100.com/index.php';//or specific page
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_file);
$contents = curl_exec($ch);
$contents = iconv('gbk','utf8',$contents);
echo $contents;
//preg_match("",$contents,$arr);
//echo $arr[1];

curl_close($ch);
