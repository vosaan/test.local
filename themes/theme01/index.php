<?php
include_once ($_SERVER['DOCUMENT_ROOT'].'/config/smarty_init.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/model/model.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/libs/simpledom/simple_html_dom.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/menu/mainmenu.php');

if (isset($_SESSION['isLogin']) && isset($_SESSION['username'])){
	$smarty->assign('login', $_SESSION['isLogin']);
	$smarty->assign('username', $_SESSION['username']);
}

$smarty->assign('mainmenu', $mainmenu);

$allFeeds = getFeedbacks($link);
$smarty->assign('feed', $allFeeds);

$html = file_get_html('https://www.gismeteo.ua/weather-zaporizhzhya-5093/');

foreach($html->find('th') as $element){
	if(isset($element->title)){
		$arr[] = $element->title.'::'.trim($element);
	} 
}
for($i=0, $k=0; $i<=77, $k<=11; $i+=7, $k++) {
		$arrn[$i]=$arr[$k];
}

foreach($html->find('tr.wrow td') as $element){
	if(!$element -> img){
		$arr2[] = $element->plaintext;
	} 
}

for($j=0; $j<=77; $j+=7){
	$arr2[$j]=$arrn[$j];
}

//$arr2 = array_diff($arr2, array(''));
//$arr2 = array_values(array_filter($arr2));

//unset($arr[0]);
//array_unshift($arr2, $arr[0]); 

?><pre>
	<?
	/*$j=0;
	//echo count($arr2);
	for($i=0; $i<count($arr); $i++){
		for(; $j<count($arr2); $j+=6){
			//$arr[$j] = $arr[$i];
			echo $i."  ".$j; continue; continue;
		}
	}
	//print_r($arr);*/
	print_r(array_chunk($arr2, 7));
	print_r($arrn);	
	//print_r($arr2);	
	?>


