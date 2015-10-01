<?php /* Smarty version 3.1.27, created on 2015-10-01 12:47:29
         compiled from "C:\OpenServer\domains\test.local\themes\theme01\templates\header.html" */ ?>
<?php
/*%%SmartyHeaderCode:29507560cf3214e71c7_16542239%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '01866d4d32024a3f52edb755b685cf3863726d91' => 
    array (
      0 => 'C:\\OpenServer\\domains\\test.local\\themes\\theme01\\templates\\header.html',
      1 => 1443689230,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '29507560cf3214e71c7_16542239',
  'variables' => 
  array (
    'login' => 0,
    'username' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_560cf32154cad6_01268393',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_560cf32154cad6_01268393')) {
function content_560cf32154cad6_01268393 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '29507560cf3214e71c7_16542239';
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
					menu
				</div>
				<div class = "header_content_right">
					user info
				</div>
			</div>
		</header>
		<div class = "page_content">
		<!-- End of header -->
						<?php if (isset($_smarty_tpl->tpl_vars['login']->value)) {?>
					aaaa
				<?php }?>
				<?php echo $_smarty_tpl->tpl_vars['username']->value;

}
}
?>