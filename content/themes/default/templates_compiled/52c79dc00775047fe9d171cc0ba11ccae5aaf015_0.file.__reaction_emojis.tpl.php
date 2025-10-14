<?php
/* Smarty version 4.3.4, created on 2025-10-14 10:51:18
  from 'C:\Users\HP\Documents\App_EBOKOLI\public_html\content\themes\default\templates\__reaction_emojis.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.4',
  'unifunc' => 'content_68ee2b26c1a272_60526009',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '52c79dc00775047fe9d171cc0ba11ccae5aaf015' => 
    array (
      0 => 'C:\\Users\\HP\\Documents\\App_EBOKOLI\\public_html\\content\\themes\\default\\templates\\__reaction_emojis.tpl',
      1 => 1707770551,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68ee2b26c1a272_60526009 (Smarty_Internal_Template $_smarty_tpl) {
?><!-- reaction -->
<div class="emoji">
  <img src="<?php echo $_smarty_tpl->tpl_vars['system']->value['system_uploads'];?>
/<?php echo $_smarty_tpl->tpl_vars['reactions']->value[$_smarty_tpl->tpl_vars['_reaction']->value]['image'];?>
" alt="<?php echo $_smarty_tpl->tpl_vars['reactions']->value[$_smarty_tpl->tpl_vars['_reaction']->value]['title'];?>
" />
</div>
<!-- reaction --><?php }
}
