<?php
/**
 * db_conn.php
 * Конфигурация подключения к базе данных
 */


/* Подключение к базе данных */
define('HOST', 'localhost');
define('USER', 'root');
define('PASS', '');
define('BASE', 'base');

/* Функция возвращает дескриптор подключения */
function db_connect(){
	$link = mysqli_connect(HOST, USER, PASS, BASE) or die(mysqli_error($link));
	return $link;
}

/* Дескриптор подключения */
$link = db_connect();
