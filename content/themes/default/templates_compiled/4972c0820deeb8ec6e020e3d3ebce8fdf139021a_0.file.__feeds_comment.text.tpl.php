<?php
/* Smarty version 4.3.4, created on 2024-02-16 21:17:10
  from '/home/u994747101/domains/ebokoli.com/public_html/content/themes/default/templates/__feeds_comment.text.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.4',
  'unifunc' => 'content_65cfd0d6c3cac7_43074597',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4972c0820deeb8ec6e020e3d3ebce8fdf139021a' => 
    array (
      0 => '/home/u994747101/domains/ebokoli.com/public_html/content/themes/default/templates/__feeds_comment.text.tpl',
      1 => 1707770525,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_65cfd0d6c3cac7_43074597 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="comment-replace">
  <div class="comment-text js_readmore" dir="auto"><?php echo $_smarty_tpl->tpl_vars['_comment']->value['text'];?>
</div>
  <div class="comment-text-plain x-hidden"><?php echo $_smarty_tpl->tpl_vars['_comment']->value['text_plain'];?>
</div>
  <?php if ($_smarty_tpl->tpl_vars['_comment']->value['image'] != '') {?>
    <span class="text-link js_lightbox-nodata" data-image="<?php echo $_smarty_tpl->tpl_vars['system']->value['system_uploads'];?>
/<?php echo $_smarty_tpl->tpl_vars['_comment']->value['image'];?>
">
      <img alt="" class="img-fluid" src="<?php echo $_smarty_tpl->tpl_vars['system']->value['system_uploads'];?>
/<?php echo $_smarty_tpl->tpl_vars['_comment']->value['image'];?>
">
    </span>
  <?php }?>
  <?php if ($_smarty_tpl->tpl_vars['_comment']->value['voice_note'] != '') {?>
    <audio class="js_audio" id="audio-<?php echo $_smarty_tpl->tpl_vars['_comment']->value['comment_id'];?>
" controls preload="auto" style="width: 100%; min-width: 200px;">
      <source src="<?php echo $_smarty_tpl->tpl_vars['system']->value['system_uploads'];?>
/<?php echo $_smarty_tpl->tpl_vars['_comment']->value['voice_note'];?>
" type="audio/mpeg">
      <source src="<?php echo $_smarty_tpl->tpl_vars['system']->value['system_uploads'];?>
/<?php echo $_smarty_tpl->tpl_vars['_comment']->value['voice_note'];?>
" type="audio/mp3">
      <?php echo __("Your browser does not support HTML5 audio");?>

    </audio>
  <?php }?>
</div><?php }
}
