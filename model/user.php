<?php
/**
 * user.php
 */
//ob_start();
require_once($_SERVER['DOCUMENT_ROOT'].'/config/db_conn.php');
 
class user{
    private $login;
    private $password;
    private $id;
    
    function __construct($login, $password){
        $this->login = $login;
        $this->password = $password;
    }
    
    function login($login, $password, $link){
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
                } else return false;    
            }
        } else return false;
    }
    
    static function logout(){
		$_SESSION = array();
		session_destroy();
        unset($user);
		return header('Location: /');        
    }
    
    static function registration($login, $password, $password_confirm, $link){
		if(isset($login) && isset($password) && isset($password_confirm)){
			$sql = "SELECT * FROM users WHERE login='%s'";
			$query = sprintf($sql, $login);
			$result = mysqli_query($link, $query) or die(mtsqli_error($link));
			$row = mysqli_fetch_assoc($result);
			if($row['login'] == $login){
				print ("Пользователь с таким логином уже существует!");
				return false;
			} else if(!preg_match('/^[a-z0-9_-]{3,15}$/', $login)){
				print ("Неверный формат логина");
				return false; 				
			} else if(!preg_match('/^[a-z0-9_-]{6,15}$/', $password)){
				print ("Неверный формат пароля");
				return false; 				
			}
			
            if($password == $password_confirm){
				$sql = "INSERT INTO users (login, passw) VALUES ('%s', '%s')";
				$query = sprintf($sql, $login, $password);
				$result = mysqli_query($link, $query) or die(mysqli_error($link));
				return header('Location: /');
			} else print("Пароли не совпадают!");	
		} else return false;    
    }
}
?>