<?php
/* Smarty version 4.3.4, created on 2024-03-31 21:12:12
  from '/home/u994747101/domains/ebokoli.com/public_html/content/themes/default/templates/ajax.who_shares.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.4',
  'unifunc' => 'content_6609d1acd123e0_83293701',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'fd21141c89a78c5a36e00fa2f169804c049fae9b' => 
    array (
      0 => '/home/u994747101/domains/ebokoli.com/public_html/content/themes/default/templates/ajax.who_shares.tpl',
      1 => 1707770576,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:__feeds_post.tpl' => 1,
  ),
),false)) {
function content_6609d1acd123e0_83293701 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="modal-header">
  <h6 class="modal-title"><?php echo __("People Who Shared This");?>
</h6>
  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body who-shares">
  <?php if ($_smarty_tpl->tpl_vars['posts']->value) {?>
    <ul>
      <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['posts']->value, 'post');
$_smarty_tpl->tpl_vars['post']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['post']->value) {
$_smarty_tpl->tpl_vars['post']->do_else = false;
?>
        <?php $_smarty_tpl->_subTemplateRender('file:__feeds_post.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('_snippet'=>true), 0, true);
?>
      <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
    </ul>

    <?php if (count($_smarty_tpl->tpl_vars['posts']->value) >= $_smarty_tpl->tpl_vars['system']->value['max_results']) {?>
      <!-- see-more -->
      <div class="alert alert-info see-more js_see-more" data-get="shares" data-id="<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
">
        <span><?php echo __("See More");?>
</span>
        <div class="loader loader_small x-hidden"></div>
      </div>
      <!-- see-more -->
    <?php }?>
  <?php } else { ?>
    <p class="text-center text-muted">
      <?php echo __("No people shared this");?>

    </p>
  <?php }?>

</div><?php }
}
