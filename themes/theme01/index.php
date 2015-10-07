<?php
include_once ($_SERVER['DOCUMENT_ROOT'].'/config/smarty_init.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/model/model.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/libs/simpledom/simple_html_dom.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/menu/mainmenu.php');

/**
 *Определение переменных Smarty для хранения переменных сессии
 */
if (isset($_SESSION['isLogin']) && isset($_SESSION['username'])){
	$smarty->assign('login', $_SESSION['isLogin']);
	$smarty->assign('username', $_SESSION['username']);
}

/**
 *Определение переменной Smarty для хранения массива с меню
 */
$smarty->assign('mainmenu', $mainmenu);

/**
 *Вызов функции, которая возвращает отзывы
 *Определение переменной Smarty для массива с отзывами
 */
$allFeeds = getFeedbacks($link);
$smarty->assign('feed', $allFeeds);

/**
 *Объект со страницей
 */
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
 *Функция "отжеляет" строку(направление ветра) от числа(скорости ветра) и возвращает строку,
 *разделенную слешем
 */
function wind($str){
	preg_match("/([а-яА-Я]+)([0-9]+)/", $str, $matches);
	return $matches[1]." / ".$matches[2];
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
 *Освобождение памяти
 */
$html->clear(); 
unset($html);

/**
 *В массив $arr_times_of_day_nums заносятся элементы из массива $arr_times_of_day, но с изменёнными
 *индексами. Индексы заменены таким образом, что при занесении в $arr_weather значений из $arr_times_of_day_nums
 *в пустые элементы массива с показателями погоды занесутся значения времени суток
 */
for($i = 0, $j = 0; $i <= count($arr_weather)-1, $j <= count($arr_times_of_day)-1; $i += 7, $j++) {
		$arr_times_of_day_nums[$i]=$arr_times_of_day[$j];
}

/**
 *Занесение в $arr_weather значений из $arr_times_of_day_nums, преобразование и занесение
 *корректных значений направления/скорости ветра
 */
for($i = 0, $j = 4; $i <= count($arr_weather)-1; $i += 7, $j += 7){
	$arr_weather[$i] = $arr_times_of_day_nums[$i];
	$arr_weather[$j] =  wind($arr_weather[$j]);
}

/*for($i = 4; $i <= count($arr_weather)-1; $i += 7){
	echo wind($arr_weather[$j]).'<br>';
}*/

/**
 *Разнесение показателей погоды на 3 массива ("сегодня", "завтра", "послезавтра")
 */
$today = array_slice($arr_weather, 0, 28);
$tomorrow = array_slice($arr_weather, 28, 28);
$after_tomorrow = array_slice($arr_weather, 56, 28);

/**
 *Разбиение каждого из массивов на 4 части, чтобы легче бвло обработать в Smarty
 */
$today_part =  array_chunk($today, 7);
$tomorrow_part =  array_chunk($tomorrow, 7);
$after_tomorrow_part =  array_chunk($after_tomorrow, 7);

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

$smarty->assign('arr_today', $today_part);
$smarty->assign('arr_tomorrow', $tomorrow_part);
$smarty->assign('arr_after_tomorrow', $after_tomorrow_part);
?>