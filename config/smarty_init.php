<?php
/**
* Подключение библиотеки Smarty
*/	
	include_once ($_SERVER['DOCUMENT_ROOT'].'/libs/smarty/smarty.class.php');
/**
* Создание объекта Smarty
*/	
	$smarty = new Smarty();
/**
* Переопределение рабочих каталогов Smarty
*/	
	$smarty->setCacheDir($_SERVER['DOCUMENT_ROOT'].'/themes/theme01/cache');
	$smarty->setConfigDir($_SERVER['DOCUMENT_ROOT'].'/themes/theme01/configs');	
	$smarty->setTemplateDir($_SERVER['DOCUMENT_ROOT'].'/themes/theme01/templates');
	$smarty->setCompileDir($_SERVER['DOCUMENT_ROOT'].'/themes/theme01/templates_c');