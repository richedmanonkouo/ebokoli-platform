<?php
/* Smarty version 4.3.4, created on 2024-02-18 09:28:37
  from '/home/u994747101/domains/ebokoli.com/public_html/content/themes/default/templates/emails/notification_email.txt' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.4',
  'unifunc' => 'content_65d1cdc592d668_82483534',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '9c6a7338e1a8946e5bea37c89e5b2cdb28917de1' => 
    array (
      0 => '/home/u994747101/domains/ebokoli.com/public_html/content/themes/default/templates/emails/notification_email.txt',
      1 => 1707771802,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_65d1cdc592d668_82483534 (Smarty_Internal_Template $_smarty_tpl) {
echo __("Hi");?>
 <?php echo $_smarty_tpl->tpl_vars['receiver']->value['name'];?>
,

<?php echo $_smarty_tpl->tpl_vars['user']->value->_data['name'];?>
 <?php echo $_smarty_tpl->tpl_vars['notification']->value['message'];?>

<?php echo $_smarty_tpl->tpl_vars['notification']->value['url'];?>


<?php echo __($_smarty_tpl->tpl_vars['system']->value['system_title']);?>
 <?php echo __("Team");
}
}
