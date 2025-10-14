<?php
/* Smarty version 4.3.4, created on 2024-02-13 21:30:30
  from '/home/u994747101/domains/ebokoli.com/public_html/content/themes/default/templates/__reaction_emojis.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.4',
  'unifunc' => 'content_65cbdf76b997f6_86677472',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '5669711dfd440ccde9fb68d12990da5a4d75b961' => 
    array (
      0 => '/home/u994747101/domains/ebokoli.com/public_html/content/themes/default/templates/__reaction_emojis.tpl',
      1 => 1707770551,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_65cbdf76b997f6_86677472 (Smarty_Internal_Template $_smarty_tpl) {
?><!-- reaction -->
<div class="emoji">
  <img src="<?php echo $_smarty_tpl->tpl_vars['system']->value['system_uploads'];?>
/<?php echo $_smarty_tpl->tpl_vars['reactions']->value[$_smarty_tpl->tpl_vars['_reaction']->value]['image'];?>
" alt="<?php echo $_smarty_tpl->tpl_vars['reactions']->value[$_smarty_tpl->tpl_vars['_reaction']->value]['title'];?>
" />
</div>
<!-- reaction --><?php }
}
