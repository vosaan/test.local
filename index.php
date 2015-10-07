<?
	ob_start();
	session_start();
	require_once ($_SERVER['DOCUMENT_ROOT'].'/themes/theme01/index.php');
	include_once ($_SERVER['DOCUMENT_ROOT'].'/config/smarty_init.php');
	
	require_once($_SERVER['DOCUMENT_ROOT'].'/model/user.php');
	
	$smarty->display('header.html');
	
	if(isset($_GET['action'])){
		$action = $_GET['action'];
	} else {
		$action = "";
	}
	
	if(isset($_GET['page'])){
		$page = $_GET['page'];
	} else {
		$page = "";
	}

	if(isset($_SESSION['isLogin'])){
		print_r($_SESSION);
	} else if($action == ""){
		$smarty->display('login.html');
	}
	
	if($action == "auth"){
		if(isset($_POST['auth_form_login']) && isset($_POST['auth_form_password'])){
			getFromDB($_POST['auth_form_login'], $_POST['auth_form_password'], $link);
			header("Location: /");
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
		}
	} else if($action == "logout"){
		logout();
		$smarty->display('login.html');
	} 
	
	if($action == "feedback"){
		if(isset($_POST['title']) &&
			 isset($_POST['message'])){
				setFeedback($_POST['title'], $_POST['message'], $link);	
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
		//echo '<pre>';
		//$allFeeds = getFeedbacks($link);
		//print_r($allFeeds);
		//echo '</pre>';
	}
	
	$smarty->display('footer.html');
?>