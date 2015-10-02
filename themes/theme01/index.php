<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/model/model.php');
$allFeeds = getFeedbacks($link);
include_once ($_SERVER['DOCUMENT_ROOT'].'/config/smarty_init.php');
include_once ($_SERVER['DOCUMENT_ROOT'].'/index.php');
if (isset($_SESSION['isLogin']) && isset($_SESSION['username'])){
	$smarty->assign('login', $_SESSION['isLogin']);
	$smarty->assign('username', $_SESSION['username']);
}

require_once($_SERVER['DOCUMENT_ROOT'].'/menu/mainmenu.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/index.php');

//if(isset($allFeeds))echo "sdfsdfsdfsdf";

$smarty->assign('mainmenu', $mainmenu);
$smarty->assign('feed', $allFeeds);
/*$gettime = time();
$smarty->assign('datetime', $gettime);*/
?>