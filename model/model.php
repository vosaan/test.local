<?php
/* Включение буферизации (в данном случае позволяет использовать http-заголовки после вывода на экран) */
ob_start();

/* Подключение файла конфигурации подключения к базе данных */
require_once($_SERVER['DOCUMENT_ROOT'].'/config/db_conn.php');

/* Подключение библиотеки для парсинга */
require_once($_SERVER['DOCUMENT_ROOT'].'/libs/simpledom/simple_html_dom.php');

/* Авторизация пользователей */
function login($login, $password, $link){
	
	/* Если аргументы определены -  */
	if(isset($login) && isset($password)){
		
		/* логин и пароль "очищаются" от "лишних" символов */
		$login =  mysqli_real_escape_string($link, trim($login));
		$password =  mysqli_real_escape_string($link, trim($password));	
		
		/* 
		 * Подготовка и выполнение запроса к базе данных. В случае, если в таблице users 
		 * существует запись, в которой поле login совпадает с переданным функции аргументом $login,
		 * запрос вернёт массив, содержащий соответствующую запись.
		 */	
		$sql = "SELECT * FROM users WHERE login='%s'";
		$query = sprintf($sql, $login);
		$result = mysqli_query($link, $query) or die(mtsqli_error($link));
		$row = mysqli_fetch_assoc($result);
		
		/* 
		 * Если в результате запроса определены все требуемые элементы массива $row,
		 * то они сравниваются с полученными функцией аргументами
		 */
		if(isset($row['login']) && isset($row['passw']) && isset($row['id'])){
			if($row['login'] == $login && $row['passw'] == $password){
				
				/*
				 * Если данные совпадают, в массив $_SESSION записываются значения:
				 * логин пользователя, его id и признак авторизации
				 */
				$_SESSION['username'] = $login;
				$_SESSION['id'] = $row['id'];
				$_SESSION['isLogin'] = true;
				return true;
			} else return false;
		}
	} else return false;
}

/* Выход */
	function logout(){
		
		/*
		 * Массив $_SESSION "обнуляется", сессия уничтожается, пользователь перенаправляется 
		 * в корень сайта (index.php)
		 */
		$_SESSION = array();
		session_destroy();
		return header('Location: /');
	}


/*	Регистрация нового пользователя */	
function registration($login, $password, $password_confirm, $link){
	
	/* Если аргументы определены -  */
	if(isset($login) && isset($password) && isset($password_confirm)){
		
		/* логин, пароль и подтверждение пароля "очищаются" от "лишних" символов */
		$login =  mysqli_real_escape_string($link, trim($login));
		$password =  mysqli_real_escape_string($link, trim($password));
		$password_confirm =  mysqli_real_escape_string($link, trim($password_confirm));
		
		/* 
		 * Подготовка и выполнение запроса к базе данных. В случае, если в таблице users 
		 * существует запись, в которой поле login совпадает с переданным функции аргументом $login,
		 * запрос вернёт массив, содержащий соответствующую запись.
		 */	
		$sql = "SELECT * FROM users WHERE login='%s'";
		$query = sprintf($sql, $login);
		$result = mysqli_query($link, $query) or die(mtsqli_error($link));
		$row = mysqli_fetch_assoc($result);
		/*
		 * Если данные совпадают, выводится сообщение о том, что такой пользователь
		 * уже существует
		 */			
		if(isset($row['login'])){
			if($row['login'] == $login){
				print ("<p style = 'color: red; text-align: center'>Пользователь с таким логином уже существует!</p>");
				return false; 
			}
		}

		/*
		 * Если логин и пароль не соответствуют требованиям безопасности, функция
		 * прекращет работу. Соответствующие сообщения выводятся с помощью
		 * скрипта валидации на js
		 */
			if(!preg_match('/^[a-z0-9_-]{3,15}$/', $login)){
				//print ("Неверный формат логина");
				return false; 				
		} else if(!preg_match('/^[a-z0-9_-]{6,15}$/', $password)){
				//print ("Неверный формат пароля");
				return false; 				
		}			
		
		/*
		 * Если пароль и подтверждение пароля совпадают, то подготавливается и выполнятеся запрос
		 * к базе данных, который вставляет новую запись с данными, полученными от пользователя
		 */
		if($password == $password_confirm){
			$sql = "INSERT INTO users (login, passw) VALUES ('%s', '%s')";
			$query = sprintf($sql, $login, $password);
			$result = mysqli_query($link, $query) or die(mysqli_error($link));
			return header('Location: /');
			} else {
					print ("<p style = 'color: red; text-align: center'>Пароли не совпадают!</p>");
					return false;}	
	} else return false; 
}
	

/* Добавление отзыва */
function setFeedback($title, $message, $email, $link){
	
	/* Если аргументы определены -  */
	if(isset($_SESSION['id']) && isset($title) && isset($message) && isset($email)){
		
		/* заголовок, e-mail и сообщение "очищаются" от "лишних" символов, а id явно приводится к целому числу */
		$title =  mysqli_real_escape_string($link, trim($title));
		$email =  mysqli_real_escape_string($link, trim($email));
		$message =  mysqli_real_escape_string($link, trim($message));
		$sess_id = (int)$_SESSION['id'];
		
		if(preg_match('/^([a-z0-9_\.-]+)@([a-z0-9_\.-]+)\.([a-z\.]{2,12})$/', $email)){
		/* 
		 * Подготовка и выполнение запроса к базе данных. В таблицу feedbacks заносятся
		 * заголовок сообщения, сообщение, e-mail и id пользователя, который оставил сообщение
		 */	
		$sql = "INSERT INTO feedbacks (userid, title, email, message) VALUES ('%d', '%s', '%s', '%s')";
		$query = sprintf($sql, $sess_id, $title, $email, $message);
		$result = mysqli_query($link, $query) or die(mysqli_error($link));
		return true;
		} else return false;
	} else return false;
}

/* Отображение всех отзывов */	
function getFeedbacks($link){
	/* Подготовка и выполнение запроса к базе данных. */
	$sql = "SELECT login, title, email, message, datetime FROM users, feedbacks WHERE users.id = feedbacks.userid";
	$result = mysqli_query($link, $sql);
	$allFeeds = mysqli_fetch_all($result, MYSQLI_ASSOC);
	
	/* Функция возвращает ассоц. массив со всеми отзывами */
	return $allFeeds;
}

/* Парсинг  погоды */
function deadWeather(){
	/* Объект со страницей */
	$html = file_get_html('https://www.gismeteo.ua/weather-zaporizhzhya-5093/');
	
	/*
	 * Функция "отсекает" все символы в строке после заданного (используется для того,
	 * чтобы отделить показатели погоды в метрической системе и отсеч показатели в другх системах)
	 */
	function delete($str,$symbol=' ') 
	{
		return($strpos=mb_strpos($str,$symbol))!==false?mb_substr($str,0,$strpos,'utf8'):$str;
	}
		
	/*
	 * Функция "отделяет" строку(направление ветра) от числа(скорости ветра) и возвращает строку,
	 * разделенную слешем
	 */
	function wind($str){
		preg_match("/([а-яА-Я]+)([0-9]+)/", $str, $matches);
		return $matches[1]." / ".$matches[2];
	}
		
	/* В массив $arr_times_of_day заносятся значения времени суток за 3 дня. */
	foreach($html->find('th') as $element){
		if(isset($element->title)){
			$arr_times_of_day[] = trim($element->plaintext);
		} 
	}
		
	/*
	 * В масив $arr_weather заносятся показатели погоды за 3 дня (только в мерической системе). В массиве
	 * присутствуют пустые элементы, на их месте должны быть картинки ("ясно", "облачно" и т.д.), которые
	 * plaintext пропускает. Поскольку эти картинки дублируются текстом, то на их место будут занесены
	 * значения времени суток
	 */
	foreach($html->find('tr.wrow td') as $element){
		if(!$element -> img){
			$arr_weather[] = delete($element->plaintext, " ");
		} 
	}
		
		
	/* Освобождение памяти */
	$html->clear(); 
	unset($html);
		
	/*
	 * В массив $arr_times_of_day_nums заносятся элементы из массива $arr_times_of_day, но с изменёнными
	 * индексами. Индексы заменены таким образом, что при занесении в $arr_weather значений из $arr_times_of_day_nums
	 * в пустые элементы массива с показателями погоды занесутся значения времени суток
	 */
	for($i = 0, $j = 0; $i <= count($arr_weather)-1, $j <= count($arr_times_of_day)-1; $i += 7, $j++) {
			$arr_times_of_day_nums[$i]=$arr_times_of_day[$j];
	}
		
	/*
	 * Занесение в $arr_weather значений из $arr_times_of_day_nums, преобразование и занесение
	 * корректных значений направления/скорости ветра
	 */
	for($i = 0, $j = 4; $i <= count($arr_weather)-1; $i += 7, $j += 7){
		$arr_weather[$i] = $arr_times_of_day_nums[$i];
		$arr_weather[$j] =  wind($arr_weather[$j]);
	}
		
	/* Разнесение показателей погоды на 3 массива ("сегодня", "завтра", "послезавтра") */
	$today = array_slice($arr_weather, 0, 28);
	$tomorrow = array_slice($arr_weather, 28, 28);
	$after_tomorrow = array_slice($arr_weather, 56, 28);
	
	/* Разбиение каждого из массивов на 4 части, чтобы легче бвло обработать в Smarty */
	$today_part =  array_chunk($today, 7);
	$tomorrow_part =  array_chunk($tomorrow, 7);
	$after_tomorrow_part =  array_chunk($after_tomorrow, 7);
	
	/* Определение дат ("сегодня", "завтра", "послезавтра") */
	setlocale(LC_TIME, "ru-RU");
	$today_date = strftime("%A, ".'%d'.'.'.'%m'.'.'.'%Y');
	$tomorrow_date = strftime("%A, ".'%d'.'.'.'%m'.'.'.'%Y',strtotime("+1 day"));
	$after_tomorrow_date = strftime("%A, ".'%d'.'.'.'%m'.'.'.'%Y',strtotime("+2 day"));
		
	/* Массив с результатами выполнения функции */
	$result = array('today_part' => $today_part,
									'tomorrow_part' => $tomorrow_part,
									'after_tomorrow_part' => $after_tomorrow_part,
									'today_date' => $today_date,
									'tomorrow_date' => $tomorrow_date,
									'after_tomorrow_date' => $after_tomorrow_date
									);
	return $result;		
}

/* Заголовки страниц */
function getTitle(){
	$title = "";
	if(@$_GET['page'] == "weather"){
			return $title="Погода в Запорожье";
	} else if(@$_GET['page'] == "feed"){
			return $title="Оставить отзыв";				
	} else if(@$_GET['page'] == "readfeed"){
			return $title="Почитать отзывы";				
	} else if(@$_GET['action'] == "reg"){
			return $title="Регистрация";				
	} else return $title="Авторизация";
}
?>