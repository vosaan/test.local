<?php /* Smarty version 3.1.27, created on 2015-10-01 15:49:14
         compiled from "C:\OpenServer\domains\test.local\themes\theme01\templates\header.html" */ ?>
<?php
/*%%SmartyHeaderCode:11712560d1dba626635_98673734%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '01866d4d32024a3f52edb755b685cf3863726d91' => 
    array (
      0 => 'C:\\OpenServer\\domains\\test.local\\themes\\theme01\\templates\\header.html',
      1 => 1443700136,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '11712560d1dba626635_98673734',
  'variables' => 
  array (
    'login' => 0,
    'mainmenu' => 0,
    'value' => 0,
    'key' => 0,
    'username' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_560d1dba6c2a59_91969741',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_560d1dba6c2a59_91969741')) {
function content_560d1dba6c2a59_91969741 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '11712560d1dba626635_98673734';
?>
<!DOCTYPE html>
<html>
	<head>
		<title></title>
		<link rel = "stylesheet" type = "text/css" href = '/themes/theme01/templates/style.css'>
		<meta charset = "utf8">
	</head>
<body>
<div class="wrap">
  <div class="page">
		<header>
			<div class = "header_content">
				<div class = "header_content_left">
					<?php if (isset($_smarty_tpl->tpl_vars['login']->value) && isset($_smarty_tpl->tpl_vars['mainmenu']->value)) {?>
						<div class = "mainmenu">
							<ul>
								<?php
$_from = $_smarty_tpl->tpl_vars['mainmenu']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$_smarty_tpl->tpl_vars['value'] = new Smarty_Variable;
$_smarty_tpl->tpl_vars['value']->_loop = false;
$_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['value']->value) {
$_smarty_tpl->tpl_vars['value']->_loop = true;
$foreach_value_Sav = $_smarty_tpl->tpl_vars['value'];
?>
									<li><a href = "index.php<?php echo $_smarty_tpl->tpl_vars['value']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['key']->value;?>
</a></li>
								<?php
$_smarty_tpl->tpl_vars['value'] = $foreach_value_Sav;
}
?>					
							</ul>
						</div>
					<?php }?>
				</div>
				<div class = "header_content_right">
					<?php if (isset($_smarty_tpl->tpl_vars['login']->value)) {?>
						Hello, <?php echo $_smarty_tpl->tpl_vars['username']->value;?>
&emsp;&emsp;&emsp;
						<a href = "index.php?action=logout" class = "logoutbtn">Logout</a>
					<?php }?>
				</div>
			</div>
		</header>
		<div class = "page_content">
		<!-- End of header -->
<?php }
}
?>