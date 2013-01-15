<?php //根据教员编号获取教员详细信息

// 这个网站用的是GB2312
header("Content-type: text/html; charset=GB2312");

error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
date_default_timezone_set('Asia/Shanghai');

$pages = file('id001.txt', FILE_IGNORE_NEW_LINES);

require ('../simplehtmldom_1_5/simple_html_dom.php');

define('BASE',   'http://www.ttgood.com/');

set_time_limit(0);

$result_file = 'id001.result.txt';
$handle = fopen($result_file, 'a') or die('无法打开文件：  '.$result_file);

foreach ($pages as $k => $page) {
  $html = file_get_html(BASE . $page);

  if(is_null($html->find("table", 3) )) {
    $mentor_sex = 'null';
    $mentor_nationality = 'null';
    $mentor_birthday = 'null';
    $mentor_school = 'null';
    $mentor_academic = 'null';
    $mentor_major = 'null';
    $mentor_identity = 'null';
    $mentor_teachable = 'null';
    $mentor_selfIntro = 'null';
    $mentor_certificate = 'null';
    $mentor_teachSchool    = 'null';
    $mentor_teachSubject   = 'null';
    $mentor_teachAge       = 'null';
    $mentor_teachLevel     = 'null';

    fwrite($handle,  $mentor_sex.'|'.$mentor_nationality.'|'.$mentor_birthday.'|'.$mentor_school.'|'.$mentor_academic.'|'.$mentor_academic.'|'.
                                  $mentor_major.'|'.$mentor_identity.'|'.$mentor_teachable.'|'.$mentor_selfIntro.'|'.$mentor_certificate.'|'.$mentor_teachable.'|'.
                                  $mentor_teachSubject.'|'.$mentor_teachAge.'|'.$mentor_teachLevel.PHP_EOL);
                     
    continue;
  }

  $mentor_sex           = trim($html->find("table", 3)
                                    ->find("tr td", 2)
                                    ->find("table tr", 1)
                                    ->find("table", 2) // 教员基本信息
                                    ->find("tr", 3)
                                    ->find("div", 1)->plaintext);

  //echo $mentor_sex . '<br />';

  $mentor_nationality   = trim($html->find("table", 3)
                                    ->find("tr td", 2)
                                    ->find("table tr", 1)
                                    ->find("table", 2)
                                    ->find("tr", 3)
                                    ->find("td", 3)->plaintext);

  //echo $mentor_nationality. '<br />';

  $mentor_birthday      = trim($html->find("table", 3)
                                    ->find("tr td", 2)
                                    ->find("table tr", 1)
                                    ->find("table", 2)
                                    ->find("tr", 4)
                                    ->find("td", 1)->plaintext);

  //echo $mentor_birthday . '<br />';

  $mentor_school        = trim($html->find("table", 3)
                                    ->find("tr td", 2)
                                    ->find("table tr", 1)
                                    ->find("table", 2)
                                    ->find("tr", 4)
                                    ->find("td", 3)->plaintext);

  //echo $mentor_school . '<br />';

  $mentor_academic      = trim($html->find("table", 3)
                                    ->find("tr td", 2)
                                    ->find("table tr", 1)
                                    ->find("table", 2)
                                    ->find("tr", 5)
                                    ->find("td", 1)->plaintext);

  //echo $mentor_academic . '<br />';

  $mentor_major         = trim($html->find("table", 3)
                                    ->find("tr td", 2)
                                    ->find("table tr", 1)
                                    ->find("table", 2)
                                    ->find("tr", 5)
                                    ->find("td", 3)->plaintext);

  //echo $mentor_major . '<br />';

  $mentor_identity      = trim($html->find("table", 3)
                                    ->find("tr td", 2)
                                    ->find("table tr", 1)
                                    ->find("table", 2)
                                    ->find("tr", 6)
                                    ->find("td", 1)->plaintext);

  //echo $mentor_identity . '<br />';

  $mentor_teachable     = trim($html->find("table", 3)
                                    ->find("tr td", 2)
                                    ->find("table tr", 1)
                                    ->find("table", 3) // 教员家教信息
                                    ->find("tr", 1)
                                    ->find("td", 1)->plaintext);

  //echo $mentor_teachable . '<br />';

  $mentor_selfIntro     = strip_tags(trim($html->find("table", 3)
                                    ->find("tr td", 2)
                                    ->find("table tr", 1)
                                    ->find("table", 3)
                                    ->find("tr", 2)
                                    ->find("td", 1)->plaintext));
  $mentor_selfIntro = str_replace(PHP_EOL, '', $mentor_selfIntro);

  //echo $mentor_selfIntro . '<br />';

  $mentor_certificate   = trim($html->find("table", 3)
                                    ->find("tr td", 2)
                                    ->find("table tr", 1)
                                    ->find("table", 3)
                                    ->find("tr", 3)
                                    ->find("td", 1)->plaintext);

  //echo $mentor_certificate . '<br />';

  $mentor_teachSchoolFlag = trim($html->find("table", 3)
                                    ->find("tr td", 2)
                                    ->find("table tr", 1)
                                    ->find("table", 2) 
                                    ->find("tr", 7)
                                    ->find("td", 0)->plaintext);

  $mentor_teachSchool    = '';
  $mentor_teachSubject   = '';
  $mentor_teachAge       = '';
  $mentor_teachLevel     = '';

  if ($mentor_teachSchoolFlag == mb_convert_encoding ('执教学校：', 'GB2312' , 'UTF-8' )) {
    
    $mentor_teachSchool = trim($html->find("table", 3)
                                    ->find("tr td", 2)
                                    ->find("table tr", 1)
                                    ->find("table", 2) 
                                    ->find("tr", 7)
                                    ->find("td", 1)->plaintext);
    
    //echo $mentor_teachSchool . '<br />';

    $mentor_teachSubject = trim($html->find("table", 3)
                                    ->find("tr td", 2)
                                    ->find("table tr", 1)
                                    ->find("table", 2) 
                                    ->find("tr", 7)
                                    ->find("td", 3)->plaintext);

    //echo $mentor_teachSubject . '<br />';

    $mentor_teachAge = trim($html->find("table", 3)
                                    ->find("tr td", 2)
                                    ->find("table tr", 1)
                                    ->find("table", 2) 
                                    ->find("tr", 8)
                                    ->find("td", 1)->plaintext);

    //echo $mentor_teachAge . '<br />';

    $mentor_teachLevel = trim($html->find("table", 3)
                                    ->find("tr td", 2)
                                    ->find("table tr", 1)
                                    ->find("table", 2) 
                                    ->find("tr", 8)
                                    ->find("td", 3)->plaintext);

    //echo $mentor_teachLevel . '<br />';

  }
  
  fwrite($handle,  $mentor_sex.'|'.$mentor_nationality.'|'.$mentor_birthday.'|'.$mentor_school.'|'.$mentor_academic.'|'.$mentor_academic.'|'.
                                $mentor_major.'|'.$mentor_identity.'|'.$mentor_teachable.'|'.$mentor_selfIntro.'|'.$mentor_certificate.'|'.$mentor_teachable.'|'.
                                $mentor_teachSubject.'|'.$mentor_teachAge.'|'.$mentor_teachLevel.PHP_EOL);

}

fclose($handle);






