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

require ('./simplehtmldom_1_5/simple_html_dom.php');

define(BASE,   'http://www.ttgood.com/');

set_time_limit(0);

//$html = file_get_html('http://www.ttgood.com/jy/t138288.htm');
$html = file_get_html('http://www.ttgood.com/jy/t150097.htm');

$mentor_lastLoginTime = trim($html->find("table", 3)
                                  ->find("tr td", 2)
                                  ->find("table tr", 1)
                                  ->find("table", 0)
                                  ->find("tr", 0)
                                  ->find("td", 1)
                                  ->find("td", 3)
                                  ->find("span", 0)->plaintext);

$mentor_sex           = trim($html->find("table", 3)
                                  ->find("tr td", 2)
                                  ->find("table tr", 1)
                                  ->find("table", 2) // 教员基本信息
                                  ->find("tr", 3)
                                  ->find("div", 1)->plaintext);


$mentor_nationality   = trim($html->find("table", 3)
                                  ->find("tr td", 2)
                                  ->find("table tr", 1)
                                  ->find("table", 2)
                                  ->find("tr", 3)
                                  ->find("td", 3)->plaintext);

$mentor_birthday      = trim($html->find("table", 3)
                                  ->find("tr td", 2)
                                  ->find("table tr", 1)
                                  ->find("table", 2)
                                  ->find("tr", 4)
                                  ->find("td", 1)->plaintext);


$mentor_school        = trim($html->find("table", 3)
                                  ->find("tr td", 2)
                                  ->find("table tr", 1)
                                  ->find("table", 2)
                                  ->find("tr", 4)
                                  ->find("td", 3)->plaintext);



$mentor_academic      = trim($html->find("table", 3)
                                  ->find("tr td", 2)
                                  ->find("table tr", 1)
                                  ->find("table", 2)
                                  ->find("tr", 5)
                                  ->find("td", 1)->plaintext);


$mentor_major         = trim($html->find("table", 3)
                                  ->find("tr td", 2)
                                  ->find("table tr", 1)
                                  ->find("table", 2)
                                  ->find("tr", 5)
                                  ->find("td", 3)->plaintext);

$mentor_identity      = trim($html->find("table", 3)
                                  ->find("tr td", 2)
                                  ->find("table tr", 1)
                                  ->find("table", 2)
                                  ->find("tr", 6)
                                  ->find("td", 1)->plaintext);


$mentor_teachable     = trim($html->find("table", 3)
                                  ->find("tr td", 2)
                                  ->find("table tr", 1)
                                  ->find("table", 3) // 教员家教信息
                                  ->find("tr", 1)
                                  ->find("td", 1)->plaintext);



$mentor_selfIntro     = trim($html->find("table", 3)
                                  ->find("tr td", 2)
                                  ->find("table tr", 1)
                                  ->find("table", 3)
                                  ->find("tr", 2)
                                  ->find("td", 1)->plaintext);



$mentor_certificate   = trim($html->find("table", 3)
                                  ->find("tr td", 2)
                                  ->find("table tr", 1)
                                  ->find("table", 3)
                                  ->find("tr", 3)
                                  ->find("td", 1));


/*
$html->find("table", 3)
                                  ->find("tr td", 2)
                                  ->find("table tr", 1)
                                  ->find("table", 2)
*/
