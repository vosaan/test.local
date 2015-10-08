<?
	ob_start();
	session_start();
	require_once ($_SERVER['DOCUMENT_ROOT'].'/themes/theme01/index.php');
	include_once ($_SERVER['DOCUMENT_ROOT'].'/config/smarty_init.php');
	require_once($_SERVER['DOCUMENT_ROOT'].'/model/user.php');
	
	/*Подключение "шапки" шаблона*/
	$smarty->display('header.html');
	
	/**
	 *Переменная хранит значение action, которое "приходит" с GET-запросом. На основании
	 *значения производятся операции с пользователем
	 */
	if(isset($_GET['action'])){
		$action = $_GET['action'];
	} else {
		$action = "";
	}
	
	/**
	 *Переменная хранит значение page, которое "приходит" с GET-запросом. На основании
	 *значения производятся операции с отзывами
	 */	
	if(isset($_GET['page'])){
		$page = $_GET['page'];
	} else {
		$page = "";
	}

	
	if(isset($_SESSION['isLogin'])){
		//print_r($_SESSION);
	} else if($action == ""){
		$smarty->display('login.html');
	}
	
	if($action == "auth"){
		if(isset($_POST['auth_form_login']) && isset($_POST['auth_form_password'])){
			$user = new user();
			$user->login($_POST['auth_form_login'], $_POST['auth_form_password'], $link);
			header("Location: index.php?page=weather");
		}
	} else if($action == "logout"){
		user::logout();
		$smarty->display('login.html');
	} else if($action == "reg"){
		$smarty->display('registration.html');
		if(isset($_POST['reg_form_login']) && 
		   isset($_POST['reg_form_password']) &&
		   isset($_POST['reg_form_password_confirm'])){
				user::registration($_POST['reg_form_login'],
								   $_POST['reg_form_password'],
								   $_POST['reg_form_password_confirm'],
								   $link);
		}
	} else if($action == "feedback"){
		if(isset($_POST['title']) &&
			 isset($_POST['message'])){
				setFeedback($_POST['title'], $_POST['message'], $link);
				header('Location: index.php?page=readfeed');
		}	
	}
		
	if($page == "weather"){
		$smarty->display('weather.html');
	}	
	
	if($page == "feed"){
		$smarty->display('feedback.html');
	}
	
	$allFeeds = array();
	
	if($page == "readfeed"){
		$smarty->display('readfeed.html');
	}
	
	$smarty->display('footer.html');
?>