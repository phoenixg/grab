<?php //获取教员个人页面URI地址列表

// 这个网站用的是GB2312
header("Content-type: text/html; charset=GB2312");

error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
date_default_timezone_set('Asia/Shanghai');

require_once '../PHPExcel_1_7_8/Classes/PHPExcel.php';

$objPHPExcel = new PHPExcel();

require ('../simplehtmldom_1_5/simple_html_dom.php');


// http://www.ttgood.com/shanghai/teacher_info/index_all.php?taxis=0&total_pages=6518&now_page=1
define('BASE',   'http://www.ttgood.com/');

set_time_limit(0);

$mentorList  = array();
for ($j=2600; $j < 3000; $j++) {  

   $objPHPExcel = PHPExcel_IOFactory::load("01_seg2.xlsx");

    $html = file_get_html(BASE . "shanghai/teacher_info/index_all.php?taxis=0&total_pages=6518&now_page={$j}/");
    
    for ($i=1; $i <= 12; $i++) { 
        $mentor_lastLoginTime =  trim($html->find("table", 5)
                                                                            ->find("td", 2)
                                                                            ->find("tr", $i+1) //第1行是标题，教员信息从第2行开始，一共1-12有12条教员记录
                                                                            ->find("div", 4)->plaintext);

        //echo $mentor_lastLoginTime;
      
        $mentor_linkTmp             =  trim($html->find("table", 5)
                                                                            ->find("td", 2)
                                                                            ->find("tr", $i+1)
                                                                            ->find("div", 0)->plaintext);

        $mentor_link = BASE . trim(str_replace('../', '', $mentor_linkTmp));
        //$mentorList[] = array($mentor_lastLoginTime, $mentor_link);

        //echo $mentor_link;

        $objPHPExcel->setActiveSheetIndex(0)
                                     ->setCellValue('A'.(12*($j-1)+$i+1), iconv('gb2312', 'utf-8', $mentor_linkTmp))
                                     ->setCellValue('B'.(12*($j-1)+$i+1), iconv('gb2312', 'utf-8', $mentor_lastLoginTime));
    }


    //$objPHPExcel->getActiveSheet()->setTitle('result');

    $objPHPExcel->setActiveSheetIndex(0);


    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
    $objWriter->save(str_replace('.php', '.xlsx', "01_seg2.xlsx"));


      // 释放内存的感觉真好，可以一次全部抓取下来！
      unset($objPHPExcel);
      unset($objWriter);

  
}


//echo '<pre>';print_r($mentorList);







