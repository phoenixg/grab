<?php //获取教员个人页面URI地址列表

// 这个网站用的是GB2312
header("Content-type: text/html; charset=GB2312");

error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
date_default_timezone_set('Asia/Shanghai');

define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');

require_once '../PHPExcel_1_7_8/Classes/PHPExcel.php';

$objPHPExcel = new PHPExcel();

$objPHPExcel->getProperties()->setCreator("黄峰")
                 ->setLastModifiedBy("黄峰")
                 ->setTitle("ttgood采集结果")
                 ->setSubject("ttgood采集结果")
                 ->setDescription("ttgood采集结果")
                 ->setKeywords("ttgood 家教")
                 ->setCategory("ttgood采集结果");



require ('../simplehtmldom_1_5/simple_html_dom.php');

define('BASE',   'http://www.ttgood.com/');

set_time_limit(0);

$mentorList  = array();
for ($j=1; $j < 200; $j++) { 
    // d1 d2代表性别
    $html = file_get_html(BASE . "jy_d2_f{$j}/");
    
    for ($i=1; $i <= 15; $i++) { 
        $mentor_lastLoginTime =  trim($html->find("table", 6) //搜索结果列表
                                                                        ->find("tr", $i) //第1行是标题，教员信息从第2行开始，一共1-15有15条教员记录
                                                                        ->find("td", 6)->plaintext);

        $mentor_linkTmp             =  trim($html->find("table", 6) 
                                                                            ->find("tr", $i)
                                                                            ->find("td", 7)
                                                                            ->find(".orange_", 0)
                                                                            ->href);
        $mentor_link = BASE . trim(str_replace('../', '', $mentor_linkTmp));
        //$mentorList[] = array($mentor_lastLoginTime, $mentor_link);

        $objPHPExcel->setActiveSheetIndex(0)
                                     ->setCellValue('A'.(15*($j-1)+$i+1), $mentor_linkTmp)
                                     ->setCellValue('B'.(15*($j-1)+$i+1), $mentor_lastLoginTime);
    }
}


//echo '<pre>';print_r($mentorList);


$objPHPExcel->getActiveSheet()->setTitle('result');

$objPHPExcel->setActiveSheetIndex(0);


$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save(str_replace('.php', '.xlsx', __FILE__));






