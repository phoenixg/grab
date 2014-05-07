<?php

/**
 * Server-side file.
 * This file is an infinitive loop. Seriously.
 * It gets the file data.txt's last-changed timestamp, checks if this is larger than the timestamp of the
 * AJAX-submitted timestamp (time of last ajax request), and if so, it sends back a JSON with the data from
 * data.txt (and a timestamp). If not, it waits for one seconds and then start the next while step.
 *
 * Note: This returns a JSON, containing the content of data.txt and the timestamp of the last data.txt change.
 * This timestamp is used by the client's JavaScript for the next request, so THIS server-side script here only
 * serves new content after the last file change. Sounds weird, but try it out, you'll get into it really fast!
 */

// set php runtime to unlimited
set_time_limit(0);

// user id 最大值 7261450 （截至 20140507）
// http://kechenggezi.com/users/7261450/details.json?token=NYMVRFHLJRGEGSODFJEPQK
// http://kechenggezi.com/users/1000/details.json?token=NYMVRFHLJRGEGSODFJEPQK
$url = 'http://kechenggezi.com/users/';
$urlAppend = '/details.json?token=';

// 从Fiddler那里，手机访问课程格子，抓手机包来获得token
$token = 'NYMVRFHLJRGEGSODFJEPQK';

// where does the data come from ? In real world this would be a SQL query or something
$data_source_file = 'data.txt';

// main loop
while (true) {
    // if ajax request has send a timestamp, then $last_ajax_call = timestamp, else $last_ajax_call = null
    $last_ajax_call = isset($_GET['timestamp']) ? (int)$_GET['timestamp'] : null;

    // PHP caches file data, like requesting the size of a file, by default. clearstatcache() clears that cache
    clearstatcache();

    $result = array();
    for ($userId = 1000; $userId < 1004; $userId ++) { 
        $urlFull = $url . $userId . $urlAppend . $token;

        $handle = curl_init($urlFull);
        curl_setopt($handle,  CURLOPT_RETURNTRANSFER, TRUE);
        $response = curl_exec($handle);
        $httpCode = curl_getinfo($handle, CURLINFO_HTTP_CODE);
        if($httpCode == 404) {
            continue;
        }

        curl_close($handle);

        $json = file_get_contents($urlFull);
        $obj = json_decode($json);
        $objUser = $obj->user;
        $result[] = $objUser->tiny_avatar_url;


        // get timestamp of when file has been changed the last time
        // $last_change_in_data_file = filemtime($data_source_file);

        // if no timestamp delivered via ajax or data.txt has been changed SINCE last ajax timestamp
        // if ($last_ajax_call == null || $last_change_in_data_file > $last_ajax_call) {
        if ($last_ajax_call == null || isset($objUser)) {
            // get content of data.txt
            // $data = file_get_contents($data_source_file);

            // put data.txt's content and timestamp of last data.txt change into array
            $result = array(
                'data_from_file' => 'a',
                'timestamp' => '222'
            );

            // encode to JSON, render the result (for AJAX)
            $json = json_encode($result);
            echo $json;

            // leave this loop step
            break;

        } else {
            // wait for 1 sec (not very sexy as this blocks the PHP/Apache process, but that's how it goes)
            sleep( 1 );
            continue;
        }

    }

    





}
