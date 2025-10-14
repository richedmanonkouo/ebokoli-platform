<?php
/* Smarty version 4.3.4, created on 2024-02-16 20:39:17
  from '/home/u994747101/domains/ebokoli.com/public_html/content/themes/default/templates/ajax.chat.messages.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.4',
  'unifunc' => 'content_65cfc7f52a2da6_31290346',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'fc81fca944b09260c998983bc7ab6ff336fd5d12' => 
    array (
      0 => '/home/u994747101/domains/ebokoli.com/public_html/content/themes/default/templates/ajax.chat.messages.tpl',
      1 => 1707770442,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:__feeds_message.tpl' => 1,
  ),
),false)) {
function content_65cfc7f52a2da6_31290346 (Smarty_Internal_Template $_smarty_tpl) {
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['messages']->value, 'message');
$_smarty_tpl->tpl_vars['message']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['message']->value) {
$_smarty_tpl->tpl_vars['message']->do_else = false;
?>
  <?php $_smarty_tpl->_subTemplateRender('file:__feeds_message.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
}
}
