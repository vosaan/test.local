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

/**
 * Функция "отсекает" все символы в строке после заданного (используется для того,
 * чтобы отделить показатели погоды в метрической системе и отсеч показатели в другх системах)
 */
function delete($str,$symbol=' ') 
{
	return($strpos=mb_strpos($str,$symbol))!==false?mb_substr($str,0,$strpos,'utf8'):$str;
} 

/**
 *В массив $arr_times_of_day заносятся значения времени суток за 3 дня.
 */
foreach($html->find('th') as $element){
	if(isset($element->title)){
		$arr_times_of_day[] = trim($element->plaintext);
	} 
}

/**
 *В масив $arr_weather заносятся показатели погоды за 3 дня (только в мерической системе). В массиве
 *присутствуют пустые элементы, на их месте должны быть картинки ("ясно", "облачно" и т.д.), которые
 *plaintext пропускает. Поскольку эти картинки дублируются текстом, то на их место будут занесены
 *значения времени суток
 */
foreach($html->find('tr.wrow td') as $element){
	if(!$element -> img){
		$arr_weather[] = delete($element->plaintext, " ");
	} 
}

/**
 *В массив $arr_times_of_day_nums заносятся элементы из массива $arr_times_of_day, но с изменёнными
 *индексами. Индексы заменены таким образом, что при занесении в $arr_weather значений из $arr_times_of_day_nums
 *в пустые элементы массива с показателями погоды занесутся значения времени суток
 */
for($i = 0, $j = 0; $i <= count($arr_weather)-1, $j <= count($arr_times_of_day)-1; $i += 7, $j++) {
		$arr_times_of_day_nums[$i]=$arr_times_of_day[$j];
}

/**
 *Занесение в $arr_weather значений из $arr_times_of_day_nums
 */
for($i = 0; $i <= count($arr_weather)-1; $i += 7){
	$arr_weather[$i]=$arr_times_of_day_nums[$i];
}

/**
 *Разнесение показателей погоды на 3 массива ("сегодня", "завтра", "послезавтра")
 */
$today = array_slice($arr_weather, 0, 28);
$tomorrow = array_slice($arr_weather, 28, 28);
$after_tomorrow = array_slice($arr_weather, 56, 28);

/**
 *Определение дат ("сегодня", "завтра", "послезавтра")
 */
setlocale(LC_TIME, "ru-RU");
$today_date = strftime("%A, ".'%d'.'.'.'%m'.'.'.'%Y');
$tomorrow_date = strftime("%A, ".'%d'.'.'.'%m'.'.'.'%Y',strtotime("+1 day"));
$after_tomorrow_date = strftime("%A, ".'%d'.'.'.'%m'.'.'.'%Y',strtotime("+2 day"));

/**
 *Определение переменных Smarty для вывода вседений о погоде
 */
$smarty->assign('today_date', $today_date);
$smarty->assign('tomorrow_date', $tomorrow_date);
$smarty->assign('after_tomorrow_date', $after_tomorrow_date);

$smarty->assign('arr_today', $today);
$smarty->assign('arr_tomorrow', $tomorrow);
$smarty->assign('arr_after_tomorrow', $after_tomorrow);
 
?>
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
	//$arr_new = array_chunk($arr2, 7);
	//$arr_day = array_chunk($arr_new, 3);
	//$smarty->assign('weath', $arr_new);
	//print_r($arr2);	
	//print_r($arr_times_of_day_nums);
	/*
echo $today_date.'<br>';
echo $tomorrow_date.'<br>';
echo $after_tomorrow_date.'<br>';

	
	print_r($today);
	
	print_r($tomorrow);
	
	print_r($after_tomorrow);
	?>
	*/
	
	


