<?php
include_once ($_SERVER['DOCUMENT_ROOT'].'/config/smarty_init.php');
if (isset($_SESSION['isLogin'])){
	$smarty->assign('login', $_SESSION['isLogin']);
	$smarty->assign('username', $_SESSION['username']);
}

require_once($_SERVER['DOCUMENT_ROOT'].'/menu/mainmenu.php');

$smarty->assign('mainmenu', $mainmenu);
?>