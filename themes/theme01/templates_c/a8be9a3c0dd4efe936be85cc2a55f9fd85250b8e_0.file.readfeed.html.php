<?php /* Smarty version 3.1.27, created on 2015-10-02 18:38:22
         compiled from "C:\OpenServer\domains\test.local\themes\theme01\templates\readfeed.html" */ ?>
<?php
/*%%SmartyHeaderCode:6611560e96deefb327_09894786%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a8be9a3c0dd4efe936be85cc2a55f9fd85250b8e' => 
    array (
      0 => 'C:\\OpenServer\\domains\\test.local\\themes\\theme01\\templates\\readfeed.html',
      1 => 1443796701,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '6611560e96deefb327_09894786',
  'variables' => 
  array (
    'feed' => 0,
    'rec' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_560e96df041ac1_76056490',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_560e96df041ac1_76056490')) {
function content_560e96df041ac1_76056490 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '6611560e96deefb327_09894786';
?>


		<?php
$_from = $_smarty_tpl->tpl_vars['feed']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$_smarty_tpl->tpl_vars['rec'] = new Smarty_Variable;
$_smarty_tpl->tpl_vars['rec']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['rec']->value) {
$_smarty_tpl->tpl_vars['rec']->_loop = true;
$foreach_rec_Sav = $_smarty_tpl->tpl_vars['rec'];
?>
			<h3><?php echo $_smarty_tpl->tpl_vars['rec']->value['title'];?>
</h3>
			<p><?php echo $_smarty_tpl->tpl_vars['rec']->value['message'];?>
</p>
			<p><?php echo $_smarty_tpl->tpl_vars['rec']->value['userid'];?>
</p>
			<p><?php echo $_smarty_tpl->tpl_vars['rec']->value['datetime'];?>
</p>
			<hr>
		<?php
$_smarty_tpl->tpl_vars['rec'] = $foreach_rec_Sav;
}
?>



<?php }
}
?>