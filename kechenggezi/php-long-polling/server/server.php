<?php

set_time_limit(0);

// user id 最大值 7261450 （截至 20140507）
// http://kechenggezi.com/users/7261450/details.json?token=NYMVRFHLJRGEGSODFJEPQK
// http://kechenggezi.com/users/1000/details.json?token=NYMVRFHLJRGEGSODFJEPQK
$url = 'http://kechenggezi.com/users/';
$urlAppend = '/details.json?token=';
$userId = '1000';

// 从Fiddler那里，手机访问课程格子，抓手机包来获得token
$token = 'NYMVRFHLJRGEGSODFJEPQK';

for($userId = 1000; $userId < 1003; $userId ++) {
    echo time() . '.' . $last_ajax_call;continue;

    $last_ajax_call = isset($_GET['timestamp']) ? (int)$_GET['timestamp'] : null;

    clearstatcache();

    $result = array();
    $urlFull = $url . $userId . $urlAppend . $token;

    // $handle = curl_init($urlFull);
    // curl_setopt($handle,  CURLOPT_RETURNTRANSFER, TRUE);
    // $response = curl_exec($handle);
    // $httpCode = curl_getinfo($handle, CURLINFO_HTTP_CODE);
    // if($httpCode == 404) {
    //     continue;
    // }

    // curl_close($handle);

    $json = file_get_contents($urlFull);
    $obj = json_decode($json);
    $objUser = $obj->user;


    if ($last_ajax_call == null || (isset($objUser) && (time() > $last_ajax_call))) {
        $result = array(
            'data_from_file' => $objUser->tiny_avatar_url,
            'timestamp' => time()
        );

        $json = json_encode($result);
        echo $json;

        continue;

    } else {
        sleep( 1 );
        continue;
    }

}
