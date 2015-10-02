<?php /* Smarty version 3.1.27, created on 2015-10-02 18:09:52
         compiled from "C:\OpenServer\domains\test.local\themes\theme01\templates\feedback.html" */ ?>
<?php
/*%%SmartyHeaderCode:26695560e90308dd750_89636565%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3c60bd2c163e1f18ee3721e03327b1b3dc761b6e' => 
    array (
      0 => 'C:\\OpenServer\\domains\\test.local\\themes\\theme01\\templates\\feedback.html',
      1 => 1443710424,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '26695560e90308dd750_89636565',
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_560e90308e15d9_10055901',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_560e90308e15d9_10055901')) {
function content_560e90308e15d9_10055901 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '26695560e90308dd750_89636565';
?>
<form action = "index.php?action=feedback" method = "post" name = "feedback">
	<label>Title:<br>
		<input type = "text" name = "title" required autofocus><br>
	</label>
	<label>Message:<br>
		<textarea name = "message" required></textarea>
	</label><br>
	<input type = "submit" name = "submitbtn" value = "Leave feedback">	
</form><?php }
}
?>