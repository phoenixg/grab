<?php //根据教员编号获取教员详细信息

// 这个网站用的是GB2312
header("Content-type: text/html; charset=GB2312");

/*
2013-01-06

以下要采集的信息都在第4个table里

【教员编号】      ：已经有的参数, eg. t138288
【最近登录时间】    ：
【性别】            ：
【籍贯】            ：
【...】

*/

error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
date_default_timezone_set('Asia/Shanghai');

define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');


$pages = file('run1.0_getmentorlist_20130107PM1730.txt', FILE_IGNORE_NEW_LINES);



require_once './PHPExcel_1_7_8/Classes/PHPExcel.php';

$objPHPExcel = new PHPExcel();

$objPHPExcel->getProperties()->setCreator("黄峰")
                 ->setLastModifiedBy("黄峰")
                 ->setTitle("ttgood采集结果")
                 ->setSubject("ttgood采集结果")
                 ->setDescription("ttgood采集结果")
                 ->setKeywords("ttgood 家教")
                 ->setCategory("ttgood采集结果");




require ('./simplehtmldom_1_5/simple_html_dom.php');

define('BASE',   'http://www.ttgood.com/');

set_time_limit(0);

// 无教师资格的教员
//$html = file_get_html('http://www.ttgood.com/jy/t144494.htm');

// 有教师资格的教员
//$html = file_get_html('http://www.ttgood.com/jy/t148686.htm');

/* 
最近登录时间，有时有 Fatal error: Call to a member function find() on a non-object 错误
所以，还是在列表里采集好了

$mentor_lastLoginTime = trim($html->find("table", 3)
                                  ->find("tr td", 2)
                                  ->find("table tr", 1)
                                  ->find("table", 0)
                                  ->find("tr", 0)
                                  ->find("td", 1)
                                  ->find("td", 3)
                                  ->find("span", 0)->plaintext);
*/

foreach ($pages as $k => $page) {
  $html = file_get_html(BASE . $page);

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

  $mentor_selfIntro     = trim($html->find("table", 3)
                                    ->find("tr td", 2)
                                    ->find("table tr", 1)
                                    ->find("table", 3)
                                    ->find("tr", 2)
                                    ->find("td", 1)->plaintext);

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
  
  $objPHPExcel->setActiveSheetIndex(0)
               ->setCellValue('D'.($k+1), iconv('gb2312', 'utf-8', $mentor_sex))
               ->setCellValue('E'.($k+1), iconv('gb2312', 'utf-8', $mentor_nationality))
               ->setCellValue('F'.($k+1), iconv('gb2312', 'utf-8', $mentor_birthday))
               ->setCellValue('G'.($k+1), iconv('gb2312', 'utf-8', $mentor_school))
               ->setCellValue('H'.($k+1), iconv('gb2312', 'utf-8', $mentor_academic))
               ->setCellValue('I'.($k+1), iconv('gb2312', 'utf-8', $mentor_major))
               ->setCellValue('J'.($k+1), iconv('gb2312', 'utf-8', $mentor_identity))
               ->setCellValue('K'.($k+1), iconv('gb2312', 'utf-8', $mentor_teachable))
               ->setCellValue('L'.($k+1), iconv('gb2312', 'utf-8', $mentor_selfIntro))
               ->setCellValue('M'.($k+1), iconv('gb2312', 'utf-8', $mentor_certificate))
               ->setCellValue('N'.($k+1), iconv('gb2312', 'utf-8', $mentor_teachSchool))
               ->setCellValue('O'.($k+1), iconv('gb2312', 'utf-8', $mentor_teachSubject))
               ->setCellValue('P'.($k+1), iconv('gb2312', 'utf-8', $mentor_teachAge))
               ->setCellValue('Q'.($k+1), iconv('gb2312', 'utf-8', $mentor_teachLevel));


}








$objPHPExcel->getActiveSheet()->setTitle('result');

$objPHPExcel->setActiveSheetIndex(0);


$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save(str_replace('.php', '.xlsx', __FILE__));




