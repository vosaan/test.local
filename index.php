<?
/**
 * index.php
 * "Точка входа" в приложение
 */

/* Включение буферизации (в данном случае позволяет использовать http-заголовки после вывода на экран) */
ob_start();
	
/* Начало сессии */	
session_start();

/* Подключение файла шаблона */
require_once($_SERVER['DOCUMENT_ROOT'].'/themes/theme01/index.php');

/* Подключение файла "логики" приложения */
require_once($_SERVER['DOCUMENT_ROOT'].'/model/model.php');
	
/* Вывод "шапки" шаблона */
$smarty->display('header.html');
	
/*
 * Переменная $action хранит значение action, которое "приходит" с GET-запросом. На основании
 * значения подключается шаблон той или иной страницы и производятся операции с пользователем
 */
if(isset($_GET['action'])){
	$action = $_GET['action'];
} else {
	$action = "";
}
	
/*
 * Переменная $page хранит значение page, которое "приходит" с GET-запросом. На основании
 * значения подключается шаблон той или иной страницы
 */	
if(isset($_GET['page'])){
	$page = $_GET['page'];
} else {
	$page = "";
}

/*
 * Признаком авторизации является значение true в элементе 'isLogin' массива $_SESSION.
 * Если это не так, вызывается шаблон страницы авторизации
 */	
	if(isset($_SESSION['isLogin'])){
		//print_r($_SESSION);
	} else if($action == ""){
		$smarty->display('login.html');
	}

/*
 * В зависимости от значения переменной $action вызываются функции входа, выхода, регистрации
 * или записи отзыва в базу данных из файла model.php
 */	
if($action == "auth"){
	
	/* Проверяется заполнение полей формы авторизации */
	if(isset($_POST['auth_form_login']) && isset($_POST['auth_form_password'])){
	
		/* Если поля заполнены, вызывается функция login() из файла model.php. Аргументами функции
		 * являются значения, полученные из формы авторизации
		 */
			if(login($_POST['auth_form_login'], $_POST['auth_form_password'], $link)){
	
			/* Если логин и пароль, введённые в форме авторизации, совпадают с соответствующей
			 * записью в базе данных, пользователь считается авторизированным и перенаправляется
			 * на страницу с прогнозом погоды,
			 */
			header("Location: index.php?page=weather");
		
			/* иначе перенаправляется на страницу авторизации */
		} else header("Location: index.php");
	}
} else if($action == "logout"){
	
	/*
	 * При нажатии кнопки "Выход" вызывается функция logout() из файла model.php и 
	 * пользватель перенаправляется на страницу авторизации
	 */
	logout();
	header("Location: index.php");
} else if($action == "reg"){

	/* Вызывается шаблон страницы регистрации */
	$smarty->display('registration.html');

	/* Если все поля заполнены, вызывается функция registration() из файла model.php */
	if(isset($_POST['reg_form_login']) && 
	   isset($_POST['reg_form_password']) &&
	   isset($_POST['reg_form_password_confirm'])){
		 registration($_POST['reg_form_login'],
			 				    $_POST['reg_form_password'],
							    $_POST['reg_form_password_confirm'],
							    $link);
	}
} else if($action == "feedback"){

	/* Если все поля заполнены, вызывается функция setFeedback() из файла model.php 
	 * и выполняется перенаправление на страницу с отзывами
	 */
	if(isset($_POST['title']) &&
	   isset($_POST['message']) &&
	   isset($_POST['email'])){
			if(setFeedback($_POST['title'], $_POST['message'], $_POST['email'], $link)){
				header('Location: index.php?page=readfeed');
			}
	}	
}

/*
 * В зависимости от значения переменной $page вызываются шаблоны соответствующих страниц
 */
if($page == "weather"){
	$smarty->display('weather.html');
}	else if($page == "feed"){
	$smarty->display('feedback.html');
} else if($page == "readfeed"){
	$smarty->display('readfeed.html');
}
	
/* Вывод "подвала" шаблона */
$smarty->display('footer.html');
?>