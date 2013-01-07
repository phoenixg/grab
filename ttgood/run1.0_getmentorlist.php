<?php //获取教员个人页面URI地址列表

// 这个网站用的是GB2312
header("Content-type: text/html; charset=GB2312");


/*
jy_f1 - jy_f199 每页有15条教员记录

2013-01-06

*/

error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
date_default_timezone_set('Asia/Shanghai');

define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');

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

$mentorList  = array();
for ($j=1; $j < 200; $j++) { 
    $html = file_get_html(BASE . "jy_f{$j}/");
    
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


die;

/* result of $mentorList
Array
(
    [0] => Array
        (
            [0] => 2013-01-07 15:29:50
            [1] => http://www.ttgood.com/jy/t138338.htm
        )

    [1] => Array
        (
            [0] => 2013-01-07 15:26:27
            [1] => http://www.ttgood.com/jy/t10072.htm
        )

    [2] => Array
        (
            [0] => 2013-01-07 15:22:39
            [1] => http://www.ttgood.com/jy/t150391.htm
        )

    [3] => Array
        (
            [0] => 2013-01-07 15:21:24
            [1] => http://www.ttgood.com/jy/t144930.htm
        )

    [4] => Array
        (
            [0] => 2013-01-07 15:20:20
            [1] => http://www.ttgood.com/jy/t148016.htm
        )

    [5] => Array
        (
            [0] => 2013-01-07 15:14:38
            [1] => http://www.ttgood.com/jy/t129723.htm
        )

    [6] => Array
        (
            [0] => 2013-01-07 15:13:09
            [1] => http://www.ttgood.com/jy/t128186.htm
        )

    [7] => Array
        (
            [0] => 2013-01-07 15:10:37
            [1] => http://www.ttgood.com/jy/t150444.htm
        )

    [8] => Array
        (
            [0] => 2013-01-07 15:08:15
            [1] => http://www.ttgood.com/jy/t145952.htm
        )

    [9] => Array
        (
            [0] => 2013-01-07 15:02:56
            [1] => http://www.ttgood.com/jy/t117579.htm
        )

    [10] => Array
        (
            [0] => 2013-01-07 15:02:56
            [1] => http://www.ttgood.com/jy/t123551.htm
        )

    [11] => Array
        (
            [0] => 2013-01-07 15:00:58
            [1] => http://www.ttgood.com/jy/t146012.htm
        )

    [12] => Array
        (
            [0] => 2013-01-07 14:59:37
            [1] => http://www.ttgood.com/jy/t141417.htm
        )

    [13] => Array
        (
            [0] => 2013-01-07 14:58:42
            [1] => http://www.ttgood.com/jy/t119911.htm
        )

    [14] => Array
        (
            [0] => 2013-01-07 14:56:59
            [1] => http://www.ttgood.com/jy/t150155.htm
        )

    [15] => Array
        (
            [0] => 2013-01-07 14:51:02
            [1] => http://www.ttgood.com/jy/t150056.htm
        )

    [16] => Array
        (
            [0] => 2013-01-07 14:50:50
            [1] => http://www.ttgood.com/jy/t150294.htm
        )

    [17] => Array
        (
            [0] => 2013-01-07 14:50:48
            [1] => http://www.ttgood.com/jy/t146298.htm
        )

    [18] => Array
        (
            [0] => 2013-01-07 14:48:55
            [1] => http://www.ttgood.com/jy/t122962.htm
        )

    [19] => Array
        (
            [0] => 2013-01-07 14:47:26
            [1] => http://www.ttgood.com/jy/t75767.htm
        )

    [20] => Array
        (
            [0] => 2013-01-07 14:47:18
            [1] => http://www.ttgood.com/jy/t146221.htm
        )

    [21] => Array
        (
            [0] => 2013-01-07 14:44:14
            [1] => http://www.ttgood.com/jy/t139844.htm
        )

    [22] => Array
        (
            [0] => 2013-01-07 14:43:26
            [1] => http://www.ttgood.com/jy/t149693.htm
        )

    [23] => Array
        (
            [0] => 2013-01-07 14:38:20
            [1] => http://www.ttgood.com/jy/t147713.htm
        )

    [24] => Array
        (
            [0] => 2013-01-07 14:37:15
            [1] => http://www.ttgood.com/jy/t121410.htm
        )

    [25] => Array
        (
            [0] => 2013-01-07 14:33:11
            [1] => http://www.ttgood.com/jy/t140844.htm
        )

    [26] => Array
        (
            [0] => 2013-01-07 14:32:35
            [1] => http://www.ttgood.com/jy/t148833.htm
        )

    [27] => Array
        (
            [0] => 2013-01-07 14:30:56
            [1] => http://www.ttgood.com/jy/t149929.htm
        )

    [28] => Array
        (
            [0] => 2013-01-07 14:27:57
            [1] => http://www.ttgood.com/jy/t99616.htm
        )

    [29] => Array
        (
            [0] => 2013-01-07 14:23:54
            [1] => http://www.ttgood.com/jy/t129661.htm
        )

    [30] => Array
        (
            [0] => 2013-01-07 14:20:50
            [1] => http://www.ttgood.com/jy/t144494.htm
        )

    [31] => Array
        (
            [0] => 2013-01-07 14:14:21
            [1] => http://www.ttgood.com/jy/t147848.htm
        )

    [32] => Array
        (
            [0] => 2013-01-07 14:12:05
            [1] => http://www.ttgood.com/jy/t150363.htm
        )

    [33] => Array
        (
            [0] => 2013-01-07 14:11:44
            [1] => http://www.ttgood.com/jy/t93314.htm
        )

    [34] => Array
        (
            [0] => 2013-01-07 14:10:46
            [1] => http://www.ttgood.com/jy/t92715.htm
        )

    [35] => Array
        (
            [0] => 2013-01-07 14:09:46
            [1] => http://www.ttgood.com/jy/t150385.htm
        )

    [36] => Array
        (
            [0] => 2013-01-07 14:09:21
            [1] => http://www.ttgood.com/jy/t86308.htm
        )

    [37] => Array
        (
            [0] => 2013-01-07 14:08:28
            [1] => http://www.ttgood.com/jy/t75534.htm
        )

    [38] => Array
        (
            [0] => 2013-01-07 14:07:11
            [1] => http://www.ttgood.com/jy/t129259.htm
        )

    [39] => Array
        (
            [0] => 2013-01-07 14:07:10
            [1] => http://www.ttgood.com/jy/t140466.htm
        )

    [40] => Array
        (
            [0] => 2013-01-07 14:06:30
            [1] => http://www.ttgood.com/jy/t149742.htm
        )

    [41] => Array
        (
            [0] => 2013-01-07 14:06:17
            [1] => http://www.ttgood.com/jy/t149101.htm
        )

    [42] => Array
        (
            [0] => 2013-01-07 14:00:43
            [1] => http://www.ttgood.com/jy/t147763.htm
        )

    [43] => Array
        (
            [0] => 2013-01-07 13:56:20
            [1] => http://www.ttgood.com/jy/t150215.htm
        )

    [44] => Array
        (
            [0] => 2013-01-07 13:56:05
            [1] => http://www.ttgood.com/jy/t119543.htm
        )

    [45] => Array
        (
            [0] => 2013-01-07 13:52:23
            [1] => http://www.ttgood.com/jy/t150353.htm
        )

    [46] => Array
        (
            [0] => 2013-01-07 13:50:18
            [1] => http://www.ttgood.com/jy/t143962.htm
        )

    [47] => Array
        (
            [0] => 2013-01-07 13:49:44
            [1] => http://www.ttgood.com/jy/t105834.htm
        )

    [48] => Array
        (
            [0] => 2013-01-07 13:48:32
            [1] => http://www.ttgood.com/jy/t16908.htm
        )

    [49] => Array
        (
            [0] => 2013-01-07 13:42:53
            [1] => http://www.ttgood.com/jy/t132285.htm
        )

    [50] => Array
        (
            [0] => 2013-01-07 13:39:49
            [1] => http://www.ttgood.com/jy/t145920.htm
        )

    [51] => Array
        (
            [0] => 2013-01-07 13:38:15
            [1] => http://www.ttgood.com/jy/t143070.htm
        )

    [52] => Array
        (
            [0] => 2013-01-07 13:37:34
            [1] => http://www.ttgood.com/jy/t125237.htm
        )

    [53] => Array
        (
            [0] => 2013-01-07 13:37:15
            [1] => http://www.ttgood.com/jy/t56369.htm
        )

    [54] => Array
        (
            [0] => 2013-01-07 13:36:41
            [1] => http://www.ttgood.com/jy/t150417.htm
        )

    [55] => Array
        (
            [0] => 2013-01-07 13:35:58
            [1] => http://www.ttgood.com/jy/t143690.htm
        )

    [56] => Array
        (
            [0] => 2013-01-07 13:35:26
            [1] => http://www.ttgood.com/jy/t150477.htm
        )

    [57] => Array
        (
            [0] => 2013-01-07 13:35:00
            [1] => http://www.ttgood.com/jy/t149690.htm
        )

    [58] => Array
        (
            [0] => 2013-01-07 13:34:56
            [1] => http://www.ttgood.com/jy/t149878.htm
        )

    [59] => Array
        (
            [0] => 2013-01-07 13:33:04
            [1] => http://www.ttgood.com/jy/t17083.htm
        )

    [60] => Array
        (
            [0] => 2013-01-07 13:32:31
            [1] => http://www.ttgood.com/jy/t145037.htm
        )

    [61] => Array
        (
            [0] => 2013-01-07 13:30:26
            [1] => http://www.ttgood.com/jy/t146685.htm
        )

    [62] => Array
        (
            [0] => 2013-01-07 13:30:10
            [1] => http://www.ttgood.com/jy/t120885.htm
        )

    [63] => Array
        (
            [0] => 2013-01-07 13:27:56
            [1] => http://www.ttgood.com/jy/t142920.htm
        )

    [64] => Array
        (
            [0] => 2013-01-07 13:27:04
            [1] => http://www.ttgood.com/jy/t147916.htm
        )

    [65] => Array
        (
            [0] => 2013-01-07 13:21:04
            [1] => http://www.ttgood.com/jy/t124400.htm
        )

    [66] => Array
        (
            [0] => 2013-01-07 13:16:44
            [1] => http://www.ttgood.com/jy/t148140.htm
        )

    [67] => Array
        (
            [0] => 2013-01-07 13:14:38
            [1] => http://www.ttgood.com/jy/t76380.htm
        )

    [68] => Array
        (
            [0] => 2013-01-07 13:10:25
            [1] => http://www.ttgood.com/jy/t146755.htm
        )

    [69] => Array
        (
            [0] => 2013-01-07 13:03:42
            [1] => http://www.ttgood.com/jy/t148918.htm
        )

    [70] => Array
        (
            [0] => 2013-01-07 13:02:18
            [1] => http://www.ttgood.com/jy/t114541.htm
        )

    [71] => Array
        (
            [0] => 2013-01-07 12:58:14
            [1] => http://www.ttgood.com/jy/t140473.htm
        )

    [72] => Array
        (
            [0] => 2013-01-07 12:56:50
            [1] => http://www.ttgood.com/jy/t74792.htm
        )

    [73] => Array
        (
            [0] => 2013-01-07 12:53:26
            [1] => http://www.ttgood.com/jy/t148529.htm
        )

    [74] => Array
        (
            [0] => 2013-01-07 12:52:12
            [1] => http://www.ttgood.com/jy/t73277.htm
        )

    [75] => Array
        (
            [0] => 2013-01-07 12:51:44
            [1] => http://www.ttgood.com/jy/t82401.htm
        )

    [76] => Array
        (
            [0] => 2013-01-07 12:39:11
            [1] => http://www.ttgood.com/jy/t149364.htm
        )

    [77] => Array
        (
            [0] => 2013-01-07 12:37:17
            [1] => http://www.ttgood.com/jy/t144215.htm
        )

    [78] => Array
        (
            [0] => 2013-01-07 12:33:04
            [1] => http://www.ttgood.com/jy/t132647.htm
        )

    [79] => Array
        (
            [0] => 2013-01-07 12:31:42
            [1] => http://www.ttgood.com/jy/t146722.htm
        )

    [80] => Array
        (
            [0] => 2013-01-07 12:29:58
            [1] => http://www.ttgood.com/jy/t141658.htm
        )

    [81] => Array
        (
            [0] => 2013-01-07 12:28:06
            [1] => http://www.ttgood.com/jy/t150439.htm
        )

    [82] => Array
        (
            [0] => 2013-01-07 12:27:02
            [1] => http://www.ttgood.com/jy/t150147.htm
        )

    [83] => Array
        (
            [0] => 2013-01-07 12:25:34
            [1] => http://www.ttgood.com/jy/t142588.htm
        )

    [84] => Array
        (
            [0] => 2013-01-07 12:24:17
            [1] => http://www.ttgood.com/jy/t150414.htm
        )

    [85] => Array
        (
            [0] => 2013-01-07 12:22:44
            [1] => http://www.ttgood.com/jy/t40702.htm
        )

    [86] => Array
        (
            [0] => 2013-01-07 12:19:20
            [1] => http://www.ttgood.com/jy/t145623.htm
        )

    [87] => Array
        (
            [0] => 2013-01-07 12:18:25
            [1] => http://www.ttgood.com/jy/t149625.htm
        )

    [88] => Array
        (
            [0] => 2013-01-07 12:16:59
            [1] => http://www.ttgood.com/jy/t99071.htm
        )

    [89] => Array
        (
            [0] => 2013-01-07 12:09:20
            [1] => http://www.ttgood.com/jy/t149144.htm
        )

    [90] => Array
        (
            [0] => 2013-01-07 12:09:20
            [1] => http://www.ttgood.com/jy/t14465.htm
        )

    [91] => Array
        (
            [0] => 2013-01-07 12:04:51
            [1] => http://www.ttgood.com/jy/t141822.htm
        )

    [92] => Array
        (
            [0] => 2013-01-07 12:03:42
            [1] => http://www.ttgood.com/jy/t149581.htm
        )

    [93] => Array
        (
            [0] => 2013-01-07 12:01:51
            [1] => http://www.ttgood.com/jy/t150364.htm
        )

    [94] => Array
        (
            [0] => 2013-01-07 11:42:51
            [1] => http://www.ttgood.com/jy/t148434.htm
        )

    [95] => Array
        (
            [0] => 2013-01-07 11:41:47
            [1] => http://www.ttgood.com/jy/t150432.htm
        )

    [96] => Array
        (
            [0] => 2013-01-07 11:40:53
            [1] => http://www.ttgood.com/jy/t143461.htm
        )

    [97] => Array
        (
            [0] => 2013-01-07 11:39:50
            [1] => http://www.ttgood.com/jy/t145403.htm
        )

    [98] => Array
        (
            [0] => 2013-01-07 11:36:52
            [1] => http://www.ttgood.com/jy/t147335.htm
        )

    [99] => Array
        (
            [0] => 2013-01-07 11:35:34
            [1] => http://www.ttgood.com/jy/t134253.htm
        )

    [100] => Array
        (
            [0] => 2013-01-07 11:31:26
            [1] => http://www.ttgood.com/jy/t150199.htm
        )

    [101] => Array
        (
            [0] => 2013-01-07 11:31:13
            [1] => http://www.ttgood.com/jy/t11935.htm
        )

    [102] => Array
        (
            [0] => 2013-01-07 11:24:56
            [1] => http://www.ttgood.com/jy/t110907.htm
        )

    [103] => Array
        (
            [0] => 2013-01-07 11:24:40
            [1] => http://www.ttgood.com/jy/t35730.htm
        )

    [104] => Array
        (
            [0] => 2013-01-07 11:23:56
            [1] => http://www.ttgood.com/jy/t110356.htm
        )

    [105] => Array
        (
            [0] => 2013-01-07 11:22:20
            [1] => http://www.ttgood.com/jy/t137962.htm
        )

    [106] => Array
        (
            [0] => 2013-01-07 11:06:18
            [1] => http://www.ttgood.com/jy/t150379.htm
        )

    [107] => Array
        (
            [0] => 2013-01-07 10:58:37
            [1] => http://www.ttgood.com/jy/t150466.htm
        )

    [108] => Array
        (
            [0] => 2013-01-07 10:58:23
            [1] => http://www.ttgood.com/jy/t150043.htm
        )

    [109] => Array
        (
            [0] => 2013-01-07 10:58:09
            [1] => http://www.ttgood.com/jy/t135923.htm
        )

    [110] => Array
        (
            [0] => 2013-01-07 10:56:47
            [1] => http://www.ttgood.com/jy/t145295.htm
        )

    [111] => Array
        (
            [0] => 2013-01-07 10:49:33
            [1] => http://www.ttgood.com/jy/t130764.htm
        )

    [112] => Array
        (
            [0] => 2013-01-07 10:47:48
            [1] => http://www.ttgood.com/jy/t148093.htm
        )

    [113] => Array
        (
            [0] => 2013-01-07 10:46:39
            [1] => http://www.ttgood.com/jy/t131494.htm
        )

    [114] => Array
        (
            [0] => 2013-01-07 10:46:23
            [1] => http://www.ttgood.com/jy/t147937.htm
        )

    [115] => Array
        (
            [0] => 2013-01-07 10:45:35
            [1] => http://www.ttgood.com/jy/t92477.htm
        )

    [116] => Array
        (
            [0] => 2013-01-07 10:44:29
            [1] => http://www.ttgood.com/jy/t139846.htm
        )

    [117] => Array
        (
            [0] => 2013-01-07 10:44:13
            [1] => http://www.ttgood.com/jy/t138918.htm
        )

    [118] => Array
        (
            [0] => 2013-01-07 10:41:09
            [1] => http://www.ttgood.com/jy/t149883.htm
        )

    [119] => Array
        (
            [0] => 2013-01-07 10:39:26
            [1] => http://www.ttgood.com/jy/t138453.htm
        )

    [120] => Array
        (
            [0] => 2013-01-07 10:38:07
            [1] => http://www.ttgood.com/jy/t150143.htm
        )

    [121] => Array
        (
            [0] => 2013-01-07 10:37:32
            [1] => http://www.ttgood.com/jy/t124951.htm
        )

    [122] => Array
        (
            [0] => 2013-01-07 10:35:53
            [1] => http://www.ttgood.com/jy/t133665.htm
        )

    [123] => Array
        (
            [0] => 2013-01-07 10:34:31
            [1] => http://www.ttgood.com/jy/t143400.htm
        )

    [124] => Array
        (
            [0] => 2013-01-07 10:32:13
            [1] => http://www.ttgood.com/jy/t148641.htm
        )

    [125] => Array
        (
            [0] => 2013-01-07 10:30:30
            [1] => http://www.ttgood.com/jy/t142138.htm
        )

    [126] => Array
        (
            [0] => 2013-01-07 10:29:57
            [1] => http://www.ttgood.com/jy/t148636.htm
        )

    [127] => Array
        (
            [0] => 2013-01-07 10:29:26
            [1] => http://www.ttgood.com/jy/t147599.htm
        )

    [128] => Array
        (
            [0] => 2013-01-07 10:27:06
            [1] => http://www.ttgood.com/jy/t110702.htm
        )

    [129] => Array
        (
            [0] => 2013-01-07 10:23:03
            [1] => http://www.ttgood.com/jy/t138296.htm
        )

    [130] => Array
        (
            [0] => 2013-01-07 10:20:19
            [1] => http://www.ttgood.com/jy/t149417.htm
        )

    [131] => Array
        (
            [0] => 2013-01-07 10:11:22
            [1] => http://www.ttgood.com/jy/t145264.htm
        )

    [132] => Array
        (
            [0] => 2013-01-07 10:11:22
            [1] => http://www.ttgood.com/jy/t135519.htm
        )

    [133] => Array
        (
            [0] => 2013-01-07 10:10:51
            [1] => http://www.ttgood.com/jy/t145571.htm
        )

    [134] => Array
        (
            [0] => 2013-01-07 10:10:45
            [1] => http://www.ttgood.com/jy/t150396.htm
        )

    [135] => Array
        (
            [0] => 2013-01-07 10:08:45
            [1] => http://www.ttgood.com/jy/t149631.htm
        )

    [136] => Array
        (
            [0] => 2013-01-07 10:06:37
            [1] => http://www.ttgood.com/jy/t150307.htm
        )

    [137] => Array
        (
            [0] => 2013-01-07 10:06:07
            [1] => http://www.ttgood.com/jy/t150248.htm
        )

    [138] => Array
        (
            [0] => 2013-01-07 10:04:36
            [1] => http://www.ttgood.com/jy/t32103.htm
        )

    [139] => Array
        (
            [0] => 2013-01-07 10:04:13
            [1] => http://www.ttgood.com/jy/t147721.htm
        )

    [140] => Array
        (
            [0] => 2013-01-07 09:50:11
            [1] => http://www.ttgood.com/jy/t123318.htm
        )

    [141] => Array
        (
            [0] => 2013-01-07 09:43:39
            [1] => http://www.ttgood.com/jy/t148804.htm
        )

    [142] => Array
        (
            [0] => 2013-01-07 09:42:06
            [1] => http://www.ttgood.com/jy/t60801.htm
        )

    [143] => Array
        (
            [0] => 2013-01-07 09:41:48
            [1] => http://www.ttgood.com/jy/t147043.htm
        )

    [144] => Array
        (
            [0] => 2013-01-07 09:38:32
            [1] => http://www.ttgood.com/jy/t124489.htm
        )

    [145] => Array
        (
            [0] => 2013-01-07 09:36:24
            [1] => http://www.ttgood.com/jy/t150087.htm
        )

    [146] => Array
        (
            [0] => 2013-01-07 09:27:20
            [1] => http://www.ttgood.com/jy/t117050.htm
        )

    [147] => Array
        (
            [0] => 2013-01-07 09:24:31
            [1] => http://www.ttgood.com/jy/t69920.htm
        )

    [148] => Array
        (
            [0] => 2013-01-07 09:19:21
            [1] => http://www.ttgood.com/jy/t148120.htm
        )

    [149] => Array
        (
            [0] => 2013-01-07 09:18:53
            [1] => http://www.ttgood.com/jy/t143697.htm
        )

    [150] => Array
        (
            [0] => 2013-01-07 09:07:13
            [1] => http://www.ttgood.com/jy/t150191.htm
        )

    [151] => Array
        (
            [0] => 2013-01-07 09:06:46
            [1] => http://www.ttgood.com/jy/t150473.htm
        )

    [152] => Array
        (
            [0] => 2013-01-07 09:06:26
            [1] => http://www.ttgood.com/jy/t150471.htm
        )

    [153] => Array
        (
            [0] => 2013-01-07 09:06:18
            [1] => http://www.ttgood.com/jy/t150470.htm
        )

    [154] => Array
        (
            [0] => 2013-01-07 09:06:06
            [1] => http://www.ttgood.com/jy/t150467.htm
        )

    [155] => Array
        (
            [0] => 2013-01-07 09:06:05
            [1] => http://www.ttgood.com/jy/t150469.htm
        )

    [156] => Array
        (
            [0] => 2013-01-07 09:05:37
            [1] => http://www.ttgood.com/jy/t150468.htm
        )

    [157] => Array
        (
            [0] => 2013-01-07 09:05:14
            [1] => http://www.ttgood.com/jy/t150465.htm
        )

    [158] => Array
        (
            [0] => 2013-01-07 09:04:55
            [1] => http://www.ttgood.com/jy/t150462.htm
        )

    [159] => Array
        (
            [0] => 2013-01-07 09:04:44
            [1] => http://www.ttgood.com/jy/t150461.htm
        )

    [160] => Array
        (
            [0] => 2013-01-07 09:04:09
            [1] => http://www.ttgood.com/jy/t150459.htm
        )

    [161] => Array
        (
            [0] => 2013-01-07 09:03:57
            [1] => http://www.ttgood.com/jy/t150458.htm
        )

    [162] => Array
        (
            [0] => 2013-01-07 09:03:40
            [1] => http://www.ttgood.com/jy/t150457.htm
        )

    [163] => Array
        (
            [0] => 2013-01-07 09:03:19
            [1] => http://www.ttgood.com/jy/t150454.htm
        )

    [164] => Array
        (
            [0] => 2013-01-07 09:03:09
            [1] => http://www.ttgood.com/jy/t150453.htm
        )

    [165] => Array
        (
            [0] => 2013-01-07 09:02:51
            [1] => http://www.ttgood.com/jy/t150450.htm
        )

    [166] => Array
        (
            [0] => 2013-01-07 08:33:32
            [1] => http://www.ttgood.com/jy/t148885.htm
        )

    [167] => Array
        (
            [0] => 2013-01-07 06:46:57
            [1] => http://www.ttgood.com/jy/t149573.htm
        )

    [168] => Array
        (
            [0] => 2013-01-07 02:00:27
            [1] => http://www.ttgood.com/jy/t149214.htm
        )

    [169] => Array
        (
            [0] => 2013-01-07 01:59:48
            [1] => http://www.ttgood.com/jy/t107090.htm
        )

    [170] => Array
        (
            [0] => 2013-01-07 01:50:26
            [1] => http://www.ttgood.com/jy/t143444.htm
        )

    [171] => Array
        (
            [0] => 2013-01-07 01:01:23
            [1] => http://www.ttgood.com/jy/t113778.htm
        )

    [172] => Array
        (
            [0] => 2013-01-07 00:44:13
            [1] => http://www.ttgood.com/jy/t138137.htm
        )

    [173] => Array
        (
            [0] => 2013-01-07 00:11:58
            [1] => http://www.ttgood.com/jy/t99941.htm
        )

    [174] => Array
        (
            [0] => 2013-01-06 23:52:53
            [1] => http://www.ttgood.com/jy/t142669.htm
        )

    [175] => Array
        (
            [0] => 2013-01-06 23:30:51
            [1] => http://www.ttgood.com/jy/t146557.htm
        )

    [176] => Array
        (
            [0] => 2013-01-06 23:30:07
            [1] => http://www.ttgood.com/jy/t150094.htm
        )

    [177] => Array
        (
            [0] => 2013-01-06 23:24:58
            [1] => http://www.ttgood.com/jy/t149086.htm
        )

    [178] => Array
        (
            [0] => 2013-01-06 23:20:10
            [1] => http://www.ttgood.com/jy/t150097.htm
        )

    [179] => Array
        (
            [0] => 2013-01-06 23:03:38
            [1] => http://www.ttgood.com/jy/t139150.htm
        )

    [180] => Array
        (
            [0] => 2013-01-06 22:58:57
            [1] => http://www.ttgood.com/jy/t146258.htm
        )

    [181] => Array
        (
            [0] => 2013-01-06 22:49:11
            [1] => http://www.ttgood.com/jy/t141544.htm
        )

    [182] => Array
        (
            [0] => 2013-01-06 22:43:17
            [1] => http://www.ttgood.com/jy/t133048.htm
        )

    [183] => Array
        (
            [0] => 2013-01-06 22:30:21
            [1] => http://www.ttgood.com/jy/t138018.htm
        )

    [184] => Array
        (
            [0] => 2013-01-06 22:22:45
            [1] => http://www.ttgood.com/jy/t8034.htm
        )

    [185] => Array
        (
            [0] => 2013-01-06 22:21:21
            [1] => http://www.ttgood.com/jy/t72371.htm
        )

    [186] => Array
        (
            [0] => 2013-01-06 22:15:10
            [1] => http://www.ttgood.com/jy/t143159.htm
        )

    [187] => Array
        (
            [0] => 2013-01-06 22:12:29
            [1] => http://www.ttgood.com/jy/t150107.htm
        )

    [188] => Array
        (
            [0] => 2013-01-06 22:11:54
            [1] => http://www.ttgood.com/jy/t150255.htm
        )

    [189] => Array
        (
            [0] => 2013-01-06 22:09:34
            [1] => http://www.ttgood.com/jy/t149996.htm
        )

    [190] => Array
        (
            [0] => 2013-01-06 22:06:20
            [1] => http://www.ttgood.com/jy/t143170.htm
        )

    [191] => Array
        (
            [0] => 2013-01-06 22:04:29
            [1] => http://www.ttgood.com/jy/t147061.htm
        )

    [192] => Array
        (
            [0] => 2013-01-06 21:56:31
            [1] => http://www.ttgood.com/jy/t141143.htm
        )

    [193] => Array
        (
            [0] => 2013-01-06 21:52:22
            [1] => http://www.ttgood.com/jy/t136397.htm
        )

    [194] => Array
        (
            [0] => 2013-01-06 21:30:20
            [1] => http://www.ttgood.com/jy/t94978.htm
        )

    [195] => Array
        (
            [0] => 2013-01-06 21:29:52
            [1] => http://www.ttgood.com/jy/t137481.htm
        )

    [196] => Array
        (
            [0] => 2013-01-06 21:28:03
            [1] => http://www.ttgood.com/jy/t146522.htm
        )

    [197] => Array
        (
            [0] => 2013-01-06 21:17:50
            [1] => http://www.ttgood.com/jy/t128078.htm
        )

    [198] => Array
        (
            [0] => 2013-01-06 21:16:16
            [1] => http://www.ttgood.com/jy/t149558.htm
        )

    [199] => Array
        (
            [0] => 2013-01-06 21:11:04
            [1] => http://www.ttgood.com/jy/t126969.htm
        )

    [200] => Array
        (
            [0] => 2013-01-06 21:01:14
            [1] => http://www.ttgood.com/jy/t141317.htm
        )

    [201] => Array
        (
            [0] => 2013-01-06 20:39:05
            [1] => http://www.ttgood.com/jy/t147049.htm
        )

    [202] => Array
        (
            [0] => 2013-01-06 20:34:24
            [1] => http://www.ttgood.com/jy/t150440.htm
        )

    [203] => Array
        (
            [0] => 2013-01-06 20:12:46
            [1] => http://www.ttgood.com/jy/t140623.htm
        )

    [204] => Array
        (
            [0] => 2013-01-06 19:50:24
            [1] => http://www.ttgood.com/jy/t110837.htm
        )

    [205] => Array
        (
            [0] => 2013-01-06 19:26:52
            [1] => http://www.ttgood.com/jy/t150265.htm
        )

    [206] => Array
        (
            [0] => 2013-01-06 19:22:24
            [1] => http://www.ttgood.com/jy/t141108.htm
        )

    [207] => Array
        (
            [0] => 2013-01-06 19:20:32
            [1] => http://www.ttgood.com/jy/t148549.htm
        )

    [208] => Array
        (
            [0] => 2013-01-06 19:08:18
            [1] => http://www.ttgood.com/jy/t121529.htm
        )

    [209] => Array
        (
            [0] => 2013-01-06 18:59:11
            [1] => http://www.ttgood.com/jy/t145077.htm
        )

    [210] => Array
        (
            [0] => 2013-01-06 18:48:06
            [1] => http://www.ttgood.com/jy/t137323.htm
        )

    [211] => Array
        (
            [0] => 2013-01-06 18:35:51
            [1] => http://www.ttgood.com/jy/t150366.htm
        )

    [212] => Array
        (
            [0] => 2013-01-06 18:33:13
            [1] => http://www.ttgood.com/jy/t44860.htm
        )

    [213] => Array
        (
            [0] => 2013-01-06 18:24:15
            [1] => http://www.ttgood.com/jy/t148759.htm
        )

    [214] => Array
        (
            [0] => 2013-01-06 18:22:08
            [1] => http://www.ttgood.com/jy/t133293.htm
        )

    [215] => Array
        (
            [0] => 2013-01-06 18:20:48
            [1] => http://www.ttgood.com/jy/t107391.htm
        )

    [216] => Array
        (
            [0] => 2013-01-06 18:13:35
            [1] => http://www.ttgood.com/jy/t143405.htm
        )

    [217] => Array
        (
            [0] => 2013-01-06 18:10:31
            [1] => http://www.ttgood.com/jy/t144455.htm
        )

    [218] => Array
        (
            [0] => 2013-01-06 18:09:55
            [1] => http://www.ttgood.com/jy/t150441.htm
        )

    [219] => Array
        (
            [0] => 2013-01-06 18:07:36
            [1] => http://www.ttgood.com/jy/t145074.htm
        )

    [220] => Array
        (
            [0] => 2013-01-06 18:07:05
            [1] => http://www.ttgood.com/jy/t127427.htm
        )

    [221] => Array
        (
            [0] => 2013-01-06 18:03:26
            [1] => http://www.ttgood.com/jy/t145085.htm
        )

    [222] => Array
        (
            [0] => 2013-01-06 17:59:21
            [1] => http://www.ttgood.com/jy/t135964.htm
        )

    [223] => Array
        (
            [0] => 2013-01-06 17:59:03
            [1] => http://www.ttgood.com/jy/t149515.htm
        )

    [224] => Array
        (
            [0] => 2013-01-06 17:58:47
            [1] => http://www.ttgood.com/jy/t93394.htm
        )

    [225] => Array
        (
            [0] => 2013-01-06 17:48:27
            [1] => http://www.ttgood.com/jy/t148695.htm
        )

    [226] => Array
        (
            [0] => 2013-01-06 17:47:42
            [1] => http://www.ttgood.com/jy/t85845.htm
        )

    [227] => Array
        (
            [0] => 2013-01-06 17:43:22
            [1] => http://www.ttgood.com/jy/t140544.htm
        )

    [228] => Array
        (
            [0] => 2013-01-06 17:12:36
            [1] => http://www.ttgood.com/jy/t149163.htm
        )

    [229] => Array
        (
            [0] => 2013-01-06 17:11:59
            [1] => http://www.ttgood.com/jy/t150195.htm
        )

    [230] => Array
        (
            [0] => 2013-01-06 16:55:34
            [1] => http://www.ttgood.com/jy/t86465.htm
        )

    [231] => Array
        (
            [0] => 2013-01-06 16:54:03
            [1] => http://www.ttgood.com/jy/t126590.htm
        )

    [232] => Array
        (
            [0] => 2013-01-06 16:52:20
            [1] => http://www.ttgood.com/jy/t148566.htm
        )

    [233] => Array
        (
            [0] => 2013-01-06 16:39:59
            [1] => http://www.ttgood.com/jy/t149244.htm
        )

    [234] => Array
        (
            [0] => 2013-01-06 16:38:49
            [1] => http://www.ttgood.com/jy/t141005.htm
        )

    [235] => Array
        (
            [0] => 2013-01-06 16:36:10
            [1] => http://www.ttgood.com/jy/t83522.htm
        )

    [236] => Array
        (
            [0] => 2013-01-06 16:28:59
            [1] => http://www.ttgood.com/jy/t148859.htm
        )

    [237] => Array
        (
            [0] => 2013-01-06 16:17:40
            [1] => http://www.ttgood.com/jy/t149010.htm
        )

    [238] => Array
        (
            [0] => 2013-01-06 16:06:40
            [1] => http://www.ttgood.com/jy/t142512.htm
        )

    [239] => Array
        (
            [0] => 2013-01-06 16:04:34
            [1] => http://www.ttgood.com/jy/t145831.htm
        )

    [240] => Array
        (
            [0] => 2013-01-06 16:00:53
            [1] => http://www.ttgood.com/jy/t150228.htm
        )

    [241] => Array
        (
            [0] => 2013-01-06 15:58:11
            [1] => http://www.ttgood.com/jy/t150221.htm
        )

    [242] => Array
        (
            [0] => 2013-01-06 15:57:54
            [1] => http://www.ttgood.com/jy/t150118.htm
        )

    [243] => Array
        (
            [0] => 2013-01-06 15:56:41
            [1] => http://www.ttgood.com/jy/t146600.htm
        )

    [244] => Array
        (
            [0] => 2013-01-06 15:54:32
            [1] => http://www.ttgood.com/jy/t123780.htm
        )

    [245] => Array
        (
            [0] => 2013-01-06 15:53:43
            [1] => http://www.ttgood.com/jy/t147271.htm
        )

    [246] => Array
        (
            [0] => 2013-01-06 15:51:56
            [1] => http://www.ttgood.com/jy/t67556.htm
        )

    [247] => Array
        (
            [0] => 2013-01-06 15:49:38
            [1] => http://www.ttgood.com/jy/t17784.htm
        )

    [248] => Array
        (
            [0] => 2013-01-06 15:45:58
            [1] => http://www.ttgood.com/jy/t145288.htm
        )

    [249] => Array
        (
            [0] => 2013-01-06 15:41:40
            [1] => http://www.ttgood.com/jy/t15365.htm
        )

    [250] => Array
        (
            [0] => 2013-01-06 15:40:40
            [1] => http://www.ttgood.com/jy/t150299.htm
        )

    [251] => Array
        (
            [0] => 2013-01-06 15:21:13
            [1] => http://www.ttgood.com/jy/t100728.htm
        )

    [252] => Array
        (
            [0] => 2013-01-06 15:06:23
            [1] => http://www.ttgood.com/jy/t150346.htm
        )

    [253] => Array
        (
            [0] => 2013-01-06 15:06:05
            [1] => http://www.ttgood.com/jy/t150395.htm
        )

    [254] => Array
        (
            [0] => 2013-01-06 15:04:23
            [1] => http://www.ttgood.com/jy/t141131.htm
        )

    [255] => Array
        (
            [0] => 2013-01-06 14:59:49
            [1] => http://www.ttgood.com/jy/t149628.htm
        )

    [256] => Array
        (
            [0] => 2013-01-06 14:59:21
            [1] => http://www.ttgood.com/jy/t64377.htm
        )

    [257] => Array
        (
            [0] => 2013-01-06 14:58:20
            [1] => http://www.ttgood.com/jy/t147915.htm
        )

    [258] => Array
        (
            [0] => 2013-01-06 14:44:41
            [1] => http://www.ttgood.com/jy/t89816.htm
        )

    [259] => Array
        (
            [0] => 2013-01-06 14:43:45
            [1] => http://www.ttgood.com/jy/t138857.htm
        )

    [260] => Array
        (
            [0] => 2013-01-06 14:38:59
            [1] => http://www.ttgood.com/jy/t122902.htm
        )

    [261] => Array
        (
            [0] => 2013-01-06 14:38:52
            [1] => http://www.ttgood.com/jy/t141279.htm
        )

    [262] => Array
        (
            [0] => 2013-01-06 14:38:19
            [1] => http://www.ttgood.com/jy/t123232.htm
        )

    [263] => Array
        (
            [0] => 2013-01-06 14:33:24
            [1] => http://www.ttgood.com/jy/t52859.htm
        )

    [264] => Array
        (
            [0] => 2013-01-06 14:28:36
            [1] => http://www.ttgood.com/jy/t101599.htm
        )

    [265] => Array
        (
            [0] => 2013-01-06 14:26:31
            [1] => http://www.ttgood.com/jy/t133031.htm
        )

    [266] => Array
        (
            [0] => 2013-01-06 14:22:11
            [1] => http://www.ttgood.com/jy/t147936.htm
        )

    [267] => Array
        (
            [0] => 2013-01-06 14:20:14
            [1] => http://www.ttgood.com/jy/t149692.htm
        )

    [268] => Array
        (
            [0] => 2013-01-06 14:19:32
            [1] => http://www.ttgood.com/jy/t144337.htm
        )

    [269] => Array
        (
            [0] => 2013-01-06 14:04:24
            [1] => http://www.ttgood.com/jy/t149143.htm
        )

    [270] => Array
        (
            [0] => 2013-01-06 14:02:40
            [1] => http://www.ttgood.com/jy/t148469.htm
        )

    [271] => Array
        (
            [0] => 2013-01-06 14:02:35
            [1] => http://www.ttgood.com/jy/t150320.htm
        )

    [272] => Array
        (
            [0] => 2013-01-06 13:57:52
            [1] => http://www.ttgood.com/jy/t127665.htm
        )

    [273] => Array
        (
            [0] => 2013-01-06 13:56:23
            [1] => http://www.ttgood.com/jy/t57774.htm
        )

    [274] => Array
        (
            [0] => 2013-01-06 13:53:11
            [1] => http://www.ttgood.com/jy/t142269.htm
        )

    [275] => Array
        (
            [0] => 2013-01-06 13:52:08
            [1] => http://www.ttgood.com/jy/t147602.htm
        )

    [276] => Array
        (
            [0] => 2013-01-06 13:48:42
            [1] => http://www.ttgood.com/jy/t146964.htm
        )

    [277] => Array
        (
            [0] => 2013-01-06 13:47:28
            [1] => http://www.ttgood.com/jy/t144126.htm
        )

    [278] => Array
        (
            [0] => 2013-01-06 13:45:00
            [1] => http://www.ttgood.com/jy/t62340.htm
        )

    [279] => Array
        (
            [0] => 2013-01-06 13:40:26
            [1] => http://www.ttgood.com/jy/t98053.htm
        )

    [280] => Array
        (
            [0] => 2013-01-06 13:36:58
            [1] => http://www.ttgood.com/jy/t129779.htm
        )

    [281] => Array
        (
            [0] => 2013-01-06 13:32:48
            [1] => http://www.ttgood.com/jy/t145217.htm
        )

    [282] => Array
        (
            [0] => 2013-01-06 13:30:04
            [1] => http://www.ttgood.com/jy/t145382.htm
        )

    [283] => Array
        (
            [0] => 2013-01-06 13:18:36
            [1] => http://www.ttgood.com/jy/t148390.htm
        )

    [284] => Array
        (
            [0] => 2013-01-06 12:56:32
            [1] => http://www.ttgood.com/jy/t130071.htm
        )

    [285] => Array
        (
            [0] => 2013-01-06 12:55:50
            [1] => http://www.ttgood.com/jy/t50946.htm
        )

    [286] => Array
        (
            [0] => 2013-01-06 12:46:34
            [1] => http://www.ttgood.com/jy/t115025.htm
        )

    [287] => Array
        (
            [0] => 2013-01-06 12:45:34
            [1] => http://www.ttgood.com/jy/t147885.htm
        )

    [288] => Array
        (
            [0] => 2013-01-06 12:38:57
            [1] => http://www.ttgood.com/jy/t150445.htm
        )

    [289] => Array
        (
            [0] => 2013-01-06 12:38:12
            [1] => http://www.ttgood.com/jy/t141923.htm
        )

    [290] => Array
        (
            [0] => 2013-01-06 12:23:21
            [1] => http://www.ttgood.com/jy/t136391.htm
        )

    [291] => Array
        (
            [0] => 2013-01-06 12:06:48
            [1] => http://www.ttgood.com/jy/t138187.htm
        )

    [292] => Array
        (
            [0] => 2013-01-06 11:57:59
            [1] => http://www.ttgood.com/jy/t147131.htm
        )

    [293] => Array
        (
            [0] => 2013-01-06 11:41:07
            [1] => http://www.ttgood.com/jy/t149548.htm
        )

    [294] => Array
        (
            [0] => 2013-01-06 11:09:43
            [1] => http://www.ttgood.com/jy/t149998.htm
        )

    [295] => Array
        (
            [0] => 2013-01-06 11:06:04
            [1] => http://www.ttgood.com/jy/t120778.htm
        )

    [296] => Array
        (
            [0] => 2013-01-06 10:52:26
            [1] => http://www.ttgood.com/jy/t142676.htm
        )

    [297] => Array
        (
            [0] => 2013-01-06 10:50:49
            [1] => http://www.ttgood.com/jy/t149657.htm
        )

    [298] => Array
        (
            [0] => 2013-01-06 10:49:58
            [1] => http://www.ttgood.com/jy/t145372.htm
        )

    [299] => Array
        (
            [0] => 2013-01-06 10:43:42
            [1] => http://www.ttgood.com/jy/t150372.htm
        )

    [300] => Array
        (
            [0] => 2013-01-06 10:35:44
            [1] => http://www.ttgood.com/jy/t91513.htm
        )

    [301] => Array
        (
            [0] => 2013-01-06 10:23:56
            [1] => http://www.ttgood.com/jy/t147303.htm
        )

    [302] => Array
        (
            [0] => 2013-01-06 10:19:51
            [1] => http://www.ttgood.com/jy/t146973.htm
        )

    [303] => Array
        (
            [0] => 2013-01-06 10:08:36
            [1] => http://www.ttgood.com/jy/t149688.htm
        )

    [304] => Array
        (
            [0] => 2013-01-06 09:55:33
            [1] => http://www.ttgood.com/jy/t140105.htm
        )

    [305] => Array
        (
            [0] => 2013-01-06 09:35:14
            [1] => http://www.ttgood.com/jy/t150407.htm
        )

    [306] => Array
        (
            [0] => 2013-01-06 09:26:04
            [1] => http://www.ttgood.com/jy/t150447.htm
        )

    [307] => Array
        (
            [0] => 2013-01-06 09:25:49
            [1] => http://www.ttgood.com/jy/t150446.htm
        )

    [308] => Array
        (
            [0] => 2013-01-06 09:24:10
            [1] => http://www.ttgood.com/jy/t150443.htm
        )

    [309] => Array
        (
            [0] => 2013-01-06 09:23:22
            [1] => http://www.ttgood.com/jy/t150442.htm
        )

    [310] => Array
        (
            [0] => 2013-01-06 09:21:40
            [1] => http://www.ttgood.com/jy/t59866.htm
        )

    [311] => Array
        (
            [0] => 2013-01-06 09:20:09
            [1] => http://www.ttgood.com/jy/t96806.htm
        )

    [312] => Array
        (
            [0] => 2013-01-06 09:20:06
            [1] => http://www.ttgood.com/jy/t150438.htm
        )

    [313] => Array
        (
            [0] => 2013-01-06 09:19:29
            [1] => http://www.ttgood.com/jy/t150437.htm
        )

    [314] => Array
        (
            [0] => 2013-01-06 09:18:20
            [1] => http://www.ttgood.com/jy/t150436.htm
        )

    [315] => Array
        (
            [0] => 2013-01-06 09:17:30
            [1] => http://www.ttgood.com/jy/t52122.htm
        )

    [316] => Array
        (
            [0] => 2013-01-06 09:17:29
            [1] => http://www.ttgood.com/jy/t150435.htm
        )

    [317] => Array
        (
            [0] => 2013-01-06 09:16:46
            [1] => http://www.ttgood.com/jy/t150433.htm
        )

    [318] => Array
        (
            [0] => 2013-01-06 09:14:22
            [1] => http://www.ttgood.com/jy/t150428.htm
        )

    [319] => Array
        (
            [0] => 2013-01-06 09:12:27
            [1] => http://www.ttgood.com/jy/t146865.htm
        )

    [320] => Array
        (
            [0] => 2013-01-06 08:52:15
            [1] => http://www.ttgood.com/jy/t147257.htm
        )

    [321] => Array
        (
            [0] => 2013-01-06 08:36:12
            [1] => http://www.ttgood.com/jy/t147834.htm
        )

    [322] => Array
        (
            [0] => 2013-01-06 08:29:52
            [1] => http://www.ttgood.com/jy/t150159.htm
        )

    [323] => Array
        (
            [0] => 2013-01-06 08:25:38
            [1] => http://www.ttgood.com/jy/t111716.htm
        )

    [324] => Array
        (
            [0] => 2013-01-06 01:06:03
            [1] => http://www.ttgood.com/jy/t28608.htm
        )

    [325] => Array
        (
            [0] => 2013-01-06 00:41:39
            [1] => http://www.ttgood.com/jy/t142194.htm
        )

    [326] => Array
        (
            [0] => 2013-01-06 00:27:16
            [1] => http://www.ttgood.com/jy/t29958.htm
        )

    [327] => Array
        (
            [0] => 2013-01-06 00:07:48
            [1] => http://www.ttgood.com/jy/t77243.htm
        )

    [328] => Array
        (
            [0] => 2013-01-06 00:07:04
            [1] => http://www.ttgood.com/jy/t98742.htm
        )

    [329] => Array
        (
            [0] => 2013-01-05 23:45:12
            [1] => http://www.ttgood.com/jy/t147357.htm
        )

    [330] => Array
        (
            [0] => 2013-01-05 23:44:47
            [1] => http://www.ttgood.com/jy/t145154.htm
        )

    [331] => Array
        (
            [0] => 2013-01-05 23:15:02
            [1] => http://www.ttgood.com/jy/t122908.htm
        )

    [332] => Array
        (
            [0] => 2013-01-05 23:00:24
            [1] => http://www.ttgood.com/jy/t150365.htm
        )

    [333] => Array
        (
            [0] => 2013-01-05 22:02:06
            [1] => http://www.ttgood.com/jy/t138530.htm
        )

    [334] => Array
        (
            [0] => 2013-01-05 22:00:45
            [1] => http://www.ttgood.com/jy/t140486.htm
        )

    [335] => Array
        (
            [0] => 2013-01-05 21:59:20
            [1] => http://www.ttgood.com/jy/t121268.htm
        )

    [336] => Array
        (
            [0] => 2013-01-05 21:54:58
            [1] => http://www.ttgood.com/jy/t148941.htm
        )

    [337] => Array
        (
            [0] => 2013-01-05 21:42:03
            [1] => http://www.ttgood.com/jy/t148880.htm
        )

    [338] => Array
        (
            [0] => 2013-01-05 21:30:59
            [1] => http://www.ttgood.com/jy/t136436.htm
        )

    [339] => Array
        (
            [0] => 2013-01-05 21:19:16
            [1] => http://www.ttgood.com/jy/t147977.htm
        )

    [340] => Array
        (
            [0] => 2013-01-05 21:18:43
            [1] => http://www.ttgood.com/jy/t92575.htm
        )

    [341] => Array
        (
            [0] => 2013-01-05 21:06:24
            [1] => http://www.ttgood.com/jy/t140134.htm
        )

    [342] => Array
        (
            [0] => 2013-01-05 21:01:01
            [1] => http://www.ttgood.com/jy/t141746.htm
        )

    [343] => Array
        (
            [0] => 2013-01-05 20:46:39
            [1] => http://www.ttgood.com/jy/t148429.htm
        )

    [344] => Array
        (
            [0] => 2013-01-05 20:44:15
            [1] => http://www.ttgood.com/jy/t148723.htm
        )

    [345] => Array
        (
            [0] => 2013-01-05 20:42:22
            [1] => http://www.ttgood.com/jy/t148252.htm
        )

    [346] => Array
        (
            [0] => 2013-01-05 20:31:18
            [1] => http://www.ttgood.com/jy/t149187.htm
        )

    [347] => Array
        (
            [0] => 2013-01-05 20:23:35
            [1] => http://www.ttgood.com/jy/t136955.htm
        )

    [348] => Array
        (
            [0] => 2013-01-05 20:03:32
            [1] => http://www.ttgood.com/jy/t126279.htm
        )

    [349] => Array
        (
            [0] => 2013-01-05 20:02:48
            [1] => http://www.ttgood.com/jy/t5473.htm
        )

    [350] => Array
        (
            [0] => 2013-01-05 19:32:32
            [1] => http://www.ttgood.com/jy/t150386.htm
        )

    [351] => Array
        (
            [0] => 2013-01-05 19:30:16
            [1] => http://www.ttgood.com/jy/t149861.htm
        )

    [352] => Array
        (
            [0] => 2013-01-05 19:28:58
            [1] => http://www.ttgood.com/jy/t150239.htm
        )

    [353] => Array
        (
            [0] => 2013-01-05 19:27:38
            [1] => http://www.ttgood.com/jy/t150209.htm
        )

    [354] => Array
        (
            [0] => 2013-01-05 19:17:42
            [1] => http://www.ttgood.com/jy/t149956.htm
        )

    [355] => Array
        (
            [0] => 2013-01-05 19:16:47
            [1] => http://www.ttgood.com/jy/t146868.htm
        )

    [356] => Array
        (
            [0] => 2013-01-05 19:11:57
            [1] => http://www.ttgood.com/jy/t148539.htm
        )

    [357] => Array
        (
            [0] => 2013-01-05 19:08:53
            [1] => http://www.ttgood.com/jy/t144746.htm
        )

    [358] => Array
        (
            [0] => 2013-01-05 18:57:52
            [1] => http://www.ttgood.com/jy/t69209.htm
        )

    [359] => Array
        (
            [0] => 2013-01-05 18:56:06
            [1] => http://www.ttgood.com/jy/t95957.htm
        )

    [360] => Array
        (
            [0] => 2013-01-05 18:45:29
            [1] => http://www.ttgood.com/jy/t146608.htm
        )

    [361] => Array
        (
            [0] => 2013-01-05 18:35:24
            [1] => http://www.ttgood.com/jy/t138118.htm
        )

    [362] => Array
        (
            [0] => 2013-01-05 18:27:26
            [1] => http://www.ttgood.com/jy/t113415.htm
        )

    [363] => Array
        (
            [0] => 2013-01-05 18:05:33
            [1] => http://www.ttgood.com/jy/t150401.htm
        )

    [364] => Array
        (
            [0] => 2013-01-05 17:51:42
            [1] => http://www.ttgood.com/jy/t146607.htm
        )

    [365] => Array
        (
            [0] => 2013-01-05 17:48:39
            [1] => http://www.ttgood.com/jy/t112236.htm
        )

    [366] => Array
        (
            [0] => 2013-01-05 17:43:16
            [1] => http://www.ttgood.com/jy/t118887.htm
        )

    [367] => Array
        (
            [0] => 2013-01-05 17:31:25
            [1] => http://www.ttgood.com/jy/t46121.htm
        )

    [368] => Array
        (
            [0] => 2013-01-05 17:30:47
            [1] => http://www.ttgood.com/jy/t150335.htm
        )

    [369] => Array
        (
            [0] => 2013-01-05 17:28:47
            [1] => http://www.ttgood.com/jy/t95982.htm
        )

    [370] => Array
        (
            [0] => 2013-01-05 17:24:10
            [1] => http://www.ttgood.com/jy/t142694.htm
        )

    [371] => Array
        (
            [0] => 2013-01-05 17:19:28
            [1] => http://www.ttgood.com/jy/t77575.htm
        )

    [372] => Array
        (
            [0] => 2013-01-05 17:10:16
            [1] => http://www.ttgood.com/jy/t115424.htm
        )

    [373] => Array
        (
            [0] => 2013-01-05 17:01:12
            [1] => http://www.ttgood.com/jy/t138240.htm
        )

    [374] => Array
        (
            [0] => 2013-01-05 16:44:27
            [1] => http://www.ttgood.com/jy/t150387.htm
        )

    [375] => Array
        (
            [0] => 2013-01-05 16:38:36
            [1] => http://www.ttgood.com/jy/t116985.htm
        )

    [376] => Array
        (
            [0] => 2013-01-05 16:36:45
            [1] => http://www.ttgood.com/jy/t148519.htm
        )

    [377] => Array
        (
            [0] => 2013-01-05 16:25:18
            [1] => http://www.ttgood.com/jy/t149720.htm
        )

    [378] => Array
        (
            [0] => 2013-01-05 16:22:27
            [1] => http://www.ttgood.com/jy/t136873.htm
        )

    [379] => Array
        (
            [0] => 2013-01-05 16:14:45
            [1] => http://www.ttgood.com/jy/t149829.htm
        )

    [380] => Array
        (
            [0] => 2013-01-05 16:12:38
            [1] => http://www.ttgood.com/jy/t139621.htm
        )

    [381] => Array
        (
            [0] => 2013-01-05 16:01:50
            [1] => http://www.ttgood.com/jy/t108399.htm
        )

    [382] => Array
        (
            [0] => 2013-01-05 15:58:18
            [1] => http://www.ttgood.com/jy/t150333.htm
        )

    [383] => Array
        (
            [0] => 2013-01-05 15:55:34
            [1] => http://www.ttgood.com/jy/t149219.htm
        )

    [384] => Array
        (
            [0] => 2013-01-05 15:47:09
            [1] => http://www.ttgood.com/jy/t150167.htm
        )

    [385] => Array
        (
            [0] => 2013-01-05 15:34:10
            [1] => http://www.ttgood.com/jy/t145690.htm
        )

    [386] => Array
        (
            [0] => 2013-01-05 15:33:47
            [1] => http://www.ttgood.com/jy/t145747.htm
        )

    [387] => Array
        (
            [0] => 2013-01-05 15:27:43
            [1] => http://www.ttgood.com/jy/t48966.htm
        )

    [388] => Array
        (
            [0] => 2013-01-05 15:26:47
            [1] => http://www.ttgood.com/jy/t127917.htm
        )

    [389] => Array
        (
            [0] => 2013-01-05 15:21:52
            [1] => http://www.ttgood.com/jy/t150135.htm
        )

    [390] => Array
        (
            [0] => 2013-01-05 15:19:24
            [1] => http://www.ttgood.com/jy/t105773.htm
        )

    [391] => Array
        (
            [0] => 2013-01-05 15:18:01
            [1] => http://www.ttgood.com/jy/t147273.htm
        )

    [392] => Array
        (
            [0] => 2013-01-05 15:14:26
            [1] => http://www.ttgood.com/jy/t125629.htm
        )

    [393] => Array
        (
            [0] => 2013-01-05 15:14:00
            [1] => http://www.ttgood.com/jy/t147451.htm
        )

    [394] => Array
        (
            [0] => 2013-01-05 15:02:41
            [1] => http://www.ttgood.com/jy/t138043.htm
        )

    [395] => Array
        (
            [0] => 2013-01-05 14:49:03
            [1] => http://www.ttgood.com/jy/t149666.htm
        )

    [396] => Array
        (
            [0] => 2013-01-05 14:42:13
            [1] => http://www.ttgood.com/jy/t126693.htm
        )

    [397] => Array
        (
            [0] => 2013-01-05 14:38:52
            [1] => http://www.ttgood.com/jy/t139329.htm
        )

    [398] => Array
        (
            [0] => 2013-01-05 14:20:04
            [1] => http://www.ttgood.com/jy/t135437.htm
        )

    [399] => Array
        (
            [0] => 2013-01-05 14:17:15
            [1] => http://www.ttgood.com/jy/t150376.htm
        )

    [400] => Array
        (
            [0] => 2013-01-05 13:52:54
            [1] => http://www.ttgood.com/jy/t144686.htm
        )

    [401] => Array
        (
            [0] => 2013-01-05 13:44:01
            [1] => http://www.ttgood.com/jy/t130308.htm
        )

    [402] => Array
        (
            [0] => 2013-01-05 13:38:38
            [1] => http://www.ttgood.com/jy/t150408.htm
        )

    [403] => Array
        (
            [0] => 2013-01-05 13:27:27
            [1] => http://www.ttgood.com/jy/t149640.htm
        )

    [404] => Array
        (
            [0] => 2013-01-05 13:25:57
            [1] => http://www.ttgood.com/jy/t108804.htm
        )

    [405] => Array
        (
            [0] => 2013-01-05 13:20:59
            [1] => http://www.ttgood.com/jy/t91030.htm
        )

    [406] => Array
        (
            [0] => 2013-01-05 13:20:33
            [1] => http://www.ttgood.com/jy/t149404.htm
        )

    [407] => Array
        (
            [0] => 2013-01-05 13:03:52
            [1] => http://www.ttgood.com/jy/t104350.htm
        )

    [408] => Array
        (
            [0] => 2013-01-05 13:03:39
            [1] => http://www.ttgood.com/jy/t148354.htm
        )

    [409] => Array
        (
            [0] => 2013-01-05 12:59:36
            [1] => http://www.ttgood.com/jy/t102659.htm
        )

    [410] => Array
        (
            [0] => 2013-01-05 12:59:01
            [1] => http://www.ttgood.com/jy/t105240.htm
        )

    [411] => Array
        (
            [0] => 2013-01-05 12:42:20
            [1] => http://www.ttgood.com/jy/t98571.htm
        )

    [412] => Array
        (
            [0] => 2013-01-05 12:38:47
            [1] => http://www.ttgood.com/jy/t138803.htm
        )

    [413] => Array
        (
            [0] => 2013-01-05 12:35:56
            [1] => http://www.ttgood.com/jy/t150158.htm
        )

    [414] => Array
        (
            [0] => 2013-01-05 12:31:54
            [1] => http://www.ttgood.com/jy/t150420.htm
        )

    [415] => Array
        (
            [0] => 2013-01-05 12:22:22
            [1] => http://www.ttgood.com/jy/t74444.htm
        )

    [416] => Array
        (
            [0] => 2013-01-05 12:22:06
            [1] => http://www.ttgood.com/jy/t150390.htm
        )

    [417] => Array
        (
            [0] => 2013-01-05 12:11:51
            [1] => http://www.ttgood.com/jy/t118128.htm
        )

    [418] => Array
        (
            [0] => 2013-01-05 11:56:15
            [1] => http://www.ttgood.com/jy/t150344.htm
        )

    [419] => Array
        (
            [0] => 2013-01-05 11:55:55
            [1] => http://www.ttgood.com/jy/t147325.htm
        )

    [420] => Array
        (
            [0] => 2013-01-05 11:51:52
            [1] => http://www.ttgood.com/jy/t148669.htm
        )

    [421] => Array
        (
            [0] => 2013-01-05 11:36:41
            [1] => http://www.ttgood.com/jy/t58545.htm
        )

    [422] => Array
        (
            [0] => 2013-01-05 11:17:58
            [1] => http://www.ttgood.com/jy/t98931.htm
        )

    [423] => Array
        (
            [0] => 2013-01-05 11:08:09
            [1] => http://www.ttgood.com/jy/t104325.htm
        )

    [424] => Array
        (
            [0] => 2013-01-05 11:00:26
            [1] => http://www.ttgood.com/jy/t108001.htm
        )

    [425] => Array
        (
            [0] => 2013-01-05 10:59:54
            [1] => http://www.ttgood.com/jy/t6177.htm
        )

    [426] => Array
        (
            [0] => 2013-01-05 10:58:10
            [1] => http://www.ttgood.com/jy/t150327.htm
        )

    [427] => Array
        (
            [0] => 2013-01-05 10:56:33
            [1] => http://www.ttgood.com/jy/t150257.htm
        )

    [428] => Array
        (
            [0] => 2013-01-05 10:56:01
            [1] => http://www.ttgood.com/jy/t123684.htm
        )

    [429] => Array
        (
            [0] => 2013-01-05 10:50:06
            [1] => http://www.ttgood.com/jy/t91056.htm
        )

    [430] => Array
        (
            [0] => 2013-01-05 10:21:27
            [1] => http://www.ttgood.com/jy/t140182.htm
        )

    [431] => Array
        (
            [0] => 2013-01-05 10:20:45
            [1] => http://www.ttgood.com/jy/t149946.htm
        )

    [432] => Array
        (
            [0] => 2013-01-05 10:13:45
            [1] => http://www.ttgood.com/jy/t138288.htm
        )

    [433] => Array
        (
            [0] => 2013-01-05 10:06:47
            [1] => http://www.ttgood.com/jy/t146358.htm
        )

    [434] => Array
        (
            [0] => 2013-01-05 10:04:15
            [1] => http://www.ttgood.com/jy/t136258.htm
        )

    [435] => Array
        (
            [0] => 2013-01-05 09:24:36
            [1] => http://www.ttgood.com/jy/t74763.htm
        )

    [436] => Array
        (
            [0] => 2013-01-05 09:23:20
            [1] => http://www.ttgood.com/jy/t150422.htm
        )

    [437] => Array
        (
            [0] => 2013-01-05 09:23:08
            [1] => http://www.ttgood.com/jy/t150419.htm
        )

    [438] => Array
        (
            [0] => 2013-01-05 09:22:21
            [1] => http://www.ttgood.com/jy/t150415.htm
        )

    [439] => Array
        (
            [0] => 2013-01-05 09:21:51
            [1] => http://www.ttgood.com/jy/t150412.htm
        )

    [440] => Array
        (
            [0] => 2013-01-05 09:21:46
            [1] => http://www.ttgood.com/jy/t150410.htm
        )

    [441] => Array
        (
            [0] => 2013-01-05 09:21:18
            [1] => http://www.ttgood.com/jy/t150406.htm
        )

    [442] => Array
        (
            [0] => 2013-01-05 09:21:11
            [1] => http://www.ttgood.com/jy/t150405.htm
        )

    [443] => Array
        (
            [0] => 2013-01-05 09:21:02
            [1] => http://www.ttgood.com/jy/t150404.htm
        )

    [444] => Array
        (
            [0] => 2013-01-05 09:20:40
            [1] => http://www.ttgood.com/jy/t150403.htm
        )

    [445] => Array
        (
            [0] => 2013-01-05 09:20:26
            [1] => http://www.ttgood.com/jy/t150399.htm
        )

    [446] => Array
        (
            [0] => 2013-01-05 09:20:23
            [1] => http://www.ttgood.com/jy/t150074.htm
        )

    [447] => Array
        (
            [0] => 2013-01-05 09:10:27
            [1] => http://www.ttgood.com/jy/t129119.htm
        )

    [448] => Array
        (
            [0] => 2013-01-05 08:24:25
            [1] => http://www.ttgood.com/jy/t150330.htm
        )

    [449] => Array
        (
            [0] => 2013-01-05 07:56:18
            [1] => http://www.ttgood.com/jy/t150227.htm
        )

    [450] => Array
        (
            [0] => 2013-01-05 02:09:56
            [1] => http://www.ttgood.com/jy/t138860.htm
        )

    [451] => Array
        (
            [0] => 2013-01-05 00:08:24
            [1] => http://www.ttgood.com/jy/t86004.htm
        )

    [452] => Array
        (
            [0] => 2013-01-05 00:04:56
            [1] => http://www.ttgood.com/jy/t150375.htm
        )

    [453] => Array
        (
            [0] => 2013-01-04 23:44:21
            [1] => http://www.ttgood.com/jy/t149699.htm
        )

    [454] => Array
        (
            [0] => 2013-01-04 23:37:54
            [1] => http://www.ttgood.com/jy/t113957.htm
        )

    [455] => Array
        (
            [0] => 2013-01-04 23:03:00
            [1] => http://www.ttgood.com/jy/t138781.htm
        )

    [456] => Array
        (
            [0] => 2013-01-04 22:49:50
            [1] => http://www.ttgood.com/jy/t141960.htm
        )

    [457] => Array
        (
            [0] => 2013-01-04 22:34:34
            [1] => http://www.ttgood.com/jy/t148115.htm
        )

    [458] => Array
        (
            [0] => 2013-01-04 22:16:19
            [1] => http://www.ttgood.com/jy/t150262.htm
        )

    [459] => Array
        (
            [0] => 2013-01-04 22:05:45
            [1] => http://www.ttgood.com/jy/t81513.htm
        )

    [460] => Array
        (
            [0] => 2013-01-04 21:45:37
            [1] => http://www.ttgood.com/jy/t135783.htm
        )

    [461] => Array
        (
            [0] => 2013-01-04 21:35:43
            [1] => http://www.ttgood.com/jy/t140720.htm
        )

    [462] => Array
        (
            [0] => 2013-01-04 21:03:16
            [1] => http://www.ttgood.com/jy/t119942.htm
        )

    [463] => Array
        (
            [0] => 2013-01-04 21:01:07
            [1] => http://www.ttgood.com/jy/t144658.htm
        )

    [464] => Array
        (
            [0] => 2013-01-04 20:50:13
            [1] => http://www.ttgood.com/jy/t143692.htm
        )

    [465] => Array
        (
            [0] => 2013-01-04 20:46:11
            [1] => http://www.ttgood.com/jy/t147363.htm
        )

    [466] => Array
        (
            [0] => 2013-01-04 20:42:02
            [1] => http://www.ttgood.com/jy/t145050.htm
        )

    [467] => Array
        (
            [0] => 2013-01-04 20:38:30
            [1] => http://www.ttgood.com/jy/t71251.htm
        )

    [468] => Array
        (
            [0] => 2013-01-04 20:27:39
            [1] => http://www.ttgood.com/jy/t138085.htm
        )

    [469] => Array
        (
            [0] => 2013-01-04 20:26:42
            [1] => http://www.ttgood.com/jy/t142109.htm
        )

    [470] => Array
        (
            [0] => 2013-01-04 20:12:43
            [1] => http://www.ttgood.com/jy/t139502.htm
        )

    [471] => Array
        (
            [0] => 2013-01-04 19:54:33
            [1] => http://www.ttgood.com/jy/t149805.htm
        )

    [472] => Array
        (
            [0] => 2013-01-04 19:44:17
            [1] => http://www.ttgood.com/jy/t147762.htm
        )

    [473] => Array
        (
            [0] => 2013-01-04 19:41:10
            [1] => http://www.ttgood.com/jy/t133950.htm
        )

    [474] => Array
        (
            [0] => 2013-01-04 19:36:19
            [1] => http://www.ttgood.com/jy/t141428.htm
        )

    [475] => Array
        (
            [0] => 2013-01-04 19:33:33
            [1] => http://www.ttgood.com/jy/t148686.htm
        )

    [476] => Array
        (
            [0] => 2013-01-04 19:27:37
            [1] => http://www.ttgood.com/jy/t143225.htm
        )

    [477] => Array
        (
            [0] => 2013-01-04 19:06:41
            [1] => http://www.ttgood.com/jy/t149533.htm
        )

    [478] => Array
        (
            [0] => 2013-01-04 18:56:30
            [1] => http://www.ttgood.com/jy/t149405.htm
        )

    [479] => Array
        (
            [0] => 2013-01-04 18:47:52
            [1] => http://www.ttgood.com/jy/t143716.htm
        )

    [480] => Array
        (
            [0] => 2013-01-04 18:33:17
            [1] => http://www.ttgood.com/jy/t146806.htm
        )

    [481] => Array
        (
            [0] => 2013-01-04 18:29:49
            [1] => http://www.ttgood.com/jy/t143563.htm
        )

    [482] => Array
        (
            [0] => 2013-01-04 18:23:55
            [1] => http://www.ttgood.com/jy/t134282.htm
        )

    [483] => Array
        (
            [0] => 2013-01-04 17:34:35
            [1] => http://www.ttgood.com/jy/t147475.htm
        )

    [484] => Array
        (
            [0] => 2013-01-04 17:32:12
            [1] => http://www.ttgood.com/jy/t148558.htm
        )

    [485] => Array
        (
            [0] => 2013-01-04 17:16:42
            [1] => http://www.ttgood.com/jy/t147737.htm
        )

    [486] => Array
        (
            [0] => 2013-01-04 16:52:02
            [1] => http://www.ttgood.com/jy/t137518.htm
        )

    [487] => Array
        (
            [0] => 2013-01-04 16:22:59
            [1] => http://www.ttgood.com/jy/t142391.htm
        )

    [488] => Array
        (
            [0] => 2013-01-04 16:22:19
            [1] => http://www.ttgood.com/jy/t149932.htm
        )

    [489] => Array
        (
            [0] => 2013-01-04 16:20:01
            [1] => http://www.ttgood.com/jy/t142890.htm
        )

    [490] => Array
        (
            [0] => 2013-01-04 16:11:31
            [1] => http://www.ttgood.com/jy/t148189.htm
        )

    [491] => Array
        (
            [0] => 2013-01-04 16:04:39
            [1] => http://www.ttgood.com/jy/t141548.htm
        )

    [492] => Array
        (
            [0] => 2013-01-04 15:45:37
            [1] => http://www.ttgood.com/jy/t146457.htm
        )

    [493] => Array
        (
            [0] => 2013-01-04 15:42:22
            [1] => http://www.ttgood.com/jy/t72779.htm
        )

    [494] => Array
        (
            [0] => 2013-01-04 15:41:52
            [1] => http://www.ttgood.com/jy/t150202.htm
        )

    [495] => Array
        (
            [0] => 2013-01-04 15:30:21
            [1] => http://www.ttgood.com/jy/t150378.htm
        )

    [496] => Array
        (
            [0] => 2013-01-04 15:29:32
            [1] => http://www.ttgood.com/jy/t148232.htm
        )

    [497] => Array
        (
            [0] => 2013-01-04 15:18:12
            [1] => http://www.ttgood.com/jy/t133213.htm
        )

    [498] => Array
        (
            [0] => 2013-01-04 15:11:16
            [1] => http://www.ttgood.com/jy/t134444.htm
        )

    [499] => Array
        (
            [0] => 2013-01-04 15:01:21
            [1] => http://www.ttgood.com/jy/t150184.htm
        )

    [500] => Array
        (
            [0] => 2013-01-04 14:53:15
            [1] => http://www.ttgood.com/jy/t150398.htm
        )

    [501] => Array
        (
            [0] => 2013-01-04 14:43:49
            [1] => http://www.ttgood.com/jy/t98893.htm
        )

    [502] => Array
        (
            [0] => 2013-01-04 14:37:27
            [1] => http://www.ttgood.com/jy/t150341.htm
        )

    [503] => Array
        (
            [0] => 2013-01-04 14:31:20
            [1] => http://www.ttgood.com/jy/t138006.htm
        )

    [504] => Array
        (
            [0] => 2013-01-04 14:29:13
            [1] => http://www.ttgood.com/jy/t130493.htm
        )

    [505] => Array
        (
            [0] => 2013-01-04 14:28:15
            [1] => http://www.ttgood.com/jy/t131026.htm
        )

    [506] => Array
        (
            [0] => 2013-01-04 14:15:34
            [1] => http://www.ttgood.com/jy/t150171.htm
        )

    [507] => Array
        (
            [0] => 2013-01-04 14:12:04
            [1] => http://www.ttgood.com/jy/t94581.htm
        )

    [508] => Array
        (
            [0] => 2013-01-04 14:03:38
            [1] => http://www.ttgood.com/jy/t150055.htm
        )

    [509] => Array
        (
            [0] => 2013-01-04 13:59:49
            [1] => http://www.ttgood.com/jy/t137872.htm
        )

    [510] => Array
        (
            [0] => 2013-01-04 13:48:13
            [1] => http://www.ttgood.com/jy/t148315.htm
        )

    [511] => Array
        (
            [0] => 2013-01-04 13:43:56
            [1] => http://www.ttgood.com/jy/t150254.htm
        )

    [512] => Array
        (
            [0] => 2013-01-04 13:43:38
            [1] => http://www.ttgood.com/jy/t148520.htm
        )

    [513] => Array
        (
            [0] => 2013-01-04 13:43:27
            [1] => http://www.ttgood.com/jy/t150181.htm
        )

    [514] => Array
        (
            [0] => 2013-01-04 13:43:04
            [1] => http://www.ttgood.com/jy/t143972.htm
        )

    [515] => Array
        (
            [0] => 2013-01-04 13:38:31
            [1] => http://www.ttgood.com/jy/t103407.htm
        )

    [516] => Array
        (
            [0] => 2013-01-04 13:35:40
            [1] => http://www.ttgood.com/jy/t146431.htm
        )

    [517] => Array
        (
            [0] => 2013-01-04 13:32:43
            [1] => http://www.ttgood.com/jy/t145294.htm
        )

    [518] => Array
        (
            [0] => 2013-01-04 13:23:42
            [1] => http://www.ttgood.com/jy/t148298.htm
        )

    [519] => Array
        (
            [0] => 2013-01-04 13:11:52
            [1] => http://www.ttgood.com/jy/t81344.htm
        )

    [520] => Array
        (
            [0] => 2013-01-04 13:04:42
            [1] => http://www.ttgood.com/jy/t135180.htm
        )

    [521] => Array
        (
            [0] => 2013-01-04 12:52:53
            [1] => http://www.ttgood.com/jy/t139022.htm
        )

    [522] => Array
        (
            [0] => 2013-01-04 12:27:34
            [1] => http://www.ttgood.com/jy/t144474.htm
        )

    [523] => Array
        (
            [0] => 2013-01-04 12:22:37
            [1] => http://www.ttgood.com/jy/t139164.htm
        )

    [524] => Array
        (
            [0] => 2013-01-04 12:20:44
            [1] => http://www.ttgood.com/jy/t145333.htm
        )

    [525] => Array
        (
            [0] => 2013-01-04 12:19:27
            [1] => http://www.ttgood.com/jy/t145090.htm
        )

    [526] => Array
        (
            [0] => 2013-01-04 12:17:10
            [1] => http://www.ttgood.com/jy/t60812.htm
        )

    [527] => Array
        (
            [0] => 2013-01-04 12:15:32
            [1] => http://www.ttgood.com/jy/t137382.htm
        )

    [528] => Array
        (
            [0] => 2013-01-04 12:12:55
            [1] => http://www.ttgood.com/jy/t120741.htm
        )

    [529] => Array
        (
            [0] => 2013-01-04 11:28:03
            [1] => http://www.ttgood.com/jy/t135100.htm
        )

    [530] => Array
        (
            [0] => 2013-01-04 11:16:11
            [1] => http://www.ttgood.com/jy/t72314.htm
        )

    [531] => Array
        (
            [0] => 2013-01-04 11:12:39
            [1] => http://www.ttgood.com/jy/t140390.htm
        )

    [532] => Array
        (
            [0] => 2013-01-04 10:59:40
            [1] => http://www.ttgood.com/jy/t150324.htm
        )

    [533] => Array
        (
            [0] => 2013-01-04 10:44:38
            [1] => http://www.ttgood.com/jy/t137438.htm
        )

    [534] => Array
        (
            [0] => 2013-01-04 10:42:39
            [1] => http://www.ttgood.com/jy/t148471.htm
        )

    [535] => Array
        (
            [0] => 2013-01-04 10:23:34
            [1] => http://www.ttgood.com/jy/t144790.htm
        )

    [536] => Array
        (
            [0] => 2013-01-04 10:19:45
            [1] => http://www.ttgood.com/jy/t145923.htm
        )

    [537] => Array
        (
            [0] => 2013-01-04 10:13:57
            [1] => http://www.ttgood.com/jy/t89516.htm
        )

    [538] => Array
        (
            [0] => 2013-01-04 09:53:13
            [1] => http://www.ttgood.com/jy/t148882.htm
        )

    [539] => Array
        (
            [0] => 2013-01-04 09:39:20
            [1] => http://www.ttgood.com/jy/t127397.htm
        )

    [540] => Array
        (
            [0] => 2013-01-04 09:14:44
            [1] => http://www.ttgood.com/jy/t150394.htm
        )

    [541] => Array
        (
            [0] => 2013-01-04 09:13:17
            [1] => http://www.ttgood.com/jy/t150389.htm
        )

    [542] => Array
        (
            [0] => 2013-01-04 09:10:56
            [1] => http://www.ttgood.com/jy/t150381.htm
        )

    [543] => Array
        (
            [0] => 2013-01-04 09:10:40
            [1] => http://www.ttgood.com/jy/t150380.htm
        )

    [544] => Array
        (
            [0] => 2013-01-04 09:07:25
            [1] => http://www.ttgood.com/jy/t150383.htm
        )

    [545] => Array
        (
            [0] => 2013-01-04 08:43:28
            [1] => http://www.ttgood.com/jy/t81602.htm
        )

    [546] => Array
        (
            [0] => 2013-01-04 08:29:51
            [1] => http://www.ttgood.com/jy/t146792.htm
        )

    [547] => Array
        (
            [0] => 2013-01-04 08:25:41
            [1] => http://www.ttgood.com/jy/t98412.htm
        )

    [548] => Array
        (
            [0] => 2013-01-04 08:11:54
            [1] => http://www.ttgood.com/jy/t131319.htm
        )

    [549] => Array
        (
            [0] => 2013-01-04 08:11:03
            [1] => http://www.ttgood.com/jy/t122098.htm
        )

    [550] => Array
        (
            [0] => 2013-01-04 08:09:56
            [1] => http://www.ttgood.com/jy/t98651.htm
        )

    [551] => Array
        (
            [0] => 2013-01-04 02:17:26
            [1] => http://www.ttgood.com/jy/t145341.htm
        )

    [552] => Array
        (
            [0] => 2013-01-04 01:40:14
            [1] => http://www.ttgood.com/jy/t121236.htm
        )

    [553] => Array
        (
            [0] => 2013-01-04 01:35:44
            [1] => http://www.ttgood.com/jy/t143601.htm
        )

    [554] => Array
        (
            [0] => 2013-01-04 01:00:42
            [1] => http://www.ttgood.com/jy/t149753.htm
        )

    [555] => Array
        (
            [0] => 2013-01-04 00:33:36
            [1] => http://www.ttgood.com/jy/t150278.htm
        )

    [556] => Array
        (
            [0] => 2013-01-04 00:11:34
            [1] => http://www.ttgood.com/jy/t149833.htm
        )

    [557] => Array
        (
            [0] => 2013-01-03 23:49:44
            [1] => http://www.ttgood.com/jy/t144211.htm
        )

    [558] => Array
        (
            [0] => 2013-01-03 23:43:07
            [1] => http://www.ttgood.com/jy/t147567.htm
        )

    [559] => Array
        (
            [0] => 2013-01-03 23:30:58
            [1] => http://www.ttgood.com/jy/t147471.htm
        )

    [560] => Array
        (
            [0] => 2013-01-03 23:28:39
            [1] => http://www.ttgood.com/jy/t149527.htm
        )

    [561] => Array
        (
            [0] => 2013-01-03 23:02:04
            [1] => http://www.ttgood.com/jy/t146469.htm
        )

    [562] => Array
        (
            [0] => 2013-01-03 23:01:31
            [1] => http://www.ttgood.com/jy/t143915.htm
        )

    [563] => Array
        (
            [0] => 2013-01-03 23:01:13
            [1] => http://www.ttgood.com/jy/t148441.htm
        )

    [564] => Array
        (
            [0] => 2013-01-03 22:37:13
            [1] => http://www.ttgood.com/jy/t132192.htm
        )

    [565] => Array
        (
            [0] => 2013-01-03 22:24:45
            [1] => http://www.ttgood.com/jy/t126250.htm
        )

    [566] => Array
        (
            [0] => 2013-01-03 22:21:22
            [1] => http://www.ttgood.com/jy/t118407.htm
        )

    [567] => Array
        (
            [0] => 2013-01-03 21:55:57
            [1] => http://www.ttgood.com/jy/t82275.htm
        )

    [568] => Array
        (
            [0] => 2013-01-03 21:24:28
            [1] => http://www.ttgood.com/jy/t144271.htm
        )

    [569] => Array
        (
            [0] => 2013-01-03 21:24:08
            [1] => http://www.ttgood.com/jy/t149849.htm
        )

    [570] => Array
        (
            [0] => 2013-01-03 21:15:44
            [1] => http://www.ttgood.com/jy/t112593.htm
        )

    [571] => Array
        (
            [0] => 2013-01-03 21:12:02
            [1] => http://www.ttgood.com/jy/t118394.htm
        )

    [572] => Array
        (
            [0] => 2013-01-03 20:56:37
            [1] => http://www.ttgood.com/jy/t149258.htm
        )

    [573] => Array
        (
            [0] => 2013-01-03 20:05:34
            [1] => http://www.ttgood.com/jy/t77979.htm
        )

    [574] => Array
        (
            [0] => 2013-01-03 19:30:06
            [1] => http://www.ttgood.com/jy/t137910.htm
        )

    [575] => Array
        (
            [0] => 2013-01-03 19:27:04
            [1] => http://www.ttgood.com/jy/t82282.htm
        )

    [576] => Array
        (
            [0] => 2013-01-03 19:25:58
            [1] => http://www.ttgood.com/jy/t148774.htm
        )

    [577] => Array
        (
            [0] => 2013-01-03 19:02:57
            [1] => http://www.ttgood.com/jy/t149963.htm
        )

    [578] => Array
        (
            [0] => 2013-01-03 18:16:04
            [1] => http://www.ttgood.com/jy/t111533.htm
        )

    [579] => Array
        (
            [0] => 2013-01-03 18:13:09
            [1] => http://www.ttgood.com/jy/t127422.htm
        )

    [580] => Array
        (
            [0] => 2013-01-03 17:44:12
            [1] => http://www.ttgood.com/jy/t146422.htm
        )

    [581] => Array
        (
            [0] => 2013-01-03 17:41:37
            [1] => http://www.ttgood.com/jy/t24250.htm
        )

    [582] => Array
        (
            [0] => 2013-01-03 17:19:20
            [1] => http://www.ttgood.com/jy/t150256.htm
        )

    [583] => Array
        (
            [0] => 2013-01-03 16:53:39
            [1] => http://www.ttgood.com/jy/t149038.htm
        )

    [584] => Array
        (
            [0] => 2013-01-03 16:45:04
            [1] => http://www.ttgood.com/jy/t149072.htm
        )

    [585] => Array
        (
            [0] => 2013-01-03 16:41:33
            [1] => http://www.ttgood.com/jy/t145248.htm
        )

    [586] => Array
        (
            [0] => 2013-01-03 16:32:37
            [1] => http://www.ttgood.com/jy/t145944.htm
        )

    [587] => Array
        (
            [0] => 2013-01-03 16:25:02
            [1] => http://www.ttgood.com/jy/t147014.htm
        )

    [588] => Array
        (
            [0] => 2013-01-03 16:16:24
            [1] => http://www.ttgood.com/jy/t145552.htm
        )

    [589] => Array
        (
            [0] => 2013-01-03 16:10:37
            [1] => http://www.ttgood.com/jy/t131867.htm
        )

    [590] => Array
        (
            [0] => 2013-01-03 15:25:26
            [1] => http://www.ttgood.com/jy/t120036.htm
        )

    [591] => Array
        (
            [0] => 2013-01-03 15:14:27
            [1] => http://www.ttgood.com/jy/t150382.htm
        )

    [592] => Array
        (
            [0] => 2013-01-03 15:10:49
            [1] => http://www.ttgood.com/jy/t147649.htm
        )

    [593] => Array
        (
            [0] => 2013-01-03 15:05:27
            [1] => http://www.ttgood.com/jy/t128464.htm
        )

    [594] => Array
        (
            [0] => 2013-01-03 15:00:21
            [1] => http://www.ttgood.com/jy/t148076.htm
        )

    [595] => Array
        (
            [0] => 2013-01-03 14:57:43
            [1] => http://www.ttgood.com/jy/t132976.htm
        )

    [596] => Array
        (
            [0] => 2013-01-03 14:40:31
            [1] => http://www.ttgood.com/jy/t141882.htm
        )

    [597] => Array
        (
            [0] => 2013-01-03 14:34:11
            [1] => http://www.ttgood.com/jy/t148361.htm
        )

    [598] => Array
        (
            [0] => 2013-01-03 14:33:34
            [1] => http://www.ttgood.com/jy/t135795.htm
        )

    [599] => Array
        (
            [0] => 2013-01-03 14:29:29
            [1] => http://www.ttgood.com/jy/t142085.htm
        )

    [600] => Array
        (
            [0] => 2013-01-03 14:25:54
            [1] => http://www.ttgood.com/jy/t144851.htm
        )

    [601] => Array
        (
            [0] => 2013-01-03 14:23:05
            [1] => http://www.ttgood.com/jy/t150233.htm
        )

    [602] => Array
        (
            [0] => 2013-01-03 14:22:31
            [1] => http://www.ttgood.com/jy/t150360.htm
        )

    [603] => Array
        (
            [0] => 2013-01-03 14:21:07
            [1] => http://www.ttgood.com/jy/t142977.htm
        )

    [604] => Array
        (
            [0] => 2013-01-03 14:19:15
            [1] => http://www.ttgood.com/jy/t143062.htm
        )

    [605] => Array
        (
            [0] => 2013-01-03 13:41:18
            [1] => http://www.ttgood.com/jy/t134163.htm
        )

    [606] => Array
        (
            [0] => 2013-01-03 13:26:37
            [1] => http://www.ttgood.com/jy/t125349.htm
        )

    [607] => Array
        (
            [0] => 2013-01-03 13:18:50
            [1] => http://www.ttgood.com/jy/t150273.htm
        )

    [608] => Array
        (
            [0] => 2013-01-03 12:57:33
            [1] => http://www.ttgood.com/jy/t138709.htm
        )

    [609] => Array
        (
            [0] => 2013-01-03 12:52:42
            [1] => http://www.ttgood.com/jy/t133565.htm
        )

    [610] => Array
        (
            [0] => 2013-01-03 12:50:02
            [1] => http://www.ttgood.com/jy/t120980.htm
        )

    [611] => Array
        (
            [0] => 2013-01-03 12:22:20
            [1] => http://www.ttgood.com/jy/t128178.htm
        )

    [612] => Array
        (
            [0] => 2013-01-03 12:17:03
            [1] => http://www.ttgood.com/jy/t141075.htm
        )

    [613] => Array
        (
            [0] => 2013-01-03 12:08:44
            [1] => http://www.ttgood.com/jy/t121928.htm
        )

    [614] => Array
        (
            [0] => 2013-01-03 12:06:41
            [1] => http://www.ttgood.com/jy/t126180.htm
        )

    [615] => Array
        (
            [0] => 2013-01-03 11:46:03
            [1] => http://www.ttgood.com/jy/t150268.htm
        )

    [616] => Array
        (
            [0] => 2013-01-03 11:40:42
            [1] => http://www.ttgood.com/jy/t143115.htm
        )

    [617] => Array
        (
            [0] => 2013-01-03 11:02:23
            [1] => http://www.ttgood.com/jy/t98654.htm
        )

    [618] => Array
        (
            [0] => 2013-01-03 10:57:33
            [1] => http://www.ttgood.com/jy/t150144.htm
        )

    [619] => Array
        (
            [0] => 2013-01-03 10:48:53
            [1] => http://www.ttgood.com/jy/t144883.htm
        )

    [620] => Array
        (
            [0] => 2013-01-03 10:46:35
            [1] => http://www.ttgood.com/jy/t65058.htm
        )

    [621] => Array
        (
            [0] => 2013-01-03 10:40:58
            [1] => http://www.ttgood.com/jy/t150343.htm
        )

    [622] => Array
        (
            [0] => 2013-01-03 10:37:20
            [1] => http://www.ttgood.com/jy/t148842.htm
        )

    [623] => Array
        (
            [0] => 2013-01-03 10:32:59
            [1] => http://www.ttgood.com/jy/t115909.htm
        )

    [624] => Array
        (
            [0] => 2013-01-03 10:23:58
            [1] => http://www.ttgood.com/jy/t149936.htm
        )

    [625] => Array
        (
            [0] => 2013-01-03 10:13:21
            [1] => http://www.ttgood.com/jy/t147511.htm
        )

    [626] => Array
        (
            [0] => 2013-01-03 10:06:34
            [1] => http://www.ttgood.com/jy/t150212.htm
        )

    [627] => Array
        (
            [0] => 2013-01-03 09:50:28
            [1] => http://www.ttgood.com/jy/t139907.htm
        )

    [628] => Array
        (
            [0] => 2013-01-03 09:05:56
            [1] => http://www.ttgood.com/jy/t150371.htm
        )

    [629] => Array
        (
            [0] => 2013-01-03 09:04:29
            [1] => http://www.ttgood.com/jy/t150362.htm
        )

    [630] => Array
        (
            [0] => 2013-01-03 08:51:00
            [1] => http://www.ttgood.com/jy/t148905.htm
        )

    [631] => Array
        (
            [0] => 2013-01-03 08:31:58
            [1] => http://www.ttgood.com/jy/t145226.htm
        )

    [632] => Array
        (
            [0] => 2013-01-03 00:22:29
            [1] => http://www.ttgood.com/jy/t149550.htm
        )

    [633] => Array
        (
            [0] => 2013-01-03 00:07:37
            [1] => http://www.ttgood.com/jy/t150161.htm
        )

    [634] => Array
        (
            [0] => 2013-01-03 00:02:06
            [1] => http://www.ttgood.com/jy/t104701.htm
        )

    [635] => Array
        (
            [0] => 2013-01-02 23:54:38
            [1] => http://www.ttgood.com/jy/t124807.htm
        )

    [636] => Array
        (
            [0] => 2013-01-02 23:17:34
            [1] => http://www.ttgood.com/jy/t134166.htm
        )

    [637] => Array
        (
            [0] => 2013-01-02 23:00:30
            [1] => http://www.ttgood.com/jy/t146968.htm
        )

    [638] => Array
        (
            [0] => 2013-01-02 22:37:46
            [1] => http://www.ttgood.com/jy/t144174.htm
        )

    [639] => Array
        (
            [0] => 2013-01-02 22:29:16
            [1] => http://www.ttgood.com/jy/t140489.htm
        )

    [640] => Array
        (
            [0] => 2013-01-02 21:56:53
            [1] => http://www.ttgood.com/jy/t142550.htm
        )

    [641] => Array
        (
            [0] => 2013-01-02 21:17:38
            [1] => http://www.ttgood.com/jy/t67014.htm
        )

    [642] => Array
        (
            [0] => 2013-01-02 21:12:21
            [1] => http://www.ttgood.com/jy/t139260.htm
        )

    [643] => Array
        (
            [0] => 2013-01-02 21:09:51
            [1] => http://www.ttgood.com/jy/t144546.htm
        )

    [644] => Array
        (
            [0] => 2013-01-02 21:09:31
            [1] => http://www.ttgood.com/jy/t112380.htm
        )

    [645] => Array
        (
            [0] => 2013-01-02 21:07:24
            [1] => http://www.ttgood.com/jy/t144852.htm
        )

    [646] => Array
        (
            [0] => 2013-01-02 20:56:33
            [1] => http://www.ttgood.com/jy/t124315.htm
        )

    [647] => Array
        (
            [0] => 2013-01-02 20:56:18
            [1] => http://www.ttgood.com/jy/t102257.htm
        )

    [648] => Array
        (
            [0] => 2013-01-02 20:55:08
            [1] => http://www.ttgood.com/jy/t150348.htm
        )

    [649] => Array
        (
            [0] => 2013-01-02 20:46:54
            [1] => http://www.ttgood.com/jy/t138412.htm
        )

    [650] => Array
        (
            [0] => 2013-01-02 20:08:54
            [1] => http://www.ttgood.com/jy/t144900.htm
        )

    [651] => Array
        (
            [0] => 2013-01-02 20:03:50
            [1] => http://www.ttgood.com/jy/t88728.htm
        )

    [652] => Array
        (
            [0] => 2013-01-02 19:57:01
            [1] => http://www.ttgood.com/jy/t130461.htm
        )

    [653] => Array
        (
            [0] => 2013-01-02 19:51:35
            [1] => http://www.ttgood.com/jy/t150247.htm
        )

    [654] => Array
        (
            [0] => 2013-01-02 19:47:39
            [1] => http://www.ttgood.com/jy/t11720.htm
        )

    [655] => Array
        (
            [0] => 2013-01-02 19:37:21
            [1] => http://www.ttgood.com/jy/t144794.htm
        )

    [656] => Array
        (
            [0] => 2013-01-02 19:25:19
            [1] => http://www.ttgood.com/jy/t132964.htm
        )

    [657] => Array
        (
            [0] => 2013-01-02 19:11:51
            [1] => http://www.ttgood.com/jy/t146526.htm
        )

    [658] => Array
        (
            [0] => 2013-01-02 19:03:47
            [1] => http://www.ttgood.com/jy/t118991.htm
        )

    [659] => Array
        (
            [0] => 2013-01-02 18:57:43
            [1] => http://www.ttgood.com/jy/t144670.htm
        )

    [660] => Array
        (
            [0] => 2013-01-02 18:57:11
            [1] => http://www.ttgood.com/jy/t114953.htm
        )

    [661] => Array
        (
            [0] => 2013-01-02 18:30:52
            [1] => http://www.ttgood.com/jy/t149295.htm
        )

    [662] => Array
        (
            [0] => 2013-01-02 18:10:04
            [1] => http://www.ttgood.com/jy/t135921.htm
        )

    [663] => Array
        (
            [0] => 2013-01-02 18:03:12
            [1] => http://www.ttgood.com/jy/t147454.htm
        )

    [664] => Array
        (
            [0] => 2013-01-02 18:02:17
            [1] => http://www.ttgood.com/jy/t149854.htm
        )

    [665] => Array
        (
            [0] => 2013-01-02 17:54:14
            [1] => http://www.ttgood.com/jy/t150011.htm
        )

    [666] => Array
        (
            [0] => 2013-01-02 17:33:20
            [1] => http://www.ttgood.com/jy/t147239.htm
        )

    [667] => Array
        (
            [0] => 2013-01-02 17:32:14
            [1] => http://www.ttgood.com/jy/t149733.htm
        )

    [668] => Array
        (
            [0] => 2013-01-02 17:31:30
            [1] => http://www.ttgood.com/jy/t149874.htm
        )

    [669] => Array
        (
            [0] => 2013-01-02 17:22:26
            [1] => http://www.ttgood.com/jy/t148828.htm
        )

    [670] => Array
        (
            [0] => 2013-01-02 17:21:16
            [1] => http://www.ttgood.com/jy/t139661.htm
        )

    [671] => Array
        (
            [0] => 2013-01-02 17:04:27
            [1] => http://www.ttgood.com/jy/t135620.htm
        )

    [672] => Array
        (
            [0] => 2013-01-02 16:50:10
            [1] => http://www.ttgood.com/jy/t148215.htm
        )

    [673] => Array
        (
            [0] => 2013-01-02 16:42:08
            [1] => http://www.ttgood.com/jy/t114550.htm
        )

    [674] => Array
        (
            [0] => 2013-01-02 16:23:04
            [1] => http://www.ttgood.com/jy/t132511.htm
        )

    [675] => Array
        (
            [0] => 2013-01-02 15:44:20
            [1] => http://www.ttgood.com/jy/t149949.htm
        )

    [676] => Array
        (
            [0] => 2013-01-02 15:28:42
            [1] => http://www.ttgood.com/jy/t141678.htm
        )

    [677] => Array
        (
            [0] => 2013-01-02 15:15:54
            [1] => http://www.ttgood.com/jy/t140978.htm
        )

    [678] => Array
        (
            [0] => 2013-01-02 15:15:03
            [1] => http://www.ttgood.com/jy/t150355.htm
        )

    [679] => Array
        (
            [0] => 2013-01-02 15:14:01
            [1] => http://www.ttgood.com/jy/t149823.htm
        )

    [680] => Array
        (
            [0] => 2013-01-02 15:09:34
            [1] => http://www.ttgood.com/jy/t113581.htm
        )

    [681] => Array
        (
            [0] => 2013-01-02 15:05:03
            [1] => http://www.ttgood.com/jy/t135139.htm
        )

    [682] => Array
        (
            [0] => 2013-01-02 14:24:47
            [1] => http://www.ttgood.com/jy/t149463.htm
        )

    [683] => Array
        (
            [0] => 2013-01-02 14:11:29
            [1] => http://www.ttgood.com/jy/t7230.htm
        )

    [684] => Array
        (
            [0] => 2013-01-02 14:11:08
            [1] => http://www.ttgood.com/jy/t99541.htm
        )

    [685] => Array
        (
            [0] => 2013-01-02 13:46:27
            [1] => http://www.ttgood.com/jy/t145134.htm
        )

    [686] => Array
        (
            [0] => 2013-01-02 13:35:49
            [1] => http://www.ttgood.com/jy/t148177.htm
        )

    [687] => Array
        (
            [0] => 2013-01-02 13:28:03
            [1] => http://www.ttgood.com/jy/t85318.htm
        )

    [688] => Array
        (
            [0] => 2013-01-02 13:00:38
            [1] => http://www.ttgood.com/jy/t149268.htm
        )

    [689] => Array
        (
            [0] => 2013-01-02 12:59:41
            [1] => http://www.ttgood.com/jy/t147972.htm
        )

    [690] => Array
        (
            [0] => 2013-01-02 12:46:05
            [1] => http://www.ttgood.com/jy/t145125.htm
        )

    [691] => Array
        (
            [0] => 2013-01-02 12:35:00
            [1] => http://www.ttgood.com/jy/t149737.htm
        )

    [692] => Array
        (
            [0] => 2013-01-02 12:31:10
            [1] => http://www.ttgood.com/jy/t143087.htm
        )

    [693] => Array
        (
            [0] => 2013-01-02 12:12:54
            [1] => http://www.ttgood.com/jy/t150030.htm
        )

    [694] => Array
        (
            [0] => 2013-01-02 12:03:14
            [1] => http://www.ttgood.com/jy/t141645.htm
        )

    [695] => Array
        (
            [0] => 2013-01-02 11:56:47
            [1] => http://www.ttgood.com/jy/t150197.htm
        )

    [696] => Array
        (
            [0] => 2013-01-02 11:47:36
            [1] => http://www.ttgood.com/jy/t141912.htm
        )

    [697] => Array
        (
            [0] => 2013-01-02 11:39:59
            [1] => http://www.ttgood.com/jy/t148853.htm
        )

    [698] => Array
        (
            [0] => 2013-01-02 11:34:13
            [1] => http://www.ttgood.com/jy/t142559.htm
        )

    [699] => Array
        (
            [0] => 2013-01-02 10:16:08
            [1] => http://www.ttgood.com/jy/t145025.htm
        )

    [700] => Array
        (
            [0] => 2013-01-02 10:06:21
            [1] => http://www.ttgood.com/jy/t143165.htm
        )

    [701] => Array
        (
            [0] => 2013-01-02 09:08:21
            [1] => http://www.ttgood.com/jy/t150357.htm
        )

    [702] => Array
        (
            [0] => 2013-01-02 09:07:22
            [1] => http://www.ttgood.com/jy/t150351.htm
        )

    [703] => Array
        (
            [0] => 2013-01-02 09:06:59
            [1] => http://www.ttgood.com/jy/t150350.htm
        )

    [704] => Array
        (
            [0] => 2013-01-02 09:05:09
            [1] => http://www.ttgood.com/jy/t150345.htm
        )

    [705] => Array
        (
            [0] => 2013-01-02 07:55:24
            [1] => http://www.ttgood.com/jy/t146757.htm
        )

    [706] => Array
        (
            [0] => 2013-01-02 05:25:21
            [1] => http://www.ttgood.com/jy/t142253.htm
        )

    [707] => Array
        (
            [0] => 2013-01-02 02:38:14
            [1] => http://www.ttgood.com/jy/t139159.htm
        )

    [708] => Array
        (
            [0] => 2013-01-01 22:54:43
            [1] => http://www.ttgood.com/jy/t149983.htm
        )

    [709] => Array
        (
            [0] => 2013-01-01 22:48:58
            [1] => http://www.ttgood.com/jy/t88528.htm
        )

    [710] => Array
        (
            [0] => 2013-01-01 22:45:16
            [1] => http://www.ttgood.com/jy/t149712.htm
        )

    [711] => Array
        (
            [0] => 2013-01-01 22:14:17
            [1] => http://www.ttgood.com/jy/t150139.htm
        )

    [712] => Array
        (
            [0] => 2013-01-01 21:44:12
            [1] => http://www.ttgood.com/jy/t147485.htm
        )

    [713] => Array
        (
            [0] => 2013-01-01 21:36:26
            [1] => http://www.ttgood.com/jy/t144577.htm
        )

    [714] => Array
        (
            [0] => 2013-01-01 21:16:42
            [1] => http://www.ttgood.com/jy/t31114.htm
        )

    [715] => Array
        (
            [0] => 2013-01-01 20:58:30
            [1] => http://www.ttgood.com/jy/t150271.htm
        )

    [716] => Array
        (
            [0] => 2013-01-01 20:48:56
            [1] => http://www.ttgood.com/jy/t143336.htm
        )

    [717] => Array
        (
            [0] => 2013-01-01 20:44:31
            [1] => http://www.ttgood.com/jy/t149363.htm
        )

    [718] => Array
        (
            [0] => 2013-01-01 20:37:57
            [1] => http://www.ttgood.com/jy/t40010.htm
        )

    [719] => Array
        (
            [0] => 2013-01-01 20:14:08
            [1] => http://www.ttgood.com/jy/t145443.htm
        )

    [720] => Array
        (
            [0] => 2013-01-01 20:04:51
            [1] => http://www.ttgood.com/jy/t136965.htm
        )

    [721] => Array
        (
            [0] => 2013-01-01 19:53:17
            [1] => http://www.ttgood.com/jy/t148160.htm
        )

    [722] => Array
        (
            [0] => 2013-01-01 19:35:41
            [1] => http://www.ttgood.com/jy/t148387.htm
        )

    [723] => Array
        (
            [0] => 2013-01-01 19:33:32
            [1] => http://www.ttgood.com/jy/t133709.htm
        )

    [724] => Array
        (
            [0] => 2013-01-01 19:26:54
            [1] => http://www.ttgood.com/jy/t141982.htm
        )

    [725] => Array
        (
            [0] => 2013-01-01 19:15:58
            [1] => http://www.ttgood.com/jy/t104814.htm
        )

    [726] => Array
        (
            [0] => 2013-01-01 18:47:08
            [1] => http://www.ttgood.com/jy/t138075.htm
        )

    [727] => Array
        (
            [0] => 2013-01-01 18:41:10
            [1] => http://www.ttgood.com/jy/t120918.htm
        )

    [728] => Array
        (
            [0] => 2013-01-01 18:31:03
            [1] => http://www.ttgood.com/jy/t125427.htm
        )

    [729] => Array
        (
            [0] => 2013-01-01 18:24:55
            [1] => http://www.ttgood.com/jy/t113933.htm
        )

    [730] => Array
        (
            [0] => 2013-01-01 18:10:03
            [1] => http://www.ttgood.com/jy/t129459.htm
        )

    [731] => Array
        (
            [0] => 2013-01-01 17:58:32
            [1] => http://www.ttgood.com/jy/t149920.htm
        )

    [732] => Array
        (
            [0] => 2013-01-01 17:52:51
            [1] => http://www.ttgood.com/jy/t149141.htm
        )

    [733] => Array
        (
            [0] => 2013-01-01 17:39:30
            [1] => http://www.ttgood.com/jy/t109266.htm
        )

    [734] => Array
        (
            [0] => 2013-01-01 17:31:28
            [1] => http://www.ttgood.com/jy/t149801.htm
        )

    [735] => Array
        (
            [0] => 2013-01-01 17:05:13
            [1] => http://www.ttgood.com/jy/t117298.htm
        )

    [736] => Array
        (
            [0] => 2013-01-01 17:02:43
            [1] => http://www.ttgood.com/jy/t62988.htm
        )

    [737] => Array
        (
            [0] => 2013-01-01 16:58:58
            [1] => http://www.ttgood.com/jy/t150133.htm
        )

    [738] => Array
        (
            [0] => 2013-01-01 16:41:50
            [1] => http://www.ttgood.com/jy/t147327.htm
        )

    [739] => Array
        (
            [0] => 2013-01-01 16:36:52
            [1] => http://www.ttgood.com/jy/t148823.htm
        )

    [740] => Array
        (
            [0] => 2013-01-01 16:21:40
            [1] => http://www.ttgood.com/jy/t147063.htm
        )

    [741] => Array
        (
            [0] => 2013-01-01 15:52:53
            [1] => http://www.ttgood.com/jy/t91235.htm
        )

    [742] => Array
        (
            [0] => 2013-01-01 15:35:20
            [1] => http://www.ttgood.com/jy/t150300.htm
        )

    [743] => Array
        (
            [0] => 2013-01-01 13:54:29
            [1] => http://www.ttgood.com/jy/t85613.htm
        )

    [744] => Array
        (
            [0] => 2013-01-01 13:47:38
            [1] => http://www.ttgood.com/jy/t149264.htm
        )

    [745] => Array
        (
            [0] => 2013-01-01 13:39:26
            [1] => http://www.ttgood.com/jy/t147909.htm
        )

    [746] => Array
        (
            [0] => 2013-01-01 12:44:42
            [1] => http://www.ttgood.com/jy/t64170.htm
        )

    [747] => Array
        (
            [0] => 2013-01-01 12:36:21
            [1] => http://www.ttgood.com/jy/t149007.htm
        )

    [748] => Array
        (
            [0] => 2013-01-01 11:47:29
            [1] => http://www.ttgood.com/jy/t148426.htm
        )

    [749] => Array
        (
            [0] => 2013-01-01 11:36:09
            [1] => http://www.ttgood.com/jy/t146341.htm
        )

    [750] => Array
        (
            [0] => 2013-01-01 11:34:10
            [1] => http://www.ttgood.com/jy/t145345.htm
        )

    [751] => Array
        (
            [0] => 2013-01-01 11:33:02
            [1] => http://www.ttgood.com/jy/t150264.htm
        )

    [752] => Array
        (
            [0] => 2013-01-01 11:30:30
            [1] => http://www.ttgood.com/jy/t149021.htm
        )

    [753] => Array
        (
            [0] => 2013-01-01 11:15:50
            [1] => http://www.ttgood.com/jy/t143463.htm
        )

    [754] => Array
        (
            [0] => 2013-01-01 11:01:53
            [1] => http://www.ttgood.com/jy/t138456.htm
        )

    [755] => Array
        (
            [0] => 2013-01-01 10:49:05
            [1] => http://www.ttgood.com/jy/t149583.htm
        )

    [756] => Array
        (
            [0] => 2013-01-01 10:43:15
            [1] => http://www.ttgood.com/jy/t122102.htm
        )

    [757] => Array
        (
            [0] => 2013-01-01 10:37:37
            [1] => http://www.ttgood.com/jy/t145983.htm
        )

    [758] => Array
        (
            [0] => 2013-01-01 10:27:51
            [1] => http://www.ttgood.com/jy/t123865.htm
        )

    [759] => Array
        (
            [0] => 2013-01-01 10:25:24
            [1] => http://www.ttgood.com/jy/t144891.htm
        )

    [760] => Array
        (
            [0] => 2013-01-01 10:23:00
            [1] => http://www.ttgood.com/jy/t91315.htm
        )

    [761] => Array
        (
            [0] => 2013-01-01 10:04:04
            [1] => http://www.ttgood.com/jy/t147300.htm
        )

    [762] => Array
        (
            [0] => 2013-01-01 09:42:19
            [1] => http://www.ttgood.com/jy/t122673.htm
        )

    [763] => Array
        (
            [0] => 2013-01-01 09:31:30
            [1] => http://www.ttgood.com/jy/t148597.htm
        )

    [764] => Array
        (
            [0] => 2013-01-01 09:23:11
            [1] => http://www.ttgood.com/jy/t139565.htm
        )

    [765] => Array
        (
            [0] => 2013-01-01 09:22:49
            [1] => http://www.ttgood.com/jy/t138312.htm
        )

    [766] => Array
        (
            [0] => 2013-01-01 09:07:36
            [1] => http://www.ttgood.com/jy/t150342.htm
        )

    [767] => Array
        (
            [0] => 2013-01-01 09:05:57
            [1] => http://www.ttgood.com/jy/t150340.htm
        )

    [768] => Array
        (
            [0] => 2013-01-01 09:05:46
            [1] => http://www.ttgood.com/jy/t150339.htm
        )

    [769] => Array
        (
            [0] => 2013-01-01 09:05:10
            [1] => http://www.ttgood.com/jy/t150336.htm
        )

    [770] => Array
        (
            [0] => 2013-01-01 09:02:47
            [1] => http://www.ttgood.com/jy/t148966.htm
        )

    [771] => Array
        (
            [0] => 2013-01-01 08:47:09
            [1] => http://www.ttgood.com/jy/t112230.htm
        )

    [772] => Array
        (
            [0] => 2013-01-01 08:28:18
            [1] => http://www.ttgood.com/jy/t398.htm
        )

    [773] => Array
        (
            [0] => 2013-01-01 07:38:22
            [1] => http://www.ttgood.com/jy/t137790.htm
        )

    [774] => Array
        (
            [0] => 2013-01-01 00:57:09
            [1] => http://www.ttgood.com/jy/t128819.htm
        )

    [775] => Array
        (
            [0] => 2012-12-31 23:39:26
            [1] => http://www.ttgood.com/jy/t143937.htm
        )

    [776] => Array
        (
            [0] => 2012-12-31 23:37:43
            [1] => http://www.ttgood.com/jy/t143532.htm
        )

    [777] => Array
        (
            [0] => 2012-12-31 23:27:54
            [1] => http://www.ttgood.com/jy/t140579.htm
        )

    [778] => Array
        (
            [0] => 2012-12-31 23:05:35
            [1] => http://www.ttgood.com/jy/t149465.htm
        )

    [779] => Array
        (
            [0] => 2012-12-31 22:59:03
            [1] => http://www.ttgood.com/jy/t144652.htm
        )

    [780] => Array
        (
            [0] => 2012-12-31 22:57:10
            [1] => http://www.ttgood.com/jy/t149680.htm
        )

    [781] => Array
        (
            [0] => 2012-12-31 22:39:07
            [1] => http://www.ttgood.com/jy/t73118.htm
        )

    [782] => Array
        (
            [0] => 2012-12-31 22:13:03
            [1] => http://www.ttgood.com/jy/t147146.htm
        )

    [783] => Array
        (
            [0] => 2012-12-31 22:05:16
            [1] => http://www.ttgood.com/jy/t133695.htm
        )

    [784] => Array
        (
            [0] => 2012-12-31 22:02:25
            [1] => http://www.ttgood.com/jy/t147826.htm
        )

    [785] => Array
        (
            [0] => 2012-12-31 21:48:07
            [1] => http://www.ttgood.com/jy/t144412.htm
        )

    [786] => Array
        (
            [0] => 2012-12-31 21:47:29
            [1] => http://www.ttgood.com/jy/t134228.htm
        )

    [787] => Array
        (
            [0] => 2012-12-31 21:32:57
            [1] => http://www.ttgood.com/jy/t138912.htm
        )

    [788] => Array
        (
            [0] => 2012-12-31 21:28:38
            [1] => http://www.ttgood.com/jy/t137419.htm
        )

    [789] => Array
        (
            [0] => 2012-12-31 21:20:55
            [1] => http://www.ttgood.com/jy/t150240.htm
        )

    [790] => Array
        (
            [0] => 2012-12-31 21:03:53
            [1] => http://www.ttgood.com/jy/t106153.htm
        )

    [791] => Array
        (
            [0] => 2012-12-31 20:46:30
            [1] => http://www.ttgood.com/jy/t94037.htm
        )

    [792] => Array
        (
            [0] => 2012-12-31 20:01:50
            [1] => http://www.ttgood.com/jy/t137483.htm
        )

    [793] => Array
        (
            [0] => 2012-12-31 19:51:17
            [1] => http://www.ttgood.com/jy/t145740.htm
        )

    [794] => Array
        (
            [0] => 2012-12-31 19:46:56
            [1] => http://www.ttgood.com/jy/t147700.htm
        )

    [795] => Array
        (
            [0] => 2012-12-31 19:20:20
            [1] => http://www.ttgood.com/jy/t105505.htm
        )

    [796] => Array
        (
            [0] => 2012-12-31 19:13:54
            [1] => http://www.ttgood.com/jy/t148815.htm
        )

    [797] => Array
        (
            [0] => 2012-12-31 19:11:56
            [1] => http://www.ttgood.com/jy/t143661.htm
        )

    [798] => Array
        (
            [0] => 2012-12-31 18:54:15
            [1] => http://www.ttgood.com/jy/t148135.htm
        )

    [799] => Array
        (
            [0] => 2012-12-31 18:53:27
            [1] => http://www.ttgood.com/jy/t138979.htm
        )

    [800] => Array
        (
            [0] => 2012-12-31 18:44:13
            [1] => http://www.ttgood.com/jy/t122840.htm
        )

    [801] => Array
        (
            [0] => 2012-12-31 18:17:53
            [1] => http://www.ttgood.com/jy/t148408.htm
        )

    [802] => Array
        (
            [0] => 2012-12-31 18:10:54
            [1] => http://www.ttgood.com/jy/t146667.htm
        )

    [803] => Array
        (
            [0] => 2012-12-31 18:07:29
            [1] => http://www.ttgood.com/jy/t149434.htm
        )

    [804] => Array
        (
            [0] => 2012-12-31 18:06:09
            [1] => http://www.ttgood.com/jy/t148758.htm
        )

    [805] => Array
        (
            [0] => 2012-12-31 18:00:27
            [1] => http://www.ttgood.com/jy/t133046.htm
        )

    [806] => Array
        (
            [0] => 2012-12-31 17:50:55
            [1] => http://www.ttgood.com/jy/t135140.htm
        )

    [807] => Array
        (
            [0] => 2012-12-31 17:36:49
            [1] => http://www.ttgood.com/jy/t130422.htm
        )

    [808] => Array
        (
            [0] => 2012-12-31 17:20:01
            [1] => http://www.ttgood.com/jy/t46528.htm
        )

    [809] => Array
        (
            [0] => 2012-12-31 17:17:07
            [1] => http://www.ttgood.com/jy/t147143.htm
        )

    [810] => Array
        (
            [0] => 2012-12-31 16:58:51
            [1] => http://www.ttgood.com/jy/t143404.htm
        )

    [811] => Array
        (
            [0] => 2012-12-31 16:52:22
            [1] => http://www.ttgood.com/jy/t117253.htm
        )

    [812] => Array
        (
            [0] => 2012-12-31 16:41:59
            [1] => http://www.ttgood.com/jy/t148627.htm
        )

    [813] => Array
        (
            [0] => 2012-12-31 16:25:04
            [1] => http://www.ttgood.com/jy/t147969.htm
        )

    [814] => Array
        (
            [0] => 2012-12-31 16:24:38
            [1] => http://www.ttgood.com/jy/t27193.htm
        )

    [815] => Array
        (
            [0] => 2012-12-31 16:23:00
            [1] => http://www.ttgood.com/jy/t122178.htm
        )

    [816] => Array
        (
            [0] => 2012-12-31 15:59:23
            [1] => http://www.ttgood.com/jy/t150151.htm
        )

    [817] => Array
        (
            [0] => 2012-12-31 15:49:11
            [1] => http://www.ttgood.com/jy/t150322.htm
        )

    [818] => Array
        (
            [0] => 2012-12-31 15:28:48
            [1] => http://www.ttgood.com/jy/t139236.htm
        )

    [819] => Array
        (
            [0] => 2012-12-31 15:26:49
            [1] => http://www.ttgood.com/jy/t142894.htm
        )

    [820] => Array
        (
            [0] => 2012-12-31 15:24:59
            [1] => http://www.ttgood.com/jy/t148871.htm
        )

    [821] => Array
        (
            [0] => 2012-12-31 15:02:49
            [1] => http://www.ttgood.com/jy/t141563.htm
        )

    [822] => Array
        (
            [0] => 2012-12-31 14:49:53
            [1] => http://www.ttgood.com/jy/t150131.htm
        )

    [823] => Array
        (
            [0] => 2012-12-31 14:30:32
            [1] => http://www.ttgood.com/jy/t53427.htm
        )

    [824] => Array
        (
            [0] => 2012-12-31 14:22:08
            [1] => http://www.ttgood.com/jy/t125593.htm
        )

    [825] => Array
        (
            [0] => 2012-12-31 14:18:53
            [1] => http://www.ttgood.com/jy/t147351.htm
        )

    [826] => Array
        (
            [0] => 2012-12-31 14:14:45
            [1] => http://www.ttgood.com/jy/t145661.htm
        )

    [827] => Array
        (
            [0] => 2012-12-31 13:59:47
            [1] => http://www.ttgood.com/jy/t148909.htm
        )

    [828] => Array
        (
            [0] => 2012-12-31 13:59:08
            [1] => http://www.ttgood.com/jy/t133028.htm
        )

    [829] => Array
        (
            [0] => 2012-12-31 13:50:52
            [1] => http://www.ttgood.com/jy/t142913.htm
        )

    [830] => Array
        (
            [0] => 2012-12-31 13:50:36
            [1] => http://www.ttgood.com/jy/t148396.htm
        )

    [831] => Array
        (
            [0] => 2012-12-31 13:48:54
            [1] => http://www.ttgood.com/jy/t99804.htm
        )

    [832] => Array
        (
            [0] => 2012-12-31 13:26:06
            [1] => http://www.ttgood.com/jy/t142925.htm
        )

    [833] => Array
        (
            [0] => 2012-12-31 13:24:17
            [1] => http://www.ttgood.com/jy/t144449.htm
        )

    [834] => Array
        (
            [0] => 2012-12-31 13:09:37
            [1] => http://www.ttgood.com/jy/t106686.htm
        )

    [835] => Array
        (
            [0] => 2012-12-31 13:00:59
            [1] => http://www.ttgood.com/jy/t148307.htm
        )

    [836] => Array
        (
            [0] => 2012-12-31 12:44:46
            [1] => http://www.ttgood.com/jy/t93751.htm
        )

    [837] => Array
        (
            [0] => 2012-12-31 12:33:39
            [1] => http://www.ttgood.com/jy/t6476.htm
        )

    [838] => Array
        (
            [0] => 2012-12-31 12:24:22
            [1] => http://www.ttgood.com/jy/t124271.htm
        )

    [839] => Array
        (
            [0] => 2012-12-31 11:56:37
            [1] => http://www.ttgood.com/jy/t130913.htm
        )

    [840] => Array
        (
            [0] => 2012-12-31 11:49:39
            [1] => http://www.ttgood.com/jy/t144645.htm
        )

    [841] => Array
        (
            [0] => 2012-12-31 10:57:04
            [1] => http://www.ttgood.com/jy/t150224.htm
        )

    [842] => Array
        (
            [0] => 2012-12-31 10:52:02
            [1] => http://www.ttgood.com/jy/t135102.htm
        )

    [843] => Array
        (
            [0] => 2012-12-31 10:44:03
            [1] => http://www.ttgood.com/jy/t147447.htm
        )

    [844] => Array
        (
            [0] => 2012-12-31 10:42:27
            [1] => http://www.ttgood.com/jy/t131739.htm
        )

    [845] => Array
        (
            [0] => 2012-12-31 10:26:55
            [1] => http://www.ttgood.com/jy/t135241.htm
        )

    [846] => Array
        (
            [0] => 2012-12-31 10:12:40
            [1] => http://www.ttgood.com/jy/t137084.htm
        )

    [847] => Array
        (
            [0] => 2012-12-31 10:06:38
            [1] => http://www.ttgood.com/jy/t147725.htm
        )

    [848] => Array
        (
            [0] => 2012-12-31 09:56:52
            [1] => http://www.ttgood.com/jy/t139024.htm
        )

    [849] => Array
        (
            [0] => 2012-12-31 09:46:37
            [1] => http://www.ttgood.com/jy/t141227.htm
        )

    [850] => Array
        (
            [0] => 2012-12-31 09:44:37
            [1] => http://www.ttgood.com/jy/t150126.htm
        )

    [851] => Array
        (
            [0] => 2012-12-31 09:06:20
            [1] => http://www.ttgood.com/jy/t150313.htm
        )

    [852] => Array
        (
            [0] => 2012-12-31 09:06:08
            [1] => http://www.ttgood.com/jy/t145576.htm
        )

    [853] => Array
        (
            [0] => 2012-12-31 09:04:03
            [1] => http://www.ttgood.com/jy/t150329.htm
        )

    [854] => Array
        (
            [0] => 2012-12-31 09:03:53
            [1] => http://www.ttgood.com/jy/t150328.htm
        )

    [855] => Array
        (
            [0] => 2012-12-31 09:03:24
            [1] => http://www.ttgood.com/jy/t150326.htm
        )

    [856] => Array
        (
            [0] => 2012-12-31 09:03:02
            [1] => http://www.ttgood.com/jy/t150325.htm
        )

    [857] => Array
        (
            [0] => 2012-12-31 09:01:27
            [1] => http://www.ttgood.com/jy/t150319.htm
        )

    [858] => Array
        (
            [0] => 2012-12-31 09:00:58
            [1] => http://www.ttgood.com/jy/t150317.htm
        )

    [859] => Array
        (
            [0] => 2012-12-31 08:45:58
            [1] => http://www.ttgood.com/jy/t138408.htm
        )

    [860] => Array
        (
            [0] => 2012-12-31 00:52:58
            [1] => http://www.ttgood.com/jy/t143268.htm
        )

    [861] => Array
        (
            [0] => 2012-12-30 23:42:09
            [1] => http://www.ttgood.com/jy/t140304.htm
        )

    [862] => Array
        (
            [0] => 2012-12-30 23:37:53
            [1] => http://www.ttgood.com/jy/t147180.htm
        )

    [863] => Array
        (
            [0] => 2012-12-30 22:41:01
            [1] => http://www.ttgood.com/jy/t150260.htm
        )

    [864] => Array
        (
            [0] => 2012-12-30 22:33:38
            [1] => http://www.ttgood.com/jy/t146800.htm
        )

    [865] => Array
        (
            [0] => 2012-12-30 22:02:42
            [1] => http://www.ttgood.com/jy/t147693.htm
        )

    [866] => Array
        (
            [0] => 2012-12-30 21:44:54
            [1] => http://www.ttgood.com/jy/t148018.htm
        )

    [867] => Array
        (
            [0] => 2012-12-30 21:16:55
            [1] => http://www.ttgood.com/jy/t150304.htm
        )

    [868] => Array
        (
            [0] => 2012-12-30 21:05:16
            [1] => http://www.ttgood.com/jy/t144380.htm
        )

    [869] => Array
        (
            [0] => 2012-12-30 20:53:19
            [1] => http://www.ttgood.com/jy/t149166.htm
        )

    [870] => Array
        (
            [0] => 2012-12-30 20:09:44
            [1] => http://www.ttgood.com/jy/t140384.htm
        )

    [871] => Array
        (
            [0] => 2012-12-30 20:07:01
            [1] => http://www.ttgood.com/jy/t139364.htm
        )

    [872] => Array
        (
            [0] => 2012-12-30 19:47:13
            [1] => http://www.ttgood.com/jy/t110671.htm
        )

    [873] => Array
        (
            [0] => 2012-12-30 19:18:27
            [1] => http://www.ttgood.com/jy/t53471.htm
        )

    [874] => Array
        (
            [0] => 2012-12-30 18:38:42
            [1] => http://www.ttgood.com/jy/t149974.htm
        )

    [875] => Array
        (
            [0] => 2012-12-30 18:11:30
            [1] => http://www.ttgood.com/jy/t150238.htm
        )

    [876] => Array
        (
            [0] => 2012-12-30 18:01:23
            [1] => http://www.ttgood.com/jy/t131533.htm
        )

    [877] => Array
        (
            [0] => 2012-12-30 17:23:28
            [1] => http://www.ttgood.com/jy/t101669.htm
        )

    [878] => Array
        (
            [0] => 2012-12-30 17:04:49
            [1] => http://www.ttgood.com/jy/t41819.htm
        )

    [879] => Array
        (
            [0] => 2012-12-30 17:00:31
            [1] => http://www.ttgood.com/jy/t124023.htm
        )

    [880] => Array
        (
            [0] => 2012-12-30 16:19:34
            [1] => http://www.ttgood.com/jy/t141667.htm
        )

    [881] => Array
        (
            [0] => 2012-12-30 16:08:26
            [1] => http://www.ttgood.com/jy/t117362.htm
        )

    [882] => Array
        (
            [0] => 2012-12-30 15:13:13
            [1] => http://www.ttgood.com/jy/t149862.htm
        )

    [883] => Array
        (
            [0] => 2012-12-30 15:06:14
            [1] => http://www.ttgood.com/jy/t149901.htm
        )

    [884] => Array
        (
            [0] => 2012-12-30 14:35:29
            [1] => http://www.ttgood.com/jy/t144709.htm
        )

    [885] => Array
        (
            [0] => 2012-12-30 13:56:38
            [1] => http://www.ttgood.com/jy/t143751.htm
        )

    [886] => Array
        (
            [0] => 2012-12-30 13:40:51
            [1] => http://www.ttgood.com/jy/t134396.htm
        )

    [887] => Array
        (
            [0] => 2012-12-30 13:33:18
            [1] => http://www.ttgood.com/jy/t122797.htm
        )

    [888] => Array
        (
            [0] => 2012-12-30 13:20:00
            [1] => http://www.ttgood.com/jy/t131255.htm
        )

    [889] => Array
        (
            [0] => 2012-12-30 13:04:03
            [1] => http://www.ttgood.com/jy/t131130.htm
        )

    [890] => Array
        (
            [0] => 2012-12-30 12:50:18
            [1] => http://www.ttgood.com/jy/t127795.htm
        )

    [891] => Array
        (
            [0] => 2012-12-30 12:45:44
            [1] => http://www.ttgood.com/jy/t147250.htm
        )

    [892] => Array
        (
            [0] => 2012-12-30 12:43:44
            [1] => http://www.ttgood.com/jy/t149273.htm
        )

    [893] => Array
        (
            [0] => 2012-12-30 12:31:57
            [1] => http://www.ttgood.com/jy/t103682.htm
        )

    [894] => Array
        (
            [0] => 2012-12-30 11:57:04
            [1] => http://www.ttgood.com/jy/t142395.htm
        )

    [895] => Array
        (
            [0] => 2012-12-30 11:53:28
            [1] => http://www.ttgood.com/jy/t101285.htm
        )

    [896] => Array
        (
            [0] => 2012-12-30 11:51:52
            [1] => http://www.ttgood.com/jy/t125574.htm
        )

    [897] => Array
        (
            [0] => 2012-12-30 11:49:25
            [1] => http://www.ttgood.com/jy/t150288.htm
        )

    [898] => Array
        (
            [0] => 2012-12-30 11:40:37
            [1] => http://www.ttgood.com/jy/t150146.htm
        )

    [899] => Array
        (
            [0] => 2012-12-30 11:20:50
            [1] => http://www.ttgood.com/jy/t147018.htm
        )

    [900] => Array
        (
            [0] => 2012-12-30 11:17:35
            [1] => http://www.ttgood.com/jy/t86313.htm
        )

    [901] => Array
        (
            [0] => 2012-12-30 11:09:42
            [1] => http://www.ttgood.com/jy/t140447.htm
        )

    [902] => Array
        (
            [0] => 2012-12-30 10:48:47
            [1] => http://www.ttgood.com/jy/t84309.htm
        )

    [903] => Array
        (
            [0] => 2012-12-30 10:27:53
            [1] => http://www.ttgood.com/jy/t112743.htm
        )

    [904] => Array
        (
            [0] => 2012-12-30 10:18:00
            [1] => http://www.ttgood.com/jy/t147196.htm
        )

    [905] => Array
        (
            [0] => 2012-12-30 10:11:19
            [1] => http://www.ttgood.com/jy/t10222.htm
        )

    [906] => Array
        (
            [0] => 2012-12-30 09:50:55
            [1] => http://www.ttgood.com/jy/t147924.htm
        )

    [907] => Array
        (
            [0] => 2012-12-30 09:35:18
            [1] => http://www.ttgood.com/jy/t141712.htm
        )

    [908] => Array
        (
            [0] => 2012-12-30 09:32:38
            [1] => http://www.ttgood.com/jy/t79522.htm
        )

    [909] => Array
        (
            [0] => 2012-12-30 09:25:53
            [1] => http://www.ttgood.com/jy/t148633.htm
        )

    [910] => Array
        (
            [0] => 2012-12-30 09:18:08
            [1] => http://www.ttgood.com/jy/t150179.htm
        )

    [911] => Array
        (
            [0] => 2012-12-30 09:15:59
            [1] => http://www.ttgood.com/jy/t150303.htm
        )

    [912] => Array
        (
            [0] => 2012-12-30 09:15:52
            [1] => http://www.ttgood.com/jy/t150302.htm
        )

    [913] => Array
        (
            [0] => 2012-12-30 09:15:44
            [1] => http://www.ttgood.com/jy/t150301.htm
        )

    [914] => Array
        (
            [0] => 2012-12-30 09:15:00
            [1] => http://www.ttgood.com/jy/t150298.htm
        )

    [915] => Array
        (
            [0] => 2012-12-30 09:14:52
            [1] => http://www.ttgood.com/jy/t150297.htm
        )

    [916] => Array
        (
            [0] => 2012-12-30 09:14:43
            [1] => http://www.ttgood.com/jy/t150296.htm
        )

    [917] => Array
        (
            [0] => 2012-12-30 09:12:42
            [1] => http://www.ttgood.com/jy/t150293.htm
        )

    [918] => Array
        (
            [0] => 2012-12-30 09:11:21
            [1] => http://www.ttgood.com/jy/t150292.htm
        )

    [919] => Array
        (
            [0] => 2012-12-29 23:27:26
            [1] => http://www.ttgood.com/jy/t149924.htm
        )

    [920] => Array
        (
            [0] => 2012-12-29 21:56:52
            [1] => http://www.ttgood.com/jy/t149822.htm
        )

    [921] => Array
        (
            [0] => 2012-12-29 21:52:33
            [1] => http://www.ttgood.com/jy/t149770.htm
        )

    [922] => Array
        (
            [0] => 2012-12-29 21:45:48
            [1] => http://www.ttgood.com/jy/t142787.htm
        )

    [923] => Array
        (
            [0] => 2012-12-29 21:44:10
            [1] => http://www.ttgood.com/jy/t146929.htm
        )

    [924] => Array
        (
            [0] => 2012-12-29 21:36:15
            [1] => http://www.ttgood.com/jy/t150081.htm
        )

    [925] => Array
        (
            [0] => 2012-12-29 20:47:29
            [1] => http://www.ttgood.com/jy/t104617.htm
        )

    [926] => Array
        (
            [0] => 2012-12-29 20:36:25
            [1] => http://www.ttgood.com/jy/t41754.htm
        )

    [927] => Array
        (
            [0] => 2012-12-29 20:35:16
            [1] => http://www.ttgood.com/jy/t141496.htm
        )

    [928] => Array
        (
            [0] => 2012-12-29 20:32:44
            [1] => http://www.ttgood.com/jy/t150281.htm
        )

    [929] => Array
        (
            [0] => 2012-12-29 19:37:10
            [1] => http://www.ttgood.com/jy/t149571.htm
        )

    [930] => Array
        (
            [0] => 2012-12-29 19:22:45
            [1] => http://www.ttgood.com/jy/t146047.htm
        )

    [931] => Array
        (
            [0] => 2012-12-29 19:17:22
            [1] => http://www.ttgood.com/jy/t138254.htm
        )

    [932] => Array
        (
            [0] => 2012-12-29 19:11:49
            [1] => http://www.ttgood.com/jy/t150266.htm
        )

    [933] => Array
        (
            [0] => 2012-12-29 19:08:10
            [1] => http://www.ttgood.com/jy/t143298.htm
        )

    [934] => Array
        (
            [0] => 2012-12-29 18:45:36
            [1] => http://www.ttgood.com/jy/t147384.htm
        )

    [935] => Array
        (
            [0] => 2012-12-29 18:38:50
            [1] => http://www.ttgood.com/jy/t150040.htm
        )

    [936] => Array
        (
            [0] => 2012-12-29 18:38:29
            [1] => http://www.ttgood.com/jy/t149907.htm
        )

    [937] => Array
        (
            [0] => 2012-12-29 18:38:21
            [1] => http://www.ttgood.com/jy/t144364.htm
        )

    [938] => Array
        (
            [0] => 2012-12-29 18:22:35
            [1] => http://www.ttgood.com/jy/t90399.htm
        )

    [939] => Array
        (
            [0] => 2012-12-29 18:21:55
            [1] => http://www.ttgood.com/jy/t136695.htm
        )

    [940] => Array
        (
            [0] => 2012-12-29 18:17:32
            [1] => http://www.ttgood.com/jy/t149403.htm
        )

    [941] => Array
        (
            [0] => 2012-12-29 18:12:30
            [1] => http://www.ttgood.com/jy/t149340.htm
        )

    [942] => Array
        (
            [0] => 2012-12-29 17:36:12
            [1] => http://www.ttgood.com/jy/t143387.htm
        )

    [943] => Array
        (
            [0] => 2012-12-29 17:17:13
            [1] => http://www.ttgood.com/jy/t147999.htm
        )

    [944] => Array
        (
            [0] => 2012-12-29 17:15:54
            [1] => http://www.ttgood.com/jy/t132016.htm
        )

    [945] => Array
        (
            [0] => 2012-12-29 17:13:30
            [1] => http://www.ttgood.com/jy/t124917.htm
        )

    [946] => Array
        (
            [0] => 2012-12-29 17:11:18
            [1] => http://www.ttgood.com/jy/t138053.htm
        )

    [947] => Array
        (
            [0] => 2012-12-29 17:02:06
            [1] => http://www.ttgood.com/jy/t150244.htm
        )

    [948] => Array
        (
            [0] => 2012-12-29 16:58:02
            [1] => http://www.ttgood.com/jy/t147691.htm
        )

    [949] => Array
        (
            [0] => 2012-12-29 16:24:42
            [1] => http://www.ttgood.com/jy/t148642.htm
        )

    [950] => Array
        (
            [0] => 2012-12-29 16:14:16
            [1] => http://www.ttgood.com/jy/t149812.htm
        )

    [951] => Array
        (
            [0] => 2012-12-29 15:56:10
            [1] => http://www.ttgood.com/jy/t119983.htm
        )

    [952] => Array
        (
            [0] => 2012-12-29 15:53:45
            [1] => http://www.ttgood.com/jy/t148447.htm
        )

    [953] => Array
        (
            [0] => 2012-12-29 15:47:43
            [1] => http://www.ttgood.com/jy/t147544.htm
        )

    [954] => Array
        (
            [0] => 2012-12-29 15:43:54
            [1] => http://www.ttgood.com/jy/t147153.htm
        )

    [955] => Array
        (
            [0] => 2012-12-29 15:41:45
            [1] => http://www.ttgood.com/jy/t150110.htm
        )

    [956] => Array
        (
            [0] => 2012-12-29 15:41:20
            [1] => http://www.ttgood.com/jy/t149740.htm
        )

    [957] => Array
        (
            [0] => 2012-12-29 15:41:17
            [1] => http://www.ttgood.com/jy/t145355.htm
        )

    [958] => Array
        (
            [0] => 2012-12-29 15:37:42
            [1] => http://www.ttgood.com/jy/t148063.htm
        )

    [959] => Array
        (
            [0] => 2012-12-29 15:35:42
            [1] => http://www.ttgood.com/jy/t129164.htm
        )

    [960] => Array
        (
            [0] => 2012-12-29 15:24:16
            [1] => http://www.ttgood.com/jy/t149587.htm
        )

    [961] => Array
        (
            [0] => 2012-12-29 13:54:57
            [1] => http://www.ttgood.com/jy/t144736.htm
        )

    [962] => Array
        (
            [0] => 2012-12-29 13:51:06
            [1] => http://www.ttgood.com/jy/t134351.htm
        )

    [963] => Array
        (
            [0] => 2012-12-29 13:39:06
            [1] => http://www.ttgood.com/jy/t135685.htm
        )

    [964] => Array
        (
            [0] => 2012-12-29 12:40:27
            [1] => http://www.ttgood.com/jy/t147179.htm
        )

    [965] => Array
        (
            [0] => 2012-12-29 12:33:19
            [1] => http://www.ttgood.com/jy/t149572.htm
        )

    [966] => Array
        (
            [0] => 2012-12-29 12:21:37
            [1] => http://www.ttgood.com/jy/t150007.htm
        )

    [967] => Array
        (
            [0] => 2012-12-29 11:46:46
            [1] => http://www.ttgood.com/jy/t139265.htm
        )

    [968] => Array
        (
            [0] => 2012-12-29 11:36:59
            [1] => http://www.ttgood.com/jy/t142065.htm
        )

    [969] => Array
        (
            [0] => 2012-12-29 11:01:58
            [1] => http://www.ttgood.com/jy/t149612.htm
        )

    [970] => Array
        (
            [0] => 2012-12-29 10:41:32
            [1] => http://www.ttgood.com/jy/t140664.htm
        )

    [971] => Array
        (
            [0] => 2012-12-29 10:41:29
            [1] => http://www.ttgood.com/jy/t145895.htm
        )

    [972] => Array
        (
            [0] => 2012-12-29 10:15:31
            [1] => http://www.ttgood.com/jy/t146450.htm
        )

    [973] => Array
        (
            [0] => 2012-12-29 09:34:37
            [1] => http://www.ttgood.com/jy/t149475.htm
        )

    [974] => Array
        (
            [0] => 2012-12-29 09:23:35
            [1] => http://www.ttgood.com/jy/t146880.htm
        )

    [975] => Array
        (
            [0] => 2012-12-29 09:07:42
            [1] => http://www.ttgood.com/jy/t150289.htm
        )

    [976] => Array
        (
            [0] => 2012-12-29 09:07:09
            [1] => http://www.ttgood.com/jy/t150287.htm
        )

    [977] => Array
        (
            [0] => 2012-12-29 09:06:20
            [1] => http://www.ttgood.com/jy/t150283.htm
        )

    [978] => Array
        (
            [0] => 2012-12-29 09:06:07
            [1] => http://www.ttgood.com/jy/t150282.htm
        )

    [979] => Array
        (
            [0] => 2012-12-29 09:05:33
            [1] => http://www.ttgood.com/jy/t150279.htm
        )

    [980] => Array
        (
            [0] => 2012-12-29 09:03:37
            [1] => http://www.ttgood.com/jy/t150277.htm
        )

    [981] => Array
        (
            [0] => 2012-12-29 09:03:30
            [1] => http://www.ttgood.com/jy/t150276.htm
        )

    [982] => Array
        (
            [0] => 2012-12-29 09:03:20
            [1] => http://www.ttgood.com/jy/t150275.htm
        )

    [983] => Array
        (
            [0] => 2012-12-29 09:03:14
            [1] => http://www.ttgood.com/jy/t150274.htm
        )

    [984] => Array
        (
            [0] => 2012-12-29 09:02:24
            [1] => http://www.ttgood.com/jy/t150269.htm
        )

    [985] => Array
        (
            [0] => 2012-12-29 08:55:27
            [1] => http://www.ttgood.com/jy/t148809.htm
        )

    [986] => Array
        (
            [0] => 2012-12-29 01:48:20
            [1] => http://www.ttgood.com/jy/t148583.htm
        )

    [987] => Array
        (
            [0] => 2012-12-28 23:54:40
            [1] => http://www.ttgood.com/jy/t100143.htm
        )

    [988] => Array
        (
            [0] => 2012-12-28 23:30:49
            [1] => http://www.ttgood.com/jy/t145766.htm
        )

    [989] => Array
        (
            [0] => 2012-12-28 23:26:54
            [1] => http://www.ttgood.com/jy/t88166.htm
        )

    [990] => Array
        (
            [0] => 2012-12-28 22:57:29
            [1] => http://www.ttgood.com/jy/t141652.htm
        )

    [991] => Array
        (
            [0] => 2012-12-28 22:15:05
            [1] => http://www.ttgood.com/jy/t150034.htm
        )

    [992] => Array
        (
            [0] => 2012-12-28 21:35:58
            [1] => http://www.ttgood.com/jy/t147047.htm
        )

    [993] => Array
        (
            [0] => 2012-12-28 21:35:32
            [1] => http://www.ttgood.com/jy/t115287.htm
        )

    [994] => Array
        (
            [0] => 2012-12-28 21:23:13
            [1] => http://www.ttgood.com/jy/t120008.htm
        )

    [995] => Array
        (
            [0] => 2012-12-28 21:06:46
            [1] => http://www.ttgood.com/jy/t150223.htm
        )

    [996] => Array
        (
            [0] => 2012-12-28 20:57:28
            [1] => http://www.ttgood.com/jy/t130319.htm
        )

    [997] => Array
        (
            [0] => 2012-12-28 20:05:48
            [1] => http://www.ttgood.com/jy/t146118.htm
        )

    [998] => Array
        (
            [0] => 2012-12-28 19:37:00
            [1] => http://www.ttgood.com/jy/t149665.htm
        )

    [999] => Array
        (
            [0] => 2012-12-28 19:23:55
            [1] => http://www.ttgood.com/jy/t148812.htm
        )

    [1000] => Array
        (
            [0] => 2012-12-28 19:19:25
            [1] => http://www.ttgood.com/jy/t146618.htm
        )

    [1001] => Array
        (
            [0] => 2012-12-28 18:34:20
            [1] => http://www.ttgood.com/jy/t150194.htm
        )

    [1002] => Array
        (
            [0] => 2012-12-28 17:43:33
            [1] => http://www.ttgood.com/jy/t148389.htm
        )

    [1003] => Array
        (
            [0] => 2012-12-28 17:39:03
            [1] => http://www.ttgood.com/jy/t150054.htm
        )

    [1004] => Array
        (
            [0] => 2012-12-28 17:17:48
            [1] => http://www.ttgood.com/jy/t145164.htm
        )

    [1005] => Array
        (
            [0] => 2012-12-28 17:02:58
            [1] => http://www.ttgood.com/jy/t133297.htm
        )

    [1006] => Array
        (
            [0] => 2012-12-28 16:53:27
            [1] => http://www.ttgood.com/jy/t149866.htm
        )

    [1007] => Array
        (
            [0] => 2012-12-28 16:15:36
            [1] => http://www.ttgood.com/jy/t150249.htm
        )

    [1008] => Array
        (
            [0] => 2012-12-28 16:15:22
            [1] => http://www.ttgood.com/jy/t145375.htm
        )

    [1009] => Array
        (
            [0] => 2012-12-28 16:07:48
            [1] => http://www.ttgood.com/jy/t149456.htm
        )

    [1010] => Array
        (
            [0] => 2012-12-28 15:54:01
            [1] => http://www.ttgood.com/jy/t143189.htm
        )

    [1011] => Array
        (
            [0] => 2012-12-28 15:52:28
            [1] => http://www.ttgood.com/jy/t118461.htm
        )

    [1012] => Array
        (
            [0] => 2012-12-28 15:49:03
            [1] => http://www.ttgood.com/jy/t128551.htm
        )

    [1013] => Array
        (
            [0] => 2012-12-28 15:40:08
            [1] => http://www.ttgood.com/jy/t149402.htm
        )

    [1014] => Array
        (
            [0] => 2012-12-28 15:31:17
            [1] => http://www.ttgood.com/jy/t149522.htm
        )

    [1015] => Array
        (
            [0] => 2012-12-28 15:29:01
            [1] => http://www.ttgood.com/jy/t148746.htm
        )

    [1016] => Array
        (
            [0] => 2012-12-28 15:27:20
            [1] => http://www.ttgood.com/jy/t113559.htm
        )

    [1017] => Array
        (
            [0] => 2012-12-28 15:26:18
            [1] => http://www.ttgood.com/jy/t142434.htm
        )

    [1018] => Array
        (
            [0] => 2012-12-28 15:18:20
            [1] => http://www.ttgood.com/jy/t136769.htm
        )

    [1019] => Array
        (
            [0] => 2012-12-28 14:58:50
            [1] => http://www.ttgood.com/jy/t149865.htm
        )

    [1020] => Array
        (
            [0] => 2012-12-28 14:41:14
            [1] => http://www.ttgood.com/jy/t148413.htm
        )

    [1021] => Array
        (
            [0] => 2012-12-28 14:39:14
            [1] => http://www.ttgood.com/jy/t121193.htm
        )

    [1022] => Array
        (
            [0] => 2012-12-28 14:33:26
            [1] => http://www.ttgood.com/jy/t150200.htm
        )

    [1023] => Array
        (
            [0] => 2012-12-28 14:32:29
            [1] => http://www.ttgood.com/jy/t121290.htm
        )

    [1024] => Array
        (
            [0] => 2012-12-28 14:08:27
            [1] => http://www.ttgood.com/jy/t149060.htm
        )

    [1025] => Array
        (
            [0] => 2012-12-28 13:50:17
            [1] => http://www.ttgood.com/jy/t42898.htm
        )

    [1026] => Array
        (
            [0] => 2012-12-28 13:21:36
            [1] => http://www.ttgood.com/jy/t138215.htm
        )

    [1027] => Array
        (
            [0] => 2012-12-28 13:16:57
            [1] => http://www.ttgood.com/jy/t132818.htm
        )

    [1028] => Array
        (
            [0] => 2012-12-28 13:09:40
            [1] => http://www.ttgood.com/jy/t150101.htm
        )

    [1029] => Array
        (
            [0] => 2012-12-28 13:03:00
            [1] => http://www.ttgood.com/jy/t145415.htm
        )

    [1030] => Array
        (
            [0] => 2012-12-28 12:50:36
            [1] => http://www.ttgood.com/jy/t142792.htm
        )

    [1031] => Array
        (
            [0] => 2012-12-28 12:49:40
            [1] => http://www.ttgood.com/jy/t146395.htm
        )

    [1032] => Array
        (
            [0] => 2012-12-28 12:39:40
            [1] => http://www.ttgood.com/jy/t146518.htm
        )

    [1033] => Array
        (
            [0] => 2012-12-28 12:22:44
            [1] => http://www.ttgood.com/jy/t128249.htm
        )

    [1034] => Array
        (
            [0] => 2012-12-28 11:42:55
            [1] => http://www.ttgood.com/jy/t138514.htm
        )

    [1035] => Array
        (
            [0] => 2012-12-28 11:32:59
            [1] => http://www.ttgood.com/jy/t149121.htm
        )

    [1036] => Array
        (
            [0] => 2012-12-28 11:06:34
            [1] => http://www.ttgood.com/jy/t145939.htm
        )

    [1037] => Array
        (
            [0] => 2012-12-28 11:01:03
            [1] => http://www.ttgood.com/jy/t93110.htm
        )

    [1038] => Array
        (
            [0] => 2012-12-28 10:32:13
            [1] => http://www.ttgood.com/jy/t75053.htm
        )

    [1039] => Array
        (
            [0] => 2012-12-28 10:27:08
            [1] => http://www.ttgood.com/jy/t150154.htm
        )

    [1040] => Array
        (
            [0] => 2012-12-28 10:25:42
            [1] => http://www.ttgood.com/jy/t146521.htm
        )

    [1041] => Array
        (
            [0] => 2012-12-28 10:02:42
            [1] => http://www.ttgood.com/jy/t137366.htm
        )

    [1042] => Array
        (
            [0] => 2012-12-28 09:14:07
            [1] => http://www.ttgood.com/jy/t150261.htm
        )

    [1043] => Array
        (
            [0] => 2012-12-28 09:12:23
            [1] => http://www.ttgood.com/jy/t150259.htm
        )

    [1044] => Array
        (
            [0] => 2012-12-28 09:12:15
            [1] => http://www.ttgood.com/jy/t150258.htm
        )

    [1045] => Array
        (
            [0] => 2012-12-28 08:06:23
            [1] => http://www.ttgood.com/jy/t63564.htm
        )

    [1046] => Array
        (
            [0] => 2012-12-27 23:58:02
            [1] => http://www.ttgood.com/jy/t74436.htm
        )

    [1047] => Array
        (
            [0] => 2012-12-27 23:48:34
            [1] => http://www.ttgood.com/jy/t147198.htm
        )

    [1048] => Array
        (
            [0] => 2012-12-27 22:44:58
            [1] => http://www.ttgood.com/jy/t135143.htm
        )

    [1049] => Array
        (
            [0] => 2012-12-27 22:35:02
            [1] => http://www.ttgood.com/jy/t54367.htm
        )

    [1050] => Array
        (
            [0] => 2012-12-27 22:20:36
            [1] => http://www.ttgood.com/jy/t149660.htm
        )

    [1051] => Array
        (
            [0] => 2012-12-27 22:09:56
            [1] => http://www.ttgood.com/jy/t140055.htm
        )

    [1052] => Array
        (
            [0] => 2012-12-27 21:57:23
            [1] => http://www.ttgood.com/jy/t148045.htm
        )

    [1053] => Array
        (
            [0] => 2012-12-27 21:54:01
            [1] => http://www.ttgood.com/jy/t149868.htm
        )

    [1054] => Array
        (
            [0] => 2012-12-27 21:50:53
            [1] => http://www.ttgood.com/jy/t149732.htm
        )

    [1055] => Array
        (
            [0] => 2012-12-27 21:47:38
            [1] => http://www.ttgood.com/jy/t146155.htm
        )

    [1056] => Array
        (
            [0] => 2012-12-27 21:43:26
            [1] => http://www.ttgood.com/jy/t148824.htm
        )

    [1057] => Array
        (
            [0] => 2012-12-27 20:02:00
            [1] => http://www.ttgood.com/jy/t148271.htm
        )

    [1058] => Array
        (
            [0] => 2012-12-27 19:56:05
            [1] => http://www.ttgood.com/jy/t148246.htm
        )

    [1059] => Array
        (
            [0] => 2012-12-27 19:31:44
            [1] => http://www.ttgood.com/jy/t122947.htm
        )

    [1060] => Array
        (
            [0] => 2012-12-27 17:13:15
            [1] => http://www.ttgood.com/jy/t135266.htm
        )

    [1061] => Array
        (
            [0] => 2012-12-27 17:09:13
            [1] => http://www.ttgood.com/jy/t150245.htm
        )

    [1062] => Array
        (
            [0] => 2012-12-27 16:50:04
            [1] => http://www.ttgood.com/jy/t147930.htm
        )

    [1063] => Array
        (
            [0] => 2012-12-27 16:39:06
            [1] => http://www.ttgood.com/jy/t148276.htm
        )

    [1064] => Array
        (
            [0] => 2012-12-27 16:38:43
            [1] => http://www.ttgood.com/jy/t123951.htm
        )

    [1065] => Array
        (
            [0] => 2012-12-27 16:09:21
            [1] => http://www.ttgood.com/jy/t148211.htm
        )

    [1066] => Array
        (
            [0] => 2012-12-27 16:06:04
            [1] => http://www.ttgood.com/jy/t147765.htm
        )

    [1067] => Array
        (
            [0] => 2012-12-27 15:52:45
            [1] => http://www.ttgood.com/jy/t149288.htm
        )

    [1068] => Array
        (
            [0] => 2012-12-27 15:45:56
            [1] => http://www.ttgood.com/jy/t94589.htm
        )

    [1069] => Array
        (
            [0] => 2012-12-27 15:37:49
            [1] => http://www.ttgood.com/jy/t148374.htm
        )

    [1070] => Array
        (
            [0] => 2012-12-27 15:22:31
            [1] => http://www.ttgood.com/jy/t149446.htm
        )

    [1071] => Array
        (
            [0] => 2012-12-27 15:06:34
            [1] => http://www.ttgood.com/jy/t145160.htm
        )

    [1072] => Array
        (
            [0] => 2012-12-27 15:03:04
            [1] => http://www.ttgood.com/jy/t138436.htm
        )

    [1073] => Array
        (
            [0] => 2012-12-27 14:52:12
            [1] => http://www.ttgood.com/jy/t149433.htm
        )

    [1074] => Array
        (
            [0] => 2012-12-27 14:49:55
            [1] => http://www.ttgood.com/jy/t150141.htm
        )

    [1075] => Array
        (
            [0] => 2012-12-27 14:31:19
            [1] => http://www.ttgood.com/jy/t79757.htm
        )

    [1076] => Array
        (
            [0] => 2012-12-27 14:26:03
            [1] => http://www.ttgood.com/jy/t123024.htm
        )

    [1077] => Array
        (
            [0] => 2012-12-27 14:23:11
            [1] => http://www.ttgood.com/jy/t149199.htm
        )

    [1078] => Array
        (
            [0] => 2012-12-27 13:45:39
            [1] => http://www.ttgood.com/jy/t134384.htm
        )

    [1079] => Array
        (
            [0] => 2012-12-27 13:42:31
            [1] => http://www.ttgood.com/jy/t149226.htm
        )

    [1080] => Array
        (
            [0] => 2012-12-27 13:34:45
            [1] => http://www.ttgood.com/jy/t129025.htm
        )

    [1081] => Array
        (
            [0] => 2012-12-27 13:21:04
            [1] => http://www.ttgood.com/jy/t42257.htm
        )

    [1082] => Array
        (
            [0] => 2012-12-27 13:19:36
            [1] => http://www.ttgood.com/jy/t140690.htm
        )

    [1083] => Array
        (
            [0] => 2012-12-27 13:16:16
            [1] => http://www.ttgood.com/jy/t149882.htm
        )

    [1084] => Array
        (
            [0] => 2012-12-27 12:54:03
            [1] => http://www.ttgood.com/jy/t87058.htm
        )

    [1085] => Array
        (
            [0] => 2012-12-27 12:53:56
            [1] => http://www.ttgood.com/jy/t148035.htm
        )

    [1086] => Array
        (
            [0] => 2012-12-27 12:16:14
            [1] => http://www.ttgood.com/jy/t83294.htm
        )

    [1087] => Array
        (
            [0] => 2012-12-27 12:09:06
            [1] => http://www.ttgood.com/jy/t136593.htm
        )

    [1088] => Array
        (
            [0] => 2012-12-27 11:24:20
            [1] => http://www.ttgood.com/jy/t146409.htm
        )

    [1089] => Array
        (
            [0] => 2012-12-27 10:49:23
            [1] => http://www.ttgood.com/jy/t136604.htm
        )

    [1090] => Array
        (
            [0] => 2012-12-27 10:36:01
            [1] => http://www.ttgood.com/jy/t116656.htm
        )

    [1091] => Array
        (
            [0] => 2012-12-27 10:31:01
            [1] => http://www.ttgood.com/jy/t146510.htm
        )

    [1092] => Array
        (
            [0] => 2012-12-27 10:18:34
            [1] => http://www.ttgood.com/jy/t132849.htm
        )

    [1093] => Array
        (
            [0] => 2012-12-27 10:11:49
            [1] => http://www.ttgood.com/jy/t63211.htm
        )

    [1094] => Array
        (
            [0] => 2012-12-27 10:08:38
            [1] => http://www.ttgood.com/jy/t150250.htm
        )

    [1095] => Array
        (
            [0] => 2012-12-27 10:03:29
            [1] => http://www.ttgood.com/jy/t141666.htm
        )

    [1096] => Array
        (
            [0] => 2012-12-27 09:22:25
            [1] => http://www.ttgood.com/jy/t150246.htm
        )

    [1097] => Array
        (
            [0] => 2012-12-27 09:22:19
            [1] => http://www.ttgood.com/jy/t150242.htm
        )

    [1098] => Array
        (
            [0] => 2012-12-27 09:18:02
            [1] => http://www.ttgood.com/jy/t150226.htm
        )

    [1099] => Array
        (
            [0] => 2012-12-27 09:17:45
            [1] => http://www.ttgood.com/jy/t150225.htm
        )

    [1100] => Array
        (
            [0] => 2012-12-27 07:52:19
            [1] => http://www.ttgood.com/jy/t97668.htm
        )

    [1101] => Array
        (
            [0] => 2012-12-27 07:33:36
            [1] => http://www.ttgood.com/jy/t52840.htm
        )

    [1102] => Array
        (
            [0] => 2012-12-27 01:34:42
            [1] => http://www.ttgood.com/jy/t149435.htm
        )

    [1103] => Array
        (
            [0] => 2012-12-27 00:21:57
            [1] => http://www.ttgood.com/jy/t139714.htm
        )

    [1104] => Array
        (
            [0] => 2012-12-26 23:58:02
            [1] => http://www.ttgood.com/jy/t148935.htm
        )

    [1105] => Array
        (
            [0] => 2012-12-26 23:12:10
            [1] => http://www.ttgood.com/jy/t143707.htm
        )

    [1106] => Array
        (
            [0] => 2012-12-26 22:21:41
            [1] => http://www.ttgood.com/jy/t148532.htm
        )

    [1107] => Array
        (
            [0] => 2012-12-26 21:54:42
            [1] => http://www.ttgood.com/jy/t147976.htm
        )

    [1108] => Array
        (
            [0] => 2012-12-26 20:29:34
            [1] => http://www.ttgood.com/jy/t149957.htm
        )

    [1109] => Array
        (
            [0] => 2012-12-26 20:22:16
            [1] => http://www.ttgood.com/jy/t86895.htm
        )

    [1110] => Array
        (
            [0] => 2012-12-26 20:19:55
            [1] => http://www.ttgood.com/jy/t107469.htm
        )

    [1111] => Array
        (
            [0] => 2012-12-26 20:11:18
            [1] => http://www.ttgood.com/jy/t145322.htm
        )

    [1112] => Array
        (
            [0] => 2012-12-26 20:05:22
            [1] => http://www.ttgood.com/jy/t150204.htm
        )

    [1113] => Array
        (
            [0] => 2012-12-26 19:43:43
            [1] => http://www.ttgood.com/jy/t140356.htm
        )

    [1114] => Array
        (
            [0] => 2012-12-26 19:31:10
            [1] => http://www.ttgood.com/jy/t148350.htm
        )

    [1115] => Array
        (
            [0] => 2012-12-26 19:29:33
            [1] => http://www.ttgood.com/jy/t141461.htm
        )

    [1116] => Array
        (
            [0] => 2012-12-26 19:15:18
            [1] => http://www.ttgood.com/jy/t147678.htm
        )

    [1117] => Array
        (
            [0] => 2012-12-26 18:47:59
            [1] => http://www.ttgood.com/jy/t138913.htm
        )

    [1118] => Array
        (
            [0] => 2012-12-26 17:43:57
            [1] => http://www.ttgood.com/jy/t142517.htm
        )

    [1119] => Array
        (
            [0] => 2012-12-26 17:35:54
            [1] => http://www.ttgood.com/jy/t148343.htm
        )

    [1120] => Array
        (
            [0] => 2012-12-26 17:32:08
            [1] => http://www.ttgood.com/jy/t86632.htm
        )

    [1121] => Array
        (
            [0] => 2012-12-26 17:25:24
            [1] => http://www.ttgood.com/jy/t131267.htm
        )

    [1122] => Array
        (
            [0] => 2012-12-26 17:11:41
            [1] => http://www.ttgood.com/jy/t136859.htm
        )

    [1123] => Array
        (
            [0] => 2012-12-26 17:11:12
            [1] => http://www.ttgood.com/jy/t145340.htm
        )

    [1124] => Array
        (
            [0] => 2012-12-26 16:39:59
            [1] => http://www.ttgood.com/jy/t150177.htm
        )

    [1125] => Array
        (
            [0] => 2012-12-26 16:34:17
            [1] => http://www.ttgood.com/jy/t147318.htm
        )

    [1126] => Array
        (
            [0] => 2012-12-26 16:32:00
            [1] => http://www.ttgood.com/jy/t148466.htm
        )

    [1127] => Array
        (
            [0] => 2012-12-26 16:02:39
            [1] => http://www.ttgood.com/jy/t125337.htm
        )

    [1128] => Array
        (
            [0] => 2012-12-26 15:52:12
            [1] => http://www.ttgood.com/jy/t147504.htm
        )

    [1129] => Array
        (
            [0] => 2012-12-26 15:50:01
            [1] => http://www.ttgood.com/jy/t144460.htm
        )

    [1130] => Array
        (
            [0] => 2012-12-26 15:23:18
            [1] => http://www.ttgood.com/jy/t137043.htm
        )

    [1131] => Array
        (
            [0] => 2012-12-26 15:07:20
            [1] => http://www.ttgood.com/jy/t150230.htm
        )

    [1132] => Array
        (
            [0] => 2012-12-26 15:04:05
            [1] => http://www.ttgood.com/jy/t150232.htm
        )

    [1133] => Array
        (
            [0] => 2012-12-26 15:03:12
            [1] => http://www.ttgood.com/jy/t141292.htm
        )

    [1134] => Array
        (
            [0] => 2012-12-26 14:32:27
            [1] => http://www.ttgood.com/jy/t141535.htm
        )

    [1135] => Array
        (
            [0] => 2012-12-26 14:31:49
            [1] => http://www.ttgood.com/jy/t122796.htm
        )

    [1136] => Array
        (
            [0] => 2012-12-26 13:09:52
            [1] => http://www.ttgood.com/jy/t54245.htm
        )

    [1137] => Array
        (
            [0] => 2012-12-26 12:58:07
            [1] => http://www.ttgood.com/jy/t150124.htm
        )

    [1138] => Array
        (
            [0] => 2012-12-26 12:31:27
            [1] => http://www.ttgood.com/jy/t150166.htm
        )

    [1139] => Array
        (
            [0] => 2012-12-26 12:30:46
            [1] => http://www.ttgood.com/jy/t77638.htm
        )

    [1140] => Array
        (
            [0] => 2012-12-26 12:26:04
            [1] => http://www.ttgood.com/jy/t150216.htm
        )

    [1141] => Array
        (
            [0] => 2012-12-26 12:20:35
            [1] => http://www.ttgood.com/jy/t138038.htm
        )

    [1142] => Array
        (
            [0] => 2012-12-26 12:11:47
            [1] => http://www.ttgood.com/jy/t149459.htm
        )

    [1143] => Array
        (
            [0] => 2012-12-26 12:05:20
            [1] => http://www.ttgood.com/jy/t72264.htm
        )

    [1144] => Array
        (
            [0] => 2012-12-26 11:55:24
            [1] => http://www.ttgood.com/jy/t146668.htm
        )

    [1145] => Array
        (
            [0] => 2012-12-26 11:52:08
            [1] => http://www.ttgood.com/jy/t150114.htm
        )

    [1146] => Array
        (
            [0] => 2012-12-26 11:41:08
            [1] => http://www.ttgood.com/jy/t148282.htm
        )

    [1147] => Array
        (
            [0] => 2012-12-26 11:38:18
            [1] => http://www.ttgood.com/jy/t149096.htm
        )

    [1148] => Array
        (
            [0] => 2012-12-26 10:36:43
            [1] => http://www.ttgood.com/jy/t121821.htm
        )

    [1149] => Array
        (
            [0] => 2012-12-26 10:31:52
            [1] => http://www.ttgood.com/jy/t150127.htm
        )

    [1150] => Array
        (
            [0] => 2012-12-26 10:18:44
            [1] => http://www.ttgood.com/jy/t79841.htm
        )

    [1151] => Array
        (
            [0] => 2012-12-26 09:58:39
            [1] => http://www.ttgood.com/jy/t115914.htm
        )

    [1152] => Array
        (
            [0] => 2012-12-26 09:08:13
            [1] => http://www.ttgood.com/jy/t150039.htm
        )

    [1153] => Array
        (
            [0] => 2012-12-26 09:05:05
            [1] => http://www.ttgood.com/jy/t150220.htm
        )

    [1154] => Array
        (
            [0] => 2012-12-26 09:04:40
            [1] => http://www.ttgood.com/jy/t150218.htm
        )

    [1155] => Array
        (
            [0] => 2012-12-26 09:04:27
            [1] => http://www.ttgood.com/jy/t150217.htm
        )

    [1156] => Array
        (
            [0] => 2012-12-26 09:03:44
            [1] => http://www.ttgood.com/jy/t150214.htm
        )

    [1157] => Array
        (
            [0] => 2012-12-26 09:03:35
            [1] => http://www.ttgood.com/jy/t150213.htm
        )

    [1158] => Array
        (
            [0] => 2012-12-26 09:03:03
            [1] => http://www.ttgood.com/jy/t150211.htm
        )

    [1159] => Array
        (
            [0] => 2012-12-26 09:02:55
            [1] => http://www.ttgood.com/jy/t150210.htm
        )

    [1160] => Array
        (
            [0] => 2012-12-26 09:02:39
            [1] => http://www.ttgood.com/jy/t150208.htm
        )

    [1161] => Array
        (
            [0] => 2012-12-26 09:02:07
            [1] => http://www.ttgood.com/jy/t150205.htm
        )

    [1162] => Array
        (
            [0] => 2012-12-26 01:47:06
            [1] => http://www.ttgood.com/jy/t144998.htm
        )

    [1163] => Array
        (
            [0] => 2012-12-26 01:43:28
            [1] => http://www.ttgood.com/jy/t149919.htm
        )

    [1164] => Array
        (
            [0] => 2012-12-26 00:04:57
            [1] => http://www.ttgood.com/jy/t149896.htm
        )

    [1165] => Array
        (
            [0] => 2012-12-25 21:56:21
            [1] => http://www.ttgood.com/jy/t149486.htm
        )

    [1166] => Array
        (
            [0] => 2012-12-25 21:36:52
            [1] => http://www.ttgood.com/jy/t128737.htm
        )

    [1167] => Array
        (
            [0] => 2012-12-25 21:24:50
            [1] => http://www.ttgood.com/jy/t148470.htm
        )

    [1168] => Array
        (
            [0] => 2012-12-25 21:23:15
            [1] => http://www.ttgood.com/jy/t145321.htm
        )

    [1169] => Array
        (
            [0] => 2012-12-25 19:54:40
            [1] => http://www.ttgood.com/jy/t16416.htm
        )

    [1170] => Array
        (
            [0] => 2012-12-25 19:45:13
            [1] => http://www.ttgood.com/jy/t147782.htm
        )

    [1171] => Array
        (
            [0] => 2012-12-25 19:41:40
            [1] => http://www.ttgood.com/jy/t139947.htm
        )

    [1172] => Array
        (
            [0] => 2012-12-25 19:24:32
            [1] => http://www.ttgood.com/jy/t143530.htm
        )

    [1173] => Array
        (
            [0] => 2012-12-25 19:17:48
            [1] => http://www.ttgood.com/jy/t92128.htm
        )

    [1174] => Array
        (
            [0] => 2012-12-25 18:35:15
            [1] => http://www.ttgood.com/jy/t149877.htm
        )

    [1175] => Array
        (
            [0] => 2012-12-25 18:24:45
            [1] => http://www.ttgood.com/jy/t147866.htm
        )

    [1176] => Array
        (
            [0] => 2012-12-25 18:05:49
            [1] => http://www.ttgood.com/jy/t140403.htm
        )

    [1177] => Array
        (
            [0] => 2012-12-25 16:37:44
            [1] => http://www.ttgood.com/jy/t105976.htm
        )

    [1178] => Array
        (
            [0] => 2012-12-25 16:21:42
            [1] => http://www.ttgood.com/jy/t148240.htm
        )

    [1179] => Array
        (
            [0] => 2012-12-25 16:20:18
            [1] => http://www.ttgood.com/jy/t143439.htm
        )

    [1180] => Array
        (
            [0] => 2012-12-25 15:57:04
            [1] => http://www.ttgood.com/jy/t120301.htm
        )

    [1181] => Array
        (
            [0] => 2012-12-25 14:48:09
            [1] => http://www.ttgood.com/jy/t54686.htm
        )

    [1182] => Array
        (
            [0] => 2012-12-25 14:26:11
            [1] => http://www.ttgood.com/jy/t136801.htm
        )

    [1183] => Array
        (
            [0] => 2012-12-25 14:19:09
            [1] => http://www.ttgood.com/jy/t149388.htm
        )

    [1184] => Array
        (
            [0] => 2012-12-25 13:46:47
            [1] => http://www.ttgood.com/jy/t146762.htm
        )

    [1185] => Array
        (
            [0] => 2012-12-25 13:02:54
            [1] => http://www.ttgood.com/jy/t147107.htm
        )

    [1186] => Array
        (
            [0] => 2012-12-25 11:27:58
            [1] => http://www.ttgood.com/jy/t149860.htm
        )

    [1187] => Array
        (
            [0] => 2012-12-25 11:27:55
            [1] => http://www.ttgood.com/jy/t147757.htm
        )

    [1188] => Array
        (
            [0] => 2012-12-25 11:15:35
            [1] => http://www.ttgood.com/jy/t125494.htm
        )

    [1189] => Array
        (
            [0] => 2012-12-25 11:13:12
            [1] => http://www.ttgood.com/jy/t145364.htm
        )

    [1190] => Array
        (
            [0] => 2012-12-25 11:11:39
            [1] => http://www.ttgood.com/jy/t107277.htm
        )

    [1191] => Array
        (
            [0] => 2012-12-25 11:06:47
            [1] => http://www.ttgood.com/jy/t122602.htm
        )

    [1192] => Array
        (
            [0] => 2012-12-25 11:04:07
            [1] => http://www.ttgood.com/jy/t146515.htm
        )

    [1193] => Array
        (
            [0] => 2012-12-25 10:45:54
            [1] => http://www.ttgood.com/jy/t144919.htm
        )

    [1194] => Array
        (
            [0] => 2012-12-25 10:31:38
            [1] => http://www.ttgood.com/jy/t147074.htm
        )

    [1195] => Array
        (
            [0] => 2012-12-25 09:50:52
            [1] => http://www.ttgood.com/jy/t116137.htm
        )

    [1196] => Array
        (
            [0] => 2012-12-25 09:48:41
            [1] => http://www.ttgood.com/jy/t94414.htm
        )

    [1197] => Array
        (
            [0] => 2012-12-25 09:12:25
            [1] => http://www.ttgood.com/jy/t150196.htm
        )

    [1198] => Array
        (
            [0] => 2012-12-25 09:11:42
            [1] => http://www.ttgood.com/jy/t150188.htm
        )

    [1199] => Array
        (
            [0] => 2012-12-25 09:11:15
            [1] => http://www.ttgood.com/jy/t150186.htm
        )

    [1200] => Array
        (
            [0] => 2012-12-25 00:03:24
            [1] => http://www.ttgood.com/jy/t142235.htm
        )

    [1201] => Array
        (
            [0] => 2012-12-24 23:47:36
            [1] => http://www.ttgood.com/jy/t96550.htm
        )

    [1202] => Array
        (
            [0] => 2012-12-24 23:22:48
            [1] => http://www.ttgood.com/jy/t147359.htm
        )

    [1203] => Array
        (
            [0] => 2012-12-24 22:08:48
            [1] => http://www.ttgood.com/jy/t109369.htm
        )

    [1204] => Array
        (
            [0] => 2012-12-24 22:07:08
            [1] => http://www.ttgood.com/jy/t138871.htm
        )

    [1205] => Array
        (
            [0] => 2012-12-24 21:15:19
            [1] => http://www.ttgood.com/jy/t146540.htm
        )

    [1206] => Array
        (
            [0] => 2012-12-24 21:10:31
            [1] => http://www.ttgood.com/jy/t136497.htm
        )

    [1207] => Array
        (
            [0] => 2012-12-24 21:02:18
            [1] => http://www.ttgood.com/jy/t136379.htm
        )

    [1208] => Array
        (
            [0] => 2012-12-24 20:49:55
            [1] => http://www.ttgood.com/jy/t138970.htm
        )

    [1209] => Array
        (
            [0] => 2012-12-24 20:37:36
            [1] => http://www.ttgood.com/jy/t97620.htm
        )

    [1210] => Array
        (
            [0] => 2012-12-24 20:08:25
            [1] => http://www.ttgood.com/jy/t146616.htm
        )

    [1211] => Array
        (
            [0] => 2012-12-24 19:07:35
            [1] => http://www.ttgood.com/jy/t133958.htm
        )

    [1212] => Array
        (
            [0] => 2012-12-24 18:33:42
            [1] => http://www.ttgood.com/jy/t141745.htm
        )

    [1213] => Array
        (
            [0] => 2012-12-24 18:08:24
            [1] => http://www.ttgood.com/jy/t147308.htm
        )

    [1214] => Array
        (
            [0] => 2012-12-24 17:54:09
            [1] => http://www.ttgood.com/jy/t144642.htm
        )

    [1215] => Array
        (
            [0] => 2012-12-24 17:08:47
            [1] => http://www.ttgood.com/jy/t142635.htm
        )

    [1216] => Array
        (
            [0] => 2012-12-24 16:36:08
            [1] => http://www.ttgood.com/jy/t148827.htm
        )

    [1217] => Array
        (
            [0] => 2012-12-24 16:28:46
            [1] => http://www.ttgood.com/jy/t149540.htm
        )

    [1218] => Array
        (
            [0] => 2012-12-24 16:19:07
            [1] => http://www.ttgood.com/jy/t145075.htm
        )

    [1219] => Array
        (
            [0] => 2012-12-24 16:13:48
            [1] => http://www.ttgood.com/jy/t147928.htm
        )

    [1220] => Array
        (
            [0] => 2012-12-24 16:00:57
            [1] => http://www.ttgood.com/jy/t145243.htm
        )

    [1221] => Array
        (
            [0] => 2012-12-24 15:53:43
            [1] => http://www.ttgood.com/jy/t141437.htm
        )

    [1222] => Array
        (
            [0] => 2012-12-24 15:44:07
            [1] => http://www.ttgood.com/jy/t111343.htm
        )

    [1223] => Array
        (
            [0] => 2012-12-24 15:40:58
            [1] => http://www.ttgood.com/jy/t136886.htm
        )

    [1224] => Array
        (
            [0] => 2012-12-24 15:06:15
            [1] => http://www.ttgood.com/jy/t136272.htm
        )

    [1225] => Array
        (
            [0] => 2012-12-24 14:27:06
            [1] => http://www.ttgood.com/jy/t142530.htm
        )

    [1226] => Array
        (
            [0] => 2012-12-24 14:22:20
            [1] => http://www.ttgood.com/jy/t127252.htm
        )

    [1227] => Array
        (
            [0] => 2012-12-24 14:20:24
            [1] => http://www.ttgood.com/jy/t133592.htm
        )

    [1228] => Array
        (
            [0] => 2012-12-24 14:00:53
            [1] => http://www.ttgood.com/jy/t149233.htm
        )

    [1229] => Array
        (
            [0] => 2012-12-24 13:51:32
            [1] => http://www.ttgood.com/jy/t138748.htm
        )

    [1230] => Array
        (
            [0] => 2012-12-24 13:43:14
            [1] => http://www.ttgood.com/jy/t142472.htm
        )

    [1231] => Array
        (
            [0] => 2012-12-24 13:15:39
            [1] => http://www.ttgood.com/jy/t150095.htm
        )

    [1232] => Array
        (
            [0] => 2012-12-24 12:18:50
            [1] => http://www.ttgood.com/jy/t144034.htm
        )

    [1233] => Array
        (
            [0] => 2012-12-24 12:10:47
            [1] => http://www.ttgood.com/jy/t147551.htm
        )

    [1234] => Array
        (
            [0] => 2012-12-24 12:07:02
            [1] => http://www.ttgood.com/jy/t150044.htm
        )

    [1235] => Array
        (
            [0] => 2012-12-24 11:28:50
            [1] => http://www.ttgood.com/jy/t80239.htm
        )

    [1236] => Array
        (
            [0] => 2012-12-24 10:59:35
            [1] => http://www.ttgood.com/jy/t136806.htm
        )

    [1237] => Array
        (
            [0] => 2012-12-24 10:47:53
            [1] => http://www.ttgood.com/jy/t129560.htm
        )

    [1238] => Array
        (
            [0] => 2012-12-24 10:35:56
            [1] => http://www.ttgood.com/jy/t115225.htm
        )

    [1239] => Array
        (
            [0] => 2012-12-24 10:26:26
            [1] => http://www.ttgood.com/jy/t142127.htm
        )

    [1240] => Array
        (
            [0] => 2012-12-24 10:18:19
            [1] => http://www.ttgood.com/jy/t150061.htm
        )

    [1241] => Array
        (
            [0] => 2012-12-24 10:17:17
            [1] => http://www.ttgood.com/jy/t140183.htm
        )

    [1242] => Array
        (
            [0] => 2012-12-24 09:26:30
            [1] => http://www.ttgood.com/jy/t149292.htm
        )

    [1243] => Array
        (
            [0] => 2012-12-24 09:25:38
            [1] => http://www.ttgood.com/jy/t150178.htm
        )

    [1244] => Array
        (
            [0] => 2012-12-24 09:25:15
            [1] => http://www.ttgood.com/jy/t150176.htm
        )

    [1245] => Array
        (
            [0] => 2012-12-24 09:24:50
            [1] => http://www.ttgood.com/jy/t150175.htm
        )

    [1246] => Array
        (
            [0] => 2012-12-24 09:23:41
            [1] => http://www.ttgood.com/jy/t150174.htm
        )

    [1247] => Array
        (
            [0] => 2012-12-24 09:14:44
            [1] => http://www.ttgood.com/jy/t143363.htm
        )

    [1248] => Array
        (
            [0] => 2012-12-24 09:02:14
            [1] => http://www.ttgood.com/jy/t150164.htm
        )

    [1249] => Array
        (
            [0] => 2012-12-23 23:47:35
            [1] => http://www.ttgood.com/jy/t145151.htm
        )

    [1250] => Array
        (
            [0] => 2012-12-23 23:34:18
            [1] => http://www.ttgood.com/jy/t141210.htm
        )

    [1251] => Array
        (
            [0] => 2012-12-23 23:18:05
            [1] => http://www.ttgood.com/jy/t149656.htm
        )

    [1252] => Array
        (
            [0] => 2012-12-23 22:12:02
            [1] => http://www.ttgood.com/jy/t149931.htm
        )

    [1253] => Array
        (
            [0] => 2012-12-23 21:45:57
            [1] => http://www.ttgood.com/jy/t122290.htm
        )

    [1254] => Array
        (
            [0] => 2012-12-23 21:44:11
            [1] => http://www.ttgood.com/jy/t142324.htm
        )

    [1255] => Array
        (
            [0] => 2012-12-23 21:33:14
            [1] => http://www.ttgood.com/jy/t85946.htm
        )

    [1256] => Array
        (
            [0] => 2012-12-23 21:04:38
            [1] => http://www.ttgood.com/jy/t147401.htm
        )

    [1257] => Array
        (
            [0] => 2012-12-23 20:34:40
            [1] => http://www.ttgood.com/jy/t146648.htm
        )

    [1258] => Array
        (
            [0] => 2012-12-23 19:47:30
            [1] => http://www.ttgood.com/jy/t147055.htm
        )

    [1259] => Array
        (
            [0] => 2012-12-23 19:31:54
            [1] => http://www.ttgood.com/jy/t147209.htm
        )

    [1260] => Array
        (
            [0] => 2012-12-23 19:18:31
            [1] => http://www.ttgood.com/jy/t136050.htm
        )

    [1261] => Array
        (
            [0] => 2012-12-23 19:18:07
            [1] => http://www.ttgood.com/jy/t143610.htm
        )

    [1262] => Array
        (
            [0] => 2012-12-23 18:40:23
            [1] => http://www.ttgood.com/jy/t148985.htm
        )

    [1263] => Array
        (
            [0] => 2012-12-23 18:15:48
            [1] => http://www.ttgood.com/jy/t135738.htm
        )

    [1264] => Array
        (
            [0] => 2012-12-23 17:54:45
            [1] => http://www.ttgood.com/jy/t127945.htm
        )

    [1265] => Array
        (
            [0] => 2012-12-23 17:42:40
            [1] => http://www.ttgood.com/jy/t143065.htm
        )

    [1266] => Array
        (
            [0] => 2012-12-23 17:28:45
            [1] => http://www.ttgood.com/jy/t148792.htm
        )

    [1267] => Array
        (
            [0] => 2012-12-23 17:01:09
            [1] => http://www.ttgood.com/jy/t135250.htm
        )

    [1268] => Array
        (
            [0] => 2012-12-23 16:33:53
            [1] => http://www.ttgood.com/jy/t148461.htm
        )

    [1269] => Array
        (
            [0] => 2012-12-23 16:18:20
            [1] => http://www.ttgood.com/jy/t96753.htm
        )

    [1270] => Array
        (
            [0] => 2012-12-23 16:11:42
            [1] => http://www.ttgood.com/jy/t129950.htm
        )

    [1271] => Array
        (
            [0] => 2012-12-23 16:11:39
            [1] => http://www.ttgood.com/jy/t150019.htm
        )

    [1272] => Array
        (
            [0] => 2012-12-23 15:58:03
            [1] => http://www.ttgood.com/jy/t150136.htm
        )

    [1273] => Array
        (
            [0] => 2012-12-23 15:43:19
            [1] => http://www.ttgood.com/jy/t139146.htm
        )

    [1274] => Array
        (
            [0] => 2012-12-23 15:23:53
            [1] => http://www.ttgood.com/jy/t143750.htm
        )

    [1275] => Array
        (
            [0] => 2012-12-23 15:13:53
            [1] => http://www.ttgood.com/jy/t139641.htm
        )

    [1276] => Array
        (
            [0] => 2012-12-23 14:59:24
            [1] => http://www.ttgood.com/jy/t149697.htm
        )

    [1277] => Array
        (
            [0] => 2012-12-23 14:57:34
            [1] => http://www.ttgood.com/jy/t149307.htm
        )

    [1278] => Array
        (
            [0] => 2012-12-23 14:43:24
            [1] => http://www.ttgood.com/jy/t134481.htm
        )

    [1279] => Array
        (
            [0] => 2012-12-23 14:38:01
            [1] => http://www.ttgood.com/jy/t149510.htm
        )

    [1280] => Array
        (
            [0] => 2012-12-23 14:23:02
            [1] => http://www.ttgood.com/jy/t150006.htm
        )

    [1281] => Array
        (
            [0] => 2012-12-23 14:18:36
            [1] => http://www.ttgood.com/jy/t148637.htm
        )

    [1282] => Array
        (
            [0] => 2012-12-23 14:17:03
            [1] => http://www.ttgood.com/jy/t145946.htm
        )

    [1283] => Array
        (
            [0] => 2012-12-23 13:57:20
            [1] => http://www.ttgood.com/jy/t148202.htm
        )

    [1284] => Array
        (
            [0] => 2012-12-23 13:18:05
            [1] => http://www.ttgood.com/jy/t139533.htm
        )

    [1285] => Array
        (
            [0] => 2012-12-23 12:31:17
            [1] => http://www.ttgood.com/jy/t80839.htm
        )

    [1286] => Array
        (
            [0] => 2012-12-23 11:57:48
            [1] => http://www.ttgood.com/jy/t144961.htm
        )

    [1287] => Array
        (
            [0] => 2012-12-23 11:32:34
            [1] => http://www.ttgood.com/jy/t150029.htm
        )

    [1288] => Array
        (
            [0] => 2012-12-23 11:15:53
            [1] => http://www.ttgood.com/jy/t144758.htm
        )

    [1289] => Array
        (
            [0] => 2012-12-23 11:12:23
            [1] => http://www.ttgood.com/jy/t139560.htm
        )

    [1290] => Array
        (
            [0] => 2012-12-23 11:10:08
            [1] => http://www.ttgood.com/jy/t149048.htm
        )

    [1291] => Array
        (
            [0] => 2012-12-23 11:06:17
            [1] => http://www.ttgood.com/jy/t148236.htm
        )

    [1292] => Array
        (
            [0] => 2012-12-23 10:32:17
            [1] => http://www.ttgood.com/jy/t101572.htm
        )

    [1293] => Array
        (
            [0] => 2012-12-23 10:23:21
            [1] => http://www.ttgood.com/jy/t150129.htm
        )

    [1294] => Array
        (
            [0] => 2012-12-23 09:13:30
            [1] => http://www.ttgood.com/jy/t147411.htm
        )

    [1295] => Array
        (
            [0] => 2012-12-23 08:59:35
            [1] => http://www.ttgood.com/jy/t150153.htm
        )

    [1296] => Array
        (
            [0] => 2012-12-23 08:58:54
            [1] => http://www.ttgood.com/jy/t150150.htm
        )

    [1297] => Array
        (
            [0] => 2012-12-23 08:58:35
            [1] => http://www.ttgood.com/jy/t150148.htm
        )

    [1298] => Array
        (
            [0] => 2012-12-23 08:57:39
            [1] => http://www.ttgood.com/jy/t150145.htm
        )

    [1299] => Array
        (
            [0] => 2012-12-22 22:37:01
            [1] => http://www.ttgood.com/jy/t149600.htm
        )

    [1300] => Array
        (
            [0] => 2012-12-22 22:35:24
            [1] => http://www.ttgood.com/jy/t140809.htm
        )

    [1301] => Array
        (
            [0] => 2012-12-22 22:32:41
            [1] => http://www.ttgood.com/jy/t133808.htm
        )

    [1302] => Array
        (
            [0] => 2012-12-22 22:09:35
            [1] => http://www.ttgood.com/jy/t148551.htm
        )

    [1303] => Array
        (
            [0] => 2012-12-22 21:37:32
            [1] => http://www.ttgood.com/jy/t138191.htm
        )

    [1304] => Array
        (
            [0] => 2012-12-22 21:15:00
            [1] => http://www.ttgood.com/jy/t145389.htm
        )

    [1305] => Array
        (
            [0] => 2012-12-22 21:14:26
            [1] => http://www.ttgood.com/jy/t148427.htm
        )

    [1306] => Array
        (
            [0] => 2012-12-22 21:03:58
            [1] => http://www.ttgood.com/jy/t148743.htm
        )

    [1307] => Array
        (
            [0] => 2012-12-22 21:03:54
            [1] => http://www.ttgood.com/jy/t144693.htm
        )

    [1308] => Array
        (
            [0] => 2012-12-22 20:41:12
            [1] => http://www.ttgood.com/jy/t83755.htm
        )

    [1309] => Array
        (
            [0] => 2012-12-22 19:49:01
            [1] => http://www.ttgood.com/jy/t148764.htm
        )

    [1310] => Array
        (
            [0] => 2012-12-22 19:27:48
            [1] => http://www.ttgood.com/jy/t119611.htm
        )

    [1311] => Array
        (
            [0] => 2012-12-22 19:20:36
            [1] => http://www.ttgood.com/jy/t150071.htm
        )

    [1312] => Array
        (
            [0] => 2012-12-22 19:14:04
            [1] => http://www.ttgood.com/jy/t140673.htm
        )

    [1313] => Array
        (
            [0] => 2012-12-22 18:33:45
            [1] => http://www.ttgood.com/jy/t144795.htm
        )

    [1314] => Array
        (
            [0] => 2012-12-22 18:23:47
            [1] => http://www.ttgood.com/jy/t146730.htm
        )

    [1315] => Array
        (
            [0] => 2012-12-22 18:10:21
            [1] => http://www.ttgood.com/jy/t150137.htm
        )

    [1316] => Array
        (
            [0] => 2012-12-22 17:58:45
            [1] => http://www.ttgood.com/jy/t149047.htm
        )

    [1317] => Array
        (
            [0] => 2012-12-22 17:58:10
            [1] => http://www.ttgood.com/jy/t141513.htm
        )

    [1318] => Array
        (
            [0] => 2012-12-22 17:47:31
            [1] => http://www.ttgood.com/jy/t145447.htm
        )

    [1319] => Array
        (
            [0] => 2012-12-22 17:19:06
            [1] => http://www.ttgood.com/jy/t120776.htm
        )

    [1320] => Array
        (
            [0] => 2012-12-22 16:56:47
            [1] => http://www.ttgood.com/jy/t131063.htm
        )

    [1321] => Array
        (
            [0] => 2012-12-22 16:38:29
            [1] => http://www.ttgood.com/jy/t149392.htm
        )

    [1322] => Array
        (
            [0] => 2012-12-22 16:27:56
            [1] => http://www.ttgood.com/jy/t143679.htm
        )

    [1323] => Array
        (
            [0] => 2012-12-22 16:20:27
            [1] => http://www.ttgood.com/jy/t147744.htm
        )

    [1324] => Array
        (
            [0] => 2012-12-22 16:12:44
            [1] => http://www.ttgood.com/jy/t94113.htm
        )

    [1325] => Array
        (
            [0] => 2012-12-22 16:11:32
            [1] => http://www.ttgood.com/jy/t118988.htm
        )

    [1326] => Array
        (
            [0] => 2012-12-22 15:44:09
            [1] => http://www.ttgood.com/jy/t146453.htm
        )

    [1327] => Array
        (
            [0] => 2012-12-22 15:15:07
            [1] => http://www.ttgood.com/jy/t149971.htm
        )

    [1328] => Array
        (
            [0] => 2012-12-22 14:40:55
            [1] => http://www.ttgood.com/jy/t147467.htm
        )

    [1329] => Array
        (
            [0] => 2012-12-22 14:08:07
            [1] => http://www.ttgood.com/jy/t146199.htm
        )

    [1330] => Array
        (
            [0] => 2012-12-22 14:04:13
            [1] => http://www.ttgood.com/jy/t141736.htm
        )

    [1331] => Array
        (
            [0] => 2012-12-22 13:50:58
            [1] => http://www.ttgood.com/jy/t144340.htm
        )

    [1332] => Array
        (
            [0] => 2012-12-22 13:12:24
            [1] => http://www.ttgood.com/jy/t139570.htm
        )

    [1333] => Array
        (
            [0] => 2012-12-22 12:54:20
            [1] => http://www.ttgood.com/jy/t84528.htm
        )

    [1334] => Array
        (
            [0] => 2012-12-22 12:44:16
            [1] => http://www.ttgood.com/jy/t120104.htm
        )

    [1335] => Array
        (
            [0] => 2012-12-22 12:22:10
            [1] => http://www.ttgood.com/jy/t150115.htm
        )

    [1336] => Array
        (
            [0] => 2012-12-22 12:15:08
            [1] => http://www.ttgood.com/jy/t136197.htm
        )

    [1337] => Array
        (
            [0] => 2012-12-22 12:13:11
            [1] => http://www.ttgood.com/jy/t150012.htm
        )

    [1338] => Array
        (
            [0] => 2012-12-22 11:58:47
            [1] => http://www.ttgood.com/jy/t144038.htm
        )

    [1339] => Array
        (
            [0] => 2012-12-22 11:39:07
            [1] => http://www.ttgood.com/jy/t147080.htm
        )

    [1340] => Array
        (
            [0] => 2012-12-22 11:27:26
            [1] => http://www.ttgood.com/jy/t147083.htm
        )

    [1341] => Array
        (
            [0] => 2012-12-22 11:23:24
            [1] => http://www.ttgood.com/jy/t145528.htm
        )

    [1342] => Array
        (
            [0] => 2012-12-22 11:14:50
            [1] => http://www.ttgood.com/jy/t123705.htm
        )

    [1343] => Array
        (
            [0] => 2012-12-22 11:03:56
            [1] => http://www.ttgood.com/jy/t139439.htm
        )

    [1344] => Array
        (
            [0] => 2012-12-22 10:30:07
            [1] => http://www.ttgood.com/jy/t147214.htm
        )

    [1345] => Array
        (
            [0] => 2012-12-22 09:55:24
            [1] => http://www.ttgood.com/jy/t147798.htm
        )

    [1346] => Array
        (
            [0] => 2012-12-22 09:45:00
            [1] => http://www.ttgood.com/jy/t138246.htm
        )

    [1347] => Array
        (
            [0] => 2012-12-22 09:35:05
            [1] => http://www.ttgood.com/jy/t132205.htm
        )

    [1348] => Array
        (
            [0] => 2012-12-22 09:14:31
            [1] => http://www.ttgood.com/jy/t149741.htm
        )

    [1349] => Array
        (
            [0] => 2012-12-22 09:06:31
            [1] => http://www.ttgood.com/jy/t150142.htm
        )

    [1350] => Array
        (
            [0] => 2012-12-22 09:06:16
            [1] => http://www.ttgood.com/jy/t150140.htm
        )

    [1351] => Array
        (
            [0] => 2012-12-22 09:06:05
            [1] => http://www.ttgood.com/jy/t150138.htm
        )

    [1352] => Array
        (
            [0] => 2012-12-22 09:05:27
            [1] => http://www.ttgood.com/jy/t150132.htm
        )

    [1353] => Array
        (
            [0] => 2012-12-22 09:05:10
            [1] => http://www.ttgood.com/jy/t150130.htm
        )

    [1354] => Array
        (
            [0] => 2012-12-22 09:04:51
            [1] => http://www.ttgood.com/jy/t150128.htm
        )

    [1355] => Array
        (
            [0] => 2012-12-21 23:57:52
            [1] => http://www.ttgood.com/jy/t144719.htm
        )

    [1356] => Array
        (
            [0] => 2012-12-21 23:40:28
            [1] => http://www.ttgood.com/jy/t125480.htm
        )

    [1357] => Array
        (
            [0] => 2012-12-21 21:57:35
            [1] => http://www.ttgood.com/jy/t148664.htm
        )

    [1358] => Array
        (
            [0] => 2012-12-21 21:57:23
            [1] => http://www.ttgood.com/jy/t149827.htm
        )

    [1359] => Array
        (
            [0] => 2012-12-21 21:46:46
            [1] => http://www.ttgood.com/jy/t147852.htm
        )

    [1360] => Array
        (
            [0] => 2012-12-21 21:44:22
            [1] => http://www.ttgood.com/jy/t119673.htm
        )

    [1361] => Array
        (
            [0] => 2012-12-21 21:33:02
            [1] => http://www.ttgood.com/jy/t136944.htm
        )

    [1362] => Array
        (
            [0] => 2012-12-21 21:19:12
            [1] => http://www.ttgood.com/jy/t134462.htm
        )

    [1363] => Array
        (
            [0] => 2012-12-21 20:53:28
            [1] => http://www.ttgood.com/jy/t149160.htm
        )

    [1364] => Array
        (
            [0] => 2012-12-21 20:24:11
            [1] => http://www.ttgood.com/jy/t146536.htm
        )

    [1365] => Array
        (
            [0] => 2012-12-21 20:08:23
            [1] => http://www.ttgood.com/jy/t147256.htm
        )

    [1366] => Array
        (
            [0] => 2012-12-21 20:05:38
            [1] => http://www.ttgood.com/jy/t139658.htm
        )

    [1367] => Array
        (
            [0] => 2012-12-21 19:55:50
            [1] => http://www.ttgood.com/jy/t143553.htm
        )

    [1368] => Array
        (
            [0] => 2012-12-21 19:55:34
            [1] => http://www.ttgood.com/jy/t109825.htm
        )

    [1369] => Array
        (
            [0] => 2012-12-21 18:51:06
            [1] => http://www.ttgood.com/jy/t139469.htm
        )

    [1370] => Array
        (
            [0] => 2012-12-21 18:46:53
            [1] => http://www.ttgood.com/jy/t149930.htm
        )

    [1371] => Array
        (
            [0] => 2012-12-21 18:18:58
            [1] => http://www.ttgood.com/jy/t111468.htm
        )

    [1372] => Array
        (
            [0] => 2012-12-21 18:17:26
            [1] => http://www.ttgood.com/jy/t149809.htm
        )

    [1373] => Array
        (
            [0] => 2012-12-21 17:53:10
            [1] => http://www.ttgood.com/jy/t146658.htm
        )

    [1374] => Array
        (
            [0] => 2012-12-21 17:46:22
            [1] => http://www.ttgood.com/jy/t149023.htm
        )

    [1375] => Array
        (
            [0] => 2012-12-21 17:39:59
            [1] => http://www.ttgood.com/jy/t140531.htm
        )

    [1376] => Array
        (
            [0] => 2012-12-21 17:27:59
            [1] => http://www.ttgood.com/jy/t148291.htm
        )

    [1377] => Array
        (
            [0] => 2012-12-21 17:27:50
            [1] => http://www.ttgood.com/jy/t149707.htm
        )

    [1378] => Array
        (
            [0] => 2012-12-21 17:08:28
            [1] => http://www.ttgood.com/jy/t150121.htm
        )

    [1379] => Array
        (
            [0] => 2012-12-21 17:08:26
            [1] => http://www.ttgood.com/jy/t65159.htm
        )

    [1380] => Array
        (
            [0] => 2012-12-21 17:05:11
            [1] => http://www.ttgood.com/jy/t149940.htm
        )

    [1381] => Array
        (
            [0] => 2012-12-21 16:58:17
            [1] => http://www.ttgood.com/jy/t150111.htm
        )

    [1382] => Array
        (
            [0] => 2012-12-21 16:52:06
            [1] => http://www.ttgood.com/jy/t126701.htm
        )

    [1383] => Array
        (
            [0] => 2012-12-21 16:38:13
            [1] => http://www.ttgood.com/jy/t150083.htm
        )

    [1384] => Array
        (
            [0] => 2012-12-21 16:09:10
            [1] => http://www.ttgood.com/jy/t147145.htm
        )

    [1385] => Array
        (
            [0] => 2012-12-21 16:09:03
            [1] => http://www.ttgood.com/jy/t144259.htm
        )

    [1386] => Array
        (
            [0] => 2012-12-21 16:04:25
            [1] => http://www.ttgood.com/jy/t149881.htm
        )

    [1387] => Array
        (
            [0] => 2012-12-21 15:50:14
            [1] => http://www.ttgood.com/jy/t146958.htm
        )

    [1388] => Array
        (
            [0] => 2012-12-21 15:23:19
            [1] => http://www.ttgood.com/jy/t148575.htm
        )

    [1389] => Array
        (
            [0] => 2012-12-21 15:13:13
            [1] => http://www.ttgood.com/jy/t132584.htm
        )

    [1390] => Array
        (
            [0] => 2012-12-21 14:59:21
            [1] => http://www.ttgood.com/jy/t148949.htm
        )

    [1391] => Array
        (
            [0] => 2012-12-21 14:50:00
            [1] => http://www.ttgood.com/jy/t144513.htm
        )

    [1392] => Array
        (
            [0] => 2012-12-21 14:47:55
            [1] => http://www.ttgood.com/jy/t87851.htm
        )

    [1393] => Array
        (
            [0] => 2012-12-21 14:45:04
            [1] => http://www.ttgood.com/jy/t149816.htm
        )

    [1394] => Array
        (
            [0] => 2012-12-21 14:35:12
            [1] => http://www.ttgood.com/jy/t147853.htm
        )

    [1395] => Array
        (
            [0] => 2012-12-21 14:25:40
            [1] => http://www.ttgood.com/jy/t138660.htm
        )

    [1396] => Array
        (
            [0] => 2012-12-21 14:02:55
            [1] => http://www.ttgood.com/jy/t23385.htm
        )

    [1397] => Array
        (
            [0] => 2012-12-21 14:02:44
            [1] => http://www.ttgood.com/jy/t136376.htm
        )

    [1398] => Array
        (
            [0] => 2012-12-21 13:56:58
            [1] => http://www.ttgood.com/jy/t94595.htm
        )

    [1399] => Array
        (
            [0] => 2012-12-21 13:55:22
            [1] => http://www.ttgood.com/jy/t141787.htm
        )

    [1400] => Array
        (
            [0] => 2012-12-21 13:50:12
            [1] => http://www.ttgood.com/jy/t148166.htm
        )

    [1401] => Array
        (
            [0] => 2012-12-21 12:34:00
            [1] => http://www.ttgood.com/jy/t88619.htm
        )

    [1402] => Array
        (
            [0] => 2012-12-21 12:28:02
            [1] => http://www.ttgood.com/jy/t133896.htm
        )

    [1403] => Array
        (
            [0] => 2012-12-21 11:57:13
            [1] => http://www.ttgood.com/jy/t148383.htm
        )

    [1404] => Array
        (
            [0] => 2012-12-21 11:53:12
            [1] => http://www.ttgood.com/jy/t150075.htm
        )

    [1405] => Array
        (
            [0] => 2012-12-21 10:51:24
            [1] => http://www.ttgood.com/jy/t29777.htm
        )

    [1406] => Array
        (
            [0] => 2012-12-21 10:51:08
            [1] => http://www.ttgood.com/jy/t88891.htm
        )

    [1407] => Array
        (
            [0] => 2012-12-21 10:50:41
            [1] => http://www.ttgood.com/jy/t32490.htm
        )

    [1408] => Array
        (
            [0] => 2012-12-21 10:46:04
            [1] => http://www.ttgood.com/jy/t136038.htm
        )

    [1409] => Array
        (
            [0] => 2012-12-21 10:25:33
            [1] => http://www.ttgood.com/jy/t150079.htm
        )

    [1410] => Array
        (
            [0] => 2012-12-21 10:24:58
            [1] => http://www.ttgood.com/jy/t129392.htm
        )

    [1411] => Array
        (
            [0] => 2012-12-21 10:24:38
            [1] => http://www.ttgood.com/jy/t150050.htm
        )

    [1412] => Array
        (
            [0] => 2012-12-21 10:22:20
            [1] => http://www.ttgood.com/jy/t145634.htm
        )

    [1413] => Array
        (
            [0] => 2012-12-21 10:19:29
            [1] => http://www.ttgood.com/jy/t126743.htm
        )

    [1414] => Array
        (
            [0] => 2012-12-21 10:11:35
            [1] => http://www.ttgood.com/jy/t88520.htm
        )

    [1415] => Array
        (
            [0] => 2012-12-21 10:10:16
            [1] => http://www.ttgood.com/jy/t128772.htm
        )

    [1416] => Array
        (
            [0] => 2012-12-21 09:40:54
            [1] => http://www.ttgood.com/jy/t56068.htm
        )

    [1417] => Array
        (
            [0] => 2012-12-21 09:29:32
            [1] => http://www.ttgood.com/jy/t150123.htm
        )

    [1418] => Array
        (
            [0] => 2012-12-21 09:29:01
            [1] => http://www.ttgood.com/jy/t116212.htm
        )

    [1419] => Array
        (
            [0] => 2012-12-21 09:28:34
            [1] => http://www.ttgood.com/jy/t150117.htm
        )

    [1420] => Array
        (
            [0] => 2012-12-21 09:28:19
            [1] => http://www.ttgood.com/jy/t150116.htm
        )

    [1421] => Array
        (
            [0] => 2012-12-21 09:27:47
            [1] => http://www.ttgood.com/jy/t150112.htm
        )

    [1422] => Array
        (
            [0] => 2012-12-21 09:26:02
            [1] => http://www.ttgood.com/jy/t150109.htm
        )

    [1423] => Array
        (
            [0] => 2012-12-21 09:25:50
            [1] => http://www.ttgood.com/jy/t150108.htm
        )

    [1424] => Array
        (
            [0] => 2012-12-21 09:25:22
            [1] => http://www.ttgood.com/jy/t150105.htm
        )

    [1425] => Array
        (
            [0] => 2012-12-21 09:25:07
            [1] => http://www.ttgood.com/jy/t150104.htm
        )

    [1426] => Array
        (
            [0] => 2012-12-21 09:24:53
            [1] => http://www.ttgood.com/jy/t150103.htm
        )

    [1427] => Array
        (
            [0] => 2012-12-21 09:17:52
            [1] => http://www.ttgood.com/jy/t150035.htm
        )

    [1428] => Array
        (
            [0] => 2012-12-21 09:01:07
            [1] => http://www.ttgood.com/jy/t85221.htm
        )

    [1429] => Array
        (
            [0] => 2012-12-21 02:55:25
            [1] => http://www.ttgood.com/jy/t149748.htm
        )

    [1430] => Array
        (
            [0] => 2012-12-20 23:21:02
            [1] => http://www.ttgood.com/jy/t149478.htm
        )

    [1431] => Array
        (
            [0] => 2012-12-20 23:20:06
            [1] => http://www.ttgood.com/jy/t148207.htm
        )

    [1432] => Array
        (
            [0] => 2012-12-20 22:59:53
            [1] => http://www.ttgood.com/jy/t149383.htm
        )

    [1433] => Array
        (
            [0] => 2012-12-20 22:42:52
            [1] => http://www.ttgood.com/jy/t144988.htm
        )

    [1434] => Array
        (
            [0] => 2012-12-20 22:23:40
            [1] => http://www.ttgood.com/jy/t148067.htm
        )

    [1435] => Array
        (
            [0] => 2012-12-20 22:22:28
            [1] => http://www.ttgood.com/jy/t132595.htm
        )

    [1436] => Array
        (
            [0] => 2012-12-20 22:19:20
            [1] => http://www.ttgood.com/jy/t122669.htm
        )

    [1437] => Array
        (
            [0] => 2012-12-20 20:37:20
            [1] => http://www.ttgood.com/jy/t148256.htm
        )

    [1438] => Array
        (
            [0] => 2012-12-20 20:18:48
            [1] => http://www.ttgood.com/jy/t146043.htm
        )

    [1439] => Array
        (
            [0] => 2012-12-20 19:40:00
            [1] => http://www.ttgood.com/jy/t147114.htm
        )

    [1440] => Array
        (
            [0] => 2012-12-20 19:39:27
            [1] => http://www.ttgood.com/jy/t149973.htm
        )

    [1441] => Array
        (
            [0] => 2012-12-20 19:20:29
            [1] => http://www.ttgood.com/jy/t126717.htm
        )

    [1442] => Array
        (
            [0] => 2012-12-20 19:07:48
            [1] => http://www.ttgood.com/jy/t141701.htm
        )

    [1443] => Array
        (
            [0] => 2012-12-20 18:37:54
            [1] => http://www.ttgood.com/jy/t142659.htm
        )

    [1444] => Array
        (
            [0] => 2012-12-20 18:27:21
            [1] => http://www.ttgood.com/jy/t148740.htm
        )

    [1445] => Array
        (
            [0] => 2012-12-20 18:20:26
            [1] => http://www.ttgood.com/jy/t140607.htm
        )

    [1446] => Array
        (
            [0] => 2012-12-20 18:12:58
            [1] => http://www.ttgood.com/jy/t148599.htm
        )

    [1447] => Array
        (
            [0] => 2012-12-20 18:10:27
            [1] => http://www.ttgood.com/jy/t60617.htm
        )

    [1448] => Array
        (
            [0] => 2012-12-20 17:47:46
            [1] => http://www.ttgood.com/jy/t148761.htm
        )

    [1449] => Array
        (
            [0] => 2012-12-20 17:32:53
            [1] => http://www.ttgood.com/jy/t143579.htm
        )

    [1450] => Array
        (
            [0] => 2012-12-20 17:28:25
            [1] => http://www.ttgood.com/jy/t142613.htm
        )

    [1451] => Array
        (
            [0] => 2012-12-20 17:26:36
            [1] => http://www.ttgood.com/jy/t149350.htm
        )

    [1452] => Array
        (
            [0] => 2012-12-20 17:18:50
            [1] => http://www.ttgood.com/jy/t149389.htm
        )

    [1453] => Array
        (
            [0] => 2012-12-20 16:36:21
            [1] => http://www.ttgood.com/jy/t147773.htm
        )

    [1454] => Array
        (
            [0] => 2012-12-20 16:30:26
            [1] => http://www.ttgood.com/jy/t104455.htm
        )

    [1455] => Array
        (
            [0] => 2012-12-20 16:03:12
            [1] => http://www.ttgood.com/jy/t145326.htm
        )

    [1456] => Array
        (
            [0] => 2012-12-20 16:01:25
            [1] => http://www.ttgood.com/jy/t106736.htm
        )

    [1457] => Array
        (
            [0] => 2012-12-20 15:59:32
            [1] => http://www.ttgood.com/jy/t147716.htm
        )

    [1458] => Array
        (
            [0] => 2012-12-20 15:51:51
            [1] => http://www.ttgood.com/jy/t150093.htm
        )

    [1459] => Array
        (
            [0] => 2012-12-20 15:48:32
            [1] => http://www.ttgood.com/jy/t149303.htm
        )

    [1460] => Array
        (
            [0] => 2012-12-20 15:45:33
            [1] => http://www.ttgood.com/jy/t135397.htm
        )

    [1461] => Array
        (
            [0] => 2012-12-20 15:34:25
            [1] => http://www.ttgood.com/jy/t100712.htm
        )

    [1462] => Array
        (
            [0] => 2012-12-20 15:23:33
            [1] => http://www.ttgood.com/jy/t145163.htm
        )

    [1463] => Array
        (
            [0] => 2012-12-20 15:09:28
            [1] => http://www.ttgood.com/jy/t149917.htm
        )

    [1464] => Array
        (
            [0] => 2012-12-20 14:51:26
            [1] => http://www.ttgood.com/jy/t119828.htm
        )

    [1465] => Array
        (
            [0] => 2012-12-20 14:49:41
            [1] => http://www.ttgood.com/jy/t144975.htm
        )

    [1466] => Array
        (
            [0] => 2012-12-20 14:42:14
            [1] => http://www.ttgood.com/jy/t138357.htm
        )

    [1467] => Array
        (
            [0] => 2012-12-20 14:11:35
            [1] => http://www.ttgood.com/jy/t141962.htm
        )

    [1468] => Array
        (
            [0] => 2012-12-20 13:28:00
            [1] => http://www.ttgood.com/jy/t95570.htm
        )

    [1469] => Array
        (
            [0] => 2012-12-20 13:25:59
            [1] => http://www.ttgood.com/jy/t149462.htm
        )

    [1470] => Array
        (
            [0] => 2012-12-20 12:26:20
            [1] => http://www.ttgood.com/jy/t147781.htm
        )

    [1471] => Array
        (
            [0] => 2012-12-20 12:26:10
            [1] => http://www.ttgood.com/jy/t150091.htm
        )

    [1472] => Array
        (
            [0] => 2012-12-20 11:49:56
            [1] => http://www.ttgood.com/jy/t147694.htm
        )

    [1473] => Array
        (
            [0] => 2012-12-20 10:56:37
            [1] => http://www.ttgood.com/jy/t148645.htm
        )

    [1474] => Array
        (
            [0] => 2012-12-20 10:31:24
            [1] => http://www.ttgood.com/jy/t126625.htm
        )

    [1475] => Array
        (
            [0] => 2012-12-20 10:20:49
            [1] => http://www.ttgood.com/jy/t149952.htm
        )

    [1476] => Array
        (
            [0] => 2012-12-20 10:06:06
            [1] => http://www.ttgood.com/jy/t146490.htm
        )

    [1477] => Array
        (
            [0] => 2012-12-20 09:59:13
            [1] => http://www.ttgood.com/jy/t125324.htm
        )

    [1478] => Array
        (
            [0] => 2012-12-20 09:21:56
            [1] => http://www.ttgood.com/jy/t150021.htm
        )

    [1479] => Array
        (
            [0] => 2012-12-20 09:09:46
            [1] => http://www.ttgood.com/jy/t150096.htm
        )

    [1480] => Array
        (
            [0] => 2012-12-20 09:07:29
            [1] => http://www.ttgood.com/jy/t150090.htm
        )

    [1481] => Array
        (
            [0] => 2012-12-20 09:07:22
            [1] => http://www.ttgood.com/jy/t150089.htm
        )

    [1482] => Array
        (
            [0] => 2012-12-20 09:06:59
            [1] => http://www.ttgood.com/jy/t150088.htm
        )

    [1483] => Array
        (
            [0] => 2012-12-20 09:04:02
            [1] => http://www.ttgood.com/jy/t150099.htm
        )

    [1484] => Array
        (
            [0] => 2012-12-20 08:04:34
            [1] => http://www.ttgood.com/jy/t140624.htm
        )

    [1485] => Array
        (
            [0] => 2012-12-20 00:48:47
            [1] => http://www.ttgood.com/jy/t143176.htm
        )

    [1486] => Array
        (
            [0] => 2012-12-19 23:16:54
            [1] => http://www.ttgood.com/jy/t148086.htm
        )

    [1487] => Array
        (
            [0] => 2012-12-19 22:58:35
            [1] => http://www.ttgood.com/jy/t142875.htm
        )

    [1488] => Array
        (
            [0] => 2012-12-19 22:49:19
            [1] => http://www.ttgood.com/jy/t140361.htm
        )

    [1489] => Array
        (
            [0] => 2012-12-19 22:15:42
            [1] => http://www.ttgood.com/jy/t148021.htm
        )

    [1490] => Array
        (
            [0] => 2012-12-19 22:05:01
            [1] => http://www.ttgood.com/jy/t122560.htm
        )

    [1491] => Array
        (
            [0] => 2012-12-19 22:01:56
            [1] => http://www.ttgood.com/jy/t104002.htm
        )

    [1492] => Array
        (
            [0] => 2012-12-19 22:01:48
            [1] => http://www.ttgood.com/jy/t142593.htm
        )

    [1493] => Array
        (
            [0] => 2012-12-19 21:43:46
            [1] => http://www.ttgood.com/jy/t141545.htm
        )

    [1494] => Array
        (
            [0] => 2012-12-19 21:25:27
            [1] => http://www.ttgood.com/jy/t141133.htm
        )

    [1495] => Array
        (
            [0] => 2012-12-19 20:39:21
            [1] => http://www.ttgood.com/jy/t149511.htm
        )

    [1496] => Array
        (
            [0] => 2012-12-19 20:14:57
            [1] => http://www.ttgood.com/jy/t127361.htm
        )

    [1497] => Array
        (
            [0] => 2012-12-19 20:10:28
            [1] => http://www.ttgood.com/jy/t149808.htm
        )

    [1498] => Array
        (
            [0] => 2012-12-19 19:35:18
            [1] => http://www.ttgood.com/jy/t149617.htm
        )

    [1499] => Array
        (
            [0] => 2012-12-19 19:02:46
            [1] => http://www.ttgood.com/jy/t148260.htm
        )

    [1500] => Array
        (
            [0] => 2012-12-19 18:30:27
            [1] => http://www.ttgood.com/jy/t145541.htm
        )

    [1501] => Array
        (
            [0] => 2012-12-19 18:29:04
            [1] => http://www.ttgood.com/jy/t149898.htm
        )

    [1502] => Array
        (
            [0] => 2012-12-19 18:14:54
            [1] => http://www.ttgood.com/jy/t148852.htm
        )

    [1503] => Array
        (
            [0] => 2012-12-19 17:49:28
            [1] => http://www.ttgood.com/jy/t91926.htm
        )

    [1504] => Array
        (
            [0] => 2012-12-19 17:02:26
            [1] => http://www.ttgood.com/jy/t150051.htm
        )

    [1505] => Array
        (
            [0] => 2012-12-19 16:57:27
            [1] => http://www.ttgood.com/jy/t130481.htm
        )

    [1506] => Array
        (
            [0] => 2012-12-19 16:15:47
            [1] => http://www.ttgood.com/jy/t146828.htm
        )

    [1507] => Array
        (
            [0] => 2012-12-19 16:10:55
            [1] => http://www.ttgood.com/jy/t143345.htm
        )

    [1508] => Array
        (
            [0] => 2012-12-19 16:10:12
            [1] => http://www.ttgood.com/jy/t137381.htm
        )

    [1509] => Array
        (
            [0] => 2012-12-19 15:42:12
            [1] => http://www.ttgood.com/jy/t142719.htm
        )

    [1510] => Array
        (
            [0] => 2012-12-19 15:37:45
            [1] => http://www.ttgood.com/jy/t104232.htm
        )

    [1511] => Array
        (
            [0] => 2012-12-19 15:20:31
            [1] => http://www.ttgood.com/jy/t148289.htm
        )

    [1512] => Array
        (
            [0] => 2012-12-19 15:20:00
            [1] => http://www.ttgood.com/jy/t92197.htm
        )

    [1513] => Array
        (
            [0] => 2012-12-19 15:12:27
            [1] => http://www.ttgood.com/jy/t149297.htm
        )

    [1514] => Array
        (
            [0] => 2012-12-19 15:08:58
            [1] => http://www.ttgood.com/jy/t140910.htm
        )

    [1515] => Array
        (
            [0] => 2012-12-19 14:49:00
            [1] => http://www.ttgood.com/jy/t145451.htm
        )

    [1516] => Array
        (
            [0] => 2012-12-19 14:29:44
            [1] => http://www.ttgood.com/jy/t65524.htm
        )

    [1517] => Array
        (
            [0] => 2012-12-19 14:26:08
            [1] => http://www.ttgood.com/jy/t143764.htm
        )

    [1518] => Array
        (
            [0] => 2012-12-19 14:19:50
            [1] => http://www.ttgood.com/jy/t146861.htm
        )

    [1519] => Array
        (
            [0] => 2012-12-19 14:19:26
            [1] => http://www.ttgood.com/jy/t149967.htm
        )

    [1520] => Array
        (
            [0] => 2012-12-19 13:51:23
            [1] => http://www.ttgood.com/jy/t135521.htm
        )

    [1521] => Array
        (
            [0] => 2012-12-19 13:48:58
            [1] => http://www.ttgood.com/jy/t147087.htm
        )

    [1522] => Array
        (
            [0] => 2012-12-19 13:41:56
            [1] => http://www.ttgood.com/jy/t148765.htm
        )

    [1523] => Array
        (
            [0] => 2012-12-19 13:04:06
            [1] => http://www.ttgood.com/jy/t146676.htm
        )

    [1524] => Array
        (
            [0] => 2012-12-19 12:23:18
            [1] => http://www.ttgood.com/jy/t147902.htm
        )

    [1525] => Array
        (
            [0] => 2012-12-19 12:03:43
            [1] => http://www.ttgood.com/jy/t149904.htm
        )

    [1526] => Array
        (
            [0] => 2012-12-19 11:54:23
            [1] => http://www.ttgood.com/jy/t149279.htm
        )

    [1527] => Array
        (
            [0] => 2012-12-19 11:50:22
            [1] => http://www.ttgood.com/jy/t150080.htm
        )

    [1528] => Array
        (
            [0] => 2012-12-19 11:25:47
            [1] => http://www.ttgood.com/jy/t137119.htm
        )

    [1529] => Array
        (
            [0] => 2012-12-19 11:21:10
            [1] => http://www.ttgood.com/jy/t146253.htm
        )

    [1530] => Array
        (
            [0] => 2012-12-19 11:13:56
            [1] => http://www.ttgood.com/jy/t38081.htm
        )

    [1531] => Array
        (
            [0] => 2012-12-19 11:10:28
            [1] => http://www.ttgood.com/jy/t147336.htm
        )

    [1532] => Array
        (
            [0] => 2012-12-19 10:55:01
            [1] => http://www.ttgood.com/jy/t93216.htm
        )

    [1533] => Array
        (
            [0] => 2012-12-19 10:54:09
            [1] => http://www.ttgood.com/jy/t81728.htm
        )

    [1534] => Array
        (
            [0] => 2012-12-19 10:23:29
            [1] => http://www.ttgood.com/jy/t149850.htm
        )

    [1535] => Array
        (
            [0] => 2012-12-19 09:58:10
            [1] => http://www.ttgood.com/jy/t149942.htm
        )

    [1536] => Array
        (
            [0] => 2012-12-19 09:11:47
            [1] => http://www.ttgood.com/jy/t150086.htm
        )

    [1537] => Array
        (
            [0] => 2012-12-19 09:11:32
            [1] => http://www.ttgood.com/jy/t150085.htm
        )

    [1538] => Array
        (
            [0] => 2012-12-19 09:09:56
            [1] => http://www.ttgood.com/jy/t150078.htm
        )

    [1539] => Array
        (
            [0] => 2012-12-19 09:09:44
            [1] => http://www.ttgood.com/jy/t150077.htm
        )

    [1540] => Array
        (
            [0] => 2012-12-19 09:09:30
            [1] => http://www.ttgood.com/jy/t150076.htm
        )

    [1541] => Array
        (
            [0] => 2012-12-19 09:08:50
            [1] => http://www.ttgood.com/jy/t150073.htm
        )

    [1542] => Array
        (
            [0] => 2012-12-19 09:08:05
            [1] => http://www.ttgood.com/jy/t150067.htm
        )

    [1543] => Array
        (
            [0] => 2012-12-19 09:07:53
            [1] => http://www.ttgood.com/jy/t150065.htm
        )

    [1544] => Array
        (
            [0] => 2012-12-19 02:42:43
            [1] => http://www.ttgood.com/jy/t136012.htm
        )

    [1545] => Array
        (
            [0] => 2012-12-18 23:12:21
            [1] => http://www.ttgood.com/jy/t139754.htm
        )

    [1546] => Array
        (
            [0] => 2012-12-18 22:36:52
            [1] => http://www.ttgood.com/jy/t104502.htm
        )

    [1547] => Array
        (
            [0] => 2012-12-18 21:57:51
            [1] => http://www.ttgood.com/jy/t149309.htm
        )

    [1548] => Array
        (
            [0] => 2012-12-18 21:54:20
            [1] => http://www.ttgood.com/jy/t139141.htm
        )

    [1549] => Array
        (
            [0] => 2012-12-18 21:41:59
            [1] => http://www.ttgood.com/jy/t148560.htm
        )

    [1550] => Array
        (
            [0] => 2012-12-18 20:52:22
            [1] => http://www.ttgood.com/jy/t150057.htm
        )

    [1551] => Array
        (
            [0] => 2012-12-18 20:43:39
            [1] => http://www.ttgood.com/jy/t95044.htm
        )

    [1552] => Array
        (
            [0] => 2012-12-18 20:40:21
            [1] => http://www.ttgood.com/jy/t146442.htm
        )

    [1553] => Array
        (
            [0] => 2012-12-18 20:35:30
            [1] => http://www.ttgood.com/jy/t149885.htm
        )

    [1554] => Array
        (
            [0] => 2012-12-18 20:11:03
            [1] => http://www.ttgood.com/jy/t146756.htm
        )

    [1555] => Array
        (
            [0] => 2012-12-18 20:00:41
            [1] => http://www.ttgood.com/jy/t100348.htm
        )

    [1556] => Array
        (
            [0] => 2012-12-18 19:57:32
            [1] => http://www.ttgood.com/jy/t149798.htm
        )

    [1557] => Array
        (
            [0] => 2012-12-18 19:47:06
            [1] => http://www.ttgood.com/jy/t135994.htm
        )

    [1558] => Array
        (
            [0] => 2012-12-18 18:49:30
            [1] => http://www.ttgood.com/jy/t146023.htm
        )

    [1559] => Array
        (
            [0] => 2012-12-18 18:45:35
            [1] => http://www.ttgood.com/jy/t149537.htm
        )

    [1560] => Array
        (
            [0] => 2012-12-18 18:29:52
            [1] => http://www.ttgood.com/jy/t144413.htm
        )

    [1561] => Array
        (
            [0] => 2012-12-18 17:53:18
            [1] => http://www.ttgood.com/jy/t150017.htm
        )

    [1562] => Array
        (
            [0] => 2012-12-18 17:30:29
            [1] => http://www.ttgood.com/jy/t147181.htm
        )

    [1563] => Array
        (
            [0] => 2012-12-18 16:03:19
            [1] => http://www.ttgood.com/jy/t146619.htm
        )

    [1564] => Array
        (
            [0] => 2012-12-18 15:57:41
            [1] => http://www.ttgood.com/jy/t148811.htm
        )

    [1565] => Array
        (
            [0] => 2012-12-18 15:22:06
            [1] => http://www.ttgood.com/jy/t140373.htm
        )

    [1566] => Array
        (
            [0] => 2012-12-18 15:05:20
            [1] => http://www.ttgood.com/jy/t148950.htm
        )

    [1567] => Array
        (
            [0] => 2012-12-18 14:44:55
            [1] => http://www.ttgood.com/jy/t107907.htm
        )

    [1568] => Array
        (
            [0] => 2012-12-18 14:41:23
            [1] => http://www.ttgood.com/jy/t149705.htm
        )

    [1569] => Array
        (
            [0] => 2012-12-18 14:39:33
            [1] => http://www.ttgood.com/jy/t149634.htm
        )

    [1570] => Array
        (
            [0] => 2012-12-18 14:31:15
            [1] => http://www.ttgood.com/jy/t148915.htm
        )

    [1571] => Array
        (
            [0] => 2012-12-18 14:29:55
            [1] => http://www.ttgood.com/jy/t149639.htm
        )

    [1572] => Array
        (
            [0] => 2012-12-18 13:53:03
            [1] => http://www.ttgood.com/jy/t135090.htm
        )

    [1573] => Array
        (
            [0] => 2012-12-18 13:43:44
            [1] => http://www.ttgood.com/jy/t150059.htm
        )

    [1574] => Array
        (
            [0] => 2012-12-18 13:09:55
            [1] => http://www.ttgood.com/jy/t149598.htm
        )

    [1575] => Array
        (
            [0] => 2012-12-18 12:46:57
            [1] => http://www.ttgood.com/jy/t144826.htm
        )

    [1576] => Array
        (
            [0] => 2012-12-18 12:37:26
            [1] => http://www.ttgood.com/jy/t149858.htm
        )

    [1577] => Array
        (
            [0] => 2012-12-18 12:29:51
            [1] => http://www.ttgood.com/jy/t141605.htm
        )

    [1578] => Array
        (
            [0] => 2012-12-18 11:37:53
            [1] => http://www.ttgood.com/jy/t137578.htm
        )

    [1579] => Array
        (
            [0] => 2012-12-18 11:31:56
            [1] => http://www.ttgood.com/jy/t145996.htm
        )

    [1580] => Array
        (
            [0] => 2012-12-18 11:30:04
            [1] => http://www.ttgood.com/jy/t147843.htm
        )

    [1581] => Array
        (
            [0] => 2012-12-18 11:17:13
            [1] => http://www.ttgood.com/jy/t141154.htm
        )

    [1582] => Array
        (
            [0] => 2012-12-18 11:17:05
            [1] => http://www.ttgood.com/jy/t116096.htm
        )

    [1583] => Array
        (
            [0] => 2012-12-18 10:45:11
            [1] => http://www.ttgood.com/jy/t146423.htm
        )

    [1584] => Array
        (
            [0] => 2012-12-18 09:13:21
            [1] => http://www.ttgood.com/jy/t150053.htm
        )

    [1585] => Array
        (
            [0] => 2012-12-18 09:12:48
            [1] => http://www.ttgood.com/jy/t150060.htm
        )

    [1586] => Array
        (
            [0] => 2012-12-18 09:12:13
            [1] => http://www.ttgood.com/jy/t150052.htm
        )

    [1587] => Array
        (
            [0] => 2012-12-18 09:11:35
            [1] => http://www.ttgood.com/jy/t150049.htm
        )

    [1588] => Array
        (
            [0] => 2012-12-18 09:10:40
            [1] => http://www.ttgood.com/jy/t150045.htm
        )

    [1589] => Array
        (
            [0] => 2012-12-18 08:11:04
            [1] => http://www.ttgood.com/jy/t131107.htm
        )

    [1590] => Array
        (
            [0] => 2012-12-18 03:09:36
            [1] => http://www.ttgood.com/jy/t141653.htm
        )

    [1591] => Array
        (
            [0] => 2012-12-17 23:23:52
            [1] => http://www.ttgood.com/jy/t135997.htm
        )

    [1592] => Array
        (
            [0] => 2012-12-17 23:10:23
            [1] => http://www.ttgood.com/jy/t147681.htm
        )

    [1593] => Array
        (
            [0] => 2012-12-17 22:37:25
            [1] => http://www.ttgood.com/jy/t149891.htm
        )

    [1594] => Array
        (
            [0] => 2012-12-17 22:30:48
            [1] => http://www.ttgood.com/jy/t147789.htm
        )

    [1595] => Array
        (
            [0] => 2012-12-17 22:17:02
            [1] => http://www.ttgood.com/jy/t46711.htm
        )

    [1596] => Array
        (
            [0] => 2012-12-17 22:10:11
            [1] => http://www.ttgood.com/jy/t107275.htm
        )

    [1597] => Array
        (
            [0] => 2012-12-17 22:09:08
            [1] => http://www.ttgood.com/jy/t149282.htm
        )

    [1598] => Array
        (
            [0] => 2012-12-17 22:02:34
            [1] => http://www.ttgood.com/jy/t145343.htm
        )

    [1599] => Array
        (
            [0] => 2012-12-17 22:00:19
            [1] => http://www.ttgood.com/jy/t146577.htm
        )

    [1600] => Array
        (
            [0] => 2012-12-17 21:36:54
            [1] => http://www.ttgood.com/jy/t145945.htm
        )

    [1601] => Array
        (
            [0] => 2012-12-17 20:58:51
            [1] => http://www.ttgood.com/jy/t149151.htm
        )

    [1602] => Array
        (
            [0] => 2012-12-17 20:53:10
            [1] => http://www.ttgood.com/jy/t144163.htm
        )

    [1603] => Array
        (
            [0] => 2012-12-17 20:06:22
            [1] => http://www.ttgood.com/jy/t149025.htm
        )

    [1604] => Array
        (
            [0] => 2012-12-17 19:31:11
            [1] => http://www.ttgood.com/jy/t142059.htm
        )

    [1605] => Array
        (
            [0] => 2012-12-17 19:14:50
            [1] => http://www.ttgood.com/jy/t141478.htm
        )

    [1606] => Array
        (
            [0] => 2012-12-17 19:11:15
            [1] => http://www.ttgood.com/jy/t120465.htm
        )

    [1607] => Array
        (
            [0] => 2012-12-17 19:09:08
            [1] => http://www.ttgood.com/jy/t150003.htm
        )

    [1608] => Array
        (
            [0] => 2012-12-17 18:18:46
            [1] => http://www.ttgood.com/jy/t103174.htm
        )

    [1609] => Array
        (
            [0] => 2012-12-17 17:39:22
            [1] => http://www.ttgood.com/jy/t149643.htm
        )

    [1610] => Array
        (
            [0] => 2012-12-17 17:08:55
            [1] => http://www.ttgood.com/jy/t141316.htm
        )

    [1611] => Array
        (
            [0] => 2012-12-17 16:42:30
            [1] => http://www.ttgood.com/jy/t118216.htm
        )

    [1612] => Array
        (
            [0] => 2012-12-17 16:28:46
            [1] => http://www.ttgood.com/jy/t126988.htm
        )

    [1613] => Array
        (
            [0] => 2012-12-17 16:13:52
            [1] => http://www.ttgood.com/jy/t147419.htm
        )

    [1614] => Array
        (
            [0] => 2012-12-17 16:09:19
            [1] => http://www.ttgood.com/jy/t150036.htm
        )

    [1615] => Array
        (
            [0] => 2012-12-17 16:04:10
            [1] => http://www.ttgood.com/jy/t136717.htm
        )

    [1616] => Array
        (
            [0] => 2012-12-17 15:39:23
            [1] => http://www.ttgood.com/jy/t149342.htm
        )

    [1617] => Array
        (
            [0] => 2012-12-17 15:33:28
            [1] => http://www.ttgood.com/jy/t134867.htm
        )

    [1618] => Array
        (
            [0] => 2012-12-17 15:14:59
            [1] => http://www.ttgood.com/jy/t148998.htm
        )

    [1619] => Array
        (
            [0] => 2012-12-17 14:57:38
            [1] => http://www.ttgood.com/jy/t135416.htm
        )

    [1620] => Array
        (
            [0] => 2012-12-17 14:56:14
            [1] => http://www.ttgood.com/jy/t146163.htm
        )

    [1621] => Array
        (
            [0] => 2012-12-17 14:53:18
            [1] => http://www.ttgood.com/jy/t148508.htm
        )

    [1622] => Array
        (
            [0] => 2012-12-17 14:41:47
            [1] => http://www.ttgood.com/jy/t149887.htm
        )

    [1623] => Array
        (
            [0] => 2012-12-17 13:53:13
            [1] => http://www.ttgood.com/jy/t150025.htm
        )

    [1624] => Array
        (
            [0] => 2012-12-17 13:46:16
            [1] => http://www.ttgood.com/jy/t145991.htm
        )

    [1625] => Array
        (
            [0] => 2012-12-17 13:35:47
            [1] => http://www.ttgood.com/jy/t150001.htm
        )

    [1626] => Array
        (
            [0] => 2012-12-17 13:22:50
            [1] => http://www.ttgood.com/jy/t149953.htm
        )

    [1627] => Array
        (
            [0] => 2012-12-17 12:56:27
            [1] => http://www.ttgood.com/jy/t149954.htm
        )

    [1628] => Array
        (
            [0] => 2012-12-17 12:21:32
            [1] => http://www.ttgood.com/jy/t150027.htm
        )

    [1629] => Array
        (
            [0] => 2012-12-17 12:18:19
            [1] => http://www.ttgood.com/jy/t145602.htm
        )

    [1630] => Array
        (
            [0] => 2012-12-17 12:16:35
            [1] => http://www.ttgood.com/jy/t141566.htm
        )

    [1631] => Array
        (
            [0] => 2012-12-17 12:10:54
            [1] => http://www.ttgood.com/jy/t147724.htm
        )

    [1632] => Array
        (
            [0] => 2012-12-17 12:10:19
            [1] => http://www.ttgood.com/jy/t141272.htm
        )

    [1633] => Array
        (
            [0] => 2012-12-17 11:05:19
            [1] => http://www.ttgood.com/jy/t120950.htm
        )

    [1634] => Array
        (
            [0] => 2012-12-17 10:58:33
            [1] => http://www.ttgood.com/jy/t148267.htm
        )

    [1635] => Array
        (
            [0] => 2012-12-17 10:18:18
            [1] => http://www.ttgood.com/jy/t149296.htm
        )

    [1636] => Array
        (
            [0] => 2012-12-17 10:13:17
            [1] => http://www.ttgood.com/jy/t140955.htm
        )

    [1637] => Array
        (
            [0] => 2012-12-17 09:27:56
            [1] => http://www.ttgood.com/jy/t140555.htm
        )

    [1638] => Array
        (
            [0] => 2012-12-17 09:15:05
            [1] => http://www.ttgood.com/jy/t149999.htm
        )

    [1639] => Array
        (
            [0] => 2012-12-17 09:13:56
            [1] => http://www.ttgood.com/jy/t149994.htm
        )

    [1640] => Array
        (
            [0] => 2012-12-17 09:12:29
            [1] => http://www.ttgood.com/jy/t149961.htm
        )

    [1641] => Array
        (
            [0] => 2012-12-17 09:08:31
            [1] => http://www.ttgood.com/jy/t148973.htm
        )

    [1642] => Array
        (
            [0] => 2012-12-17 09:07:38
            [1] => http://www.ttgood.com/jy/t150032.htm
        )

    [1643] => Array
        (
            [0] => 2012-12-17 00:06:03
            [1] => http://www.ttgood.com/jy/t101583.htm
        )

    [1644] => Array
        (
            [0] => 2012-12-16 23:24:52
            [1] => http://www.ttgood.com/jy/t148878.htm
        )

    [1645] => Array
        (
            [0] => 2012-12-16 23:16:29
            [1] => http://www.ttgood.com/jy/t144815.htm
        )

    [1646] => Array
        (
            [0] => 2012-12-16 22:19:43
            [1] => http://www.ttgood.com/jy/t150024.htm
        )

    [1647] => Array
        (
            [0] => 2012-12-16 21:22:31
            [1] => http://www.ttgood.com/jy/t145471.htm
        )

    [1648] => Array
        (
            [0] => 2012-12-16 20:33:30
            [1] => http://www.ttgood.com/jy/t149576.htm
        )

    [1649] => Array
        (
            [0] => 2012-12-16 20:01:25
            [1] => http://www.ttgood.com/jy/t149985.htm
        )

    [1650] => Array
        (
            [0] => 2012-12-16 19:48:24
            [1] => http://www.ttgood.com/jy/t126567.htm
        )

    [1651] => Array
        (
            [0] => 2012-12-16 19:40:52
            [1] => http://www.ttgood.com/jy/t147962.htm
        )

    [1652] => Array
        (
            [0] => 2012-12-16 19:28:02
            [1] => http://www.ttgood.com/jy/t125135.htm
        )

    [1653] => Array
        (
            [0] => 2012-12-16 19:08:56
            [1] => http://www.ttgood.com/jy/t19421.htm
        )

    [1654] => Array
        (
            [0] => 2012-12-16 18:31:58
            [1] => http://www.ttgood.com/jy/t130544.htm
        )

    [1655] => Array
        (
            [0] => 2012-12-16 17:57:44
            [1] => http://www.ttgood.com/jy/t148275.htm
        )

    [1656] => Array
        (
            [0] => 2012-12-16 17:54:23
            [1] => http://www.ttgood.com/jy/t131184.htm
        )

    [1657] => Array
        (
            [0] => 2012-12-16 17:42:01
            [1] => http://www.ttgood.com/jy/t146327.htm
        )

    [1658] => Array
        (
            [0] => 2012-12-16 17:39:44
            [1] => http://www.ttgood.com/jy/t148249.htm
        )

    [1659] => Array
        (
            [0] => 2012-12-16 17:34:49
            [1] => http://www.ttgood.com/jy/t110763.htm
        )

    [1660] => Array
        (
            [0] => 2012-12-16 17:31:11
            [1] => http://www.ttgood.com/jy/t145489.htm
        )

    [1661] => Array
        (
            [0] => 2012-12-16 17:27:06
            [1] => http://www.ttgood.com/jy/t124175.htm
        )

    [1662] => Array
        (
            [0] => 2012-12-16 17:06:14
            [1] => http://www.ttgood.com/jy/t139238.htm
        )

    [1663] => Array
        (
            [0] => 2012-12-16 16:41:14
            [1] => http://www.ttgood.com/jy/t146981.htm
        )

    [1664] => Array
        (
            [0] => 2012-12-16 16:32:25
            [1] => http://www.ttgood.com/jy/t142357.htm
        )

    [1665] => Array
        (
            [0] => 2012-12-16 16:32:13
            [1] => http://www.ttgood.com/jy/t135776.htm
        )

    [1666] => Array
        (
            [0] => 2012-12-16 16:14:35
            [1] => http://www.ttgood.com/jy/t142839.htm
        )

    [1667] => Array
        (
            [0] => 2012-12-16 14:40:33
            [1] => http://www.ttgood.com/jy/t149637.htm
        )

    [1668] => Array
        (
            [0] => 2012-12-16 14:38:11
            [1] => http://www.ttgood.com/jy/t148143.htm
        )

    [1669] => Array
        (
            [0] => 2012-12-16 14:09:44
            [1] => http://www.ttgood.com/jy/t102873.htm
        )

    [1670] => Array
        (
            [0] => 2012-12-16 14:05:15
            [1] => http://www.ttgood.com/jy/t149689.htm
        )

    [1671] => Array
        (
            [0] => 2012-12-16 13:20:30
            [1] => http://www.ttgood.com/jy/t149496.htm
        )

    [1672] => Array
        (
            [0] => 2012-12-16 12:19:27
            [1] => http://www.ttgood.com/jy/t129139.htm
        )

    [1673] => Array
        (
            [0] => 2012-12-16 11:51:03
            [1] => http://www.ttgood.com/jy/t139028.htm
        )

    [1674] => Array
        (
            [0] => 2012-12-16 11:46:33
            [1] => http://www.ttgood.com/jy/t149523.htm
        )

    [1675] => Array
        (
            [0] => 2012-12-16 10:57:43
            [1] => http://www.ttgood.com/jy/t141194.htm
        )

    [1676] => Array
        (
            [0] => 2012-12-16 10:52:11
            [1] => http://www.ttgood.com/jy/t130522.htm
        )

    [1677] => Array
        (
            [0] => 2012-12-16 10:36:51
            [1] => http://www.ttgood.com/jy/t140257.htm
        )

    [1678] => Array
        (
            [0] => 2012-12-16 10:22:06
            [1] => http://www.ttgood.com/jy/t149945.htm
        )

    [1679] => Array
        (
            [0] => 2012-12-16 10:17:09
            [1] => http://www.ttgood.com/jy/t149903.htm
        )

    [1680] => Array
        (
            [0] => 2012-12-16 10:12:44
            [1] => http://www.ttgood.com/jy/t143278.htm
        )

    [1681] => Array
        (
            [0] => 2012-12-16 09:11:03
            [1] => http://www.ttgood.com/jy/t150020.htm
        )

    [1682] => Array
        (
            [0] => 2012-12-16 09:08:52
            [1] => http://www.ttgood.com/jy/t150016.htm
        )

    [1683] => Array
        (
            [0] => 2012-12-16 09:07:34
            [1] => http://www.ttgood.com/jy/t150014.htm
        )

    [1684] => Array
        (
            [0] => 2012-12-16 09:07:21
            [1] => http://www.ttgood.com/jy/t150013.htm
        )

    [1685] => Array
        (
            [0] => 2012-12-16 02:21:57
            [1] => http://www.ttgood.com/jy/t95763.htm
        )

    [1686] => Array
        (
            [0] => 2012-12-15 23:20:24
            [1] => http://www.ttgood.com/jy/t140379.htm
        )

    [1687] => Array
        (
            [0] => 2012-12-15 23:19:57
            [1] => http://www.ttgood.com/jy/t115308.htm
        )

    [1688] => Array
        (
            [0] => 2012-12-15 23:15:55
            [1] => http://www.ttgood.com/jy/t150002.htm
        )

    [1689] => Array
        (
            [0] => 2012-12-15 23:08:32
            [1] => http://www.ttgood.com/jy/t124029.htm
        )

    [1690] => Array
        (
            [0] => 2012-12-15 22:24:48
            [1] => http://www.ttgood.com/jy/t139592.htm
        )

    [1691] => Array
        (
            [0] => 2012-12-15 22:12:35
            [1] => http://www.ttgood.com/jy/t147821.htm
        )

    [1692] => Array
        (
            [0] => 2012-12-15 22:10:26
            [1] => http://www.ttgood.com/jy/t27180.htm
        )

    [1693] => Array
        (
            [0] => 2012-12-15 22:07:44
            [1] => http://www.ttgood.com/jy/t142025.htm
        )

    [1694] => Array
        (
            [0] => 2012-12-15 21:58:59
            [1] => http://www.ttgood.com/jy/t147088.htm
        )

    [1695] => Array
        (
            [0] => 2012-12-15 21:47:37
            [1] => http://www.ttgood.com/jy/t149962.htm
        )

    [1696] => Array
        (
            [0] => 2012-12-15 21:29:03
            [1] => http://www.ttgood.com/jy/t149361.htm
        )

    [1697] => Array
        (
            [0] => 2012-12-15 21:19:25
            [1] => http://www.ttgood.com/jy/t149504.htm
        )

    [1698] => Array
        (
            [0] => 2012-12-15 21:06:36
            [1] => http://www.ttgood.com/jy/t135971.htm
        )

    [1699] => Array
        (
            [0] => 2012-12-15 20:45:45
            [1] => http://www.ttgood.com/jy/t75245.htm
        )

    [1700] => Array
        (
            [0] => 2012-12-15 20:30:51
            [1] => http://www.ttgood.com/jy/t113795.htm
        )

    [1701] => Array
        (
            [0] => 2012-12-15 20:17:28
            [1] => http://www.ttgood.com/jy/t85901.htm
        )

    [1702] => Array
        (
            [0] => 2012-12-15 19:45:10
            [1] => http://www.ttgood.com/jy/t85406.htm
        )

    [1703] => Array
        (
            [0] => 2012-12-15 19:33:06
            [1] => http://www.ttgood.com/jy/t79429.htm
        )

    [1704] => Array
        (
            [0] => 2012-12-15 19:11:09
            [1] => http://www.ttgood.com/jy/t146794.htm
        )

    [1705] => Array
        (
            [0] => 2012-12-15 18:51:57
            [1] => http://www.ttgood.com/jy/t146724.htm
        )

    [1706] => Array
        (
            [0] => 2012-12-15 18:43:58
            [1] => http://www.ttgood.com/jy/t148201.htm
        )

    [1707] => Array
        (
            [0] => 2012-12-15 18:00:00
            [1] => http://www.ttgood.com/jy/t147530.htm
        )

    [1708] => Array
        (
            [0] => 2012-12-15 17:23:47
            [1] => http://www.ttgood.com/jy/t149644.htm
        )

    [1709] => Array
        (
            [0] => 2012-12-15 16:53:06
            [1] => http://www.ttgood.com/jy/t133621.htm
        )

    [1710] => Array
        (
            [0] => 2012-12-15 16:44:08
            [1] => http://www.ttgood.com/jy/t149585.htm
        )

    [1711] => Array
        (
            [0] => 2012-12-15 16:18:30
            [1] => http://www.ttgood.com/jy/t150009.htm
        )

    [1712] => Array
        (
            [0] => 2012-12-15 16:16:46
            [1] => http://www.ttgood.com/jy/t91929.htm
        )

    [1713] => Array
        (
            [0] => 2012-12-15 16:10:03
            [1] => http://www.ttgood.com/jy/t122715.htm
        )

    [1714] => Array
        (
            [0] => 2012-12-15 15:57:24
            [1] => http://www.ttgood.com/jy/t149938.htm
        )

    [1715] => Array
        (
            [0] => 2012-12-15 15:54:26
            [1] => http://www.ttgood.com/jy/t146250.htm
        )

    [1716] => Array
        (
            [0] => 2012-12-15 15:40:29
            [1] => http://www.ttgood.com/jy/t149915.htm
        )

    [1717] => Array
        (
            [0] => 2012-12-15 15:22:04
            [1] => http://www.ttgood.com/jy/t149120.htm
        )

    [1718] => Array
        (
            [0] => 2012-12-15 15:03:12
            [1] => http://www.ttgood.com/jy/t146847.htm
        )

    [1719] => Array
        (
            [0] => 2012-12-15 14:58:06
            [1] => http://www.ttgood.com/jy/t122157.htm
        )

    [1720] => Array
        (
            [0] => 2012-12-15 14:51:38
            [1] => http://www.ttgood.com/jy/t128157.htm
        )

    [1721] => Array
        (
            [0] => 2012-12-15 14:47:26
            [1] => http://www.ttgood.com/jy/t138824.htm
        )

    [1722] => Array
        (
            [0] => 2012-12-15 14:44:39
            [1] => http://www.ttgood.com/jy/t149979.htm
        )

    [1723] => Array
        (
            [0] => 2012-12-15 14:39:02
            [1] => http://www.ttgood.com/jy/t149776.htm
        )

    [1724] => Array
        (
            [0] => 2012-12-15 14:31:38
            [1] => http://www.ttgood.com/jy/t52746.htm
        )

    [1725] => Array
        (
            [0] => 2012-12-15 14:12:24
            [1] => http://www.ttgood.com/jy/t147397.htm
        )

    [1726] => Array
        (
            [0] => 2012-12-15 14:10:47
            [1] => http://www.ttgood.com/jy/t133479.htm
        )

    [1727] => Array
        (
            [0] => 2012-12-15 13:51:55
            [1] => http://www.ttgood.com/jy/t149107.htm
        )

    [1728] => Array
        (
            [0] => 2012-12-15 13:51:04
            [1] => http://www.ttgood.com/jy/t149215.htm
        )

    [1729] => Array
        (
            [0] => 2012-12-15 13:32:45
            [1] => http://www.ttgood.com/jy/t98817.htm
        )

    [1730] => Array
        (
            [0] => 2012-12-15 13:05:52
            [1] => http://www.ttgood.com/jy/t147284.htm
        )

    [1731] => Array
        (
            [0] => 2012-12-15 12:41:03
            [1] => http://www.ttgood.com/jy/t149263.htm
        )

    [1732] => Array
        (
            [0] => 2012-12-15 12:24:26
            [1] => http://www.ttgood.com/jy/t146597.htm
        )

    [1733] => Array
        (
            [0] => 2012-12-15 12:20:03
            [1] => http://www.ttgood.com/jy/t149615.htm
        )

    [1734] => Array
        (
            [0] => 2012-12-15 11:52:10
            [1] => http://www.ttgood.com/jy/t119630.htm
        )

    [1735] => Array
        (
            [0] => 2012-12-15 11:45:41
            [1] => http://www.ttgood.com/jy/t149978.htm
        )

    [1736] => Array
        (
            [0] => 2012-12-15 11:18:54
            [1] => http://www.ttgood.com/jy/t145814.htm
        )

    [1737] => Array
        (
            [0] => 2012-12-15 11:09:24
            [1] => http://www.ttgood.com/jy/t145626.htm
        )

    [1738] => Array
        (
            [0] => 2012-12-15 11:09:13
            [1] => http://www.ttgood.com/jy/t123610.htm
        )

    [1739] => Array
        (
            [0] => 2012-12-15 11:07:47
            [1] => http://www.ttgood.com/jy/t123231.htm
        )

    [1740] => Array
        (
            [0] => 2012-12-15 10:40:07
            [1] => http://www.ttgood.com/jy/t148398.htm
        )

    [1741] => Array
        (
            [0] => 2012-12-15 10:35:44
            [1] => http://www.ttgood.com/jy/t149987.htm
        )

    [1742] => Array
        (
            [0] => 2012-12-15 10:30:42
            [1] => http://www.ttgood.com/jy/t149084.htm
        )

    [1743] => Array
        (
            [0] => 2012-12-15 10:29:47
            [1] => http://www.ttgood.com/jy/t149990.htm
        )

    [1744] => Array
        (
            [0] => 2012-12-15 10:13:39
            [1] => http://www.ttgood.com/jy/t145775.htm
        )

    [1745] => Array
        (
            [0] => 2012-12-15 10:05:24
            [1] => http://www.ttgood.com/jy/t149330.htm
        )

    [1746] => Array
        (
            [0] => 2012-12-15 10:01:33
            [1] => http://www.ttgood.com/jy/t147796.htm
        )

    [1747] => Array
        (
            [0] => 2012-12-15 09:15:22
            [1] => http://www.ttgood.com/jy/t150010.htm
        )

    [1748] => Array
        (
            [0] => 2012-12-15 09:14:24
            [1] => http://www.ttgood.com/jy/t150008.htm
        )

    [1749] => Array
        (
            [0] => 2012-12-15 09:13:31
            [1] => http://www.ttgood.com/jy/t150004.htm
        )

    [1750] => Array
        (
            [0] => 2012-12-15 09:08:27
            [1] => http://www.ttgood.com/jy/t149995.htm
        )

    [1751] => Array
        (
            [0] => 2012-12-15 09:07:57
            [1] => http://www.ttgood.com/jy/t149993.htm
        )

    [1752] => Array
        (
            [0] => 2012-12-15 09:07:35
            [1] => http://www.ttgood.com/jy/t149992.htm
        )

    [1753] => Array
        (
            [0] => 2012-12-15 01:09:41
            [1] => http://www.ttgood.com/jy/t117607.htm
        )

    [1754] => Array
        (
            [0] => 2012-12-15 00:22:05
            [1] => http://www.ttgood.com/jy/t145882.htm
        )

    [1755] => Array
        (
            [0] => 2012-12-14 23:23:52
            [1] => http://www.ttgood.com/jy/t145715.htm
        )

    [1756] => Array
        (
            [0] => 2012-12-14 22:56:32
            [1] => http://www.ttgood.com/jy/t149428.htm
        )

    [1757] => Array
        (
            [0] => 2012-12-14 22:50:59
            [1] => http://www.ttgood.com/jy/t149677.htm
        )

    [1758] => Array
        (
            [0] => 2012-12-14 22:44:35
            [1] => http://www.ttgood.com/jy/t133717.htm
        )

    [1759] => Array
        (
            [0] => 2012-12-14 22:19:04
            [1] => http://www.ttgood.com/jy/t146587.htm
        )

    [1760] => Array
        (
            [0] => 2012-12-14 22:10:44
            [1] => http://www.ttgood.com/jy/t148753.htm
        )

    [1761] => Array
        (
            [0] => 2012-12-14 22:00:03
            [1] => http://www.ttgood.com/jy/t121176.htm
        )

    [1762] => Array
        (
            [0] => 2012-12-14 21:56:07
            [1] => http://www.ttgood.com/jy/t149427.htm
        )

    [1763] => Array
        (
            [0] => 2012-12-14 21:56:01
            [1] => http://www.ttgood.com/jy/t139723.htm
        )

    [1764] => Array
        (
            [0] => 2012-12-14 21:19:25
            [1] => http://www.ttgood.com/jy/t133021.htm
        )

    [1765] => Array
        (
            [0] => 2012-12-14 20:50:50
            [1] => http://www.ttgood.com/jy/t142924.htm
        )

    [1766] => Array
        (
            [0] => 2012-12-14 20:20:09
            [1] => http://www.ttgood.com/jy/t132669.htm
        )

    [1767] => Array
        (
            [0] => 2012-12-14 19:28:27
            [1] => http://www.ttgood.com/jy/t147149.htm
        )

    [1768] => Array
        (
            [0] => 2012-12-14 18:57:18
            [1] => http://www.ttgood.com/jy/t149448.htm
        )

    [1769] => Array
        (
            [0] => 2012-12-14 17:33:56
            [1] => http://www.ttgood.com/jy/t147790.htm
        )

    [1770] => Array
        (
            [0] => 2012-12-14 17:26:54
            [1] => http://www.ttgood.com/jy/t147124.htm
        )

    [1771] => Array
        (
            [0] => 2012-12-14 17:17:29
            [1] => http://www.ttgood.com/jy/t137786.htm
        )

    [1772] => Array
        (
            [0] => 2012-12-14 17:15:47
            [1] => http://www.ttgood.com/jy/t132766.htm
        )

    [1773] => Array
        (
            [0] => 2012-12-14 17:11:35
            [1] => http://www.ttgood.com/jy/t143059.htm
        )

    [1774] => Array
        (
            [0] => 2012-12-14 17:05:04
            [1] => http://www.ttgood.com/jy/t149965.htm
        )

    [1775] => Array
        (
            [0] => 2012-12-14 16:15:29
            [1] => http://www.ttgood.com/jy/t148033.htm
        )

    [1776] => Array
        (
            [0] => 2012-12-14 16:09:09
            [1] => http://www.ttgood.com/jy/t149592.htm
        )

    [1777] => Array
        (
            [0] => 2012-12-14 15:57:36
            [1] => http://www.ttgood.com/jy/t119588.htm
        )

    [1778] => Array
        (
            [0] => 2012-12-14 15:50:15
            [1] => http://www.ttgood.com/jy/t137272.htm
        )

    [1779] => Array
        (
            [0] => 2012-12-14 15:43:36
            [1] => http://www.ttgood.com/jy/t149980.htm
        )

    [1780] => Array
        (
            [0] => 2012-12-14 15:40:34
            [1] => http://www.ttgood.com/jy/t143835.htm
        )

    [1781] => Array
        (
            [0] => 2012-12-14 15:40:14
            [1] => http://www.ttgood.com/jy/t149843.htm
        )

    [1782] => Array
        (
            [0] => 2012-12-14 15:36:51
            [1] => http://www.ttgood.com/jy/t138873.htm
        )

    [1783] => Array
        (
            [0] => 2012-12-14 15:19:58
            [1] => http://www.ttgood.com/jy/t149875.htm
        )

    [1784] => Array
        (
            [0] => 2012-12-14 15:13:58
            [1] => http://www.ttgood.com/jy/t149925.htm
        )

    [1785] => Array
        (
            [0] => 2012-12-14 15:07:53
            [1] => http://www.ttgood.com/jy/t149831.htm
        )

    [1786] => Array
        (
            [0] => 2012-12-14 15:07:43
            [1] => http://www.ttgood.com/jy/t148991.htm
        )

    [1787] => Array
        (
            [0] => 2012-12-14 15:06:41
            [1] => http://www.ttgood.com/jy/t125785.htm
        )

    [1788] => Array
        (
            [0] => 2012-12-14 14:59:30
            [1] => http://www.ttgood.com/jy/t127728.htm
        )

    [1789] => Array
        (
            [0] => 2012-12-14 14:39:49
            [1] => http://www.ttgood.com/jy/t132865.htm
        )

    [1790] => Array
        (
            [0] => 2012-12-14 14:37:48
            [1] => http://www.ttgood.com/jy/t146259.htm
        )

    [1791] => Array
        (
            [0] => 2012-12-14 14:34:30
            [1] => http://www.ttgood.com/jy/t142098.htm
        )

    [1792] => Array
        (
            [0] => 2012-12-14 14:26:55
            [1] => http://www.ttgood.com/jy/t145887.htm
        )

    [1793] => Array
        (
            [0] => 2012-12-14 14:20:35
            [1] => http://www.ttgood.com/jy/t132649.htm
        )

    [1794] => Array
        (
            [0] => 2012-12-14 14:19:14
            [1] => http://www.ttgood.com/jy/t147648.htm
        )

    [1795] => Array
        (
            [0] => 2012-12-14 14:12:03
            [1] => http://www.ttgood.com/jy/t138759.htm
        )

    [1796] => Array
        (
            [0] => 2012-12-14 13:32:57
            [1] => http://www.ttgood.com/jy/t135835.htm
        )

    [1797] => Array
        (
            [0] => 2012-12-14 12:21:16
            [1] => http://www.ttgood.com/jy/t85846.htm
        )

    [1798] => Array
        (
            [0] => 2012-12-14 12:20:14
            [1] => http://www.ttgood.com/jy/t145438.htm
        )

    [1799] => Array
        (
            [0] => 2012-12-14 11:49:58
            [1] => http://www.ttgood.com/jy/t140865.htm
        )

    [1800] => Array
        (
            [0] => 2012-12-14 11:05:33
            [1] => http://www.ttgood.com/jy/t149856.htm
        )

    [1801] => Array
        (
            [0] => 2012-12-14 11:03:58
            [1] => http://www.ttgood.com/jy/t139782.htm
        )

    [1802] => Array
        (
            [0] => 2012-12-14 10:48:03
            [1] => http://www.ttgood.com/jy/t149525.htm
        )

    [1803] => Array
        (
            [0] => 2012-12-14 10:44:06
            [1] => http://www.ttgood.com/jy/t147911.htm
        )

    [1804] => Array
        (
            [0] => 2012-12-14 10:21:52
            [1] => http://www.ttgood.com/jy/t58015.htm
        )

    [1805] => Array
        (
            [0] => 2012-12-14 09:54:24
            [1] => http://www.ttgood.com/jy/t149981.htm
        )

    [1806] => Array
        (
            [0] => 2012-12-14 09:19:44
            [1] => http://www.ttgood.com/jy/t144655.htm
        )

    [1807] => Array
        (
            [0] => 2012-12-14 09:17:15
            [1] => http://www.ttgood.com/jy/t149975.htm
        )

    [1808] => Array
        (
            [0] => 2012-12-14 09:16:28
            [1] => http://www.ttgood.com/jy/t149977.htm
        )

    [1809] => Array
        (
            [0] => 2012-12-14 09:16:17
            [1] => http://www.ttgood.com/jy/t149976.htm
        )

    [1810] => Array
        (
            [0] => 2012-12-14 09:14:35
            [1] => http://www.ttgood.com/jy/t149968.htm
        )

    [1811] => Array
        (
            [0] => 2012-12-14 08:44:01
            [1] => http://www.ttgood.com/jy/t149736.htm
        )

    [1812] => Array
        (
            [0] => 2012-12-14 07:47:09
            [1] => http://www.ttgood.com/jy/t149607.htm
        )

    [1813] => Array
        (
            [0] => 2012-12-13 23:42:34
            [1] => http://www.ttgood.com/jy/t105814.htm
        )

    [1814] => Array
        (
            [0] => 2012-12-13 22:58:30
            [1] => http://www.ttgood.com/jy/t148688.htm
        )

    [1815] => Array
        (
            [0] => 2012-12-13 21:25:42
            [1] => http://www.ttgood.com/jy/t149513.htm
        )

    [1816] => Array
        (
            [0] => 2012-12-13 21:14:23
            [1] => http://www.ttgood.com/jy/t148324.htm
        )

    [1817] => Array
        (
            [0] => 2012-12-13 20:33:18
            [1] => http://www.ttgood.com/jy/t149436.htm
        )

    [1818] => Array
        (
            [0] => 2012-12-13 20:27:20
            [1] => http://www.ttgood.com/jy/t121185.htm
        )

    [1819] => Array
        (
            [0] => 2012-12-13 20:24:12
            [1] => http://www.ttgood.com/jy/t93316.htm
        )

    [1820] => Array
        (
            [0] => 2012-12-13 20:19:16
            [1] => http://www.ttgood.com/jy/t145084.htm
        )

    [1821] => Array
        (
            [0] => 2012-12-13 19:34:39
            [1] => http://www.ttgood.com/jy/t132909.htm
        )

    [1822] => Array
        (
            [0] => 2012-12-13 19:33:20
            [1] => http://www.ttgood.com/jy/t146963.htm
        )

    [1823] => Array
        (
            [0] => 2012-12-13 19:19:09
            [1] => http://www.ttgood.com/jy/t133300.htm
        )

    [1824] => Array
        (
            [0] => 2012-12-13 19:14:50
            [1] => http://www.ttgood.com/jy/t94670.htm
        )

    [1825] => Array
        (
            [0] => 2012-12-13 18:49:26
            [1] => http://www.ttgood.com/jy/t149497.htm
        )

    [1826] => Array
        (
            [0] => 2012-12-13 18:40:02
            [1] => http://www.ttgood.com/jy/t149745.htm
        )

    [1827] => Array
        (
            [0] => 2012-12-13 18:35:49
            [1] => http://www.ttgood.com/jy/t110561.htm
        )

    [1828] => Array
        (
            [0] => 2012-12-13 18:30:58
            [1] => http://www.ttgood.com/jy/t143825.htm
        )

    [1829] => Array
        (
            [0] => 2012-12-13 17:39:22
            [1] => http://www.ttgood.com/jy/t148010.htm
        )

    [1830] => Array
        (
            [0] => 2012-12-13 16:46:20
            [1] => http://www.ttgood.com/jy/t97007.htm
        )

    [1831] => Array
        (
            [0] => 2012-12-13 16:17:15
            [1] => http://www.ttgood.com/jy/t149777.htm
        )

    [1832] => Array
        (
            [0] => 2012-12-13 15:46:19
            [1] => http://www.ttgood.com/jy/t39905.htm
        )

    [1833] => Array
        (
            [0] => 2012-12-13 15:44:37
            [1] => http://www.ttgood.com/jy/t104781.htm
        )

    [1834] => Array
        (
            [0] => 2012-12-13 15:36:03
            [1] => http://www.ttgood.com/jy/t145399.htm
        )

    [1835] => Array
        (
            [0] => 2012-12-13 15:24:48
            [1] => http://www.ttgood.com/jy/t134286.htm
        )

    [1836] => Array
        (
            [0] => 2012-12-13 15:23:34
            [1] => http://www.ttgood.com/jy/t36237.htm
        )

    [1837] => Array
        (
            [0] => 2012-12-13 15:15:01
            [1] => http://www.ttgood.com/jy/t149802.htm
        )

    [1838] => Array
        (
            [0] => 2012-12-13 14:10:57
            [1] => http://www.ttgood.com/jy/t148750.htm
        )

    [1839] => Array
        (
            [0] => 2012-12-13 13:57:44
            [1] => http://www.ttgood.com/jy/t149632.htm
        )

    [1840] => Array
        (
            [0] => 2012-12-13 13:33:47
            [1] => http://www.ttgood.com/jy/t142018.htm
        )

    [1841] => Array
        (
            [0] => 2012-12-13 13:27:33
            [1] => http://www.ttgood.com/jy/t138787.htm
        )

    [1842] => Array
        (
            [0] => 2012-12-13 12:47:31
            [1] => http://www.ttgood.com/jy/t142002.htm
        )

    [1843] => Array
        (
            [0] => 2012-12-13 12:42:59
            [1] => http://www.ttgood.com/jy/t132793.htm
        )

    [1844] => Array
        (
            [0] => 2012-12-13 12:21:15
            [1] => http://www.ttgood.com/jy/t147446.htm
        )

    [1845] => Array
        (
            [0] => 2012-12-13 11:32:10
            [1] => http://www.ttgood.com/jy/t48545.htm
        )

    [1846] => Array
        (
            [0] => 2012-12-13 11:07:20
            [1] => http://www.ttgood.com/jy/t148084.htm
        )

    [1847] => Array
        (
            [0] => 2012-12-13 09:49:06
            [1] => http://www.ttgood.com/jy/t140620.htm
        )

    [1848] => Array
        (
            [0] => 2012-12-13 09:34:34
            [1] => http://www.ttgood.com/jy/t137834.htm
        )

    [1849] => Array
        (
            [0] => 2012-12-13 09:07:39
            [1] => http://www.ttgood.com/jy/t149966.htm
        )

    [1850] => Array
        (
            [0] => 2012-12-13 09:06:43
            [1] => http://www.ttgood.com/jy/t149960.htm
        )

    [1851] => Array
        (
            [0] => 2012-12-13 09:05:57
            [1] => http://www.ttgood.com/jy/t149951.htm
        )

    [1852] => Array
        (
            [0] => 2012-12-13 09:05:48
            [1] => http://www.ttgood.com/jy/t149950.htm
        )

    [1853] => Array
        (
            [0] => 2012-12-13 09:05:34
            [1] => http://www.ttgood.com/jy/t149948.htm
        )

    [1854] => Array
        (
            [0] => 2012-12-13 09:04:47
            [1] => http://www.ttgood.com/jy/t149944.htm
        )

    [1855] => Array
        (
            [0] => 2012-12-12 22:34:43
            [1] => http://www.ttgood.com/jy/t133904.htm
        )

    [1856] => Array
        (
            [0] => 2012-12-12 21:29:08
            [1] => http://www.ttgood.com/jy/t139737.htm
        )

    [1857] => Array
        (
            [0] => 2012-12-12 21:16:25
            [1] => http://www.ttgood.com/jy/t136407.htm
        )

    [1858] => Array
        (
            [0] => 2012-12-12 20:55:02
            [1] => http://www.ttgood.com/jy/t125273.htm
        )

    [1859] => Array
        (
            [0] => 2012-12-12 20:49:29
            [1] => http://www.ttgood.com/jy/t149916.htm
        )

    [1860] => Array
        (
            [0] => 2012-12-12 20:49:20
            [1] => http://www.ttgood.com/jy/t135049.htm
        )

    [1861] => Array
        (
            [0] => 2012-12-12 19:31:59
            [1] => http://www.ttgood.com/jy/t145278.htm
        )

    [1862] => Array
        (
            [0] => 2012-12-12 18:46:21
            [1] => http://www.ttgood.com/jy/t139498.htm
        )

    [1863] => Array
        (
            [0] => 2012-12-12 18:40:18
            [1] => http://www.ttgood.com/jy/t149663.htm
        )

    [1864] => Array
        (
            [0] => 2012-12-12 18:34:18
            [1] => http://www.ttgood.com/jy/t149635.htm
        )

    [1865] => Array
        (
            [0] => 2012-12-12 18:23:53
            [1] => http://www.ttgood.com/jy/t148665.htm
        )

    [1866] => Array
        (
            [0] => 2012-12-12 18:12:13
            [1] => http://www.ttgood.com/jy/t147696.htm
        )

    [1867] => Array
        (
            [0] => 2012-12-12 18:09:38
            [1] => http://www.ttgood.com/jy/t124578.htm
        )

    [1868] => Array
        (
            [0] => 2012-12-12 17:18:15
            [1] => http://www.ttgood.com/jy/t138005.htm
        )

    [1869] => Array
        (
            [0] => 2012-12-12 17:15:08
            [1] => http://www.ttgood.com/jy/t148661.htm
        )

    [1870] => Array
        (
            [0] => 2012-12-12 17:08:24
            [1] => http://www.ttgood.com/jy/t135401.htm
        )

    [1871] => Array
        (
            [0] => 2012-12-12 16:52:40
            [1] => http://www.ttgood.com/jy/t147732.htm
        )

    [1872] => Array
        (
            [0] => 2012-12-12 16:27:35
            [1] => http://www.ttgood.com/jy/t143140.htm
        )

    [1873] => Array
        (
            [0] => 2012-12-12 16:26:28
            [1] => http://www.ttgood.com/jy/t127690.htm
        )

    [1874] => Array
        (
            [0] => 2012-12-12 16:21:53
            [1] => http://www.ttgood.com/jy/t52399.htm
        )

    [1875] => Array
        (
            [0] => 2012-12-12 16:21:24
            [1] => http://www.ttgood.com/jy/t121035.htm
        )

    [1876] => Array
        (
            [0] => 2012-12-12 16:19:07
            [1] => http://www.ttgood.com/jy/t144666.htm
        )

    [1877] => Array
        (
            [0] => 2012-12-12 14:46:27
            [1] => http://www.ttgood.com/jy/t149575.htm
        )

    [1878] => Array
        (
            [0] => 2012-12-12 14:45:06
            [1] => http://www.ttgood.com/jy/t146002.htm
        )

    [1879] => Array
        (
            [0] => 2012-12-12 14:39:42
            [1] => http://www.ttgood.com/jy/t125905.htm
        )

    [1880] => Array
        (
            [0] => 2012-12-12 14:26:49
            [1] => http://www.ttgood.com/jy/t120877.htm
        )

    [1881] => Array
        (
            [0] => 2012-12-12 13:08:53
            [1] => http://www.ttgood.com/jy/t148403.htm
        )

    [1882] => Array
        (
            [0] => 2012-12-12 12:30:05
            [1] => http://www.ttgood.com/jy/t149937.htm
        )

    [1883] => Array
        (
            [0] => 2012-12-12 12:18:13
            [1] => http://www.ttgood.com/jy/t149439.htm
        )

    [1884] => Array
        (
            [0] => 2012-12-12 11:09:50
            [1] => http://www.ttgood.com/jy/t53741.htm
        )

    [1885] => Array
        (
            [0] => 2012-12-12 11:09:26
            [1] => http://www.ttgood.com/jy/t149441.htm
        )

    [1886] => Array
        (
            [0] => 2012-12-12 10:59:18
            [1] => http://www.ttgood.com/jy/t148369.htm
        )

    [1887] => Array
        (
            [0] => 2012-12-12 09:29:45
            [1] => http://www.ttgood.com/jy/t149754.htm
        )

    [1888] => Array
        (
            [0] => 2012-12-12 09:18:46
            [1] => http://www.ttgood.com/jy/t149935.htm
        )

    [1889] => Array
        (
            [0] => 2012-12-12 09:09:12
            [1] => http://www.ttgood.com/jy/t149934.htm
        )

    [1890] => Array
        (
            [0] => 2012-12-12 09:05:40
            [1] => http://www.ttgood.com/jy/t143289.htm
        )

    [1891] => Array
        (
            [0] => 2012-12-12 08:52:26
            [1] => http://www.ttgood.com/jy/t105091.htm
        )

    [1892] => Array
        (
            [0] => 2012-12-11 23:06:44
            [1] => http://www.ttgood.com/jy/t147817.htm
        )

    [1893] => Array
        (
            [0] => 2012-12-11 22:46:38
            [1] => http://www.ttgood.com/jy/t44224.htm
        )

    [1894] => Array
        (
            [0] => 2012-12-11 21:10:37
            [1] => http://www.ttgood.com/jy/t134913.htm
        )

    [1895] => Array
        (
            [0] => 2012-12-11 21:07:10
            [1] => http://www.ttgood.com/jy/t141681.htm
        )

    [1896] => Array
        (
            [0] => 2012-12-11 20:39:32
            [1] => http://www.ttgood.com/jy/t121469.htm
        )

    [1897] => Array
        (
            [0] => 2012-12-11 20:36:42
            [1] => http://www.ttgood.com/jy/t133103.htm
        )

    [1898] => Array
        (
            [0] => 2012-12-11 20:08:22
            [1] => http://www.ttgood.com/jy/t149810.htm
        )

    [1899] => Array
        (
            [0] => 2012-12-11 19:52:40
            [1] => http://www.ttgood.com/jy/t109137.htm
        )

    [1900] => Array
        (
            [0] => 2012-12-11 19:36:53
            [1] => http://www.ttgood.com/jy/t149872.htm
        )

    [1901] => Array
        (
            [0] => 2012-12-11 19:32:24
            [1] => http://www.ttgood.com/jy/t134269.htm
        )

    [1902] => Array
        (
            [0] => 2012-12-11 19:07:54
            [1] => http://www.ttgood.com/jy/t125520.htm
        )

    [1903] => Array
        (
            [0] => 2012-12-11 18:33:01
            [1] => http://www.ttgood.com/jy/t149912.htm
        )

    [1904] => Array
        (
            [0] => 2012-12-11 17:54:16
            [1] => http://www.ttgood.com/jy/t138597.htm
        )

    [1905] => Array
        (
            [0] => 2012-12-11 17:35:19
            [1] => http://www.ttgood.com/jy/t139512.htm
        )

    [1906] => Array
        (
            [0] => 2012-12-11 17:22:35
            [1] => http://www.ttgood.com/jy/t139598.htm
        )

    [1907] => Array
        (
            [0] => 2012-12-11 17:14:23
            [1] => http://www.ttgood.com/jy/t128719.htm
        )

    [1908] => Array
        (
            [0] => 2012-12-11 17:07:08
            [1] => http://www.ttgood.com/jy/t144796.htm
        )

    [1909] => Array
        (
            [0] => 2012-12-11 16:59:20
            [1] => http://www.ttgood.com/jy/t142075.htm
        )

    [1910] => Array
        (
            [0] => 2012-12-11 16:56:40
            [1] => http://www.ttgood.com/jy/t144139.htm
        )

    [1911] => Array
        (
            [0] => 2012-12-11 16:40:32
            [1] => http://www.ttgood.com/jy/t136113.htm
        )

    [1912] => Array
        (
            [0] => 2012-12-11 16:11:57
            [1] => http://www.ttgood.com/jy/t142665.htm
        )

    [1913] => Array
        (
            [0] => 2012-12-11 16:02:07
            [1] => http://www.ttgood.com/jy/t138932.htm
        )

    [1914] => Array
        (
            [0] => 2012-12-11 15:59:04
            [1] => http://www.ttgood.com/jy/t146671.htm
        )

    [1915] => Array
        (
            [0] => 2012-12-11 15:57:02
            [1] => http://www.ttgood.com/jy/t149913.htm
        )

    [1916] => Array
        (
            [0] => 2012-12-11 15:56:28
            [1] => http://www.ttgood.com/jy/t144219.htm
        )

    [1917] => Array
        (
            [0] => 2012-12-11 15:54:04
            [1] => http://www.ttgood.com/jy/t149172.htm
        )

    [1918] => Array
        (
            [0] => 2012-12-11 15:48:51
            [1] => http://www.ttgood.com/jy/t134642.htm
        )

    [1919] => Array
        (
            [0] => 2012-12-11 15:43:14
            [1] => http://www.ttgood.com/jy/t149668.htm
        )

    [1920] => Array
        (
            [0] => 2012-12-11 15:39:01
            [1] => http://www.ttgood.com/jy/t141616.htm
        )

    [1921] => Array
        (
            [0] => 2012-12-11 15:29:04
            [1] => http://www.ttgood.com/jy/t125173.htm
        )

    [1922] => Array
        (
            [0] => 2012-12-11 14:23:10
            [1] => http://www.ttgood.com/jy/t149863.htm
        )

    [1923] => Array
        (
            [0] => 2012-12-11 13:58:59
            [1] => http://www.ttgood.com/jy/t142387.htm
        )

    [1924] => Array
        (
            [0] => 2012-12-11 13:50:03
            [1] => http://www.ttgood.com/jy/t143561.htm
        )

    [1925] => Array
        (
            [0] => 2012-12-11 13:00:36
            [1] => http://www.ttgood.com/jy/t95717.htm
        )

    [1926] => Array
        (
            [0] => 2012-12-11 12:42:04
            [1] => http://www.ttgood.com/jy/t145615.htm
        )

    [1927] => Array
        (
            [0] => 2012-12-11 12:30:17
            [1] => http://www.ttgood.com/jy/t120032.htm
        )

    [1928] => Array
        (
            [0] => 2012-12-11 12:22:57
            [1] => http://www.ttgood.com/jy/t127239.htm
        )

    [1929] => Array
        (
            [0] => 2012-12-11 12:14:37
            [1] => http://www.ttgood.com/jy/t113013.htm
        )

    [1930] => Array
        (
            [0] => 2012-12-11 12:14:13
            [1] => http://www.ttgood.com/jy/t137533.htm
        )

    [1931] => Array
        (
            [0] => 2012-12-11 11:00:29
            [1] => http://www.ttgood.com/jy/t145696.htm
        )

    [1932] => Array
        (
            [0] => 2012-12-11 10:40:07
            [1] => http://www.ttgood.com/jy/t147722.htm
        )

    [1933] => Array
        (
            [0] => 2012-12-11 10:22:33
            [1] => http://www.ttgood.com/jy/t149910.htm
        )

    [1934] => Array
        (
            [0] => 2012-12-11 09:56:48
            [1] => http://www.ttgood.com/jy/t139687.htm
        )

    [1935] => Array
        (
            [0] => 2012-12-11 09:53:52
            [1] => http://www.ttgood.com/jy/t149871.htm
        )

    [1936] => Array
        (
            [0] => 2012-12-11 09:20:39
            [1] => http://www.ttgood.com/jy/t148906.htm
        )

    [1937] => Array
        (
            [0] => 2012-12-11 09:08:40
            [1] => http://www.ttgood.com/jy/t149922.htm
        )

    [1938] => Array
        (
            [0] => 2012-12-11 09:07:59
            [1] => http://www.ttgood.com/jy/t149918.htm
        )

    [1939] => Array
        (
            [0] => 2012-12-11 09:07:20
            [1] => http://www.ttgood.com/jy/t149911.htm
        )

    [1940] => Array
        (
            [0] => 2012-12-11 09:07:18
            [1] => http://www.ttgood.com/jy/t149539.htm
        )

    [1941] => Array
        (
            [0] => 2012-12-11 09:06:53
            [1] => http://www.ttgood.com/jy/t145249.htm
        )

    [1942] => Array
        (
            [0] => 2012-12-11 09:06:30
            [1] => http://www.ttgood.com/jy/t149905.htm
        )

    [1943] => Array
        (
            [0] => 2012-12-11 09:04:50
            [1] => http://www.ttgood.com/jy/t149902.htm
        )

    [1944] => Array
        (
            [0] => 2012-12-11 09:04:30
            [1] => http://www.ttgood.com/jy/t149900.htm
        )

    [1945] => Array
        (
            [0] => 2012-12-11 08:53:21
            [1] => http://www.ttgood.com/jy/t146486.htm
        )

    [1946] => Array
        (
            [0] => 2012-12-11 08:45:56
            [1] => http://www.ttgood.com/jy/t128887.htm
        )

    [1947] => Array
        (
            [0] => 2012-12-11 04:14:35
            [1] => http://www.ttgood.com/jy/t149560.htm
        )

    [1948] => Array
        (
            [0] => 2012-12-11 01:18:01
            [1] => http://www.ttgood.com/jy/t136349.htm
        )

    [1949] => Array
        (
            [0] => 2012-12-10 23:36:38
            [1] => http://www.ttgood.com/jy/t146727.htm
        )

    [1950] => Array
        (
            [0] => 2012-12-10 22:45:40
            [1] => http://www.ttgood.com/jy/t144838.htm
        )

    [1951] => Array
        (
            [0] => 2012-12-10 22:42:32
            [1] => http://www.ttgood.com/jy/t124912.htm
        )

    [1952] => Array
        (
            [0] => 2012-12-10 22:06:03
            [1] => http://www.ttgood.com/jy/t129518.htm
        )

    [1953] => Array
        (
            [0] => 2012-12-10 21:14:39
            [1] => http://www.ttgood.com/jy/t127837.htm
        )

    [1954] => Array
        (
            [0] => 2012-12-10 21:00:56
            [1] => http://www.ttgood.com/jy/t145496.htm
        )

    [1955] => Array
        (
            [0] => 2012-12-10 20:32:38
            [1] => http://www.ttgood.com/jy/t70676.htm
        )

    [1956] => Array
        (
            [0] => 2012-12-10 20:12:11
            [1] => http://www.ttgood.com/jy/t109292.htm
        )

    [1957] => Array
        (
            [0] => 2012-12-10 19:50:20
            [1] => http://www.ttgood.com/jy/t120676.htm
        )

    [1958] => Array
        (
            [0] => 2012-12-10 19:18:55
            [1] => http://www.ttgood.com/jy/t149852.htm
        )

    [1959] => Array
        (
            [0] => 2012-12-10 19:04:29
            [1] => http://www.ttgood.com/jy/t149892.htm
        )

    [1960] => Array
        (
            [0] => 2012-12-10 18:53:36
            [1] => http://www.ttgood.com/jy/t143395.htm
        )

    [1961] => Array
        (
            [0] => 2012-12-10 18:40:37
            [1] => http://www.ttgood.com/jy/t148269.htm
        )

    [1962] => Array
        (
            [0] => 2012-12-10 17:58:34
            [1] => http://www.ttgood.com/jy/t149824.htm
        )

    [1963] => Array
        (
            [0] => 2012-12-10 17:53:13
            [1] => http://www.ttgood.com/jy/t143725.htm
        )

    [1964] => Array
        (
            [0] => 2012-12-10 17:51:24
            [1] => http://www.ttgood.com/jy/t93089.htm
        )

    [1965] => Array
        (
            [0] => 2012-12-10 17:50:14
            [1] => http://www.ttgood.com/jy/t145468.htm
        )

    [1966] => Array
        (
            [0] => 2012-12-10 17:33:24
            [1] => http://www.ttgood.com/jy/t149884.htm
        )

    [1967] => Array
        (
            [0] => 2012-12-10 17:09:49
            [1] => http://www.ttgood.com/jy/t149794.htm
        )

    [1968] => Array
        (
            [0] => 2012-12-10 16:33:53
            [1] => http://www.ttgood.com/jy/t149819.htm
        )

    [1969] => Array
        (
            [0] => 2012-12-10 16:28:29
            [1] => http://www.ttgood.com/jy/t125710.htm
        )

    [1970] => Array
        (
            [0] => 2012-12-10 16:26:38
            [1] => http://www.ttgood.com/jy/t149360.htm
        )

    [1971] => Array
        (
            [0] => 2012-12-10 16:11:15
            [1] => http://www.ttgood.com/jy/t116657.htm
        )

    [1972] => Array
        (
            [0] => 2012-12-10 16:04:49
            [1] => http://www.ttgood.com/jy/t147536.htm
        )

    [1973] => Array
        (
            [0] => 2012-12-10 15:35:54
            [1] => http://www.ttgood.com/jy/t116107.htm
        )

    [1974] => Array
        (
            [0] => 2012-12-10 15:12:27
            [1] => http://www.ttgood.com/jy/t140628.htm
        )

    [1975] => Array
        (
            [0] => 2012-12-10 15:08:56
            [1] => http://www.ttgood.com/jy/t149879.htm
        )

    [1976] => Array
        (
            [0] => 2012-12-10 15:05:29
            [1] => http://www.ttgood.com/jy/t148340.htm
        )

    [1977] => Array
        (
            [0] => 2012-12-10 14:39:09
            [1] => http://www.ttgood.com/jy/t130974.htm
        )

    [1978] => Array
        (
            [0] => 2012-12-10 14:27:56
            [1] => http://www.ttgood.com/jy/t140144.htm
        )

    [1979] => Array
        (
            [0] => 2012-12-10 14:16:02
            [1] => http://www.ttgood.com/jy/t125915.htm
        )

    [1980] => Array
        (
            [0] => 2012-12-10 13:39:37
            [1] => http://www.ttgood.com/jy/t149702.htm
        )

    [1981] => Array
        (
            [0] => 2012-12-10 13:27:09
            [1] => http://www.ttgood.com/jy/t147540.htm
        )

    [1982] => Array
        (
            [0] => 2012-12-10 12:24:21
            [1] => http://www.ttgood.com/jy/t145561.htm
        )

    [1983] => Array
        (
            [0] => 2012-12-10 12:22:42
            [1] => http://www.ttgood.com/jy/t138056.htm
        )

    [1984] => Array
        (
            [0] => 2012-12-10 11:35:42
            [1] => http://www.ttgood.com/jy/t134763.htm
        )

    [1985] => Array
        (
            [0] => 2012-12-10 11:31:07
            [1] => http://www.ttgood.com/jy/t147442.htm
        )

    [1986] => Array
        (
            [0] => 2012-12-10 11:24:15
            [1] => http://www.ttgood.com/jy/t145941.htm
        )

    [1987] => Array
        (
            [0] => 2012-12-10 11:23:52
            [1] => http://www.ttgood.com/jy/t149814.htm
        )

    [1988] => Array
        (
            [0] => 2012-12-10 11:08:33
            [1] => http://www.ttgood.com/jy/t149853.htm
        )

    [1989] => Array
        (
            [0] => 2012-12-10 11:06:34
            [1] => http://www.ttgood.com/jy/t119975.htm
        )

    [1990] => Array
        (
            [0] => 2012-12-10 11:05:36
            [1] => http://www.ttgood.com/jy/t137679.htm
        )

    [1991] => Array
        (
            [0] => 2012-12-10 11:00:31
            [1] => http://www.ttgood.com/jy/t149602.htm
        )

    [1992] => Array
        (
            [0] => 2012-12-10 10:46:50
            [1] => http://www.ttgood.com/jy/t149461.htm
        )

    [1993] => Array
        (
            [0] => 2012-12-10 10:38:35
            [1] => http://www.ttgood.com/jy/t148693.htm
        )

    [1994] => Array
        (
            [0] => 2012-12-10 09:38:47
            [1] => http://www.ttgood.com/jy/t148678.htm
        )

    [1995] => Array
        (
            [0] => 2012-12-10 09:36:38
            [1] => http://www.ttgood.com/jy/t144205.htm
        )

    [1996] => Array
        (
            [0] => 2012-12-10 09:09:22
            [1] => http://www.ttgood.com/jy/t135360.htm
        )

    [1997] => Array
        (
            [0] => 2012-12-10 09:09:01
            [1] => http://www.ttgood.com/jy/t149897.htm
        )

    [1998] => Array
        (
            [0] => 2012-12-10 09:08:53
            [1] => http://www.ttgood.com/jy/t149894.htm
        )

    [1999] => Array
        (
            [0] => 2012-12-10 09:08:09
            [1] => http://www.ttgood.com/jy/t149888.htm
        )

    [2000] => Array
        (
            [0] => 2012-12-10 09:07:30
            [1] => http://www.ttgood.com/jy/t149886.htm
        )

    [2001] => Array
        (
            [0] => 2012-12-09 22:19:40
            [1] => http://www.ttgood.com/jy/t98129.htm
        )

    [2002] => Array
        (
            [0] => 2012-12-09 22:02:59
            [1] => http://www.ttgood.com/jy/t125015.htm
        )

    [2003] => Array
        (
            [0] => 2012-12-09 21:42:20
            [1] => http://www.ttgood.com/jy/t148751.htm
        )

    [2004] => Array
        (
            [0] => 2012-12-09 21:36:59
            [1] => http://www.ttgood.com/jy/t130143.htm
        )

    [2005] => Array
        (
            [0] => 2012-12-09 21:28:03
            [1] => http://www.ttgood.com/jy/t147844.htm
        )

    [2006] => Array
        (
            [0] => 2012-12-09 21:27:57
            [1] => http://www.ttgood.com/jy/t149591.htm
        )

    [2007] => Array
        (
            [0] => 2012-12-09 21:26:28
            [1] => http://www.ttgood.com/jy/t146170.htm
        )

    [2008] => Array
        (
            [0] => 2012-12-09 20:53:29
            [1] => http://www.ttgood.com/jy/t127125.htm
        )

    [2009] => Array
        (
            [0] => 2012-12-09 20:30:47
            [1] => http://www.ttgood.com/jy/t134219.htm
        )

    [2010] => Array
        (
            [0] => 2012-12-09 20:22:38
            [1] => http://www.ttgood.com/jy/t145885.htm
        )

    [2011] => Array
        (
            [0] => 2012-12-09 20:21:06
            [1] => http://www.ttgood.com/jy/t148752.htm
        )

    [2012] => Array
        (
            [0] => 2012-12-09 18:56:46
            [1] => http://www.ttgood.com/jy/t148233.htm
        )

    [2013] => Array
        (
            [0] => 2012-12-09 18:51:46
            [1] => http://www.ttgood.com/jy/t145505.htm
        )

    [2014] => Array
        (
            [0] => 2012-12-09 17:50:38
            [1] => http://www.ttgood.com/jy/t119626.htm
        )

    [2015] => Array
        (
            [0] => 2012-12-09 17:15:01
            [1] => http://www.ttgood.com/jy/t144491.htm
        )

    [2016] => Array
        (
            [0] => 2012-12-09 16:27:30
            [1] => http://www.ttgood.com/jy/t149771.htm
        )

    [2017] => Array
        (
            [0] => 2012-12-09 15:23:22
            [1] => http://www.ttgood.com/jy/t146913.htm
        )

    [2018] => Array
        (
            [0] => 2012-12-09 14:54:04
            [1] => http://www.ttgood.com/jy/t149115.htm
        )

    [2019] => Array
        (
            [0] => 2012-12-09 14:34:14
            [1] => http://www.ttgood.com/jy/t139655.htm
        )

    [2020] => Array
        (
            [0] => 2012-12-09 14:11:33
            [1] => http://www.ttgood.com/jy/t149642.htm
        )

    [2021] => Array
        (
            [0] => 2012-12-09 13:58:03
            [1] => http://www.ttgood.com/jy/t127675.htm
        )

    [2022] => Array
        (
            [0] => 2012-12-09 12:20:29
            [1] => http://www.ttgood.com/jy/t149545.htm
        )

    [2023] => Array
        (
            [0] => 2012-12-09 12:17:40
            [1] => http://www.ttgood.com/jy/t141654.htm
        )

    [2024] => Array
        (
            [0] => 2012-12-09 12:08:00
            [1] => http://www.ttgood.com/jy/t127814.htm
        )

    [2025] => Array
        (
            [0] => 2012-12-09 11:56:54
            [1] => http://www.ttgood.com/jy/t149837.htm
        )

    [2026] => Array
        (
            [0] => 2012-12-09 11:18:28
            [1] => http://www.ttgood.com/jy/t145975.htm
        )

    [2027] => Array
        (
            [0] => 2012-12-09 11:06:20
            [1] => http://www.ttgood.com/jy/t148813.htm
        )

    [2028] => Array
        (
            [0] => 2012-12-09 10:27:52
            [1] => http://www.ttgood.com/jy/t149839.htm
        )

    [2029] => Array
        (
            [0] => 2012-12-09 10:11:56
            [1] => http://www.ttgood.com/jy/t145717.htm
        )

    [2030] => Array
        (
            [0] => 2012-12-09 09:56:43
            [1] => http://www.ttgood.com/jy/t146787.htm
        )

    [2031] => Array
        (
            [0] => 2012-12-09 09:38:23
            [1] => http://www.ttgood.com/jy/t147119.htm
        )

    [2032] => Array
        (
            [0] => 2012-12-09 09:04:50
            [1] => http://www.ttgood.com/jy/t149869.htm
        )

    [2033] => Array
        (
            [0] => 2012-12-09 09:04:12
            [1] => http://www.ttgood.com/jy/t149870.htm
        )

    [2034] => Array
        (
            [0] => 2012-12-09 09:04:00
            [1] => http://www.ttgood.com/jy/t149851.htm
        )

    [2035] => Array
        (
            [0] => 2012-12-09 08:52:25
            [1] => http://www.ttgood.com/jy/t137501.htm
        )

    [2036] => Array
        (
            [0] => 2012-12-08 23:12:52
            [1] => http://www.ttgood.com/jy/t146497.htm
        )

    [2037] => Array
        (
            [0] => 2012-12-08 23:07:51
            [1] => http://www.ttgood.com/jy/t149685.htm
        )

    [2038] => Array
        (
            [0] => 2012-12-08 22:52:05
            [1] => http://www.ttgood.com/jy/t131945.htm
        )

    [2039] => Array
        (
            [0] => 2012-12-08 22:50:54
            [1] => http://www.ttgood.com/jy/t143315.htm
        )

    [2040] => Array
        (
            [0] => 2012-12-08 22:18:28
            [1] => http://www.ttgood.com/jy/t143767.htm
        )

    [2041] => Array
        (
            [0] => 2012-12-08 22:08:05
            [1] => http://www.ttgood.com/jy/t142276.htm
        )

    [2042] => Array
        (
            [0] => 2012-12-08 21:42:09
            [1] => http://www.ttgood.com/jy/t144787.htm
        )

    [2043] => Array
        (
            [0] => 2012-12-08 21:36:35
            [1] => http://www.ttgood.com/jy/t148606.htm
        )

    [2044] => Array
        (
            [0] => 2012-12-08 21:21:53
            [1] => http://www.ttgood.com/jy/t149234.htm
        )

    [2045] => Array
        (
            [0] => 2012-12-08 20:40:18
            [1] => http://www.ttgood.com/jy/t144191.htm
        )

    [2046] => Array
        (
            [0] => 2012-12-08 20:24:04
            [1] => http://www.ttgood.com/jy/t145254.htm
        )

    [2047] => Array
        (
            [0] => 2012-12-08 19:55:39
            [1] => http://www.ttgood.com/jy/t78809.htm
        )

    [2048] => Array
        (
            [0] => 2012-12-08 19:43:10
            [1] => http://www.ttgood.com/jy/t141582.htm
        )

    [2049] => Array
        (
            [0] => 2012-12-08 19:42:57
            [1] => http://www.ttgood.com/jy/t148129.htm
        )

    [2050] => Array
        (
            [0] => 2012-12-08 19:27:42
            [1] => http://www.ttgood.com/jy/t149505.htm
        )

    [2051] => Array
        (
            [0] => 2012-12-08 17:11:05
            [1] => http://www.ttgood.com/jy/t149803.htm
        )

    [2052] => Array
        (
            [0] => 2012-12-08 16:49:09
            [1] => http://www.ttgood.com/jy/t132139.htm
        )

    [2053] => Array
        (
            [0] => 2012-12-08 16:43:13
            [1] => http://www.ttgood.com/jy/t146906.htm
        )

    [2054] => Array
        (
            [0] => 2012-12-08 16:28:45
            [1] => http://www.ttgood.com/jy/t126283.htm
        )

    [2055] => Array
        (
            [0] => 2012-12-08 16:24:30
            [1] => http://www.ttgood.com/jy/t146492.htm
        )

    [2056] => Array
        (
            [0] => 2012-12-08 15:56:45
            [1] => http://www.ttgood.com/jy/t113561.htm
        )

    [2057] => Array
        (
            [0] => 2012-12-08 15:05:42
            [1] => http://www.ttgood.com/jy/t135520.htm
        )

    [2058] => Array
        (
            [0] => 2012-12-08 14:55:08
            [1] => http://www.ttgood.com/jy/t139890.htm
        )

    [2059] => Array
        (
            [0] => 2012-12-08 14:18:40
            [1] => http://www.ttgood.com/jy/t123932.htm
        )

    [2060] => Array
        (
            [0] => 2012-12-08 14:09:29
            [1] => http://www.ttgood.com/jy/t149672.htm
        )

    [2061] => Array
        (
            [0] => 2012-12-08 12:36:57
            [1] => http://www.ttgood.com/jy/t149016.htm
        )

    [2062] => Array
        (
            [0] => 2012-12-08 12:30:20
            [1] => http://www.ttgood.com/jy/t135680.htm
        )

    [2063] => Array
        (
            [0] => 2012-12-08 12:18:07
            [1] => http://www.ttgood.com/jy/t101033.htm
        )

    [2064] => Array
        (
            [0] => 2012-12-08 11:28:38
            [1] => http://www.ttgood.com/jy/t101647.htm
        )

    [2065] => Array
        (
            [0] => 2012-12-08 11:16:10
            [1] => http://www.ttgood.com/jy/t144307.htm
        )

    [2066] => Array
        (
            [0] => 2012-12-08 10:44:14
            [1] => http://www.ttgood.com/jy/t146098.htm
        )

    [2067] => Array
        (
            [0] => 2012-12-08 10:13:01
            [1] => http://www.ttgood.com/jy/t128388.htm
        )

    [2068] => Array
        (
            [0] => 2012-12-08 09:10:42
            [1] => http://www.ttgood.com/jy/t149844.htm
        )

    [2069] => Array
        (
            [0] => 2012-12-08 09:10:16
            [1] => http://www.ttgood.com/jy/t149841.htm
        )

    [2070] => Array
        (
            [0] => 2012-12-08 09:10:07
            [1] => http://www.ttgood.com/jy/t149840.htm
        )

    [2071] => Array
        (
            [0] => 2012-12-08 09:09:16
            [1] => http://www.ttgood.com/jy/t149834.htm
        )

    [2072] => Array
        (
            [0] => 2012-12-08 09:08:48
            [1] => http://www.ttgood.com/jy/t149832.htm
        )

    [2073] => Array
        (
            [0] => 2012-12-08 09:08:26
            [1] => http://www.ttgood.com/jy/t149830.htm
        )

    [2074] => Array
        (
            [0] => 2012-12-08 03:33:22
            [1] => http://www.ttgood.com/jy/t89663.htm
        )

    [2075] => Array
        (
            [0] => 2012-12-08 00:02:25
            [1] => http://www.ttgood.com/jy/t146303.htm
        )

    [2076] => Array
        (
            [0] => 2012-12-07 23:57:01
            [1] => http://www.ttgood.com/jy/t144472.htm
        )

    [2077] => Array
        (
            [0] => 2012-12-07 23:01:16
            [1] => http://www.ttgood.com/jy/t149686.htm
        )

    [2078] => Array
        (
            [0] => 2012-12-07 22:22:27
            [1] => http://www.ttgood.com/jy/t43300.htm
        )

    [2079] => Array
        (
            [0] => 2012-12-07 22:17:18
            [1] => http://www.ttgood.com/jy/t147723.htm
        )

    [2080] => Array
        (
            [0] => 2012-12-07 21:56:35
            [1] => http://www.ttgood.com/jy/t144245.htm
        )

    [2081] => Array
        (
            [0] => 2012-12-07 21:06:59
            [1] => http://www.ttgood.com/jy/t130903.htm
        )

    [2082] => Array
        (
            [0] => 2012-12-07 20:56:49
            [1] => http://www.ttgood.com/jy/t88888.htm
        )

    [2083] => Array
        (
            [0] => 2012-12-07 20:56:00
            [1] => http://www.ttgood.com/jy/t149765.htm
        )

    [2084] => Array
        (
            [0] => 2012-12-07 20:49:53
            [1] => http://www.ttgood.com/jy/t149649.htm
        )

    [2085] => Array
        (
            [0] => 2012-12-07 20:31:15
            [1] => http://www.ttgood.com/jy/t142277.htm
        )

    [2086] => Array
        (
            [0] => 2012-12-07 20:10:48
            [1] => http://www.ttgood.com/jy/t76328.htm
        )

    [2087] => Array
        (
            [0] => 2012-12-07 18:43:28
            [1] => http://www.ttgood.com/jy/t87468.htm
        )

    [2088] => Array
        (
            [0] => 2012-12-07 18:30:30
            [1] => http://www.ttgood.com/jy/t148768.htm
        )

    [2089] => Array
        (
            [0] => 2012-12-07 18:12:42
            [1] => http://www.ttgood.com/jy/t149590.htm
        )

    [2090] => Array
        (
            [0] => 2012-12-07 18:01:19
            [1] => http://www.ttgood.com/jy/t149171.htm
        )

    [2091] => Array
        (
            [0] => 2012-12-07 17:59:46
            [1] => http://www.ttgood.com/jy/t149687.htm
        )

    [2092] => Array
        (
            [0] => 2012-12-07 17:59:46
            [1] => http://www.ttgood.com/jy/t128696.htm
        )

    [2093] => Array
        (
            [0] => 2012-12-07 17:43:53
            [1] => http://www.ttgood.com/jy/t149089.htm
        )

    [2094] => Array
        (
            [0] => 2012-12-07 17:43:49
            [1] => http://www.ttgood.com/jy/t149618.htm
        )

    [2095] => Array
        (
            [0] => 2012-12-07 17:22:02
            [1] => http://www.ttgood.com/jy/t149667.htm
        )

    [2096] => Array
        (
            [0] => 2012-12-07 17:18:07
            [1] => http://www.ttgood.com/jy/t140317.htm
        )

    [2097] => Array
        (
            [0] => 2012-12-07 16:25:27
            [1] => http://www.ttgood.com/jy/t143551.htm
        )

    [2098] => Array
        (
            [0] => 2012-12-07 16:24:59
            [1] => http://www.ttgood.com/jy/t140429.htm
        )

    [2099] => Array
        (
            [0] => 2012-12-07 16:16:30
            [1] => http://www.ttgood.com/jy/t100974.htm
        )

    [2100] => Array
        (
            [0] => 2012-12-07 15:16:16
            [1] => http://www.ttgood.com/jy/t123689.htm
        )

    [2101] => Array
        (
            [0] => 2012-12-07 15:13:56
            [1] => http://www.ttgood.com/jy/t77856.htm
        )

    [2102] => Array
        (
            [0] => 2012-12-07 15:13:50
            [1] => http://www.ttgood.com/jy/t73479.htm
        )

    [2103] => Array
        (
            [0] => 2012-12-07 14:24:36
            [1] => http://www.ttgood.com/jy/t40113.htm
        )

    [2104] => Array
        (
            [0] => 2012-12-07 14:05:53
            [1] => http://www.ttgood.com/jy/t146371.htm
        )

    [2105] => Array
        (
            [0] => 2012-12-07 13:06:15
            [1] => http://www.ttgood.com/jy/t128924.htm
        )

    [2106] => Array
        (
            [0] => 2012-12-07 12:47:36
            [1] => http://www.ttgood.com/jy/t134816.htm
        )

    [2107] => Array
        (
            [0] => 2012-12-07 12:35:34
            [1] => http://www.ttgood.com/jy/t149807.htm
        )

    [2108] => Array
        (
            [0] => 2012-12-07 12:00:33
            [1] => http://www.ttgood.com/jy/t147867.htm
        )

    [2109] => Array
        (
            [0] => 2012-12-07 11:53:49
            [1] => http://www.ttgood.com/jy/t148579.htm
        )

    [2110] => Array
        (
            [0] => 2012-12-07 11:27:15
            [1] => http://www.ttgood.com/jy/t147889.htm
        )

    [2111] => Array
        (
            [0] => 2012-12-07 10:42:54
            [1] => http://www.ttgood.com/jy/t148144.htm
        )

    [2112] => Array
        (
            [0] => 2012-12-07 09:22:05
            [1] => http://www.ttgood.com/jy/t109204.htm
        )

    [2113] => Array
        (
            [0] => 2012-12-07 09:03:25
            [1] => http://www.ttgood.com/jy/t127346.htm
        )

    [2114] => Array
        (
            [0] => 2012-12-07 09:02:10
            [1] => http://www.ttgood.com/jy/t149828.htm
        )

    [2115] => Array
        (
            [0] => 2012-12-07 08:59:23
            [1] => http://www.ttgood.com/jy/t149820.htm
        )

    [2116] => Array
        (
            [0] => 2012-12-07 08:57:44
            [1] => http://www.ttgood.com/jy/t149818.htm
        )

    [2117] => Array
        (
            [0] => 2012-12-07 08:57:39
            [1] => http://www.ttgood.com/jy/t149817.htm
        )

    [2118] => Array
        (
            [0] => 2012-12-06 23:28:45
            [1] => http://www.ttgood.com/jy/t143135.htm
        )

    [2119] => Array
        (
            [0] => 2012-12-06 22:55:25
            [1] => http://www.ttgood.com/jy/t148719.htm
        )

    [2120] => Array
        (
            [0] => 2012-12-06 22:47:13
            [1] => http://www.ttgood.com/jy/t135686.htm
        )

    [2121] => Array
        (
            [0] => 2012-12-06 22:44:41
            [1] => http://www.ttgood.com/jy/t149786.htm
        )

    [2122] => Array
        (
            [0] => 2012-12-06 22:42:57
            [1] => http://www.ttgood.com/jy/t96643.htm
        )

    [2123] => Array
        (
            [0] => 2012-12-06 22:06:09
            [1] => http://www.ttgood.com/jy/t148847.htm
        )

    [2124] => Array
        (
            [0] => 2012-12-06 21:53:04
            [1] => http://www.ttgood.com/jy/t136618.htm
        )

    [2125] => Array
        (
            [0] => 2012-12-06 21:52:39
            [1] => http://www.ttgood.com/jy/t106739.htm
        )

    [2126] => Array
        (
            [0] => 2012-12-06 21:40:42
            [1] => http://www.ttgood.com/jy/t146394.htm
        )

    [2127] => Array
        (
            [0] => 2012-12-06 21:30:54
            [1] => http://www.ttgood.com/jy/t143947.htm
        )

    [2128] => Array
        (
            [0] => 2012-12-06 21:07:45
            [1] => http://www.ttgood.com/jy/t149744.htm
        )

    [2129] => Array
        (
            [0] => 2012-12-06 20:42:23
            [1] => http://www.ttgood.com/jy/t149257.htm
        )

    [2130] => Array
        (
            [0] => 2012-12-06 20:00:26
            [1] => http://www.ttgood.com/jy/t148704.htm
        )

    [2131] => Array
        (
            [0] => 2012-12-06 19:41:27
            [1] => http://www.ttgood.com/jy/t147361.htm
        )

    [2132] => Array
        (
            [0] => 2012-12-06 18:58:39
            [1] => http://www.ttgood.com/jy/t125139.htm
        )

    [2133] => Array
        (
            [0] => 2012-12-06 18:32:58
            [1] => http://www.ttgood.com/jy/t149785.htm
        )

    [2134] => Array
        (
            [0] => 2012-12-06 18:27:08
            [1] => http://www.ttgood.com/jy/t101814.htm
        )

    [2135] => Array
        (
            [0] => 2012-12-06 18:24:38
            [1] => http://www.ttgood.com/jy/t147746.htm
        )

    [2136] => Array
        (
            [0] => 2012-12-06 18:22:09
            [1] => http://www.ttgood.com/jy/t136726.htm
        )

    [2137] => Array
        (
            [0] => 2012-12-06 18:16:40
            [1] => http://www.ttgood.com/jy/t149811.htm
        )

    [2138] => Array
        (
            [0] => 2012-12-06 18:13:12
            [1] => http://www.ttgood.com/jy/t147953.htm
        )

    [2139] => Array
        (
            [0] => 2012-12-06 18:10:46
            [1] => http://www.ttgood.com/jy/t144224.htm
        )

    [2140] => Array
        (
            [0] => 2012-12-06 17:55:45
            [1] => http://www.ttgood.com/jy/t141195.htm
        )

    [2141] => Array
        (
            [0] => 2012-12-06 17:48:45
            [1] => http://www.ttgood.com/jy/t146642.htm
        )

    [2142] => Array
        (
            [0] => 2012-12-06 16:48:23
            [1] => http://www.ttgood.com/jy/t148193.htm
        )

    [2143] => Array
        (
            [0] => 2012-12-06 16:11:22
            [1] => http://www.ttgood.com/jy/t130044.htm
        )

    [2144] => Array
        (
            [0] => 2012-12-06 16:07:31
            [1] => http://www.ttgood.com/jy/t149783.htm
        )

    [2145] => Array
        (
            [0] => 2012-12-06 15:58:53
            [1] => http://www.ttgood.com/jy/t148453.htm
        )

    [2146] => Array
        (
            [0] => 2012-12-06 15:47:07
            [1] => http://www.ttgood.com/jy/t149813.htm
        )

    [2147] => Array
        (
            [0] => 2012-12-06 15:34:11
            [1] => http://www.ttgood.com/jy/t140166.htm
        )

    [2148] => Array
        (
            [0] => 2012-12-06 15:29:22
            [1] => http://www.ttgood.com/jy/t148136.htm
        )

    [2149] => Array
        (
            [0] => 2012-12-06 15:05:20
            [1] => http://www.ttgood.com/jy/t149169.htm
        )

    [2150] => Array
        (
            [0] => 2012-12-06 14:49:55
            [1] => http://www.ttgood.com/jy/t103404.htm
        )

    [2151] => Array
        (
            [0] => 2012-12-06 14:40:25
            [1] => http://www.ttgood.com/jy/t140085.htm
        )

    [2152] => Array
        (
            [0] => 2012-12-06 14:21:23
            [1] => http://www.ttgood.com/jy/t148777.htm
        )

    [2153] => Array
        (
            [0] => 2012-12-06 14:18:45
            [1] => http://www.ttgood.com/jy/t128212.htm
        )

    [2154] => Array
        (
            [0] => 2012-12-06 14:17:52
            [1] => http://www.ttgood.com/jy/t146565.htm
        )

    [2155] => Array
        (
            [0] => 2012-12-06 14:09:07
            [1] => http://www.ttgood.com/jy/t112862.htm
        )

    [2156] => Array
        (
            [0] => 2012-12-06 14:00:39
            [1] => http://www.ttgood.com/jy/t136372.htm
        )

    [2157] => Array
        (
            [0] => 2012-12-06 13:24:41
            [1] => http://www.ttgood.com/jy/t148485.htm
        )

    [2158] => Array
        (
            [0] => 2012-12-06 13:18:09
            [1] => http://www.ttgood.com/jy/t144396.htm
        )

    [2159] => Array
        (
            [0] => 2012-12-06 12:40:31
            [1] => http://www.ttgood.com/jy/t115715.htm
        )

    [2160] => Array
        (
            [0] => 2012-12-06 12:30:49
            [1] => http://www.ttgood.com/jy/t124230.htm
        )

    [2161] => Array
        (
            [0] => 2012-12-06 12:07:00
            [1] => http://www.ttgood.com/jy/t147603.htm
        )

    [2162] => Array
        (
            [0] => 2012-12-06 11:29:31
            [1] => http://www.ttgood.com/jy/t147847.htm
        )

    [2163] => Array
        (
            [0] => 2012-12-06 11:18:36
            [1] => http://www.ttgood.com/jy/t147840.htm
        )

    [2164] => Array
        (
            [0] => 2012-12-06 10:58:37
            [1] => http://www.ttgood.com/jy/t146370.htm
        )

    [2165] => Array
        (
            [0] => 2012-12-06 10:55:38
            [1] => http://www.ttgood.com/jy/t149017.htm
        )

    [2166] => Array
        (
            [0] => 2012-12-06 10:27:16
            [1] => http://www.ttgood.com/jy/t147098.htm
        )

    [2167] => Array
        (
            [0] => 2012-12-06 10:00:33
            [1] => http://www.ttgood.com/jy/t145762.htm
        )

    [2168] => Array
        (
            [0] => 2012-12-06 09:48:43
            [1] => http://www.ttgood.com/jy/t147854.htm
        )

    [2169] => Array
        (
            [0] => 2012-12-06 09:43:52
            [1] => http://www.ttgood.com/jy/t147150.htm
        )

    [2170] => Array
        (
            [0] => 2012-12-06 08:35:41
            [1] => http://www.ttgood.com/jy/t99294.htm
        )

    [2171] => Array
        (
            [0] => 2012-12-06 08:30:14
            [1] => http://www.ttgood.com/jy/t138591.htm
        )

    [2172] => Array
        (
            [0] => 2012-12-06 00:35:11
            [1] => http://www.ttgood.com/jy/t96854.htm
        )

    [2173] => Array
        (
            [0] => 2012-12-05 23:54:40
            [1] => http://www.ttgood.com/jy/t142688.htm
        )

    [2174] => Array
        (
            [0] => 2012-12-05 23:51:49
            [1] => http://www.ttgood.com/jy/t138287.htm
        )

    [2175] => Array
        (
            [0] => 2012-12-05 21:52:42
            [1] => http://www.ttgood.com/jy/t149437.htm
        )

    [2176] => Array
        (
            [0] => 2012-12-05 21:34:25
            [1] => http://www.ttgood.com/jy/t145603.htm
        )

    [2177] => Array
        (
            [0] => 2012-12-05 20:54:33
            [1] => http://www.ttgood.com/jy/t146840.htm
        )

    [2178] => Array
        (
            [0] => 2012-12-05 20:39:40
            [1] => http://www.ttgood.com/jy/t144273.htm
        )

    [2179] => Array
        (
            [0] => 2012-12-05 20:34:05
            [1] => http://www.ttgood.com/jy/t142378.htm
        )

    [2180] => Array
        (
            [0] => 2012-12-05 20:17:29
            [1] => http://www.ttgood.com/jy/t142366.htm
        )

    [2181] => Array
        (
            [0] => 2012-12-05 20:13:37
            [1] => http://www.ttgood.com/jy/t136647.htm
        )

    [2182] => Array
        (
            [0] => 2012-12-05 20:07:56
            [1] => http://www.ttgood.com/jy/t141953.htm
        )

    [2183] => Array
        (
            [0] => 2012-12-05 20:01:36
            [1] => http://www.ttgood.com/jy/t129665.htm
        )

    [2184] => Array
        (
            [0] => 2012-12-05 19:39:50
            [1] => http://www.ttgood.com/jy/t74565.htm
        )

    [2185] => Array
        (
            [0] => 2012-12-05 19:00:14
            [1] => http://www.ttgood.com/jy/t144417.htm
        )

    [2186] => Array
        (
            [0] => 2012-12-05 17:03:19
            [1] => http://www.ttgood.com/jy/t138797.htm
        )

    [2187] => Array
        (
            [0] => 2012-12-05 16:49:05
            [1] => http://www.ttgood.com/jy/t149782.htm
        )

    [2188] => Array
        (
            [0] => 2012-12-05 16:12:21
            [1] => http://www.ttgood.com/jy/t130938.htm
        )

    [2189] => Array
        (
            [0] => 2012-12-05 15:15:10
            [1] => http://www.ttgood.com/jy/t148787.htm
        )

    [2190] => Array
        (
            [0] => 2012-12-05 15:04:49
            [1] => http://www.ttgood.com/jy/t145240.htm
        )

    [2191] => Array
        (
            [0] => 2012-12-05 14:57:38
            [1] => http://www.ttgood.com/jy/t111949.htm
        )

    [2192] => Array
        (
            [0] => 2012-12-05 14:50:46
            [1] => http://www.ttgood.com/jy/t149255.htm
        )

    [2193] => Array
        (
            [0] => 2012-12-05 14:34:24
            [1] => http://www.ttgood.com/jy/t149484.htm
        )

    [2194] => Array
        (
            [0] => 2012-12-05 14:24:53
            [1] => http://www.ttgood.com/jy/t144769.htm
        )

    [2195] => Array
        (
            [0] => 2012-12-05 14:08:50
            [1] => http://www.ttgood.com/jy/t146568.htm
        )

    [2196] => Array
        (
            [0] => 2012-12-05 14:04:48
            [1] => http://www.ttgood.com/jy/t140707.htm
        )

    [2197] => Array
        (
            [0] => 2012-12-05 13:49:52
            [1] => http://www.ttgood.com/jy/t145646.htm
        )

    [2198] => Array
        (
            [0] => 2012-12-05 13:43:31
            [1] => http://www.ttgood.com/jy/t137687.htm
        )

    [2199] => Array
        (
            [0] => 2012-12-05 12:50:09
            [1] => http://www.ttgood.com/jy/t141484.htm
        )

    [2200] => Array
        (
            [0] => 2012-12-05 12:48:45
            [1] => http://www.ttgood.com/jy/t148802.htm
        )

    [2201] => Array
        (
            [0] => 2012-12-05 11:53:36
            [1] => http://www.ttgood.com/jy/t120058.htm
        )

    [2202] => Array
        (
            [0] => 2012-12-05 11:18:24
            [1] => http://www.ttgood.com/jy/t149416.htm
        )

    [2203] => Array
        (
            [0] => 2012-12-05 10:49:59
            [1] => http://www.ttgood.com/jy/t141472.htm
        )

    [2204] => Array
        (
            [0] => 2012-12-05 10:47:26
            [1] => http://www.ttgood.com/jy/t145967.htm
        )

    [2205] => Array
        (
            [0] => 2012-12-05 10:42:05
            [1] => http://www.ttgood.com/jy/t149304.htm
        )

    [2206] => Array
        (
            [0] => 2012-12-05 10:40:44
            [1] => http://www.ttgood.com/jy/t146056.htm
        )

    [2207] => Array
        (
            [0] => 2012-12-05 10:40:09
            [1] => http://www.ttgood.com/jy/t147167.htm
        )

    [2208] => Array
        (
            [0] => 2012-12-05 10:32:25
            [1] => http://www.ttgood.com/jy/t139899.htm
        )

    [2209] => Array
        (
            [0] => 2012-12-05 10:20:44
            [1] => http://www.ttgood.com/jy/t149789.htm
        )

    [2210] => Array
        (
            [0] => 2012-12-05 10:15:03
            [1] => http://www.ttgood.com/jy/t149792.htm
        )

    [2211] => Array
        (
            [0] => 2012-12-05 09:51:44
            [1] => http://www.ttgood.com/jy/t140791.htm
        )

    [2212] => Array
        (
            [0] => 2012-12-05 09:39:27
            [1] => http://www.ttgood.com/jy/t120996.htm
        )

    [2213] => Array
        (
            [0] => 2012-12-05 09:11:30
            [1] => http://www.ttgood.com/jy/t149788.htm
        )

    [2214] => Array
        (
            [0] => 2012-12-05 09:11:05
            [1] => http://www.ttgood.com/jy/t149791.htm
        )

    [2215] => Array
        (
            [0] => 2012-12-05 09:03:37
            [1] => http://www.ttgood.com/jy/t149784.htm
        )

    [2216] => Array
        (
            [0] => 2012-12-05 09:03:12
            [1] => http://www.ttgood.com/jy/t149781.htm
        )

    [2217] => Array
        (
            [0] => 2012-12-05 00:15:12
            [1] => http://www.ttgood.com/jy/t140020.htm
        )

    [2218] => Array
        (
            [0] => 2012-12-04 22:59:15
            [1] => http://www.ttgood.com/jy/t148814.htm
        )

    [2219] => Array
        (
            [0] => 2012-12-04 22:43:13
            [1] => http://www.ttgood.com/jy/t149423.htm
        )

    [2220] => Array
        (
            [0] => 2012-12-04 22:14:48
            [1] => http://www.ttgood.com/jy/t147221.htm
        )

    [2221] => Array
        (
            [0] => 2012-12-04 22:14:40
            [1] => http://www.ttgood.com/jy/t124270.htm
        )

    [2222] => Array
        (
            [0] => 2012-12-04 22:10:49
            [1] => http://www.ttgood.com/jy/t149725.htm
        )

    [2223] => Array
        (
            [0] => 2012-12-04 21:44:01
            [1] => http://www.ttgood.com/jy/t149451.htm
        )

    [2224] => Array
        (
            [0] => 2012-12-04 21:37:24
            [1] => http://www.ttgood.com/jy/t149651.htm
        )

    [2225] => Array
        (
            [0] => 2012-12-04 21:33:31
            [1] => http://www.ttgood.com/jy/t81081.htm
        )

    [2226] => Array
        (
            [0] => 2012-12-04 20:14:41
            [1] => http://www.ttgood.com/jy/t148395.htm
        )

    [2227] => Array
        (
            [0] => 2012-12-04 20:04:50
            [1] => http://www.ttgood.com/jy/t144239.htm
        )

    [2228] => Array
        (
            [0] => 2012-12-04 18:40:41
            [1] => http://www.ttgood.com/jy/t77764.htm
        )

    [2229] => Array
        (
            [0] => 2012-12-04 18:29:42
            [1] => http://www.ttgood.com/jy/t146621.htm
        )

    [2230] => Array
        (
            [0] => 2012-12-04 17:55:36
            [1] => http://www.ttgood.com/jy/t148724.htm
        )

    [2231] => Array
        (
            [0] => 2012-12-04 17:50:13
            [1] => http://www.ttgood.com/jy/t149683.htm
        )

    [2232] => Array
        (
            [0] => 2012-12-04 17:38:40
            [1] => http://www.ttgood.com/jy/t149293.htm
        )

    [2233] => Array
        (
            [0] => 2012-12-04 17:21:44
            [1] => http://www.ttgood.com/jy/t92072.htm
        )

    [2234] => Array
        (
            [0] => 2012-12-04 16:49:31
            [1] => http://www.ttgood.com/jy/t149759.htm
        )

    [2235] => Array
        (
            [0] => 2012-12-04 16:38:24
            [1] => http://www.ttgood.com/jy/t147537.htm
        )

    [2236] => Array
        (
            [0] => 2012-12-04 16:35:10
            [1] => http://www.ttgood.com/jy/t133570.htm
        )

    [2237] => Array
        (
            [0] => 2012-12-04 16:06:53
            [1] => http://www.ttgood.com/jy/t144365.htm
        )

    [2238] => Array
        (
            [0] => 2012-12-04 15:47:50
            [1] => http://www.ttgood.com/jy/t148917.htm
        )

    [2239] => Array
        (
            [0] => 2012-12-04 15:44:06
            [1] => http://www.ttgood.com/jy/t142195.htm
        )

    [2240] => Array
        (
            [0] => 2012-12-04 15:40:15
            [1] => http://www.ttgood.com/jy/t149106.htm
        )

    [2241] => Array
        (
            [0] => 2012-12-04 15:40:06
            [1] => http://www.ttgood.com/jy/t149123.htm
        )

    [2242] => Array
        (
            [0] => 2012-12-04 15:37:05
            [1] => http://www.ttgood.com/jy/t149493.htm
        )

    [2243] => Array
        (
            [0] => 2012-12-04 15:05:10
            [1] => http://www.ttgood.com/jy/t144806.htm
        )

    [2244] => Array
        (
            [0] => 2012-12-04 14:52:45
            [1] => http://www.ttgood.com/jy/t142459.htm
        )

    [2245] => Array
        (
            [0] => 2012-12-04 14:21:10
            [1] => http://www.ttgood.com/jy/t147405.htm
        )

    [2246] => Array
        (
            [0] => 2012-12-04 14:17:45
            [1] => http://www.ttgood.com/jy/t145521.htm
        )

    [2247] => Array
        (
            [0] => 2012-12-04 14:16:14
            [1] => http://www.ttgood.com/jy/t79782.htm
        )

    [2248] => Array
        (
            [0] => 2012-12-04 13:49:03
            [1] => http://www.ttgood.com/jy/t135981.htm
        )

    [2249] => Array
        (
            [0] => 2012-12-04 13:32:58
            [1] => http://www.ttgood.com/jy/t146117.htm
        )

    [2250] => Array
        (
            [0] => 2012-12-04 12:50:15
            [1] => http://www.ttgood.com/jy/t149133.htm
        )

    [2251] => Array
        (
            [0] => 2012-12-04 12:28:51
            [1] => http://www.ttgood.com/jy/t148510.htm
        )

    [2252] => Array
        (
            [0] => 2012-12-04 11:57:58
            [1] => http://www.ttgood.com/jy/t13075.htm
        )

    [2253] => Array
        (
            [0] => 2012-12-04 11:34:06
            [1] => http://www.ttgood.com/jy/t106314.htm
        )

    [2254] => Array
        (
            [0] => 2012-12-04 11:15:57
            [1] => http://www.ttgood.com/jy/t134943.htm
        )

    [2255] => Array
        (
            [0] => 2012-12-04 11:11:52
            [1] => http://www.ttgood.com/jy/t130084.htm
        )

    [2256] => Array
        (
            [0] => 2012-12-04 10:40:02
            [1] => http://www.ttgood.com/jy/t130658.htm
        )

    [2257] => Array
        (
            [0] => 2012-12-04 10:37:33
            [1] => http://www.ttgood.com/jy/t149301.htm
        )

    [2258] => Array
        (
            [0] => 2012-12-04 10:11:12
            [1] => http://www.ttgood.com/jy/t142481.htm
        )

    [2259] => Array
        (
            [0] => 2012-12-04 10:06:59
            [1] => http://www.ttgood.com/jy/t149719.htm
        )

    [2260] => Array
        (
            [0] => 2012-12-04 09:56:00
            [1] => http://www.ttgood.com/jy/t148649.htm
        )

    [2261] => Array
        (
            [0] => 2012-12-04 09:31:02
            [1] => http://www.ttgood.com/jy/t76702.htm
        )

    [2262] => Array
        (
            [0] => 2012-12-04 09:18:21
            [1] => http://www.ttgood.com/jy/t149773.htm
        )

    [2263] => Array
        (
            [0] => 2012-12-04 09:17:44
            [1] => http://www.ttgood.com/jy/t149767.htm
        )

    [2264] => Array
        (
            [0] => 2012-12-04 09:17:20
            [1] => http://www.ttgood.com/jy/t149762.htm
        )

    [2265] => Array
        (
            [0] => 2012-12-04 09:16:56
            [1] => http://www.ttgood.com/jy/t149756.htm
        )

    [2266] => Array
        (
            [0] => 2012-12-04 09:15:13
            [1] => http://www.ttgood.com/jy/t149751.htm
        )

    [2267] => Array
        (
            [0] => 2012-12-04 09:14:54
            [1] => http://www.ttgood.com/jy/t149749.htm
        )

    [2268] => Array
        (
            [0] => 2012-12-04 07:50:30
            [1] => http://www.ttgood.com/jy/t120022.htm
        )

    [2269] => Array
        (
            [0] => 2012-12-03 23:41:23
            [1] => http://www.ttgood.com/jy/t148088.htm
        )

    [2270] => Array
        (
            [0] => 2012-12-03 23:18:04
            [1] => http://www.ttgood.com/jy/t120165.htm
        )

    [2271] => Array
        (
            [0] => 2012-12-03 22:52:59
            [1] => http://www.ttgood.com/jy/t134383.htm
        )

    [2272] => Array
        (
            [0] => 2012-12-03 22:37:47
            [1] => http://www.ttgood.com/jy/t148940.htm
        )

    [2273] => Array
        (
            [0] => 2012-12-03 22:29:40
            [1] => http://www.ttgood.com/jy/t112503.htm
        )

    [2274] => Array
        (
            [0] => 2012-12-03 22:26:10
            [1] => http://www.ttgood.com/jy/t136131.htm
        )

    [2275] => Array
        (
            [0] => 2012-12-03 21:35:29
            [1] => http://www.ttgood.com/jy/t144249.htm
        )

    [2276] => Array
        (
            [0] => 2012-12-03 21:04:35
            [1] => http://www.ttgood.com/jy/t148800.htm
        )

    [2277] => Array
        (
            [0] => 2012-12-03 20:30:05
            [1] => http://www.ttgood.com/jy/t82569.htm
        )

    [2278] => Array
        (
            [0] => 2012-12-03 19:35:41
            [1] => http://www.ttgood.com/jy/t138756.htm
        )

    [2279] => Array
        (
            [0] => 2012-12-03 19:32:21
            [1] => http://www.ttgood.com/jy/t135003.htm
        )

    [2280] => Array
        (
            [0] => 2012-12-03 18:43:03
            [1] => http://www.ttgood.com/jy/t147203.htm
        )

    [2281] => Array
        (
            [0] => 2012-12-03 18:25:21
            [1] => http://www.ttgood.com/jy/t149518.htm
        )

    [2282] => Array
        (
            [0] => 2012-12-03 18:09:04
            [1] => http://www.ttgood.com/jy/t129460.htm
        )

    [2283] => Array
        (
            [0] => 2012-12-03 17:41:07
            [1] => http://www.ttgood.com/jy/t149727.htm
        )

    [2284] => Array
        (
            [0] => 2012-12-03 17:39:26
            [1] => http://www.ttgood.com/jy/t149599.htm
        )

    [2285] => Array
        (
            [0] => 2012-12-03 17:21:32
            [1] => http://www.ttgood.com/jy/t145220.htm
        )

    [2286] => Array
        (
            [0] => 2012-12-03 16:55:02
            [1] => http://www.ttgood.com/jy/t145742.htm
        )

    [2287] => Array
        (
            [0] => 2012-12-03 16:53:22
            [1] => http://www.ttgood.com/jy/t30190.htm
        )

    [2288] => Array
        (
            [0] => 2012-12-03 16:50:02
            [1] => http://www.ttgood.com/jy/t142942.htm
        )

    [2289] => Array
        (
            [0] => 2012-12-03 16:35:04
            [1] => http://www.ttgood.com/jy/t149136.htm
        )

    [2290] => Array
        (
            [0] => 2012-12-03 15:53:28
            [1] => http://www.ttgood.com/jy/t144267.htm
        )

    [2291] => Array
        (
            [0] => 2012-12-03 15:14:24
            [1] => http://www.ttgood.com/jy/t148856.htm
        )

    [2292] => Array
        (
            [0] => 2012-12-03 15:03:09
            [1] => http://www.ttgood.com/jy/t146663.htm
        )

    [2293] => Array
        (
            [0] => 2012-12-03 14:33:17
            [1] => http://www.ttgood.com/jy/t139002.htm
        )

    [2294] => Array
        (
            [0] => 2012-12-03 14:30:48
            [1] => http://www.ttgood.com/jy/t141514.htm
        )

    [2295] => Array
        (
            [0] => 2012-12-03 14:12:53
            [1] => http://www.ttgood.com/jy/t149232.htm
        )

    [2296] => Array
        (
            [0] => 2012-12-03 13:52:31
            [1] => http://www.ttgood.com/jy/t149730.htm
        )

    [2297] => Array
        (
            [0] => 2012-12-03 13:51:22
            [1] => http://www.ttgood.com/jy/t124505.htm
        )

    [2298] => Array
        (
            [0] => 2012-12-03 13:46:29
            [1] => http://www.ttgood.com/jy/t101645.htm
        )

    [2299] => Array
        (
            [0] => 2012-12-03 13:44:24
            [1] => http://www.ttgood.com/jy/t144842.htm
        )

    [2300] => Array
        (
            [0] => 2012-12-03 12:58:53
            [1] => http://www.ttgood.com/jy/t102259.htm
        )

    [2301] => Array
        (
            [0] => 2012-12-03 12:19:25
            [1] => http://www.ttgood.com/jy/t52104.htm
        )

    [2302] => Array
        (
            [0] => 2012-12-03 10:36:36
            [1] => http://www.ttgood.com/jy/t149593.htm
        )

    [2303] => Array
        (
            [0] => 2012-12-03 10:36:04
            [1] => http://www.ttgood.com/jy/t149735.htm
        )

    [2304] => Array
        (
            [0] => 2012-12-03 10:06:52
            [1] => http://www.ttgood.com/jy/t148075.htm
        )

    [2305] => Array
        (
            [0] => 2012-12-03 09:36:14
            [1] => http://www.ttgood.com/jy/t122055.htm
        )

    [2306] => Array
        (
            [0] => 2012-12-03 09:30:42
            [1] => http://www.ttgood.com/jy/t149717.htm
        )

    [2307] => Array
        (
            [0] => 2012-12-03 09:22:31
            [1] => http://www.ttgood.com/jy/t119252.htm
        )

    [2308] => Array
        (
            [0] => 2012-12-03 09:16:00
            [1] => http://www.ttgood.com/jy/t149746.htm
        )

    [2309] => Array
        (
            [0] => 2012-12-03 09:14:48
            [1] => http://www.ttgood.com/jy/t136361.htm
        )

    [2310] => Array
        (
            [0] => 2012-12-03 09:14:44
            [1] => http://www.ttgood.com/jy/t149743.htm
        )

    [2311] => Array
        (
            [0] => 2012-12-03 09:13:59
            [1] => http://www.ttgood.com/jy/t149721.htm
        )

    [2312] => Array
        (
            [0] => 2012-12-03 09:13:43
            [1] => http://www.ttgood.com/jy/t149722.htm
        )

    [2313] => Array
        (
            [0] => 2012-12-03 09:13:12
            [1] => http://www.ttgood.com/jy/t149724.htm
        )

    [2314] => Array
        (
            [0] => 2012-12-03 09:12:07
            [1] => http://www.ttgood.com/jy/t149728.htm
        )

    [2315] => Array
        (
            [0] => 2012-12-03 09:11:51
            [1] => http://www.ttgood.com/jy/t149729.htm
        )

    [2316] => Array
        (
            [0] => 2012-12-03 09:10:38
            [1] => http://www.ttgood.com/jy/t149734.htm
        )

    [2317] => Array
        (
            [0] => 2012-12-03 09:08:33
            [1] => http://www.ttgood.com/jy/t149738.htm
        )

    [2318] => Array
        (
            [0] => 2012-12-03 09:07:48
            [1] => http://www.ttgood.com/jy/t149739.htm
        )

    [2319] => Array
        (
            [0] => 2012-12-03 09:05:09
            [1] => http://www.ttgood.com/jy/t149718.htm
        )

    [2320] => Array
        (
            [0] => 2012-12-03 08:50:27
            [1] => http://www.ttgood.com/jy/t149266.htm
        )

    [2321] => Array
        (
            [0] => 2012-12-03 03:10:18
            [1] => http://www.ttgood.com/jy/t147652.htm
        )

    [2322] => Array
        (
            [0] => 2012-12-02 23:47:40
            [1] => http://www.ttgood.com/jy/t144055.htm
        )

    [2323] => Array
        (
            [0] => 2012-12-02 23:23:50
            [1] => http://www.ttgood.com/jy/t148971.htm
        )

    [2324] => Array
        (
            [0] => 2012-12-02 23:22:21
            [1] => http://www.ttgood.com/jy/t149466.htm
        )

    [2325] => Array
        (
            [0] => 2012-12-02 23:16:44
            [1] => http://www.ttgood.com/jy/t148670.htm
        )

    [2326] => Array
        (
            [0] => 2012-12-02 21:53:50
            [1] => http://www.ttgood.com/jy/t148891.htm
        )

    [2327] => Array
        (
            [0] => 2012-12-02 21:32:17
            [1] => http://www.ttgood.com/jy/t139464.htm
        )

    [2328] => Array
        (
            [0] => 2012-12-02 21:29:39
            [1] => http://www.ttgood.com/jy/t146511.htm
        )

    [2329] => Array
        (
            [0] => 2012-12-02 20:57:47
            [1] => http://www.ttgood.com/jy/t149351.htm
        )

    [2330] => Array
        (
            [0] => 2012-12-02 20:19:31
            [1] => http://www.ttgood.com/jy/t145990.htm
        )

    [2331] => Array
        (
            [0] => 2012-12-02 20:00:29
            [1] => http://www.ttgood.com/jy/t149012.htm
        )

    [2332] => Array
        (
            [0] => 2012-12-02 19:49:32
            [1] => http://www.ttgood.com/jy/t79539.htm
        )

    [2333] => Array
        (
            [0] => 2012-12-02 19:16:21
            [1] => http://www.ttgood.com/jy/t143215.htm
        )

    [2334] => Array
        (
            [0] => 2012-12-02 18:42:06
            [1] => http://www.ttgood.com/jy/t135888.htm
        )

    [2335] => Array
        (
            [0] => 2012-12-02 18:25:13
            [1] => http://www.ttgood.com/jy/t147123.htm
        )

    [2336] => Array
        (
            [0] => 2012-12-02 17:01:29
            [1] => http://www.ttgood.com/jy/t149674.htm
        )

    [2337] => Array
        (
            [0] => 2012-12-02 15:29:51
            [1] => http://www.ttgood.com/jy/t146412.htm
        )

    [2338] => Array
        (
            [0] => 2012-12-02 14:54:53
            [1] => http://www.ttgood.com/jy/t139647.htm
        )

    [2339] => Array
        (
            [0] => 2012-12-02 14:47:03
            [1] => http://www.ttgood.com/jy/t57494.htm
        )

    [2340] => Array
        (
            [0] => 2012-12-02 14:41:02
            [1] => http://www.ttgood.com/jy/t149104.htm
        )

    [2341] => Array
        (
            [0] => 2012-12-02 13:48:44
            [1] => http://www.ttgood.com/jy/t148756.htm
        )

    [2342] => Array
        (
            [0] => 2012-12-02 13:41:51
            [1] => http://www.ttgood.com/jy/t149265.htm
        )

    [2343] => Array
        (
            [0] => 2012-12-02 13:00:03
            [1] => http://www.ttgood.com/jy/t149709.htm
        )

    [2344] => Array
        (
            [0] => 2012-12-02 12:50:08
            [1] => http://www.ttgood.com/jy/t143019.htm
        )

    [2345] => Array
        (
            [0] => 2012-12-02 12:45:18
            [1] => http://www.ttgood.com/jy/t149067.htm
        )

    [2346] => Array
        (
            [0] => 2012-12-02 12:14:24
            [1] => http://www.ttgood.com/jy/t138954.htm
        )

    [2347] => Array
        (
            [0] => 2012-12-02 12:06:16
            [1] => http://www.ttgood.com/jy/t132863.htm
        )

    [2348] => Array
        (
            [0] => 2012-12-02 11:52:46
            [1] => http://www.ttgood.com/jy/t131075.htm
        )

    [2349] => Array
        (
            [0] => 2012-12-02 11:03:51
            [1] => http://www.ttgood.com/jy/t120983.htm
        )

    [2350] => Array
        (
            [0] => 2012-12-02 10:57:23
            [1] => http://www.ttgood.com/jy/t136936.htm
        )

    [2351] => Array
        (
            [0] => 2012-12-02 10:32:55
            [1] => http://www.ttgood.com/jy/t114745.htm
        )

    [2352] => Array
        (
            [0] => 2012-12-02 09:43:45
            [1] => http://www.ttgood.com/jy/t149536.htm
        )

    [2353] => Array
        (
            [0] => 2012-12-02 09:38:53
            [1] => http://www.ttgood.com/jy/t139744.htm
        )

    [2354] => Array
        (
            [0] => 2012-12-02 09:23:25
            [1] => http://www.ttgood.com/jy/t147563.htm
        )

    [2355] => Array
        (
            [0] => 2012-12-02 09:04:35
            [1] => http://www.ttgood.com/jy/t149710.htm
        )

    [2356] => Array
        (
            [0] => 2012-12-02 09:04:13
            [1] => http://www.ttgood.com/jy/t149708.htm
        )

    [2357] => Array
        (
            [0] => 2012-12-02 09:03:56
            [1] => http://www.ttgood.com/jy/t149706.htm
        )

    [2358] => Array
        (
            [0] => 2012-12-02 09:03:29
            [1] => http://www.ttgood.com/jy/t149704.htm
        )

    [2359] => Array
        (
            [0] => 2012-12-02 09:03:21
            [1] => http://www.ttgood.com/jy/t149703.htm
        )

    [2360] => Array
        (
            [0] => 2012-12-02 00:39:41
            [1] => http://www.ttgood.com/jy/t146187.htm
        )

    [2361] => Array
        (
            [0] => 2012-12-01 22:51:49
            [1] => http://www.ttgood.com/jy/t149691.htm
        )

    [2362] => Array
        (
            [0] => 2012-12-01 22:43:05
            [1] => http://www.ttgood.com/jy/t147352.htm
        )

    [2363] => Array
        (
            [0] => 2012-12-01 22:11:49
            [1] => http://www.ttgood.com/jy/t64500.htm
        )

    [2364] => Array
        (
            [0] => 2012-12-01 21:57:37
            [1] => http://www.ttgood.com/jy/t147320.htm
        )

    [2365] => Array
        (
            [0] => 2012-12-01 21:35:07
            [1] => http://www.ttgood.com/jy/t149512.htm
        )

    [2366] => Array
        (
            [0] => 2012-12-01 20:36:56
            [1] => http://www.ttgood.com/jy/t149125.htm
        )

    [2367] => Array
        (
            [0] => 2012-12-01 19:49:12
            [1] => http://www.ttgood.com/jy/t146000.htm
        )

    [2368] => Array
        (
            [0] => 2012-12-01 19:39:11
            [1] => http://www.ttgood.com/jy/t143025.htm
        )

    [2369] => Array
        (
            [0] => 2012-12-01 19:01:12
            [1] => http://www.ttgood.com/jy/t98209.htm
        )

    [2370] => Array
        (
            [0] => 2012-12-01 17:12:23
            [1] => http://www.ttgood.com/jy/t146072.htm
        )

    [2371] => Array
        (
            [0] => 2012-12-01 17:11:12
            [1] => http://www.ttgood.com/jy/t147614.htm
        )

    [2372] => Array
        (
            [0] => 2012-12-01 17:00:24
            [1] => http://www.ttgood.com/jy/t136999.htm
        )

    [2373] => Array
        (
            [0] => 2012-12-01 16:47:35
            [1] => http://www.ttgood.com/jy/t148415.htm
        )

    [2374] => Array
        (
            [0] => 2012-12-01 16:42:06
            [1] => http://www.ttgood.com/jy/t149453.htm
        )

    [2375] => Array
        (
            [0] => 2012-12-01 16:36:27
            [1] => http://www.ttgood.com/jy/t146325.htm
        )

    [2376] => Array
        (
            [0] => 2012-12-01 16:22:43
            [1] => http://www.ttgood.com/jy/t102852.htm
        )

    [2377] => Array
        (
            [0] => 2012-12-01 16:02:32
            [1] => http://www.ttgood.com/jy/t149222.htm
        )

    [2378] => Array
        (
            [0] => 2012-12-01 15:57:02
            [1] => http://www.ttgood.com/jy/t146273.htm
        )

    [2379] => Array
        (
            [0] => 2012-12-01 15:13:48
            [1] => http://www.ttgood.com/jy/t139134.htm
        )

    [2380] => Array
        (
            [0] => 2012-12-01 15:09:44
            [1] => http://www.ttgood.com/jy/t105850.htm
        )

    [2381] => Array
        (
            [0] => 2012-12-01 14:48:14
            [1] => http://www.ttgood.com/jy/t148622.htm
        )

    [2382] => Array
        (
            [0] => 2012-12-01 14:46:03
            [1] => http://www.ttgood.com/jy/t111161.htm
        )

    [2383] => Array
        (
            [0] => 2012-12-01 13:58:22
            [1] => http://www.ttgood.com/jy/t149681.htm
        )

    [2384] => Array
        (
            [0] => 2012-12-01 11:43:55
            [1] => http://www.ttgood.com/jy/t149212.htm
        )

    [2385] => Array
        (
            [0] => 2012-12-01 11:29:56
            [1] => http://www.ttgood.com/jy/t143938.htm
        )

    [2386] => Array
        (
            [0] => 2012-12-01 11:22:06
            [1] => http://www.ttgood.com/jy/t133546.htm
        )

    [2387] => Array
        (
            [0] => 2012-12-01 10:52:35
            [1] => http://www.ttgood.com/jy/t131401.htm
        )

    [2388] => Array
        (
            [0] => 2012-12-01 09:53:54
            [1] => http://www.ttgood.com/jy/t138422.htm
        )

    [2389] => Array
        (
            [0] => 2012-12-01 09:13:37
            [1] => http://www.ttgood.com/jy/t149696.htm
        )

    [2390] => Array
        (
            [0] => 2012-12-01 09:13:31
            [1] => http://www.ttgood.com/jy/t149695.htm
        )

    [2391] => Array
        (
            [0] => 2012-12-01 09:13:24
            [1] => http://www.ttgood.com/jy/t149694.htm
        )

    [2392] => Array
        (
            [0] => 2012-12-01 09:10:00
            [1] => http://www.ttgood.com/jy/t149679.htm
        )

    [2393] => Array
        (
            [0] => 2012-12-01 09:09:30
            [1] => http://www.ttgood.com/jy/t149675.htm
        )

    [2394] => Array
        (
            [0] => 2012-12-01 09:09:02
            [1] => http://www.ttgood.com/jy/t149673.htm
        )

    [2395] => Array
        (
            [0] => 2012-12-01 09:08:05
            [1] => http://www.ttgood.com/jy/t149669.htm
        )

    [2396] => Array
        (
            [0] => 2012-12-01 01:13:16
            [1] => http://www.ttgood.com/jy/t146488.htm
        )

    [2397] => Array
        (
            [0] => 2012-11-30 23:36:21
            [1] => http://www.ttgood.com/jy/t127600.htm
        )

    [2398] => Array
        (
            [0] => 2012-11-30 23:01:36
            [1] => http://www.ttgood.com/jy/t146595.htm
        )

    [2399] => Array
        (
            [0] => 2012-11-30 22:52:07
            [1] => http://www.ttgood.com/jy/t147113.htm
        )

    [2400] => Array
        (
            [0] => 2012-11-30 20:21:00
            [1] => http://www.ttgood.com/jy/t148568.htm
        )

    [2401] => Array
        (
            [0] => 2012-11-30 19:38:01
            [1] => http://www.ttgood.com/jy/t135873.htm
        )

    [2402] => Array
        (
            [0] => 2012-11-30 19:28:40
            [1] => http://www.ttgood.com/jy/t148047.htm
        )

    [2403] => Array
        (
            [0] => 2012-11-30 19:04:25
            [1] => http://www.ttgood.com/jy/t141993.htm
        )

    [2404] => Array
        (
            [0] => 2012-11-30 18:40:46
            [1] => http://www.ttgood.com/jy/t147554.htm
        )

    [2405] => Array
        (
            [0] => 2012-11-30 18:06:37
            [1] => http://www.ttgood.com/jy/t146248.htm
        )

    [2406] => Array
        (
            [0] => 2012-11-30 17:22:07
            [1] => http://www.ttgood.com/jy/t148028.htm
        )

    [2407] => Array
        (
            [0] => 2012-11-30 17:11:01
            [1] => http://www.ttgood.com/jy/t149603.htm
        )

    [2408] => Array
        (
            [0] => 2012-11-30 17:09:17
            [1] => http://www.ttgood.com/jy/t124248.htm
        )

    [2409] => Array
        (
            [0] => 2012-11-30 16:33:55
            [1] => http://www.ttgood.com/jy/t148306.htm
        )

    [2410] => Array
        (
            [0] => 2012-11-30 16:15:37
            [1] => http://www.ttgood.com/jy/t148952.htm
        )

    [2411] => Array
        (
            [0] => 2012-11-30 16:12:16
            [1] => http://www.ttgood.com/jy/t149503.htm
        )

    [2412] => Array
        (
            [0] => 2012-11-30 15:34:54
            [1] => http://www.ttgood.com/jy/t146593.htm
        )

    [2413] => Array
        (
            [0] => 2012-11-30 15:33:54
            [1] => http://www.ttgood.com/jy/t133833.htm
        )

    [2414] => Array
        (
            [0] => 2012-11-30 15:33:25
            [1] => http://www.ttgood.com/jy/t145263.htm
        )

    [2415] => Array
        (
            [0] => 2012-11-30 14:48:36
            [1] => http://www.ttgood.com/jy/t149202.htm
        )

    [2416] => Array
        (
            [0] => 2012-11-30 14:08:48
            [1] => http://www.ttgood.com/jy/t133533.htm
        )

    [2417] => Array
        (
            [0] => 2012-11-30 13:49:52
            [1] => http://www.ttgood.com/jy/t149455.htm
        )

    [2418] => Array
        (
            [0] => 2012-11-30 13:47:38
            [1] => http://www.ttgood.com/jy/t47886.htm
        )

    [2419] => Array
        (
            [0] => 2012-11-30 13:46:55
            [1] => http://www.ttgood.com/jy/t145810.htm
        )

    [2420] => Array
        (
            [0] => 2012-11-30 13:31:05
            [1] => http://www.ttgood.com/jy/t147493.htm
        )

    [2421] => Array
        (
            [0] => 2012-11-30 13:11:43
            [1] => http://www.ttgood.com/jy/t148114.htm
        )

    [2422] => Array
        (
            [0] => 2012-11-30 13:01:22
            [1] => http://www.ttgood.com/jy/t145261.htm
        )

    [2423] => Array
        (
            [0] => 2012-11-30 12:14:46
            [1] => http://www.ttgood.com/jy/t149371.htm
        )

    [2424] => Array
        (
            [0] => 2012-11-30 12:02:17
            [1] => http://www.ttgood.com/jy/t148830.htm
        )

    [2425] => Array
        (
            [0] => 2012-11-30 11:25:55
            [1] => http://www.ttgood.com/jy/t139181.htm
        )

    [2426] => Array
        (
            [0] => 2012-11-30 11:03:07
            [1] => http://www.ttgood.com/jy/t129925.htm
        )

    [2427] => Array
        (
            [0] => 2012-11-30 10:55:49
            [1] => http://www.ttgood.com/jy/t146754.htm
        )

    [2428] => Array
        (
            [0] => 2012-11-30 10:44:41
            [1] => http://www.ttgood.com/jy/t149633.htm
        )

    [2429] => Array
        (
            [0] => 2012-11-30 10:22:27
            [1] => http://www.ttgood.com/jy/t134321.htm
        )

    [2430] => Array
        (
            [0] => 2012-11-30 10:04:06
            [1] => http://www.ttgood.com/jy/t91199.htm
        )

    [2431] => Array
        (
            [0] => 2012-11-30 09:52:39
            [1] => http://www.ttgood.com/jy/t148327.htm
        )

    [2432] => Array
        (
            [0] => 2012-11-30 09:48:13
            [1] => http://www.ttgood.com/jy/t149664.htm
        )

    [2433] => Array
        (
            [0] => 2012-11-30 09:47:45
            [1] => http://www.ttgood.com/jy/t149662.htm
        )

    [2434] => Array
        (
            [0] => 2012-11-30 09:47:33
            [1] => http://www.ttgood.com/jy/t149661.htm
        )

    [2435] => Array
        (
            [0] => 2012-11-30 09:46:59
            [1] => http://www.ttgood.com/jy/t149659.htm
        )

    [2436] => Array
        (
            [0] => 2012-11-30 09:33:13
            [1] => http://www.ttgood.com/jy/t149654.htm
        )

    [2437] => Array
        (
            [0] => 2012-11-30 09:23:55
            [1] => http://www.ttgood.com/jy/t87710.htm
        )

    [2438] => Array
        (
            [0] => 2012-11-30 09:20:40
            [1] => http://www.ttgood.com/jy/t149653.htm
        )

    [2439] => Array
        (
            [0] => 2012-11-30 09:19:19
            [1] => http://www.ttgood.com/jy/t149648.htm
        )

    [2440] => Array
        (
            [0] => 2012-11-30 09:18:17
            [1] => http://www.ttgood.com/jy/t149647.htm
        )

    [2441] => Array
        (
            [0] => 2012-11-30 09:17:58
            [1] => http://www.ttgood.com/jy/t149646.htm
        )

    [2442] => Array
        (
            [0] => 2012-11-30 09:17:24
            [1] => http://www.ttgood.com/jy/t149645.htm
        )

    [2443] => Array
        (
            [0] => 2012-11-30 09:06:45
            [1] => http://www.ttgood.com/jy/t149641.htm
        )

    [2444] => Array
        (
            [0] => 2012-11-30 08:42:12
            [1] => http://www.ttgood.com/jy/t146247.htm
        )

    [2445] => Array
        (
            [0] => 2012-11-30 07:55:01
            [1] => http://www.ttgood.com/jy/t50185.htm
        )

    [2446] => Array
        (
            [0] => 2012-11-30 01:53:05
            [1] => http://www.ttgood.com/jy/t136976.htm
        )

    [2447] => Array
        (
            [0] => 2012-11-30 00:24:44
            [1] => http://www.ttgood.com/jy/t39280.htm
        )

    [2448] => Array
        (
            [0] => 2012-11-29 23:30:51
            [1] => http://www.ttgood.com/jy/t140433.htm
        )

    [2449] => Array
        (
            [0] => 2012-11-29 22:57:52
            [1] => http://www.ttgood.com/jy/t143011.htm
        )

    [2450] => Array
        (
            [0] => 2012-11-29 22:17:31
            [1] => http://www.ttgood.com/jy/t147547.htm
        )

    [2451] => Array
        (
            [0] => 2012-11-29 21:10:39
            [1] => http://www.ttgood.com/jy/t124887.htm
        )

    [2452] => Array
        (
            [0] => 2012-11-29 20:44:25
            [1] => http://www.ttgood.com/jy/t21216.htm
        )

    [2453] => Array
        (
            [0] => 2012-11-29 20:22:59
            [1] => http://www.ttgood.com/jy/t146623.htm
        )

    [2454] => Array
        (
            [0] => 2012-11-29 19:52:12
            [1] => http://www.ttgood.com/jy/t140545.htm
        )

    [2455] => Array
        (
            [0] => 2012-11-29 19:31:55
            [1] => http://www.ttgood.com/jy/t138911.htm
        )

    [2456] => Array
        (
            [0] => 2012-11-29 18:48:23
            [1] => http://www.ttgood.com/jy/t148353.htm
        )

    [2457] => Array
        (
            [0] => 2012-11-29 18:39:43
            [1] => http://www.ttgood.com/jy/t148644.htm
        )

    [2458] => Array
        (
            [0] => 2012-11-29 18:19:53
            [1] => http://www.ttgood.com/jy/t147097.htm
        )

    [2459] => Array
        (
            [0] => 2012-11-29 18:11:06
            [1] => http://www.ttgood.com/jy/t147565.htm
        )

    [2460] => Array
        (
            [0] => 2012-11-29 18:10:39
            [1] => http://www.ttgood.com/jy/t148738.htm
        )

    [2461] => Array
        (
            [0] => 2012-11-29 17:51:29
            [1] => http://www.ttgood.com/jy/t149472.htm
        )

    [2462] => Array
        (
            [0] => 2012-11-29 17:04:49
            [1] => http://www.ttgood.com/jy/t149176.htm
        )

    [2463] => Array
        (
            [0] => 2012-11-29 16:32:14
            [1] => http://www.ttgood.com/jy/t149636.htm
        )

    [2464] => Array
        (
            [0] => 2012-11-29 16:02:43
            [1] => http://www.ttgood.com/jy/t131405.htm
        )

    [2465] => Array
        (
            [0] => 2012-11-29 15:44:53
            [1] => http://www.ttgood.com/jy/t139501.htm
        )

    [2466] => Array
        (
            [0] => 2012-11-29 15:39:21
            [1] => http://www.ttgood.com/jy/t149356.htm
        )

    [2467] => Array
        (
            [0] => 2012-11-29 15:20:55
            [1] => http://www.ttgood.com/jy/t127543.htm
        )

    [2468] => Array
        (
            [0] => 2012-11-29 15:11:51
            [1] => http://www.ttgood.com/jy/t133428.htm
        )

    [2469] => Array
        (
            [0] => 2012-11-29 14:58:55
            [1] => http://www.ttgood.com/jy/t141093.htm
        )

    [2470] => Array
        (
            [0] => 2012-11-29 14:52:21
            [1] => http://www.ttgood.com/jy/t145384.htm
        )

    [2471] => Array
        (
            [0] => 2012-11-29 14:34:40
            [1] => http://www.ttgood.com/jy/t145600.htm
        )

    [2472] => Array
        (
            [0] => 2012-11-29 14:33:54
            [1] => http://www.ttgood.com/jy/t149376.htm
        )

    [2473] => Array
        (
            [0] => 2012-11-29 14:21:40
            [1] => http://www.ttgood.com/jy/t145350.htm
        )

    [2474] => Array
        (
            [0] => 2012-11-29 14:19:04
            [1] => http://www.ttgood.com/jy/t138521.htm
        )

    [2475] => Array
        (
            [0] => 2012-11-29 14:14:54
            [1] => http://www.ttgood.com/jy/t111689.htm
        )

    [2476] => Array
        (
            [0] => 2012-11-29 14:02:58
            [1] => http://www.ttgood.com/jy/t149341.htm
        )

    [2477] => Array
        (
            [0] => 2012-11-29 14:01:12
            [1] => http://www.ttgood.com/jy/t146310.htm
        )

    [2478] => Array
        (
            [0] => 2012-11-29 13:53:54
            [1] => http://www.ttgood.com/jy/t149270.htm
        )

    [2479] => Array
        (
            [0] => 2012-11-29 13:21:03
            [1] => http://www.ttgood.com/jy/t7097.htm
        )

    [2480] => Array
        (
            [0] => 2012-11-29 13:10:51
            [1] => http://www.ttgood.com/jy/t146638.htm
        )

    [2481] => Array
        (
            [0] => 2012-11-29 11:24:11
            [1] => http://www.ttgood.com/jy/t149139.htm
        )

    [2482] => Array
        (
            [0] => 2012-11-29 11:19:40
            [1] => http://www.ttgood.com/jy/t141716.htm
        )

    [2483] => Array
        (
            [0] => 2012-11-29 11:07:51
            [1] => http://www.ttgood.com/jy/t139704.htm
        )

    [2484] => Array
        (
            [0] => 2012-11-29 10:20:31
            [1] => http://www.ttgood.com/jy/t149604.htm
        )

    [2485] => Array
        (
            [0] => 2012-11-29 10:03:29
            [1] => http://www.ttgood.com/jy/t122756.htm
        )

    [2486] => Array
        (
            [0] => 2012-11-29 09:49:11
            [1] => http://www.ttgood.com/jy/t140162.htm
        )

    [2487] => Array
        (
            [0] => 2012-11-29 09:30:39
            [1] => http://www.ttgood.com/jy/t149638.htm
        )

    [2488] => Array
        (
            [0] => 2012-11-29 09:29:14
            [1] => http://www.ttgood.com/jy/t149630.htm
        )

    [2489] => Array
        (
            [0] => 2012-11-29 09:10:40
            [1] => http://www.ttgood.com/jy/t77351.htm
        )

    [2490] => Array
        (
            [0] => 2012-11-29 09:08:25
            [1] => http://www.ttgood.com/jy/t138527.htm
        )

    [2491] => Array
        (
            [0] => 2012-11-29 09:03:57
            [1] => http://www.ttgood.com/jy/t90930.htm
        )

    [2492] => Array
        (
            [0] => 2012-11-29 09:03:33
            [1] => http://www.ttgood.com/jy/t149624.htm
        )

    [2493] => Array
        (
            [0] => 2012-11-29 09:01:55
            [1] => http://www.ttgood.com/jy/t149614.htm
        )

    [2494] => Array
        (
            [0] => 2012-11-29 08:45:06
            [1] => http://www.ttgood.com/jy/t149580.htm
        )

    [2495] => Array
        (
            [0] => 2012-11-29 06:46:58
            [1] => http://www.ttgood.com/jy/t133171.htm
        )

    [2496] => Array
        (
            [0] => 2012-11-29 04:01:18
            [1] => http://www.ttgood.com/jy/t66537.htm
        )

    [2497] => Array
        (
            [0] => 2012-11-29 01:35:36
            [1] => http://www.ttgood.com/jy/t128554.htm
        )

    [2498] => Array
        (
            [0] => 2012-11-28 23:50:59
            [1] => http://www.ttgood.com/jy/t138877.htm
        )

    [2499] => Array
        (
            [0] => 2012-11-28 22:50:31
            [1] => http://www.ttgood.com/jy/t149319.htm
        )

    [2500] => Array
        (
            [0] => 2012-11-28 22:28:46
            [1] => http://www.ttgood.com/jy/t41969.htm
        )

    [2501] => Array
        (
            [0] => 2012-11-28 22:06:04
            [1] => http://www.ttgood.com/jy/t80014.htm
        )

    [2502] => Array
        (
            [0] => 2012-11-28 20:45:40
            [1] => http://www.ttgood.com/jy/t131338.htm
        )

    [2503] => Array
        (
            [0] => 2012-11-28 20:42:59
            [1] => http://www.ttgood.com/jy/t146782.htm
        )

    [2504] => Array
        (
            [0] => 2012-11-28 20:31:47
            [1] => http://www.ttgood.com/jy/t141684.htm
        )

    [2505] => Array
        (
            [0] => 2012-11-28 20:20:44
            [1] => http://www.ttgood.com/jy/t143314.htm
        )

    [2506] => Array
        (
            [0] => 2012-11-28 20:01:24
            [1] => http://www.ttgood.com/jy/t147875.htm
        )

    [2507] => Array
        (
            [0] => 2012-11-28 18:56:16
            [1] => http://www.ttgood.com/jy/t128053.htm
        )

    [2508] => Array
        (
            [0] => 2012-11-28 18:42:42
            [1] => http://www.ttgood.com/jy/t148908.htm
        )

    [2509] => Array
        (
            [0] => 2012-11-28 18:39:54
            [1] => http://www.ttgood.com/jy/t141624.htm
        )

    [2510] => Array
        (
            [0] => 2012-11-28 18:31:28
            [1] => http://www.ttgood.com/jy/t148285.htm
        )

    [2511] => Array
        (
            [0] => 2012-11-28 18:02:04
            [1] => http://www.ttgood.com/jy/t147729.htm
        )

    [2512] => Array
        (
            [0] => 2012-11-28 17:54:30
            [1] => http://www.ttgood.com/jy/t146389.htm
        )

    [2513] => Array
        (
            [0] => 2012-11-28 17:15:48
            [1] => http://www.ttgood.com/jy/t113079.htm
        )

    [2514] => Array
        (
            [0] => 2012-11-28 17:12:19
            [1] => http://www.ttgood.com/jy/t148228.htm
        )

    [2515] => Array
        (
            [0] => 2012-11-28 17:09:09
            [1] => http://www.ttgood.com/jy/t136253.htm
        )

    [2516] => Array
        (
            [0] => 2012-11-28 16:30:32
            [1] => http://www.ttgood.com/jy/t149357.htm
        )

    [2517] => Array
        (
            [0] => 2012-11-28 15:56:34
            [1] => http://www.ttgood.com/jy/t122566.htm
        )

    [2518] => Array
        (
            [0] => 2012-11-28 15:14:16
            [1] => http://www.ttgood.com/jy/t148923.htm
        )

    [2519] => Array
        (
            [0] => 2012-11-28 15:01:13
            [1] => http://www.ttgood.com/jy/t133960.htm
        )

    [2520] => Array
        (
            [0] => 2012-11-28 14:29:59
            [1] => http://www.ttgood.com/jy/t135135.htm
        )

    [2521] => Array
        (
            [0] => 2012-11-28 11:42:33
            [1] => http://www.ttgood.com/jy/t146281.htm
        )

    [2522] => Array
        (
            [0] => 2012-11-28 11:42:16
            [1] => http://www.ttgood.com/jy/t149552.htm
        )

    [2523] => Array
        (
            [0] => 2012-11-28 11:30:56
            [1] => http://www.ttgood.com/jy/t82929.htm
        )

    [2524] => Array
        (
            [0] => 2012-11-28 11:24:28
            [1] => http://www.ttgood.com/jy/t147653.htm
        )

    [2525] => Array
        (
            [0] => 2012-11-28 11:17:29
            [1] => http://www.ttgood.com/jy/t146656.htm
        )

    [2526] => Array
        (
            [0] => 2012-11-28 11:17:04
            [1] => http://www.ttgood.com/jy/t118613.htm
        )

    [2527] => Array
        (
            [0] => 2012-11-28 11:08:28
            [1] => http://www.ttgood.com/jy/t148648.htm
        )

    [2528] => Array
        (
            [0] => 2012-11-28 10:54:40
            [1] => http://www.ttgood.com/jy/t149557.htm
        )

    [2529] => Array
        (
            [0] => 2012-11-28 10:33:14
            [1] => http://www.ttgood.com/jy/t142453.htm
        )

    [2530] => Array
        (
            [0] => 2012-11-28 09:36:57
            [1] => http://www.ttgood.com/jy/t117131.htm
        )

    [2531] => Array
        (
            [0] => 2012-11-28 09:22:51
            [1] => http://www.ttgood.com/jy/t149606.htm
        )

    [2532] => Array
        (
            [0] => 2012-11-28 09:22:39
            [1] => http://www.ttgood.com/jy/t149605.htm
        )

    [2533] => Array
        (
            [0] => 2012-11-28 09:21:40
            [1] => http://www.ttgood.com/jy/t149601.htm
        )

    [2534] => Array
        (
            [0] => 2012-11-28 09:18:49
            [1] => http://www.ttgood.com/jy/t149596.htm
        )

    [2535] => Array
        (
            [0] => 2012-11-28 09:18:26
            [1] => http://www.ttgood.com/jy/t149594.htm
        )

    [2536] => Array
        (
            [0] => 2012-11-28 09:12:05
            [1] => http://www.ttgood.com/jy/t149589.htm
        )

    [2537] => Array
        (
            [0] => 2012-11-27 23:02:20
            [1] => http://www.ttgood.com/jy/t123495.htm
        )

    [2538] => Array
        (
            [0] => 2012-11-27 22:47:58
            [1] => http://www.ttgood.com/jy/t149569.htm
        )

    [2539] => Array
        (
            [0] => 2012-11-27 22:13:33
            [1] => http://www.ttgood.com/jy/t148428.htm
        )

    [2540] => Array
        (
            [0] => 2012-11-27 22:09:58
            [1] => http://www.ttgood.com/jy/t149556.htm
        )

    [2541] => Array
        (
            [0] => 2012-11-27 21:18:59
            [1] => http://www.ttgood.com/jy/t144637.htm
        )

    [2542] => Array
        (
            [0] => 2012-11-27 21:10:06
            [1] => http://www.ttgood.com/jy/t149584.htm
        )

    [2543] => Array
        (
            [0] => 2012-11-27 21:06:42
            [1] => http://www.ttgood.com/jy/t149051.htm
        )

    [2544] => Array
        (
            [0] => 2012-11-27 21:00:01
            [1] => http://www.ttgood.com/jy/t148336.htm
        )

    [2545] => Array
        (
            [0] => 2012-11-27 20:57:26
            [1] => http://www.ttgood.com/jy/t144904.htm
        )

    [2546] => Array
        (
            [0] => 2012-11-27 20:01:43
            [1] => http://www.ttgood.com/jy/t144986.htm
        )

    [2547] => Array
        (
            [0] => 2012-11-27 20:00:10
            [1] => http://www.ttgood.com/jy/t138786.htm
        )

    [2548] => Array
        (
            [0] => 2012-11-27 19:56:04
            [1] => http://www.ttgood.com/jy/t127669.htm
        )

    [2549] => Array
        (
            [0] => 2012-11-27 19:38:47
            [1] => http://www.ttgood.com/jy/t146022.htm
        )

    [2550] => Array
        (
            [0] => 2012-11-27 19:22:37
            [1] => http://www.ttgood.com/jy/t146689.htm
        )

    [2551] => Array
        (
            [0] => 2012-11-27 19:01:49
            [1] => http://www.ttgood.com/jy/t149333.htm
        )

    [2552] => Array
        (
            [0] => 2012-11-27 18:45:18
            [1] => http://www.ttgood.com/jy/t146715.htm
        )

    [2553] => Array
        (
            [0] => 2012-11-27 18:23:29
            [1] => http://www.ttgood.com/jy/t87981.htm
        )

    [2554] => Array
        (
            [0] => 2012-11-27 17:48:09
            [1] => http://www.ttgood.com/jy/t148241.htm
        )

    [2555] => Array
        (
            [0] => 2012-11-27 17:45:11
            [1] => http://www.ttgood.com/jy/t149458.htm
        )

    [2556] => Array
        (
            [0] => 2012-11-27 17:33:58
            [1] => http://www.ttgood.com/jy/t144907.htm
        )

    [2557] => Array
        (
            [0] => 2012-11-27 16:52:38
            [1] => http://www.ttgood.com/jy/t149201.htm
        )

    [2558] => Array
        (
            [0] => 2012-11-27 16:47:16
            [1] => http://www.ttgood.com/jy/t139580.htm
        )

    [2559] => Array
        (
            [0] => 2012-11-27 16:31:40
            [1] => http://www.ttgood.com/jy/t149483.htm
        )

    [2560] => Array
        (
            [0] => 2012-11-27 16:23:45
            [1] => http://www.ttgood.com/jy/t143483.htm
        )

    [2561] => Array
        (
            [0] => 2012-11-27 16:16:48
            [1] => http://www.ttgood.com/jy/t149310.htm
        )

    [2562] => Array
        (
            [0] => 2012-11-27 16:11:09
            [1] => http://www.ttgood.com/jy/t142445.htm
        )

    [2563] => Array
        (
            [0] => 2012-11-27 16:03:59
            [1] => http://www.ttgood.com/jy/t140345.htm
        )

    [2564] => Array
        (
            [0] => 2012-11-27 16:03:03
            [1] => http://www.ttgood.com/jy/t149564.htm
        )

    [2565] => Array
        (
            [0] => 2012-11-27 15:54:54
            [1] => http://www.ttgood.com/jy/t149408.htm
        )

    [2566] => Array
        (
            [0] => 2012-11-27 15:29:15
            [1] => http://www.ttgood.com/jy/t136678.htm
        )

    [2567] => Array
        (
            [0] => 2012-11-27 15:23:53
            [1] => http://www.ttgood.com/jy/t149454.htm
        )

    [2568] => Array
        (
            [0] => 2012-11-27 14:38:52
            [1] => http://www.ttgood.com/jy/t148886.htm
        )

    [2569] => Array
        (
            [0] => 2012-11-27 14:13:49
            [1] => http://www.ttgood.com/jy/t147297.htm
        )

    [2570] => Array
        (
            [0] => 2012-11-27 14:06:35
            [1] => http://www.ttgood.com/jy/t145310.htm
        )

    [2571] => Array
        (
            [0] => 2012-11-27 13:52:51
            [1] => http://www.ttgood.com/jy/t149547.htm
        )

    [2572] => Array
        (
            [0] => 2012-11-27 13:45:46
            [1] => http://www.ttgood.com/jy/t130477.htm
        )

    [2573] => Array
        (
            [0] => 2012-11-27 13:17:21
            [1] => http://www.ttgood.com/jy/t147548.htm
        )

    [2574] => Array
        (
            [0] => 2012-11-27 13:03:43
            [1] => http://www.ttgood.com/jy/t139067.htm
        )

    [2575] => Array
        (
            [0] => 2012-11-27 12:46:02
            [1] => http://www.ttgood.com/jy/t148930.htm
        )

    [2576] => Array
        (
            [0] => 2012-11-27 12:45:18
            [1] => http://www.ttgood.com/jy/t149543.htm
        )

    [2577] => Array
        (
            [0] => 2012-11-27 12:31:13
            [1] => http://www.ttgood.com/jy/t148659.htm
        )

    [2578] => Array
        (
            [0] => 2012-11-27 12:24:17
            [1] => http://www.ttgood.com/jy/t143174.htm
        )

    [2579] => Array
        (
            [0] => 2012-11-27 11:21:40
            [1] => http://www.ttgood.com/jy/t149302.htm
        )

    [2580] => Array
        (
            [0] => 2012-11-27 10:40:39
            [1] => http://www.ttgood.com/jy/t145584.htm
        )

    [2581] => Array
        (
            [0] => 2012-11-27 10:03:59
            [1] => http://www.ttgood.com/jy/t149468.htm
        )

    [2582] => Array
        (
            [0] => 2012-11-27 09:55:32
            [1] => http://www.ttgood.com/jy/t149494.htm
        )

    [2583] => Array
        (
            [0] => 2012-11-27 09:55:08
            [1] => http://www.ttgood.com/jy/t136165.htm
        )

    [2584] => Array
        (
            [0] => 2012-11-27 09:21:28
            [1] => http://www.ttgood.com/jy/t139085.htm
        )

    [2585] => Array
        (
            [0] => 2012-11-27 09:21:19
            [1] => http://www.ttgood.com/jy/t149582.htm
        )

    [2586] => Array
        (
            [0] => 2012-11-27 09:20:31
            [1] => http://www.ttgood.com/jy/t149579.htm
        )

    [2587] => Array
        (
            [0] => 2012-11-27 09:19:56
            [1] => http://www.ttgood.com/jy/t149578.htm
        )

    [2588] => Array
        (
            [0] => 2012-11-27 09:19:42
            [1] => http://www.ttgood.com/jy/t149586.htm
        )

    [2589] => Array
        (
            [0] => 2012-11-27 09:18:08
            [1] => http://www.ttgood.com/jy/t149574.htm
        )

    [2590] => Array
        (
            [0] => 2012-11-27 09:12:27
            [1] => http://www.ttgood.com/jy/t149562.htm
        )

    [2591] => Array
        (
            [0] => 2012-11-27 09:11:34
            [1] => http://www.ttgood.com/jy/t149561.htm
        )

    [2592] => Array
        (
            [0] => 2012-11-27 09:05:29
            [1] => http://www.ttgood.com/jy/t149440.htm
        )

    [2593] => Array
        (
            [0] => 2012-11-27 09:05:10
            [1] => http://www.ttgood.com/jy/t146541.htm
        )

    [2594] => Array
        (
            [0] => 2012-11-26 23:14:31
            [1] => http://www.ttgood.com/jy/t146982.htm
        )

    [2595] => Array
        (
            [0] => 2012-11-26 22:43:07
            [1] => http://www.ttgood.com/jy/t149281.htm
        )

    [2596] => Array
        (
            [0] => 2012-11-26 21:54:44
            [1] => http://www.ttgood.com/jy/t138535.htm
        )

    [2597] => Array
        (
            [0] => 2012-11-26 21:49:51
            [1] => http://www.ttgood.com/jy/t146267.htm
        )

    [2598] => Array
        (
            [0] => 2012-11-26 21:47:10
            [1] => http://www.ttgood.com/jy/t141898.htm
        )

    [2599] => Array
        (
            [0] => 2012-11-26 21:38:42
            [1] => http://www.ttgood.com/jy/t149220.htm
        )

    [2600] => Array
        (
            [0] => 2012-11-26 21:28:14
            [1] => http://www.ttgood.com/jy/t132885.htm
        )

    [2601] => Array
        (
            [0] => 2012-11-26 20:51:03
            [1] => http://www.ttgood.com/jy/t145169.htm
        )

    [2602] => Array
        (
            [0] => 2012-11-26 20:48:39
            [1] => http://www.ttgood.com/jy/t148762.htm
        )

    [2603] => Array
        (
            [0] => 2012-11-26 19:43:34
            [1] => http://www.ttgood.com/jy/t123696.htm
        )

    [2604] => Array
        (
            [0] => 2012-11-26 18:49:37
            [1] => http://www.ttgood.com/jy/t149345.htm
        )

    [2605] => Array
        (
            [0] => 2012-11-26 17:58:50
            [1] => http://www.ttgood.com/jy/t138020.htm
        )

    [2606] => Array
        (
            [0] => 2012-11-26 17:58:16
            [1] => http://www.ttgood.com/jy/t147833.htm
        )

    [2607] => Array
        (
            [0] => 2012-11-26 17:25:36
            [1] => http://www.ttgood.com/jy/t149477.htm
        )

    [2608] => Array
        (
            [0] => 2012-11-26 17:04:31
            [1] => http://www.ttgood.com/jy/t139405.htm
        )

    [2609] => Array
        (
            [0] => 2012-11-26 17:03:02
            [1] => http://www.ttgood.com/jy/t139566.htm
        )

    [2610] => Array
        (
            [0] => 2012-11-26 16:30:01
            [1] => http://www.ttgood.com/jy/t149204.htm
        )

    [2611] => Array
        (
            [0] => 2012-11-26 16:14:33
            [1] => http://www.ttgood.com/jy/t139124.htm
        )

    [2612] => Array
        (
            [0] => 2012-11-26 16:13:32
            [1] => http://www.ttgood.com/jy/t149498.htm
        )

    [2613] => Array
        (
            [0] => 2012-11-26 16:13:05
            [1] => http://www.ttgood.com/jy/t12744.htm
        )

    [2614] => Array
        (
            [0] => 2012-11-26 16:07:00
            [1] => http://www.ttgood.com/jy/t68244.htm
        )

    [2615] => Array
        (
            [0] => 2012-11-26 16:06:54
            [1] => http://www.ttgood.com/jy/t145812.htm
        )

    [2616] => Array
        (
            [0] => 2012-11-26 16:02:28
            [1] => http://www.ttgood.com/jy/t147249.htm
        )

    [2617] => Array
        (
            [0] => 2012-11-26 15:33:14
            [1] => http://www.ttgood.com/jy/t148572.htm
        )

    [2618] => Array
        (
            [0] => 2012-11-26 14:49:10
            [1] => http://www.ttgood.com/jy/t120851.htm
        )

    [2619] => Array
        (
            [0] => 2012-11-26 14:46:42
            [1] => http://www.ttgood.com/jy/t149482.htm
        )

    [2620] => Array
        (
            [0] => 2012-11-26 14:41:03
            [1] => http://www.ttgood.com/jy/t144921.htm
        )

    [2621] => Array
        (
            [0] => 2012-11-26 13:57:45
            [1] => http://www.ttgood.com/jy/t143518.htm
        )

    [2622] => Array
        (
            [0] => 2012-11-26 13:28:45
            [1] => http://www.ttgood.com/jy/t149327.htm
        )

    [2623] => Array
        (
            [0] => 2012-11-26 13:17:34
            [1] => http://www.ttgood.com/jy/t121325.htm
        )

    [2624] => Array
        (
            [0] => 2012-11-26 12:21:54
            [1] => http://www.ttgood.com/jy/t79810.htm
        )

    [2625] => Array
        (
            [0] => 2012-11-26 12:16:55
            [1] => http://www.ttgood.com/jy/t149553.htm
        )

    [2626] => Array
        (
            [0] => 2012-11-26 11:50:31
            [1] => http://www.ttgood.com/jy/t147410.htm
        )

    [2627] => Array
        (
            [0] => 2012-11-26 11:48:25
            [1] => http://www.ttgood.com/jy/t148559.htm
        )

    [2628] => Array
        (
            [0] => 2012-11-26 11:43:01
            [1] => http://www.ttgood.com/jy/t87859.htm
        )

    [2629] => Array
        (
            [0] => 2012-11-26 10:54:53
            [1] => http://www.ttgood.com/jy/t141245.htm
        )

    [2630] => Array
        (
            [0] => 2012-11-26 10:50:29
            [1] => http://www.ttgood.com/jy/t134058.htm
        )

    [2631] => Array
        (
            [0] => 2012-11-26 10:31:06
            [1] => http://www.ttgood.com/jy/t149426.htm
        )

    [2632] => Array
        (
            [0] => 2012-11-26 10:25:00
            [1] => http://www.ttgood.com/jy/t148942.htm
        )

    [2633] => Array
        (
            [0] => 2012-11-26 10:04:40
            [1] => http://www.ttgood.com/jy/t147238.htm
        )

    [2634] => Array
        (
            [0] => 2012-11-26 09:59:36
            [1] => http://www.ttgood.com/jy/t149544.htm
        )

    [2635] => Array
        (
            [0] => 2012-11-26 09:59:11
            [1] => http://www.ttgood.com/jy/t149546.htm
        )

    [2636] => Array
        (
            [0] => 2012-11-26 09:58:13
            [1] => http://www.ttgood.com/jy/t149532.htm
        )

    [2637] => Array
        (
            [0] => 2012-11-26 09:57:58
            [1] => http://www.ttgood.com/jy/t149534.htm
        )

    [2638] => Array
        (
            [0] => 2012-11-26 09:57:24
            [1] => http://www.ttgood.com/jy/t149554.htm
        )

    [2639] => Array
        (
            [0] => 2012-11-26 09:55:41
            [1] => http://www.ttgood.com/jy/t149555.htm
        )

    [2640] => Array
        (
            [0] => 2012-11-26 09:51:52
            [1] => http://www.ttgood.com/jy/t129443.htm
        )

    [2641] => Array
        (
            [0] => 2012-11-26 09:46:11
            [1] => http://www.ttgood.com/jy/t149530.htm
        )

    [2642] => Array
        (
            [0] => 2012-11-26 08:19:03
            [1] => http://www.ttgood.com/jy/t147279.htm
        )

    [2643] => Array
        (
            [0] => 2012-11-26 00:58:01
            [1] => http://www.ttgood.com/jy/t143338.htm
        )

    [2644] => Array
        (
            [0] => 2012-11-26 00:20:56
            [1] => http://www.ttgood.com/jy/t149320.htm
        )

    [2645] => Array
        (
            [0] => 2012-11-25 23:32:14
            [1] => http://www.ttgood.com/jy/t149162.htm
        )

    [2646] => Array
        (
            [0] => 2012-11-25 23:19:29
            [1] => http://www.ttgood.com/jy/t149521.htm
        )

    [2647] => Array
        (
            [0] => 2012-11-25 22:41:24
            [1] => http://www.ttgood.com/jy/t134947.htm
        )

    [2648] => Array
        (
            [0] => 2012-11-25 22:02:48
            [1] => http://www.ttgood.com/jy/t144999.htm
        )

    [2649] => Array
        (
            [0] => 2012-11-25 21:57:54
            [1] => http://www.ttgood.com/jy/t148257.htm
        )

    [2650] => Array
        (
            [0] => 2012-11-25 21:30:33
            [1] => http://www.ttgood.com/jy/t147051.htm
        )

    [2651] => Array
        (
            [0] => 2012-11-25 21:17:06
            [1] => http://www.ttgood.com/jy/t145564.htm
        )

    [2652] => Array
        (
            [0] => 2012-11-25 21:05:03
            [1] => http://www.ttgood.com/jy/t138543.htm
        )

    [2653] => Array
        (
            [0] => 2012-11-25 20:40:53
            [1] => http://www.ttgood.com/jy/t38732.htm
        )

    [2654] => Array
        (
            [0] => 2012-11-25 20:36:56
            [1] => http://www.ttgood.com/jy/t149499.htm
        )

    [2655] => Array
        (
            [0] => 2012-11-25 19:30:48
            [1] => http://www.ttgood.com/jy/t148156.htm
        )

    [2656] => Array
        (
            [0] => 2012-11-25 19:03:48
            [1] => http://www.ttgood.com/jy/t148370.htm
        )

    [2657] => Array
        (
            [0] => 2012-11-25 18:39:38
            [1] => http://www.ttgood.com/jy/t101805.htm
        )

    [2658] => Array
        (
            [0] => 2012-11-25 18:35:25
            [1] => http://www.ttgood.com/jy/t135886.htm
        )

    [2659] => Array
        (
            [0] => 2012-11-25 17:24:12
            [1] => http://www.ttgood.com/jy/t148621.htm
        )

    [2660] => Array
        (
            [0] => 2012-11-25 16:58:29
            [1] => http://www.ttgood.com/jy/t147650.htm
        )

    [2661] => Array
        (
            [0] => 2012-11-25 16:52:24
            [1] => http://www.ttgood.com/jy/t136153.htm
        )

    [2662] => Array
        (
            [0] => 2012-11-25 16:16:44
            [1] => http://www.ttgood.com/jy/t148620.htm
        )

    [2663] => Array
        (
            [0] => 2012-11-25 16:12:28
            [1] => http://www.ttgood.com/jy/t147380.htm
        )

    [2664] => Array
        (
            [0] => 2012-11-25 15:09:31
            [1] => http://www.ttgood.com/jy/t147367.htm
        )

    [2665] => Array
        (
            [0] => 2012-11-25 15:04:40
            [1] => http://www.ttgood.com/jy/t141848.htm
        )

    [2666] => Array
        (
            [0] => 2012-11-25 15:04:03
            [1] => http://www.ttgood.com/jy/t148960.htm
        )

    [2667] => Array
        (
            [0] => 2012-11-25 14:41:37
            [1] => http://www.ttgood.com/jy/t145548.htm
        )

    [2668] => Array
        (
            [0] => 2012-11-25 14:39:13
            [1] => http://www.ttgood.com/jy/t147268.htm
        )

    [2669] => Array
        (
            [0] => 2012-11-25 14:37:46
            [1] => http://www.ttgood.com/jy/t138942.htm
        )

    [2670] => Array
        (
            [0] => 2012-11-25 14:04:05
            [1] => http://www.ttgood.com/jy/t149353.htm
        )

    [2671] => Array
        (
            [0] => 2012-11-25 13:52:36
            [1] => http://www.ttgood.com/jy/t147304.htm
        )

    [2672] => Array
        (
            [0] => 2012-11-25 13:39:30
            [1] => http://www.ttgood.com/jy/t146894.htm
        )

    [2673] => Array
        (
            [0] => 2012-11-25 13:23:15
            [1] => http://www.ttgood.com/jy/t144393.htm
        )

    [2674] => Array
        (
            [0] => 2012-11-25 12:42:48
            [1] => http://www.ttgood.com/jy/t145830.htm
        )

    [2675] => Array
        (
            [0] => 2012-11-25 12:17:56
            [1] => http://www.ttgood.com/jy/t138879.htm
        )

    [2676] => Array
        (
            [0] => 2012-11-25 11:59:15
            [1] => http://www.ttgood.com/jy/t149105.htm
        )

    [2677] => Array
        (
            [0] => 2012-11-25 11:42:39
            [1] => http://www.ttgood.com/jy/t149409.htm
        )

    [2678] => Array
        (
            [0] => 2012-11-25 11:06:16
            [1] => http://www.ttgood.com/jy/t148711.htm
        )

    [2679] => Array
        (
            [0] => 2012-11-25 10:55:46
            [1] => http://www.ttgood.com/jy/t146928.htm
        )

    [2680] => Array
        (
            [0] => 2012-11-25 10:31:33
            [1] => http://www.ttgood.com/jy/t139933.htm
        )

    [2681] => Array
        (
            [0] => 2012-11-25 10:21:07
            [1] => http://www.ttgood.com/jy/t147570.htm
        )

    [2682] => Array
        (
            [0] => 2012-11-25 10:16:50
            [1] => http://www.ttgood.com/jy/t149198.htm
        )

    [2683] => Array
        (
            [0] => 2012-11-25 10:10:22
            [1] => http://www.ttgood.com/jy/t149028.htm
        )

    [2684] => Array
        (
            [0] => 2012-11-25 10:08:41
            [1] => http://www.ttgood.com/jy/t145036.htm
        )

    [2685] => Array
        (
            [0] => 2012-11-25 09:53:23
            [1] => http://www.ttgood.com/jy/t149110.htm
        )

    [2686] => Array
        (
            [0] => 2012-11-25 09:12:15
            [1] => http://www.ttgood.com/jy/t149517.htm
        )

    [2687] => Array
        (
            [0] => 2012-11-25 09:11:56
            [1] => http://www.ttgood.com/jy/t149516.htm
        )

    [2688] => Array
        (
            [0] => 2012-11-25 09:10:54
            [1] => http://www.ttgood.com/jy/t149509.htm
        )

    [2689] => Array
        (
            [0] => 2012-11-25 09:10:43
            [1] => http://www.ttgood.com/jy/t149508.htm
        )

    [2690] => Array
        (
            [0] => 2012-11-25 09:10:36
            [1] => http://www.ttgood.com/jy/t149506.htm
        )

    [2691] => Array
        (
            [0] => 2012-11-25 09:08:47
            [1] => http://www.ttgood.com/jy/t149495.htm
        )

    [2692] => Array
        (
            [0] => 2012-11-24 23:18:52
            [1] => http://www.ttgood.com/jy/t147587.htm
        )

    [2693] => Array
        (
            [0] => 2012-11-24 23:00:35
            [1] => http://www.ttgood.com/jy/t139001.htm
        )

    [2694] => Array
        (
            [0] => 2012-11-24 22:45:11
            [1] => http://www.ttgood.com/jy/t147876.htm
        )

    [2695] => Array
        (
            [0] => 2012-11-24 22:37:31
            [1] => http://www.ttgood.com/jy/t124479.htm
        )

    [2696] => Array
        (
            [0] => 2012-11-24 22:26:52
            [1] => http://www.ttgood.com/jy/t145834.htm
        )

    [2697] => Array
        (
            [0] => 2012-11-24 22:06:12
            [1] => http://www.ttgood.com/jy/t139127.htm
        )

    [2698] => Array
        (
            [0] => 2012-11-24 21:32:50
            [1] => http://www.ttgood.com/jy/t146514.htm
        )

    [2699] => Array
        (
            [0] => 2012-11-24 21:11:11
            [1] => http://www.ttgood.com/jy/t148839.htm
        )

    [2700] => Array
        (
            [0] => 2012-11-24 20:45:00
            [1] => http://www.ttgood.com/jy/t146138.htm
        )

    [2701] => Array
        (
            [0] => 2012-11-24 20:41:46
            [1] => http://www.ttgood.com/jy/t146570.htm
        )

    [2702] => Array
        (
            [0] => 2012-11-24 19:58:42
            [1] => http://www.ttgood.com/jy/t136076.htm
        )

    [2703] => Array
        (
            [0] => 2012-11-24 19:46:39
            [1] => http://www.ttgood.com/jy/t149489.htm
        )

    [2704] => Array
        (
            [0] => 2012-11-24 19:44:18
            [1] => http://www.ttgood.com/jy/t134773.htm
        )

    [2705] => Array
        (
            [0] => 2012-11-24 19:26:33
            [1] => http://www.ttgood.com/jy/t141671.htm
        )

    [2706] => Array
        (
            [0] => 2012-11-24 19:26:11
            [1] => http://www.ttgood.com/jy/t67753.htm
        )

    [2707] => Array
        (
            [0] => 2012-11-24 19:24:23
            [1] => http://www.ttgood.com/jy/t143712.htm
        )

    [2708] => Array
        (
            [0] => 2012-11-24 18:54:49
            [1] => http://www.ttgood.com/jy/t148733.htm
        )

    [2709] => Array
        (
            [0] => 2012-11-24 18:48:06
            [1] => http://www.ttgood.com/jy/t145280.htm
        )

    [2710] => Array
        (
            [0] => 2012-11-24 18:28:37
            [1] => http://www.ttgood.com/jy/t149167.htm
        )

    [2711] => Array
        (
            [0] => 2012-11-24 18:26:26
            [1] => http://www.ttgood.com/jy/t149148.htm
        )

    [2712] => Array
        (
            [0] => 2012-11-24 18:12:26
            [1] => http://www.ttgood.com/jy/t145684.htm
        )

    [2713] => Array
        (
            [0] => 2012-11-24 18:05:57
            [1] => http://www.ttgood.com/jy/t143184.htm
        )

    [2714] => Array
        (
            [0] => 2012-11-24 18:00:45
            [1] => http://www.ttgood.com/jy/t133799.htm
        )

    [2715] => Array
        (
            [0] => 2012-11-24 17:39:26
            [1] => http://www.ttgood.com/jy/t149109.htm
        )

    [2716] => Array
        (
            [0] => 2012-11-24 17:29:54
            [1] => http://www.ttgood.com/jy/t149473.htm
        )

    [2717] => Array
        (
            [0] => 2012-11-24 17:24:47
            [1] => http://www.ttgood.com/jy/t143263.htm
        )

    [2718] => Array
        (
            [0] => 2012-11-24 17:08:51
            [1] => http://www.ttgood.com/jy/t148849.htm
        )

    [2719] => Array
        (
            [0] => 2012-11-24 16:58:41
            [1] => http://www.ttgood.com/jy/t147742.htm
        )

    [2720] => Array
        (
            [0] => 2012-11-24 16:36:37
            [1] => http://www.ttgood.com/jy/t146096.htm
        )

    [2721] => Array
        (
            [0] => 2012-11-24 15:52:42
            [1] => http://www.ttgood.com/jy/t130907.htm
        )

    [2722] => Array
        (
            [0] => 2012-11-24 15:43:22
            [1] => http://www.ttgood.com/jy/t148983.htm
        )

    [2723] => Array
        (
            [0] => 2012-11-24 15:36:38
            [1] => http://www.ttgood.com/jy/t144090.htm
        )

    [2724] => Array
        (
            [0] => 2012-11-24 15:21:14
            [1] => http://www.ttgood.com/jy/t111349.htm
        )

    [2725] => Array
        (
            [0] => 2012-11-24 14:48:08
            [1] => http://www.ttgood.com/jy/t149488.htm
        )

    [2726] => Array
        (
            [0] => 2012-11-24 14:38:31
            [1] => http://www.ttgood.com/jy/t138809.htm
        )

    [2727] => Array
        (
            [0] => 2012-11-24 14:24:30
            [1] => http://www.ttgood.com/jy/t149285.htm
        )

    [2728] => Array
        (
            [0] => 2012-11-24 14:14:56
            [1] => http://www.ttgood.com/jy/t145694.htm
        )

    [2729] => Array
        (
            [0] => 2012-11-24 14:13:39
            [1] => http://www.ttgood.com/jy/t146635.htm
        )

    [2730] => Array
        (
            [0] => 2012-11-24 13:51:04
            [1] => http://www.ttgood.com/jy/t149425.htm
        )

    [2731] => Array
        (
            [0] => 2012-11-24 12:09:41
            [1] => http://www.ttgood.com/jy/t148676.htm
        )

    [2732] => Array
        (
            [0] => 2012-11-24 11:48:36
            [1] => http://www.ttgood.com/jy/t146168.htm
        )

    [2733] => Array
        (
            [0] => 2012-11-24 11:14:57
            [1] => http://www.ttgood.com/jy/t141634.htm
        )

    [2734] => Array
        (
            [0] => 2012-11-24 11:13:29
            [1] => http://www.ttgood.com/jy/t129684.htm
        )

    [2735] => Array
        (
            [0] => 2012-11-24 10:19:19
            [1] => http://www.ttgood.com/jy/t132702.htm
        )

    [2736] => Array
        (
            [0] => 2012-11-24 10:17:22
            [1] => http://www.ttgood.com/jy/t124987.htm
        )

    [2737] => Array
        (
            [0] => 2012-11-24 10:14:36
            [1] => http://www.ttgood.com/jy/t149058.htm
        )

    [2738] => Array
        (
            [0] => 2012-11-24 10:10:46
            [1] => http://www.ttgood.com/jy/t137157.htm
        )

    [2739] => Array
        (
            [0] => 2012-11-24 10:04:05
            [1] => http://www.ttgood.com/jy/t149470.htm
        )

    [2740] => Array
        (
            [0] => 2012-11-24 09:53:41
            [1] => http://www.ttgood.com/jy/t149338.htm
        )

    [2741] => Array
        (
            [0] => 2012-11-24 09:43:42
            [1] => http://www.ttgood.com/jy/t147888.htm
        )

    [2742] => Array
        (
            [0] => 2012-11-24 09:15:29
            [1] => http://www.ttgood.com/jy/t147104.htm
        )

    [2743] => Array
        (
            [0] => 2012-11-24 09:13:32
            [1] => http://www.ttgood.com/jy/t147010.htm
        )

    [2744] => Array
        (
            [0] => 2012-11-24 09:04:59
            [1] => http://www.ttgood.com/jy/t149491.htm
        )

    [2745] => Array
        (
            [0] => 2012-11-24 09:04:13
            [1] => http://www.ttgood.com/jy/t149487.htm
        )

    [2746] => Array
        (
            [0] => 2012-11-24 09:03:58
            [1] => http://www.ttgood.com/jy/t149485.htm
        )

    [2747] => Array
        (
            [0] => 2012-11-24 09:03:42
            [1] => http://www.ttgood.com/jy/t149481.htm
        )

    [2748] => Array
        (
            [0] => 2012-11-24 09:02:54
            [1] => http://www.ttgood.com/jy/t149474.htm
        )

    [2749] => Array
        (
            [0] => 2012-11-24 09:02:09
            [1] => http://www.ttgood.com/jy/t149471.htm
        )

    [2750] => Array
        (
            [0] => 2012-11-24 09:01:56
            [1] => http://www.ttgood.com/jy/t149469.htm
        )

    [2751] => Array
        (
            [0] => 2012-11-24 09:01:33
            [1] => http://www.ttgood.com/jy/t149464.htm
        )

    [2752] => Array
        (
            [0] => 2012-11-24 09:01:18
            [1] => http://www.ttgood.com/jy/t149460.htm
        )

    [2753] => Array
        (
            [0] => 2012-11-24 09:00:52
            [1] => http://www.ttgood.com/jy/t149457.htm
        )

    [2754] => Array
        (
            [0] => 2012-11-24 08:42:32
            [1] => http://www.ttgood.com/jy/t149378.htm
        )

    [2755] => Array
        (
            [0] => 2012-11-24 08:25:56
            [1] => http://www.ttgood.com/jy/t147677.htm
        )

    [2756] => Array
        (
            [0] => 2012-11-23 23:36:13
            [1] => http://www.ttgood.com/jy/t141550.htm
        )

    [2757] => Array
        (
            [0] => 2012-11-23 23:05:49
            [1] => http://www.ttgood.com/jy/t128954.htm
        )

    [2758] => Array
        (
            [0] => 2012-11-23 21:23:17
            [1] => http://www.ttgood.com/jy/t136631.htm
        )

    [2759] => Array
        (
            [0] => 2012-11-23 21:12:03
            [1] => http://www.ttgood.com/jy/t142369.htm
        )

    [2760] => Array
        (
            [0] => 2012-11-23 20:56:39
            [1] => http://www.ttgood.com/jy/t149329.htm
        )

    [2761] => Array
        (
            [0] => 2012-11-23 20:09:19
            [1] => http://www.ttgood.com/jy/t148393.htm
        )

    [2762] => Array
        (
            [0] => 2012-11-23 19:32:19
            [1] => http://www.ttgood.com/jy/t99433.htm
        )

    [2763] => Array
        (
            [0] => 2012-11-23 18:30:53
            [1] => http://www.ttgood.com/jy/t149069.htm
        )

    [2764] => Array
        (
            [0] => 2012-11-23 18:26:19
            [1] => http://www.ttgood.com/jy/t149286.htm
        )

    [2765] => Array
        (
            [0] => 2012-11-23 18:26:05
            [1] => http://www.ttgood.com/jy/t148498.htm
        )

    [2766] => Array
        (
            [0] => 2012-11-23 18:15:17
            [1] => http://www.ttgood.com/jy/t149026.htm
        )

    [2767] => Array
        (
            [0] => 2012-11-23 18:07:24
            [1] => http://www.ttgood.com/jy/t149043.htm
        )

    [2768] => Array
        (
            [0] => 2012-11-23 17:29:11
            [1] => http://www.ttgood.com/jy/t144613.htm
        )

    [2769] => Array
        (
            [0] => 2012-11-23 17:26:23
            [1] => http://www.ttgood.com/jy/t145953.htm
        )

    [2770] => Array
        (
            [0] => 2012-11-23 17:07:33
            [1] => http://www.ttgood.com/jy/t94420.htm
        )

    [2771] => Array
        (
            [0] => 2012-11-23 17:07:02
            [1] => http://www.ttgood.com/jy/t143035.htm
        )

    [2772] => Array
        (
            [0] => 2012-11-23 16:43:01
            [1] => http://www.ttgood.com/jy/t140856.htm
        )

    [2773] => Array
        (
            [0] => 2012-11-23 16:38:18
            [1] => http://www.ttgood.com/jy/t134600.htm
        )

    [2774] => Array
        (
            [0] => 2012-11-23 16:10:32
            [1] => http://www.ttgood.com/jy/t147288.htm
        )

    [2775] => Array
        (
            [0] => 2012-11-23 15:41:51
            [1] => http://www.ttgood.com/jy/t148537.htm
        )

    [2776] => Array
        (
            [0] => 2012-11-23 15:28:11
            [1] => http://www.ttgood.com/jy/t146960.htm
        )

    [2777] => Array
        (
            [0] => 2012-11-23 15:26:08
            [1] => http://www.ttgood.com/jy/t148630.htm
        )

    [2778] => Array
        (
            [0] => 2012-11-23 15:17:10
            [1] => http://www.ttgood.com/jy/t126562.htm
        )

    [2779] => Array
        (
            [0] => 2012-11-23 14:41:01
            [1] => http://www.ttgood.com/jy/t146410.htm
        )

    [2780] => Array
        (
            [0] => 2012-11-23 14:14:36
            [1] => http://www.ttgood.com/jy/t134577.htm
        )

    [2781] => Array
        (
            [0] => 2012-11-23 14:04:45
            [1] => http://www.ttgood.com/jy/t135598.htm
        )

    [2782] => Array
        (
            [0] => 2012-11-23 13:59:27
            [1] => http://www.ttgood.com/jy/t149362.htm
        )

    [2783] => Array
        (
            [0] => 2012-11-23 13:33:39
            [1] => http://www.ttgood.com/jy/t149377.htm
        )

    [2784] => Array
        (
            [0] => 2012-11-23 12:53:46
            [1] => http://www.ttgood.com/jy/t148699.htm
        )

    [2785] => Array
        (
            [0] => 2012-11-23 12:38:08
            [1] => http://www.ttgood.com/jy/t149367.htm
        )

    [2786] => Array
        (
            [0] => 2012-11-23 12:37:36
            [1] => http://www.ttgood.com/jy/t131384.htm
        )

    [2787] => Array
        (
            [0] => 2012-11-23 12:24:57
            [1] => http://www.ttgood.com/jy/t122378.htm
        )

    [2788] => Array
        (
            [0] => 2012-11-23 12:23:32
            [1] => http://www.ttgood.com/jy/t149335.htm
        )

    [2789] => Array
        (
            [0] => 2012-11-23 11:28:51
            [1] => http://www.ttgood.com/jy/t149347.htm
        )

    [2790] => Array
        (
            [0] => 2012-11-23 11:17:01
            [1] => http://www.ttgood.com/jy/t112914.htm
        )

    [2791] => Array
        (
            [0] => 2012-11-23 11:14:25
            [1] => http://www.ttgood.com/jy/t148943.htm
        )

    [2792] => Array
        (
            [0] => 2012-11-23 11:14:24
            [1] => http://www.ttgood.com/jy/t149189.htm
        )

    [2793] => Array
        (
            [0] => 2012-11-23 11:13:49
            [1] => http://www.ttgood.com/jy/t93389.htm
        )

    [2794] => Array
        (
            [0] => 2012-11-23 11:11:42
            [1] => http://www.ttgood.com/jy/t113563.htm
        )

    [2795] => Array
        (
            [0] => 2012-11-23 11:07:12
            [1] => http://www.ttgood.com/jy/t127804.htm
        )

    [2796] => Array
        (
            [0] => 2012-11-23 10:53:20
            [1] => http://www.ttgood.com/jy/t149400.htm
        )

    [2797] => Array
        (
            [0] => 2012-11-23 09:29:46
            [1] => http://www.ttgood.com/jy/t102782.htm
        )

    [2798] => Array
        (
            [0] => 2012-11-23 09:26:50
            [1] => http://www.ttgood.com/jy/t149444.htm
        )

    [2799] => Array
        (
            [0] => 2012-11-23 09:26:41
            [1] => http://www.ttgood.com/jy/t149443.htm
        )

    [2800] => Array
        (
            [0] => 2012-11-23 09:26:31
            [1] => http://www.ttgood.com/jy/t149442.htm
        )

    [2801] => Array
        (
            [0] => 2012-11-23 09:25:46
            [1] => http://www.ttgood.com/jy/t149438.htm
        )

    [2802] => Array
        (
            [0] => 2012-11-23 09:22:52
            [1] => http://www.ttgood.com/jy/t149432.htm
        )

    [2803] => Array
        (
            [0] => 2012-11-23 09:22:40
            [1] => http://www.ttgood.com/jy/t149431.htm
        )

    [2804] => Array
        (
            [0] => 2012-11-23 09:22:07
            [1] => http://www.ttgood.com/jy/t149430.htm
        )

    [2805] => Array
        (
            [0] => 2012-11-23 09:15:05
            [1] => http://www.ttgood.com/jy/t149422.htm
        )

    [2806] => Array
        (
            [0] => 2012-11-23 09:10:38
            [1] => http://www.ttgood.com/jy/t149420.htm
        )

    [2807] => Array
        (
            [0] => 2012-11-23 08:49:08
            [1] => http://www.ttgood.com/jy/t148867.htm
        )

    [2808] => Array
        (
            [0] => 2012-11-23 00:11:06
            [1] => http://www.ttgood.com/jy/t122783.htm
        )

    [2809] => Array
        (
            [0] => 2012-11-22 23:38:17
            [1] => http://www.ttgood.com/jy/t142011.htm
        )

    [2810] => Array
        (
            [0] => 2012-11-22 23:22:46
            [1] => http://www.ttgood.com/jy/t145381.htm
        )

    [2811] => Array
        (
            [0] => 2012-11-22 23:05:53
            [1] => http://www.ttgood.com/jy/t149213.htm
        )

    [2812] => Array
        (
            [0] => 2012-11-22 22:45:52
            [1] => http://www.ttgood.com/jy/t132131.htm
        )

    [2813] => Array
        (
            [0] => 2012-11-22 22:18:37
            [1] => http://www.ttgood.com/jy/t148617.htm
        )

    [2814] => Array
        (
            [0] => 2012-11-22 21:16:52
            [1] => http://www.ttgood.com/jy/t146852.htm
        )

    [2815] => Array
        (
            [0] => 2012-11-22 21:08:37
            [1] => http://www.ttgood.com/jy/t144661.htm
        )

    [2816] => Array
        (
            [0] => 2012-11-22 20:16:35
            [1] => http://www.ttgood.com/jy/t146971.htm
        )

    [2817] => Array
        (
            [0] => 2012-11-22 20:10:47
            [1] => http://www.ttgood.com/jy/t131791.htm
        )

    [2818] => Array
        (
            [0] => 2012-11-22 19:37:31
            [1] => http://www.ttgood.com/jy/t90610.htm
        )

    [2819] => Array
        (
            [0] => 2012-11-22 19:24:56
            [1] => http://www.ttgood.com/jy/t124119.htm
        )

    [2820] => Array
        (
            [0] => 2012-11-22 19:20:40
            [1] => http://www.ttgood.com/jy/t148554.htm
        )

    [2821] => Array
        (
            [0] => 2012-11-22 19:17:10
            [1] => http://www.ttgood.com/jy/t140449.htm
        )

    [2822] => Array
        (
            [0] => 2012-11-22 18:26:45
            [1] => http://www.ttgood.com/jy/t149267.htm
        )

    [2823] => Array
        (
            [0] => 2012-11-22 17:47:18
            [1] => http://www.ttgood.com/jy/t148557.htm
        )

    [2824] => Array
        (
            [0] => 2012-11-22 17:32:00
            [1] => http://www.ttgood.com/jy/t148708.htm
        )

    [2825] => Array
        (
            [0] => 2012-11-22 17:21:47
            [1] => http://www.ttgood.com/jy/t145752.htm
        )

    [2826] => Array
        (
            [0] => 2012-11-22 16:55:54
            [1] => http://www.ttgood.com/jy/t148705.htm
        )

    [2827] => Array
        (
            [0] => 2012-11-22 15:41:34
            [1] => http://www.ttgood.com/jy/t146644.htm
        )

    [2828] => Array
        (
            [0] => 2012-11-22 15:18:22
            [1] => http://www.ttgood.com/jy/t100522.htm
        )

    [2829] => Array
        (
            [0] => 2012-11-22 15:18:09
            [1] => http://www.ttgood.com/jy/t147611.htm
        )

    [2830] => Array
        (
            [0] => 2012-11-22 15:14:15
            [1] => http://www.ttgood.com/jy/t127233.htm
        )

    [2831] => Array
        (
            [0] => 2012-11-22 15:12:58
            [1] => http://www.ttgood.com/jy/t74855.htm
        )

    [2832] => Array
        (
            [0] => 2012-11-22 15:05:44
            [1] => http://www.ttgood.com/jy/t147476.htm
        )

    [2833] => Array
        (
            [0] => 2012-11-22 14:51:19
            [1] => http://www.ttgood.com/jy/t126418.htm
        )

    [2834] => Array
        (
            [0] => 2012-11-22 14:50:31
            [1] => http://www.ttgood.com/jy/t148092.htm
        )

    [2835] => Array
        (
            [0] => 2012-11-22 14:37:38
            [1] => http://www.ttgood.com/jy/t149368.htm
        )

    [2836] => Array
        (
            [0] => 2012-11-22 14:20:58
            [1] => http://www.ttgood.com/jy/t126903.htm
        )

    [2837] => Array
        (
            [0] => 2012-11-22 14:16:04
            [1] => http://www.ttgood.com/jy/t139557.htm
        )

    [2838] => Array
        (
            [0] => 2012-11-22 14:09:19
            [1] => http://www.ttgood.com/jy/t148947.htm
        )

    [2839] => Array
        (
            [0] => 2012-11-22 13:55:32
            [1] => http://www.ttgood.com/jy/t145630.htm
        )

    [2840] => Array
        (
            [0] => 2012-11-22 13:35:55
            [1] => http://www.ttgood.com/jy/t149406.htm
        )

    [2841] => Array
        (
            [0] => 2012-11-22 13:10:53
            [1] => http://www.ttgood.com/jy/t146226.htm
        )

    [2842] => Array
        (
            [0] => 2012-11-22 12:27:56
            [1] => http://www.ttgood.com/jy/t135219.htm
        )

    [2843] => Array
        (
            [0] => 2012-11-22 10:29:06
            [1] => http://www.ttgood.com/jy/t149317.htm
        )

    [2844] => Array
        (
            [0] => 2012-11-22 10:26:11
            [1] => http://www.ttgood.com/jy/t133187.htm
        )

    [2845] => Array
        (
            [0] => 2012-11-22 10:22:21
            [1] => http://www.ttgood.com/jy/t149413.htm
        )

    [2846] => Array
        (
            [0] => 2012-11-22 10:22:21
            [1] => http://www.ttgood.com/jy/t147670.htm
        )

    [2847] => Array
        (
            [0] => 2012-11-22 10:21:29
            [1] => http://www.ttgood.com/jy/t102066.htm
        )

    [2848] => Array
        (
            [0] => 2012-11-22 10:21:24
            [1] => http://www.ttgood.com/jy/t148237.htm
        )

    [2849] => Array
        (
            [0] => 2012-11-22 10:11:55
            [1] => http://www.ttgood.com/jy/t144731.htm
        )

    [2850] => Array
        (
            [0] => 2012-11-22 09:09:39
            [1] => http://www.ttgood.com/jy/t149412.htm
        )

    [2851] => Array
        (
            [0] => 2012-11-22 09:09:30
            [1] => http://www.ttgood.com/jy/t149411.htm
        )

    [2852] => Array
        (
            [0] => 2012-11-22 09:09:11
            [1] => http://www.ttgood.com/jy/t149410.htm
        )

    [2853] => Array
        (
            [0] => 2012-11-22 09:08:28
            [1] => http://www.ttgood.com/jy/t148687.htm
        )

    [2854] => Array
        (
            [0] => 2012-11-22 09:08:08
            [1] => http://www.ttgood.com/jy/t149399.htm
        )

    [2855] => Array
        (
            [0] => 2012-11-22 09:08:03
            [1] => http://www.ttgood.com/jy/t149398.htm
        )

    [2856] => Array
        (
            [0] => 2012-11-22 09:07:58
            [1] => http://www.ttgood.com/jy/t149396.htm
        )

    [2857] => Array
        (
            [0] => 2012-11-22 09:07:19
            [1] => http://www.ttgood.com/jy/t149393.htm
        )

    [2858] => Array
        (
            [0] => 2012-11-22 09:07:08
            [1] => http://www.ttgood.com/jy/t149390.htm
        )

    [2859] => Array
        (
            [0] => 2012-11-22 09:06:41
            [1] => http://www.ttgood.com/jy/t149386.htm
        )

    [2860] => Array
        (
            [0] => 2012-11-22 09:02:34
            [1] => http://www.ttgood.com/jy/t149384.htm
        )

    [2861] => Array
        (
            [0] => 2012-11-22 08:41:40
            [1] => http://www.ttgood.com/jy/t147111.htm
        )

    [2862] => Array
        (
            [0] => 2012-11-22 07:56:04
            [1] => http://www.ttgood.com/jy/t132765.htm
        )

    [2863] => Array
        (
            [0] => 2012-11-21 21:30:09
            [1] => http://www.ttgood.com/jy/t141999.htm
        )

    [2864] => Array
        (
            [0] => 2012-11-21 21:29:56
            [1] => http://www.ttgood.com/jy/t145695.htm
        )

    [2865] => Array
        (
            [0] => 2012-11-21 21:19:29
            [1] => http://www.ttgood.com/jy/t135363.htm
        )

    [2866] => Array
        (
            [0] => 2012-11-21 21:00:17
            [1] => http://www.ttgood.com/jy/t110171.htm
        )

    [2867] => Array
        (
            [0] => 2012-11-21 20:04:35
            [1] => http://www.ttgood.com/jy/t149150.htm
        )

    [2868] => Array
        (
            [0] => 2012-11-21 20:03:26
            [1] => http://www.ttgood.com/jy/t121753.htm
        )

    [2869] => Array
        (
            [0] => 2012-11-21 20:00:12
            [1] => http://www.ttgood.com/jy/t147413.htm
        )

    [2870] => Array
        (
            [0] => 2012-11-21 19:24:16
            [1] => http://www.ttgood.com/jy/t146728.htm
        )

    [2871] => Array
        (
            [0] => 2012-11-21 19:05:14
            [1] => http://www.ttgood.com/jy/t142686.htm
        )

    [2872] => Array
        (
            [0] => 2012-11-21 19:04:56
            [1] => http://www.ttgood.com/jy/t145567.htm
        )

    [2873] => Array
        (
            [0] => 2012-11-21 18:12:39
            [1] => http://www.ttgood.com/jy/t127038.htm
        )

    [2874] => Array
        (
            [0] => 2012-11-21 18:09:11
            [1] => http://www.ttgood.com/jy/t146588.htm
        )

    [2875] => Array
        (
            [0] => 2012-11-21 17:59:02
            [1] => http://www.ttgood.com/jy/t149035.htm
        )

    [2876] => Array
        (
            [0] => 2012-11-21 17:52:37
            [1] => http://www.ttgood.com/jy/t149153.htm
        )

    [2877] => Array
        (
            [0] => 2012-11-21 16:45:19
            [1] => http://www.ttgood.com/jy/t144336.htm
        )

    [2878] => Array
        (
            [0] => 2012-11-21 15:55:51
            [1] => http://www.ttgood.com/jy/t133344.htm
        )

    [2879] => Array
        (
            [0] => 2012-11-21 15:44:30
            [1] => http://www.ttgood.com/jy/t147227.htm
        )

    [2880] => Array
        (
            [0] => 2012-11-21 15:31:32
            [1] => http://www.ttgood.com/jy/t148150.htm
        )

    [2881] => Array
        (
            [0] => 2012-11-21 15:27:59
            [1] => http://www.ttgood.com/jy/t141502.htm
        )

    [2882] => Array
        (
            [0] => 2012-11-21 15:26:48
            [1] => http://www.ttgood.com/jy/t134083.htm
        )

    [2883] => Array
        (
            [0] => 2012-11-21 15:25:58
            [1] => http://www.ttgood.com/jy/t113592.htm
        )

    [2884] => Array
        (
            [0] => 2012-11-21 15:19:29
            [1] => http://www.ttgood.com/jy/t117817.htm
        )

    [2885] => Array
        (
            [0] => 2012-11-21 14:58:15
            [1] => http://www.ttgood.com/jy/t123292.htm
        )

    [2886] => Array
        (
            [0] => 2012-11-21 14:51:39
            [1] => http://www.ttgood.com/jy/t149374.htm
        )

    [2887] => Array
        (
            [0] => 2012-11-21 14:49:45
            [1] => http://www.ttgood.com/jy/t148698.htm
        )

    [2888] => Array
        (
            [0] => 2012-11-21 14:43:05
            [1] => http://www.ttgood.com/jy/t146876.htm
        )

    [2889] => Array
        (
            [0] => 2012-11-21 14:43:01
            [1] => http://www.ttgood.com/jy/t145722.htm
        )

    [2890] => Array
        (
            [0] => 2012-11-21 14:27:52
            [1] => http://www.ttgood.com/jy/t110579.htm
        )

    [2891] => Array
        (
            [0] => 2012-11-21 14:19:15
            [1] => http://www.ttgood.com/jy/t128563.htm
        )

    [2892] => Array
        (
            [0] => 2012-11-21 14:09:47
            [1] => http://www.ttgood.com/jy/t104457.htm
        )

    [2893] => Array
        (
            [0] => 2012-11-21 14:06:24
            [1] => http://www.ttgood.com/jy/t133584.htm
        )

    [2894] => Array
        (
            [0] => 2012-11-21 13:39:11
            [1] => http://www.ttgood.com/jy/t148244.htm
        )

    [2895] => Array
        (
            [0] => 2012-11-21 13:38:25
            [1] => http://www.ttgood.com/jy/t149019.htm
        )

    [2896] => Array
        (
            [0] => 2012-11-21 13:30:55
            [1] => http://www.ttgood.com/jy/t146657.htm
        )

    [2897] => Array
        (
            [0] => 2012-11-21 13:19:13
            [1] => http://www.ttgood.com/jy/t146156.htm
        )

    [2898] => Array
        (
            [0] => 2012-11-21 13:01:58
            [1] => http://www.ttgood.com/jy/t149336.htm
        )

    [2899] => Array
        (
            [0] => 2012-11-21 11:56:55
            [1] => http://www.ttgood.com/jy/t146867.htm
        )

    [2900] => Array
        (
            [0] => 2012-11-21 11:46:16
            [1] => http://www.ttgood.com/jy/t116952.htm
        )

    [2901] => Array
        (
            [0] => 2012-11-21 11:25:53
            [1] => http://www.ttgood.com/jy/t137866.htm
        )

    [2902] => Array
        (
            [0] => 2012-11-21 09:26:53
            [1] => http://www.ttgood.com/jy/t135896.htm
        )

    [2903] => Array
        (
            [0] => 2012-11-21 09:19:22
            [1] => http://www.ttgood.com/jy/t148944.htm
        )

    [2904] => Array
        (
            [0] => 2012-11-21 09:17:23
            [1] => http://www.ttgood.com/jy/t149365.htm
        )

    [2905] => Array
        (
            [0] => 2012-11-21 09:17:18
            [1] => http://www.ttgood.com/jy/t149366.htm
        )

    [2906] => Array
        (
            [0] => 2012-11-21 09:16:56
            [1] => http://www.ttgood.com/jy/t149369.htm
        )

    [2907] => Array
        (
            [0] => 2012-11-21 09:16:51
            [1] => http://www.ttgood.com/jy/t149358.htm
        )

    [2908] => Array
        (
            [0] => 2012-11-21 09:16:50
            [1] => http://www.ttgood.com/jy/t149370.htm
        )

    [2909] => Array
        (
            [0] => 2012-11-21 09:16:04
            [1] => http://www.ttgood.com/jy/t149373.htm
        )

    [2910] => Array
        (
            [0] => 2012-11-21 09:14:25
            [1] => http://www.ttgood.com/jy/t149355.htm
        )

    [2911] => Array
        (
            [0] => 2012-11-21 09:12:08
            [1] => http://www.ttgood.com/jy/t149354.htm
        )

    [2912] => Array
        (
            [0] => 2012-11-21 09:11:37
            [1] => http://www.ttgood.com/jy/t138463.htm
        )

    [2913] => Array
        (
            [0] => 2012-11-21 09:09:18
            [1] => http://www.ttgood.com/jy/t149349.htm
        )

    [2914] => Array
        (
            [0] => 2012-11-20 23:35:34
            [1] => http://www.ttgood.com/jy/t136023.htm
        )

    [2915] => Array
        (
            [0] => 2012-11-20 22:45:24
            [1] => http://www.ttgood.com/jy/t149027.htm
        )

    [2916] => Array
        (
            [0] => 2012-11-20 22:04:23
            [1] => http://www.ttgood.com/jy/t149274.htm
        )

    [2917] => Array
        (
            [0] => 2012-11-20 21:59:50
            [1] => http://www.ttgood.com/jy/t149331.htm
        )

    [2918] => Array
        (
            [0] => 2012-11-20 21:53:48
            [1] => http://www.ttgood.com/jy/t143178.htm
        )

    [2919] => Array
        (
            [0] => 2012-11-20 21:25:44
            [1] => http://www.ttgood.com/jy/t147913.htm
        )

    [2920] => Array
        (
            [0] => 2012-11-20 19:59:20
            [1] => http://www.ttgood.com/jy/t139635.htm
        )

    [2921] => Array
        (
            [0] => 2012-11-20 19:30:19
            [1] => http://www.ttgood.com/jy/t147011.htm
        )

    [2922] => Array
        (
            [0] => 2012-11-20 18:18:32
            [1] => http://www.ttgood.com/jy/t146232.htm
        )

    [2923] => Array
        (
            [0] => 2012-11-20 17:39:15
            [1] => http://www.ttgood.com/jy/t149256.htm
        )

    [2924] => Array
        (
            [0] => 2012-11-20 17:22:36
            [1] => http://www.ttgood.com/jy/t148381.htm
        )

    [2925] => Array
        (
            [0] => 2012-11-20 17:09:52
            [1] => http://www.ttgood.com/jy/t149099.htm
        )

    [2926] => Array
        (
            [0] => 2012-11-20 16:35:05
            [1] => http://www.ttgood.com/jy/t118455.htm
        )

    [2927] => Array
        (
            [0] => 2012-11-20 16:00:36
            [1] => http://www.ttgood.com/jy/t146703.htm
        )

    [2928] => Array
        (
            [0] => 2012-11-20 15:49:21
            [1] => http://www.ttgood.com/jy/t137654.htm
        )

    [2929] => Array
        (
            [0] => 2012-11-20 14:58:27
            [1] => http://www.ttgood.com/jy/t146323.htm
        )

    [2930] => Array
        (
            [0] => 2012-11-20 14:57:04
            [1] => http://www.ttgood.com/jy/t148511.htm
        )

    [2931] => Array
        (
            [0] => 2012-11-20 14:26:44
            [1] => http://www.ttgood.com/jy/t135124.htm
        )

    [2932] => Array
        (
            [0] => 2012-11-20 14:13:41
            [1] => http://www.ttgood.com/jy/t146881.htm
        )

    [2933] => Array
        (
            [0] => 2012-11-20 14:04:52
            [1] => http://www.ttgood.com/jy/t143858.htm
        )

    [2934] => Array
        (
            [0] => 2012-11-20 14:02:09
            [1] => http://www.ttgood.com/jy/t145621.htm
        )

    [2935] => Array
        (
            [0] => 2012-11-20 13:56:59
            [1] => http://www.ttgood.com/jy/t146182.htm
        )

    [2936] => Array
        (
            [0] => 2012-11-20 13:44:45
            [1] => http://www.ttgood.com/jy/t142821.htm
        )

    [2937] => Array
        (
            [0] => 2012-11-20 13:40:42
            [1] => http://www.ttgood.com/jy/t134777.htm
        )

    [2938] => Array
        (
            [0] => 2012-11-20 13:01:15
            [1] => http://www.ttgood.com/jy/t138260.htm
        )

    [2939] => Array
        (
            [0] => 2012-11-20 12:59:24
            [1] => http://www.ttgood.com/jy/t133883.htm
        )

    [2940] => Array
        (
            [0] => 2012-11-20 12:37:58
            [1] => http://www.ttgood.com/jy/t139054.htm
        )

    [2941] => Array
        (
            [0] => 2012-11-20 12:29:59
            [1] => http://www.ttgood.com/jy/t148766.htm
        )

    [2942] => Array
        (
            [0] => 2012-11-20 12:28:49
            [1] => http://www.ttgood.com/jy/t147393.htm
        )

    [2943] => Array
        (
            [0] => 2012-11-20 12:25:36
            [1] => http://www.ttgood.com/jy/t149082.htm
        )

    [2944] => Array
        (
            [0] => 2012-11-20 12:23:54
            [1] => http://www.ttgood.com/jy/t149088.htm
        )

    [2945] => Array
        (
            [0] => 2012-11-20 12:03:44
            [1] => http://www.ttgood.com/jy/t137767.htm
        )

    [2946] => Array
        (
            [0] => 2012-11-20 11:42:30
            [1] => http://www.ttgood.com/jy/t145848.htm
        )

    [2947] => Array
        (
            [0] => 2012-11-20 11:36:31
            [1] => http://www.ttgood.com/jy/t146337.htm
        )

    [2948] => Array
        (
            [0] => 2012-11-20 11:24:28
            [1] => http://www.ttgood.com/jy/t109654.htm
        )

    [2949] => Array
        (
            [0] => 2012-11-20 11:20:39
            [1] => http://www.ttgood.com/jy/t149068.htm
        )

    [2950] => Array
        (
            [0] => 2012-11-20 11:19:58
            [1] => http://www.ttgood.com/jy/t136337.htm
        )

    [2951] => Array
        (
            [0] => 2012-11-20 11:10:40
            [1] => http://www.ttgood.com/jy/t103389.htm
        )

    [2952] => Array
        (
            [0] => 2012-11-20 10:57:24
            [1] => http://www.ttgood.com/jy/t141121.htm
        )

    [2953] => Array
        (
            [0] => 2012-11-20 10:25:59
            [1] => http://www.ttgood.com/jy/t146640.htm
        )

    [2954] => Array
        (
            [0] => 2012-11-20 10:24:47
            [1] => http://www.ttgood.com/jy/t148521.htm
        )

    [2955] => Array
        (
            [0] => 2012-11-20 10:22:15
            [1] => http://www.ttgood.com/jy/t145547.htm
        )

    [2956] => Array
        (
            [0] => 2012-11-20 09:56:01
            [1] => http://www.ttgood.com/jy/t145554.htm
        )

    [2957] => Array
        (
            [0] => 2012-11-20 09:48:37
            [1] => http://www.ttgood.com/jy/t149004.htm
        )

    [2958] => Array
        (
            [0] => 2012-11-20 09:46:12
            [1] => http://www.ttgood.com/jy/t134102.htm
        )

    [2959] => Array
        (
            [0] => 2012-11-20 09:35:56
            [1] => http://www.ttgood.com/jy/t148297.htm
        )

    [2960] => Array
        (
            [0] => 2012-11-20 09:15:02
            [1] => http://www.ttgood.com/jy/t149337.htm
        )

    [2961] => Array
        (
            [0] => 2012-11-20 09:14:52
            [1] => http://www.ttgood.com/jy/t149326.htm
        )

    [2962] => Array
        (
            [0] => 2012-11-20 09:14:51
            [1] => http://www.ttgood.com/jy/t149339.htm
        )

    [2963] => Array
        (
            [0] => 2012-11-20 09:11:54
            [1] => http://www.ttgood.com/jy/t149322.htm
        )

    [2964] => Array
        (
            [0] => 2012-11-20 09:11:03
            [1] => http://www.ttgood.com/jy/t147502.htm
        )

    [2965] => Array
        (
            [0] => 2012-11-20 09:08:00
            [1] => http://www.ttgood.com/jy/t149318.htm
        )

    [2966] => Array
        (
            [0] => 2012-11-20 09:06:51
            [1] => http://www.ttgood.com/jy/t149344.htm
        )

    [2967] => Array
        (
            [0] => 2012-11-20 09:06:47
            [1] => http://www.ttgood.com/jy/t149314.htm
        )

    [2968] => Array
        (
            [0] => 2012-11-20 09:06:38
            [1] => http://www.ttgood.com/jy/t149346.htm
        )

    [2969] => Array
        (
            [0] => 2012-11-20 09:05:53
            [1] => http://www.ttgood.com/jy/t149313.htm
        )

    [2970] => Array
        (
            [0] => 2012-11-20 09:04:27
            [1] => http://www.ttgood.com/jy/t149312.htm
        )

    [2971] => Array
        (
            [0] => 2012-11-20 09:02:28
            [1] => http://www.ttgood.com/jy/t149332.htm
        )

    [2972] => Array
        (
            [0] => 2012-11-20 08:59:41
            [1] => http://www.ttgood.com/jy/t148955.htm
        )

    [2973] => Array
        (
            [0] => 2012-11-20 07:08:07
            [1] => http://www.ttgood.com/jy/t103746.htm
        )

    [2974] => Array
        (
            [0] => 2012-11-20 03:28:19
            [1] => http://www.ttgood.com/jy/t126174.htm
        )

    [2975] => Array
        (
            [0] => 2012-11-20 00:53:53
            [1] => http://www.ttgood.com/jy/t144775.htm
        )

    [2976] => Array
        (
            [0] => 2012-11-19 23:59:55
            [1] => http://www.ttgood.com/jy/t132522.htm
        )

    [2977] => Array
        (
            [0] => 2012-11-19 23:57:21
            [1] => http://www.ttgood.com/jy/t146185.htm
        )

    [2978] => Array
        (
            [0] => 2012-11-19 22:54:28
            [1] => http://www.ttgood.com/jy/t114232.htm
        )

    [2979] => Array
        (
            [0] => 2012-11-19 22:46:13
            [1] => http://www.ttgood.com/jy/t146763.htm
        )

    [2980] => Array
        (
            [0] => 2012-11-19 22:29:22
            [1] => http://www.ttgood.com/jy/t149178.htm
        )

    [2981] => Array
        (
            [0] => 2012-11-19 22:07:16
            [1] => http://www.ttgood.com/jy/t149132.htm
        )

    [2982] => Array
        (
            [0] => 2012-11-19 22:00:35
            [1] => http://www.ttgood.com/jy/t148736.htm
        )

    [2983] => Array
        (
            [0] => 2012-11-19 21:49:01
            [1] => http://www.ttgood.com/jy/t148938.htm
        )

    [2984] => Array
        (
            [0] => 2012-11-19 21:47:10
            [1] => http://www.ttgood.com/jy/t141904.htm
        )

)


*/



























































