<?php
/* Smarty version 4.3.4, created on 2025-10-14 10:51:07
  from 'C:\Users\HP\Documents\App_EBOKOLI\public_html\content\themes\default\templates\_announcements.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.4',
  'unifunc' => 'content_68ee2b1ba575a1_75323175',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '844c3d9726a92272af65842cd2513d8f4d4183e7' => 
    array (
      0 => 'C:\\Users\\HP\\Documents\\App_EBOKOLI\\public_html\\content\\themes\\default\\templates\\_announcements.tpl',
      1 => 1707770616,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68ee2b1ba575a1_75323175 (Smarty_Internal_Template $_smarty_tpl) {
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['announcements']->value, 'announcement');
$_smarty_tpl->tpl_vars['announcement']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['announcement']->value) {
$_smarty_tpl->tpl_vars['announcement']->do_else = false;
?>
  <div class="alert alert-<?php echo $_smarty_tpl->tpl_vars['announcement']->value['type'];?>
 text-with-list">
    <?php if ($_smarty_tpl->tpl_vars['user']->value->_logged_in) {?>
      <button type="button" class="btn-close float-end js_announcment-remover" data-id="<?php echo $_smarty_tpl->tpl_vars['announcement']->value['announcement_id'];?>
"></button>
    <?php }?>
    <?php if ($_smarty_tpl->tpl_vars['announcement']->value['title']) {?><div class="title"><?php echo $_smarty_tpl->tpl_vars['announcement']->value['title'];?>
</div><?php }?>
    <?php echo $_smarty_tpl->tpl_vars['announcement']->value['code'];?>

  </div>
<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
}
}
