<?php
/**
 * user.php
 */
//ob_start();
require_once($_SERVER['DOCUMENT_ROOT'].'/config/db_conn.php');
 
class user{
    /*private $login;
    private $password;
    private $id;*/
    
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
        
    }
}
 

?>