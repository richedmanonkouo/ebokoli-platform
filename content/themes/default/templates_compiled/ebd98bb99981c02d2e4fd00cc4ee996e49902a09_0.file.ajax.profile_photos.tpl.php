<?php
/* Smarty version 4.3.4, created on 2024-02-14 05:50:19
  from '/home/u994747101/domains/ebokoli.com/public_html/content/themes/default/templates/ajax.profile_photos.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.4',
  'unifunc' => 'content_65cc549b098aa3_21742994',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'ebd98bb99981c02d2e4fd00cc4ee996e49902a09' => 
    array (
      0 => '/home/u994747101/domains/ebokoli.com/public_html/content/themes/default/templates/ajax.profile_photos.tpl',
      1 => 1707770440,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:__svg_icons.tpl' => 1,
    'file:__feeds_profile_photo.tpl' => 1,
    'file:_no_data.tpl' => 1,
  ),
),false)) {
function content_65cc549b098aa3_21742994 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="modal-header">
  <h6 class="modal-title">
    <?php $_smarty_tpl->_subTemplateRender('file:__svg_icons.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('icon'=>"photos",'class'=>"main-icon mr10",'width'=>"24px",'height'=>"24px"), 0, false);
?>
    <?php echo __("Select Photo");?>

  </h6>
  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
  <?php if ($_smarty_tpl->tpl_vars['photos']->value) {?>
    <ul class="row">
      <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['photos']->value, 'photo');
$_smarty_tpl->tpl_vars['photo']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['photo']->value) {
$_smarty_tpl->tpl_vars['photo']->do_else = false;
?>
        <?php $_smarty_tpl->_subTemplateRender('file:__feeds_profile_photo.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('_filter'=>$_smarty_tpl->tpl_vars['filter']->value), 0, true);
?>
      <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
    </ul>
    <!-- see-more -->
    <div class="alert alert-post see-more mt20 js_see-more" data-get="profile_photos" data-id="<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
" data-type='<?php echo $_smarty_tpl->tpl_vars['type']->value;?>
' data-filter="<?php echo $_smarty_tpl->tpl_vars['filter']->value;?>
">
      <span><?php echo __("See More");?>
</span>
      <div class="loader loader_small x-hidden"></div>
    </div>
    <!-- see-more -->
  <?php } else { ?>
    <?php $_smarty_tpl->_subTemplateRender('file:_no_data.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
  <?php }?>
</div><?php }
}
