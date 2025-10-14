<?php
/* Smarty version 4.3.4, created on 2024-02-17 11:48:57
  from '/home/u994747101/domains/ebokoli.com/public_html/content/themes/default/templates/_pinned_post.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.4',
  'unifunc' => 'content_65d09d2962afd5_53122506',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f06b0d5d05a771d1f2068ac9d297e09473893de8' => 
    array (
      0 => '/home/u994747101/domains/ebokoli.com/public_html/content/themes/default/templates/_pinned_post.tpl',
      1 => 1707770625,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:__feeds_post.tpl' => 1,
  ),
),false)) {
function content_65d09d2962afd5_53122506 (Smarty_Internal_Template $_smarty_tpl) {
?><!-- posts-filter -->
<div class="posts-filter">
  <span><?php echo __("Pinned Post");?>
</span>
</div>
<!-- posts-filter -->

<?php $_smarty_tpl->_subTemplateRender('file:__feeds_post.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('standalone'=>true,'pinned'=>true), 0, false);
}
}
