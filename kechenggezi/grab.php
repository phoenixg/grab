<?php 

$url = 'http://kechenggezi.com/users/';
$urlAppend = '/details.json?token=';

// 从Fiddler那里，手机访问课程格子，抓手机包来获得token
$token = 'NYMVRFHLJRGEGSODFJEPQK';

$userId = '1000';

$urlFull = $url . $userId . $urlAppend . $token;

$json = file_get_contents($urlFull);
$obj = json_decode($json);
$objUser = $obj->user;

echo $objUser->tiny_avatar_url;


/*


if( 404 ) {
	next;
} else {
	$arr[] = array('id' => '', 'name' => '')
}

foreach($arr as $people){
	// print out as a tr line
}

*/

