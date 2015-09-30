<?
	session_start();
	//include_once ($_SERVER['DOCUMENT_ROOT'].'/themes/theme01/index.php');
	include_once ($_SERVER['DOCUMENT_ROOT'].'/config/smarty_init.php');
	$smarty->display('header.html');
	require_once("model/model.php");
	$errors = array();

	if(isset($_GET['action'])){
		$action = $_GET['action'];
	} else {
		$action = "";
	}

	if(isset($_SESSION['isLogin'])){
		include('view/mainpage.php');
	} else if($action == ""){
		$smarty->display('login.html');
	}
	
	if($action == "auth"){
		if(isset($_POST['auth_form_login']) && isset($_POST['auth_form_password'])){
			getFromDB($_POST['auth_form_login'], $_POST['auth_form_password'], $link);
			header("Location: /");
		}
	} else if($action == "reg"){
		include('view/reg.php');
		if(isset($_POST['reg_form_login']) && 
		   isset($_POST['reg_form_password']) &&
		   isset($_POST['reg_form_password_confirm'])){
			registration($_POST['reg_form_login'],
						 $_POST['reg_form_password'],
						 $_POST['reg_form_password_confirm'],
						 $link);
			//header("Location: /");
		}
	} else if($action == "logout"){
		logout();
		header("Location: /");
	}
	$smarty->display('header.html');
?>