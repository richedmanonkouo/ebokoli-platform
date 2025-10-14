<?php
/* Smarty version 4.3.4, created on 2024-02-14 19:06:52
  from '/home/u994747101/domains/ebokoli.com/public_html/content/themes/default/templates/ajax.group.publisher.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.4',
  'unifunc' => 'content_65cd0f4ca53937_87842017',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '578bc8d7d100b8e90f7c7281f5b50d9a812b8a77' => 
    array (
      0 => '/home/u994747101/domains/ebokoli.com/public_html/content/themes/default/templates/ajax.group.publisher.tpl',
      1 => 1707770586,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:__svg_icons.tpl' => 1,
    'file:__categories.recursive_options.tpl' => 1,
    'file:__custom_fields.tpl' => 1,
  ),
),false)) {
function content_65cd0f4ca53937_87842017 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="modal-header">
  <h6 class="modal-title">
    <?php $_smarty_tpl->_subTemplateRender('file:__svg_icons.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('icon'=>"groups",'class'=>"main-icon mr10",'width'=>"24px",'height'=>"24px"), 0, false);
?>
    <?php echo __("Create New Group");?>

  </h6>
  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<form class="js_ajax-forms" data-url="modules/create.php?type=group&do=create">
  <div class="modal-body">
    <div class="form-group">
      <label class="form-label" for="title"><?php echo __("Name Your Group");?>
</label>
      <input type="text" class="form-control" name="title" id="title">
    </div>
    <div class="form-group">
      <label class="form-label" for="username"><?php echo __("Group Username");?>
</label>
      <div class="input-group">
        <span class="input-group-text d-none d-sm-block"><?php echo $_smarty_tpl->tpl_vars['system']->value['system_url'];?>
/groups/</span>
        <input type="text" class="form-control" name="username" id="username">
      </div>
      <div class="form-text">
        <?php echo __("Can only contain alphanumeric characters (A–Z, 0–9) and periods ('.')");?>

      </div>
    </div>
    <div class="form-group">
      <label class="form-label" for="privacy"><?php echo __("Select Privacy");?>
</label>
      <select class="form-select" name="privacy">
        <option value="public"><?php echo __("Public Group");?>
</option>
        <option value="closed"><?php echo __("Closed Group");?>
</option>
        <option value="secret"><?php echo __("Secret Group");?>
</option>
      </select>
    </div>
    <div class="form-group">
      <label class="form-label" for="category"><?php echo __("Category");?>
</label>
      <select class="form-select" name="category" id="category">
        <option><?php echo __("Select Category");?>
</option>
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['categories']->value, 'category');
$_smarty_tpl->tpl_vars['category']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['category']->value) {
$_smarty_tpl->tpl_vars['category']->do_else = false;
?>
          <?php $_smarty_tpl->_subTemplateRender('file:__categories.recursive_options.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
      </select>
    </div>
    <div class="form-group">
      <label class="form-label" for="description"><?php echo __("About");?>
</label>
      <textarea class="form-control" name="description"></textarea>
    </div>
    <!-- custom fields -->
    <?php if ($_smarty_tpl->tpl_vars['custom_fields']->value) {?>
      <?php $_smarty_tpl->_subTemplateRender('file:__custom_fields.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('_custom_fields'=>$_smarty_tpl->tpl_vars['custom_fields']->value,'_registration'=>true), 0, false);
?>
    <?php }?>
    <!-- custom fields -->
    <!-- error -->
    <div class="alert alert-danger mb0 mt10 x-hidden"></div>
    <!-- error -->
  </div>
  <div class="modal-footer">
    <button type="submit" class="btn btn-primary"><?php echo __("Create");?>
</button>
  </div>
</form><?php }
}
