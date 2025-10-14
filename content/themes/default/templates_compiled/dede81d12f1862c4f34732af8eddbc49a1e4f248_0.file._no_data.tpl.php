<?php
/* Smarty version 4.3.4, created on 2024-02-13 20:39:47
  from '/home/u994747101/domains/ebokoli.com/public_html/content/themes/default/templates/_no_data.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.4',
  'unifunc' => 'content_65cbd393407bb5_31012022',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'dede81d12f1862c4f34732af8eddbc49a1e4f248' => 
    array (
      0 => '/home/u994747101/domains/ebokoli.com/public_html/content/themes/default/templates/_no_data.tpl',
      1 => 1707770627,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:__svg_icons.tpl' => 1,
  ),
),false)) {
function content_65cbd393407bb5_31012022 (Smarty_Internal_Template $_smarty_tpl) {
?><!-- no data -->
<div class="text-center text-muted mb20">
  <?php $_smarty_tpl->_subTemplateRender('file:__svg_icons.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('icon'=>"empty",'class'=>"mb20",'width'=>"80px",'height'=>"80px"), 0, false);
?>
  <div class="text-md">
    <span class="no-data"><?php echo __("No data to show");?>
</span>
  </div>
</div>
<!-- no data --><?php }
}
