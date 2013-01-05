<?php 

/*
jy_f1 - jy_f199 每页有15条教员记录

2013-01-05

*/

require ('./simplehtmldom_1_5/simple_html_dom.php');

define(BASE,   'http://www.ttgood.com/');

// http://www.ttgood.com/jy/t10072.htm




$mentorList  = array();
for ($i=1; $i < 200; $i++) { 
	$html = file_get_html(BASE . "jy_f{$i}/");
	foreach($html->find('table .orange_') as $mentor)
	   $mentorList[] = BASE . trim(str_replace('../', '', $mentor->href));
}

echo '<pre>';print_r($mentorList);













