<?php
/**
 * user.php
 */
//ob_start();
require_once($_SERVER['DOCUMENT_ROOT'].'/config/db_conn.php');
 
class user{
    public $login;
    public $password;
    public $id;
    
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
                    $_SESSION['username'] = $this->login;
                    $_SESSION['id'] = $this->id;
                    return $_SESSION['isLogin'] = true;
                } else return false;    
            }
        } else return false;
    }
}
 

?>