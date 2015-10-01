<?php /* Smarty version 3.1.27, created on 2015-10-01 18:41:45
         compiled from "C:\OpenServer\domains\test.local\themes\theme01\templates\feedback.html" */ ?>
<?php
/*%%SmartyHeaderCode:8062560d4629321e29_28835287%%*/
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
  'nocache_hash' => '8062560d4629321e29_28835287',
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_560d462936c1c4_63461187',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_560d462936c1c4_63461187')) {
function content_560d462936c1c4_63461187 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '8062560d4629321e29_28835287';
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