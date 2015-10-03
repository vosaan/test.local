<?php /* Smarty version 3.1.27, created on 2015-10-03 22:54:42
         compiled from "C:\OpenServer\domains\test.local\themes\theme01\templates\weather.html" */ ?>
<?php
/*%%SmartyHeaderCode:121556102472ce0ff0_39751089%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd5063690f9ffcad05f0e67726291268ccc09fa8a' => 
    array (
      0 => 'C:\\OpenServer\\domains\\test.local\\themes\\theme01\\templates\\weather.html',
      1 => 1443898480,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '121556102472ce0ff0_39751089',
  'variables' => 
  array (
    'login' => 0,
    'today' => 0,
    'rec' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_56102472d7d417_58253292',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_56102472d7d417_58253292')) {
function content_56102472d7d417_58253292 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '121556102472ce0ff0_39751089';
if (isset($_smarty_tpl->tpl_vars['login']->value)) {?>
<table border=1>
	<tr>
	<?php
$_from = $_smarty_tpl->tpl_vars['today']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$_smarty_tpl->tpl_vars['rec'] = new Smarty_Variable;
$_smarty_tpl->tpl_vars['rec']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['rec']->value) {
$_smarty_tpl->tpl_vars['rec']->_loop = true;
$foreach_rec_Sav = $_smarty_tpl->tpl_vars['rec'];
?>
		<td><?php echo $_smarty_tpl->tpl_vars['rec']->value;?>
</td>
	<?php
$_smarty_tpl->tpl_vars['rec'] = $foreach_rec_Sav;
}
?>
	</tr>
</table>	
<?php }
}
}
?>