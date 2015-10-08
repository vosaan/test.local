<?php
/**
 * smarty_init.php
 * Подключение библиотеки Smarty
 */	
	
include_once ($_SERVER['DOCUMENT_ROOT'].'/libs/smarty/Smarty.class.php');

/* Создание объекта Smarty */	
$smarty = new Smarty();

/* Переопределение рабочих каталогов Smarty */	
$smarty->setCacheDir($_SERVER['DOCUMENT_ROOT'].'/themes/theme01/cache');
$smarty->setConfigDir($_SERVER['DOCUMENT_ROOT'].'/themes/theme01/configs');	
$smarty->setTemplateDir($_SERVER['DOCUMENT_ROOT'].'/themes/theme01/templates');
$smarty->setCompileDir($_SERVER['DOCUMENT_ROOT'].'/themes/theme01/templates_c');