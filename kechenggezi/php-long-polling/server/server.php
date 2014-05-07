<?php
header('Content-Type: text/html; charset=utf-8');
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
        
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($handle, CURLOPT_CONNECTTIMEOUT, 120);
        curl_setopt($handle, CURLOPT_TIMEOUT, 120);
        $response = curl_exec($handle);
        $httpCode = curl_getinfo($handle, CURLINFO_HTTP_CODE);

        if($httpCode == 404 || $userId < 25) {
            $json = json_encode(array('report' => '遇到404啦亲', 
                                        'userId' => $userId),
                                        'uid' => '',
                                        'geziId' => '',
                                        'major' => '',
                                        'department' => '',
                                        'grade' => '',
                                        'sex' => '',
                                        'school' => '',
                                        'last_login_time' => '',
                                        'birthday' => '',
                                        );
            echo $json;
            curl_close($handle);
            break;
        } else {
            $json = file_get_contents($urlFull);
            $obj = json_decode($json);

            // 可能是请求被拒绝！请求频率过高！
            if(isset($obj->success) && $obj->success == false){
                $json = json_encode(array('report' => '请求频率过高亲', 
                                            'userId' => $userId - 1,
                                            'uid' => '',
                                            'geziId' => '',
                                            'major' => '',
                                            'department' => '',
                                            'grade' => '',
                                            'sex' => '',
                                            'school' => '',
                                            'last_login_time' => '',
                                            'birthday' => '',
                                            ));
                echo $json;
                curl_close($handle);
                break;
            } 

            $objUser = $obj->user;
            $origin_avatar_url = $objUser->origin_avatar_url;
            $uid = $objUser->id;
            $gezi_id = $objUser->gezi_id;
            $major = $objUser->major;
            $department = $objUser->department;
            $grade = $objUser->grade;
            $sex = $objUser->sex;
            $school = $objUser->school;
            $last_login_time = $objUser->last_login_time;
            $birthday = $objUser->birthday;

            $result = array(
                'report' => $origin_avatar_url,
                'userId' => $userId,
                'uid' => $uid,
                'geziId' => $geziId;
                'major' => $major,
                'department' => $department,
                'grade' => $grade,
                'sex' => $sex,
                'school' => $school,
                'last_login_time' => $last_login_time,
                'birthday' => $birthday
            );
            
            $json = json_encode($result);
            echo $json;
            curl_close($handle);

            break;            
   
        }
    }

    $result = array(
        'report' => '初始',
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