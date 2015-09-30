<pre>
<?php
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
			if(isset($row['login']) && isset($row['passw'])){
				if($row['login'] == $login && $row['passw'] == $password){
					$_SESSION['username'] = $login;
					return $_SESSION['isLogin'] = true;
				} else {
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
		return true;
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
				$result = mysqli_query($link, $query) or die(mtsqli_error($link));
				return header('Location: /');
			} else {
				print("Пароли не совпадают!");
			}
		} else {
			return false;
		}
	}
?>
</pre>