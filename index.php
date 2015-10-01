<?
	session_start();
	include_once ($_SERVER['DOCUMENT_ROOT'].'/themes/theme01/index.php');
	include_once ($_SERVER['DOCUMENT_ROOT'].'/config/smarty_init.php');
	
	require_once("model/model.php");
	
	$smarty->display('header.html');
	
	if(isset($_GET['action'])){
		$action = $_GET['action'];
	} else {
		$action = "";
	}

	if(isset($_SESSION['isLogin'])){
		echo "login";
		print_r($_SESSION);
	} else if($action == ""){
		$smarty->display('login.html');
	}
	
	if($action == "auth"){
		if(isset($_POST['auth_form_login']) && isset($_POST['auth_form_password'])){
			getFromDB($_POST['auth_form_login'], $_POST['auth_form_password'], $link);
			//header("Location: /");
		}
	} else if($action == "reg"){
		$smarty->display('registration.html');
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
		$smarty->display('login.html');
	}
	$smarty->display('footer.html');
?>