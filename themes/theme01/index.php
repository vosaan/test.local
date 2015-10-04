<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/model/model.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/libs/simpledom/simple_html_dom.php');
$allFeeds = getFeedbacks($link);
include_once ($_SERVER['DOCUMENT_ROOT'].'/config/smarty_init.php');
//include_once ($_SERVER['DOCUMENT_ROOT'].'/index.php');
if (isset($_SESSION['isLogin']) && isset($_SESSION['username'])){
	$smarty->assign('login', $_SESSION['isLogin']);
	$smarty->assign('username', $_SESSION['username']);
}

require_once($_SERVER['DOCUMENT_ROOT'].'/menu/mainmenu.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/index.php');

$smarty->assign('mainmenu', $mainmenu);
$smarty->assign('feed', $allFeeds);

$today = parseWeather('http://www.gismeteo.ua/city/daily/5093/', '#tbwdaily1 tr');
$smarty->assign('today', $today);

/*$gettime = time();
$smarty->assign('datetime', $gettime);*/

//$arr = array();
//$html = file_get_html('http://www.gismeteo.ua/city/daily/5093/');

//foreach($html->find('#tbwdaily1 tr td') as $element){
//	if($element->innertext != ""){
//		$arr[] = trim($element->innertext);
//	}	
//}
//$html->clear(); 
//unset($html);

//$arr = array_diff($arr, array(''));

/*$str = preg_split('/<[^>]*[^\/]>/i', $arr[0], -1, PREG_SPLIT_NO_EMPTY);
$arr2 = array();
foreach($str as $rec){
		if(($rec)!=""){
			$arr2[] = $rec;
		}
}
$smarty->assign('today', $arr);

?>*/
