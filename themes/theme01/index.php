<?php
	include_once ($_SERVER['DOCUMENT_ROOT'].'/libs/smarty/Smarty.class.php');
	
	$smarty = new Smarty();
	
	$smarty->setCacheDir($_SERVER['DOCUMENT_ROOT'].'/themes/theme01/cache');
	$smarty->setConfigsDir($_SERVER['DOCUMENT_ROOT'].'/themes/theme01/cache');
	$smarty->setTemlpateDir($_SERVER['DOCUMENT_ROOT'].'/themes/theme01/cache');
	$smarty->setCompileDir($_SERVER['DOCUMENT_ROOT'].'/themes/theme01/cache');
	
?>