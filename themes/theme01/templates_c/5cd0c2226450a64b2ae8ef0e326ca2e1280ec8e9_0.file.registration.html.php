<?php /* Smarty version 3.1.27, created on 2015-10-01 12:07:41
         compiled from "C:\OpenServer\domains\test.local\themes\theme01\templates\registration.html" */ ?>
<?php
/*%%SmartyHeaderCode:27674560ce9cdc6e9e4_14708187%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5cd0c2226450a64b2ae8ef0e326ca2e1280ec8e9' => 
    array (
      0 => 'C:\\OpenServer\\domains\\test.local\\themes\\theme01\\templates\\registration.html',
      1 => 1443686781,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '27674560ce9cdc6e9e4_14708187',
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_560ce9cdcb8d71_31750239',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_560ce9cdcb8d71_31750239')) {
function content_560ce9cdcb8d71_31750239 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '27674560ce9cdc6e9e4_14708187';
?>
<div class = "reg_form">
	<form action="" method="POST">
		Login:<br>
		<input type = "text" name="reg_form_login" required autofocus><br>

		Password:<br>
		<input type = "password" name="reg_form_password" required><br>

		Password one more time:<br>
		<input type = "password" name="reg_form_password_confirm" required><br>		
		
		<input type="submit" name="reg_submit_btn" value="Register">
	</form>
</div><?php }
}
?>