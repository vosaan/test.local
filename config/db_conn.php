<?php
/*
*	connection to database
*/

	//define('HOST', 'localhost');
	//define('USER', 'bwt_user');
	//define('PASS', '24sen2015');
	//define('BASE', 'bwtgroup');

	define('HOST', 'localhost');
	define('USER', 'root');
	define('PASS', '');
	define('BASE', 'base');

	function db_connect(){
		$link = mysqli_connect(HOST, USER, PASS, BASE) or die(mysqli_error($link));
		return $link;
	}

	$link = db_connect(); // <-- database connection descriptor
