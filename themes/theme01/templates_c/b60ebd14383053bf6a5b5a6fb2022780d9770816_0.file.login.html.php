<?php /* Smarty version 3.1.27, created on 2015-10-02 18:40:09
         compiled from "C:\OpenServer\domains\test.local\themes\theme01\templates\login.html" */ ?>
<?php
/*%%SmartyHeaderCode:29785560e97493acf80_07794630%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b60ebd14383053bf6a5b5a6fb2022780d9770816' => 
    array (
      0 => 'C:\\OpenServer\\domains\\test.local\\themes\\theme01\\templates\\login.html',
      1 => 1443686160,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '29785560e97493acf80_07794630',
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_560e97493ef613_25663759',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_560e97493ef613_25663759')) {
function content_560e97493ef613_25663759 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '29785560e97493acf80_07794630';
?>
<div class = "login_form">
	<form method = "POST" action = "index.php?action=auth">
		Login:<br>
		<input type = 'text' name = "auth_form_login"  autofocus><br>
		Password:<br>
		<input type = 'password' name = "auth_form_password" ><br>
		<input type = 'submit' name = "auth_form_btn" value = 'Sign in'>
	</form>
	<a href="index.php?action=reg">Регистрация</a>
</div><?php }
}
?>