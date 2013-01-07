<?php

error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
date_default_timezone_set('Asia/Shanghai');

define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');

require_once './PHPExcel_1_7_8/Classes/PHPExcel.php';

echo date('H:i:s') , " 创建新的 PHPExcel 对象" , EOL;
$objPHPExcel = new PHPExcel();

echo date('H:i:s') , " 设置文档属性" , EOL;
$objPHPExcel->getProperties()->setCreator("黄峰")
				 ->setLastModifiedBy("黄峰")
				 ->setTitle("ttgood采集结果")
				 ->setSubject("ttgood采集结果")
				 ->setDescription("ttgood采集结果")
				 ->setKeywords("ttgood 家教")
				 ->setCategory("ttgood采集结果");


echo date('H:i:s') , " 添加一些数据" , EOL;
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Hello')
            ->setCellValue('B2', 'world!')
            ->setCellValue('C1', 'Hello')
            ->setCellValue('D2', 'world!');

echo date('H:i:s') , " 重命名工作表" , EOL;
$objPHPExcel->getActiveSheet()->setTitle('result');

$objPHPExcel->setActiveSheetIndex(0);

echo date('H:i:s') , " 写入为 Excel2007 格式" , EOL;
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save(str_replace('.php', '.xlsx', __FILE__));
echo date('H:i:s') , " 文件被写入 " , str_replace('.php', '.xlsx', pathinfo(__FILE__, PATHINFO_BASENAME)) , EOL;


echo date('H:i:s') , " 内存使用状况: " , (memory_get_peak_usage(true) / 1024 / 1024) , " MB" , EOL;

echo '文件被存储在 ' , getcwd() , EOL;
