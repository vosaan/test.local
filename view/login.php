		<form method = "POST" action = "index.php?action=auth">
			Login:<br>
			<input type = 'text' name = "auth_form_login"  autofocus><br>
			Password:<br>
			<input type = 'password' name = "auth_form_password" ><br>
			<input type = 'submit' name = "auth_form_btn" value = 'Sign in'>
		</form>
		<a href="index.php?action=reg">Регистрация</a>

<?/*
	require_once('auth.php');
	if($_SERVER['HTTP_REFERER']=="http://bwt.local/register.php"){
		echo "<h2>Теперь можете войти</h2>";
	}

	if($auth->isAuth()){
		echo "Здрасьте, ".$auth->getLogin();
		echo "<br><a href='auth.php?is_exit=1'>Exit</a>";
	} else {
		?>
		<form method = "POST" action = "index.php">
			Login:<br>
			<input type = 'text' name = 'login'><br>
			Password:<br>
			<input type = 'password' name = 'passw'><br>
			<input type = 'submit' value = 'Sign in'>
		</form>
		<a href="register.php">Регистрация</a>
	<?php		
	}*/?>