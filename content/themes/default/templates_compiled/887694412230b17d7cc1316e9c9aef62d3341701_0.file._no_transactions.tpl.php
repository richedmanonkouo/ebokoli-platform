<?php
/* Smarty version 4.3.4, created on 2025-10-14 11:13:34
  from 'C:\Users\HP\Documents\App_EBOKOLI\public_html\content\themes\default\templates\_no_transactions.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.4',
  'unifunc' => 'content_68ee305e4c3d99_86954171',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '887694412230b17d7cc1316e9c9aef62d3341701' => 
    array (
      0 => 'C:\\Users\\HP\\Documents\\App_EBOKOLI\\public_html\\content\\themes\\default\\templates\\_no_transactions.tpl',
      1 => 1707770452,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:__svg_icons.tpl' => 1,
  ),
),false)) {
function content_68ee305e4c3d99_86954171 (Smarty_Internal_Template $_smarty_tpl) {
?><!-- no transaction -->
<div class="text-center text-muted">
  <?php $_smarty_tpl->_subTemplateRender('file:__svg_icons.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('icon'=>"transaction",'class'=>"mb20",'width'=>"56px",'height'=>"56px"), 0, false);
?>
  <div class="text-md">
    <span class="no-data"><?php echo __("Looks like you don't have any transaction yet");?>
</span>
  </div>
</div>
<!-- no transaction --><?php }
}
