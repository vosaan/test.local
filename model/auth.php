<?php
	session_start();
	require_once('config/db_conn.php');
	
	class AuthClass{
		private $login;
		private $passw;
		
		public function __construct($login, $passw){
			$this->login = $login;
			$this->passw = $passw;
		}
		
		public function isAuth(){
			if(isset($_SESSION['isAuth'])){
				return $_SESSION['isAuth'];
			} else {
				return false;
			}
		}
		
		public function auth($login, $passw){
			if($login == $this->login && $passw == $this->passw){
				$_SESSION['isAuth'] = true;
				$_SESSION['login'] = $login;
				return true;
			} else {
				$_SESSION['isAuth'] = false;
				return false;
			}
		}
		
		public function getLogin(){
			if($this->isAuth()){
				return $_SESSION['login'];
			}
		}
		
		public function out(){
			$_SESSION = array();
			session_destroy();
		}
	}
	
	function fromDB($link, $login, $passw){
		$sql = "SELECT * FROM users WHERE login = '%s'";
		$query = sprintf($sql, $login);
		$result = mysqli_query($link, $query) or die(mysqli_error($link));
		return $row = mysqli_fetch_assoc($result);
		
	}
	
	$auth_login = "";
	$auth_passw = "";
	
	if(isset($_POST['login']) && isset($_POST['passw'])){
		$user_arr = fromDB($link, $_POST['login'], $_POST['passw']);
		echo $login = $user_arr['login'];
		echo $passw = $user_arr['passw'];
		
		if($login == $_POST['login'] && $passw == $_POST['passw']){
			$auth_login = $login;
			$auth_passw = $passw;
			echo $login.':'.$_POST['login']."<br>";
			echo $passw.':'.$_POST['passw'];
		}
	}
	
	$auth = new AuthClass($auth_login, $auth_passw);
	
	if(isset($_POST['login']) && isset($_POST['passw'])){
		if(!$auth->auth($_POST['login'], $_POST['passw'])){
			echo "Логин и пароль введены неправильно";
		}
	}
	
	if(isset($_GET['is_exit'])){
		if($_GET['is_exit'] == 1){
			$auth->out();
			header ('Location: index.php?is_exit=0');
		}
	}
?>