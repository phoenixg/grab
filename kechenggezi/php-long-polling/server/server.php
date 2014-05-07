<?php
header('Content-Type: text/html; charset=utf-8');
$userAgentsArr = include 'user-agents.php';
set_time_limit(0);

// user id 最大值 7261450 ； 最小值 27 （截至 20140507）
// http://kechenggezi.com/users/7261450/details.json?token=NYMVRFHLJRGEGSODFJEPQK
// http://kechenggezi.com/users/1000/details.json?token=NYMVRFHLJRGEGSODFJEPQK
$url = 'http://kechenggezi.com/users/';
$urlAppend = '/details.json?token=';

// 从Fiddler那里，手机访问课程格子，抓手机包来获得token
$token = 'NYMVRFHLJRGEGSODFJEPQK';

while( true ) {
    $userId = isset($_GET['userId']) ? (int) ($_GET['userId']) : null;
    if($userId == 1)
        $userId += 25;

    clearstatcache();

    if ($userId !== null) {
        $result = array();
        $urlFull = $url . $userId . $urlAppend . $token;

        $handle = curl_init($urlFull);
        
        $headers[]  = array_rand($userAgentsArr);
        $headers[]  = "Accept:text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8";
        $headers[]  = "Accept-Language:en-us,en;q=0.5";
        $headers[]  = "Accept-Encoding:gzip,deflate";
        $headers[]  = "Accept-Charset:ISO-8859-1,utf-8;q=0.7,*;q=0.7";
        $headers[]  = "Keep-Alive:115";
        $headers[]  = "Connection:keep-alive";
        $headers[]  = "Cache-Control:max-age=0";

        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($handle, CURLOPT_CONNECTTIMEOUT, 120);
        curl_setopt($handle, CURLOPT_TIMEOUT, 120);
        $response = curl_exec($handle);
        $httpCode = curl_getinfo($handle, CURLINFO_HTTP_CODE);

        if($httpCode == 404 || $userId < 25) {
            $json = json_encode(array('data_from_file' => '遇到404啦亲', 'userId' => $userId));
            echo $json;
            curl_close($handle);
            break;
        } else {
            $json = file_get_contents($urlFull);
            $obj = json_decode($json);

            // 可能是请求被拒绝！请求频率过高！
            if(isset($obj->success) && $obj->success == false){
                $json = json_encode(array('data_from_file' => '请求频率过高亲', 'userId' => $userId - 1));
                echo $json;
                curl_close($handle);
                break;
            } 

            $objUser = $obj->user;
            $aaa = $objUser->tiny_avatar_url;

            $result = array(
                'data_from_file' => $aaa,
                'userId' => $userId
            );
            
            $json = json_encode($result);
            echo $json;
            curl_close($handle);

            break;            
   
        }
    }

    $result = array(
        'data_from_file' => 'a',
        'userId' => $userId
    );

    $json = json_encode($result);
    echo $json;

    break;
}


/*
{

    "success": false,
    "error": "请求被拒绝！请求频率过高！",
    "notice": "请求被拒绝！请求频率过高！"

}
*/