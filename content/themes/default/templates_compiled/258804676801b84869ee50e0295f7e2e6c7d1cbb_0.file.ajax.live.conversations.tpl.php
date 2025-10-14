<?php
/* Smarty version 4.3.4, created on 2024-02-16 20:39:18
  from '/home/u994747101/domains/ebokoli.com/public_html/content/themes/default/templates/ajax.live.conversations.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.4',
  'unifunc' => 'content_65cfc7f6478cd1_25554141',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '258804676801b84869ee50e0295f7e2e6c7d1cbb' => 
    array (
      0 => '/home/u994747101/domains/ebokoli.com/public_html/content/themes/default/templates/ajax.live.conversations.tpl',
      1 => 1707770555,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:__feeds_conversation.tpl' => 1,
  ),
),false)) {
function content_65cfc7f6478cd1_25554141 (Smarty_Internal_Template $_smarty_tpl) {
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['conversations']->value, 'conversation');
$_smarty_tpl->tpl_vars['conversation']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['conversation']->value) {
$_smarty_tpl->tpl_vars['conversation']->do_else = false;
?>
  <?php $_smarty_tpl->_subTemplateRender('file:__feeds_conversation.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
}
}
