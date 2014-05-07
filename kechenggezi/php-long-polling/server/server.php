<?php

set_time_limit(0);

// user id 最大值 7261450 （截至 20140507）
// http://kechenggezi.com/users/7261450/details.json?token=NYMVRFHLJRGEGSODFJEPQK
// http://kechenggezi.com/users/1000/details.json?token=NYMVRFHLJRGEGSODFJEPQK
$url = 'http://kechenggezi.com/users/';
$urlAppend = '/details.json?token=';

// 从Fiddler那里，手机访问课程格子，抓手机包来获得token
$token = 'NYMVRFHLJRGEGSODFJEPQK';

while( true ) {
    $userId = isset($_GET['userId']) ? (int) ($_GET['userId'] + 1000) : null;

    clearstatcache();

    if ($userId !== null) {
        $result = array();
        $urlFull = $url . $userId . $urlAppend . $token;

        $json = file_get_contents($urlFull);
        $obj = json_decode($json);
        $objUser = $obj->user;
        //$objUser->tiny_avatar_url;
    }

    $result = array(
        'data_from_file' => 'a',
        'userId' => $userId
    );

    $json = json_encode($result);
    echo $json;

    break;
}



// $handle = curl_init($urlFull);
// curl_setopt($handle,  CURLOPT_RETURNTRANSFER, TRUE);
// $response = curl_exec($handle);
// $httpCode = curl_getinfo($handle, CURLINFO_HTTP_CODE);
// if($httpCode == 404) {
//     continue;
// }

// curl_close($handle);