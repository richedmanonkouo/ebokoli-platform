<?php
/* Smarty version 4.3.4, created on 2025-10-14 10:32:31
  from 'C:\Users\HP\Documents\App_EBOKOLI\public_html\content\themes\default\templates\index.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.4',
  'unifunc' => 'content_68ee26bf700d68_53612016',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '674ca0b4efb1575994f428e2108174efd5c1781e' => 
    array (
      0 => 'C:\\Users\\HP\\Documents\\App_EBOKOLI\\public_html\\content\\themes\\default\\templates\\index.tpl',
      1 => 1707770451,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:index.landing.tpl' => 1,
    'file:index.newsfeed.tpl' => 1,
  ),
),false)) {
function content_68ee26bf700d68_53612016 (Smarty_Internal_Template $_smarty_tpl) {
if (!$_smarty_tpl->tpl_vars['user']->value->_logged_in && !$_smarty_tpl->tpl_vars['system']->value['newsfeed_public']) {?>
  <?php $_smarty_tpl->_subTemplateRender('file:index.landing.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
} else { ?>
  <?php $_smarty_tpl->_subTemplateRender('file:index.newsfeed.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
}
