<?php
/* Smarty version 4.3.4, created on 2024-02-13 20:39:47
  from '/home/u994747101/domains/ebokoli.com/public_html/content/themes/default/templates/_widget.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.4',
  'unifunc' => 'content_65cbd393411c92_20652431',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '8878cd8972fc04efe85bb10cab104e6b8225addf' => 
    array (
      0 => '/home/u994747101/domains/ebokoli.com/public_html/content/themes/default/templates/_widget.tpl',
      1 => 1707770617,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_65cbd393411c92_20652431 (Smarty_Internal_Template $_smarty_tpl) {
if ($_smarty_tpl->tpl_vars['widgets']->value) {?>
  <!-- Widgets -->
  <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['widgets']->value, 'widget');
$_smarty_tpl->tpl_vars['widget']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['widget']->value) {
$_smarty_tpl->tpl_vars['widget']->do_else = false;
?>
    <div class="card">
      <div class="card-header">
        <strong><?php ob_start();
echo $_smarty_tpl->tpl_vars['widget']->value['title'];
$_prefixVariable1 = ob_get_clean();
echo __($_prefixVariable1);?>
</strong>
      </div>
      <div class="card-body"><?php echo $_smarty_tpl->tpl_vars['widget']->value['code'];?>
</div>
    </div>
  <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
  <!-- Widgets -->
<?php }
}
}
