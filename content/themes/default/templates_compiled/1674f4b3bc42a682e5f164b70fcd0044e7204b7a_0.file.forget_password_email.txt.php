<?php
/* Smarty version 4.3.4, created on 2024-02-21 06:19:36
  from '/home/u994747101/domains/ebokoli.com/public_html/content/themes/default/templates/emails/forget_password_email.txt' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.4',
  'unifunc' => 'content_65d595f8b0e942_36538017',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '1674f4b3bc42a682e5f164b70fcd0044e7204b7a' => 
    array (
      0 => '/home/u994747101/domains/ebokoli.com/public_html/content/themes/default/templates/emails/forget_password_email.txt',
      1 => 1707771810,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_65d595f8b0e942_36538017 (Smarty_Internal_Template $_smarty_tpl) {
echo __("Hi");?>


<?php echo __("To complete the reset password process, please copy this token");?>
:

<?php echo __("Token");?>
: <?php echo $_smarty_tpl->tpl_vars['reset_key']->value;?>


<?php echo __($_smarty_tpl->tpl_vars['system']->value['system_title']);?>
 <?php echo __("Team");
}
}
