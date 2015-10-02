<?php
	ob_start();
	require_once('config/db_conn.php');

	/*function getAuthFields($login, $password){
		//$authArr = array();
		if(isset($login) && isset($password)){
			$_SESSION['isLogin'] = true;
			return $authArr = array('login' =>	$login,
							   'password' => $password);
		} else {
			return false;
		}	
	}*/

	function getFromDB($login, $password, $link){
		if(isset($login) && isset($password)){		
			$sql = "SELECT * FROM users WHERE login='%s'";
			$query = sprintf($sql, $login);
			$result = mysqli_query($link, $query) or die(mtsqli_error($link));
			$row = mysqli_fetch_assoc($result);
			if(isset($row['login']) && isset($row['passw']) && isset($row['id'])){
				if($row['login'] == $login && $row['passw'] == $password){
					$_SESSION['username'] = $login;
					$_SESSION['id'] = $row['id'];
					return $_SESSION['isLogin'] = true;
				} else {
					echo "No!";
					return false;
				}
			}
		} else {
			return false;
		}

	}

	function logout(){
		$_SESSION = array();
		session_destroy();
		return header('Location: /');
	}

	function registration($login, $password, $password_confirm, $link){
		if(isset($login) && isset($password) && isset($password_confirm)){
			$sql = "SELECT * FROM users WHERE login='%s'";
			$query = sprintf($sql, $login);
			$result = mysqli_query($link, $query) or die(mtsqli_error($link));
			$row = mysqli_fetch_assoc($result);
			if($row['login'] == $login){
				print ("Такой уже есть");
				return false;
			}
			if($password == $password_confirm){
				$sql = "INSERT INTO users (login, passw) VALUES ('%s', '%s')";
				$query = sprintf($sql, $login, $password);
				$result = mysqli_query($link, $query) or die(mysqli_error($link));
				return header('Location: /');
			} else {
				print("Пароли не совпадают!");
			}
		} else {
			return false;
		}
	}
	
	function setFeedback($title, $message, $link){
		if(isset($_SESSION['id']) && isset($title) && isset($message)){
			$sql = "INSERT INTO feedbacks (userid, title, message) VALUES ('%d', '%s', '%s')";
			$query = sprintf($sql, $_SESSION['id'], $title, $message);
			$result = mysqli_query($link, $query) or die(mysqli_error($link));
			return header('Location: index.php?page=feed');
		} 
	}
	
	function getFeedbacks($link){
		$sql = "SELECT * FROM %s";
		$query = sprintf($sql, 'feedbacks');
		$result = mysqli_query($link, $query);
		$allFeeds = mysqli_fetch_all($result, MYSQLI_ASSOC);
		return $allFeeds;		
	}

	/*function setFeedback(){
		print($_SESSION['id']);
	}	*/
?>
