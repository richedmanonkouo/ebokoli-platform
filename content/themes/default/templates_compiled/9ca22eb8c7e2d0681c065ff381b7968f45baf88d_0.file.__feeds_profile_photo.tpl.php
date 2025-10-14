<?php
/* Smarty version 4.3.4, created on 2024-02-26 12:44:44
  from '/home/u994747101/domains/ebokoli.com/public_html/content/themes/default/templates/__feeds_profile_photo.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.4',
  'unifunc' => 'content_65dc87bc37ca67_88194533',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '9ca22eb8c7e2d0681c065ff381b7968f45baf88d' => 
    array (
      0 => '/home/u994747101/domains/ebokoli.com/public_html/content/themes/default/templates/__feeds_profile_photo.tpl',
      1 => 1707770458,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_65dc87bc37ca67_88194533 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="col-4 mb10">
  <div class="pg_photo pointer <?php if ($_smarty_tpl->tpl_vars['_filter']->value == "avatar") {?>js_profile-picture-change<?php } else { ?>js_profile-cover-change<?php }?>" data-id=<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
 data-type=<?php echo $_smarty_tpl->tpl_vars['type']->value;?>
 data-image="<?php echo $_smarty_tpl->tpl_vars['photo']->value['source'];?>
" style="background-image:url(<?php echo $_smarty_tpl->tpl_vars['system']->value['system_uploads'];?>
/<?php echo $_smarty_tpl->tpl_vars['photo']->value['source'];?>
);">
  </div>
</div><?php }
}
