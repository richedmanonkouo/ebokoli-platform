<?php
/* Smarty version 4.3.4, created on 2024-02-15 07:12:58
  from '/home/u994747101/domains/ebokoli.com/public_html/content/themes/default/templates/emails/contact_form_email.txt' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.4',
  'unifunc' => 'content_65cdb97a5cc496_62629461',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '53f933c32c1f665ad6bccb2762a9a4f4de57b818' => 
    array (
      0 => '/home/u994747101/domains/ebokoli.com/public_html/content/themes/default/templates/emails/contact_form_email.txt',
      1 => 1707771800,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_65cdb97a5cc496_62629461 (Smarty_Internal_Template $_smarty_tpl) {
echo __("Hi");?>
,

<?php echo __("You have a new email message");?>


<?php echo __("Email Subject");?>
: <?php echo $_smarty_tpl->tpl_vars['subject']->value;?>


<?php echo __("Sender Name");?>
: <?php echo $_smarty_tpl->tpl_vars['name']->value;?>


<?php echo __("Sender Email");?>
: <?php echo $_smarty_tpl->tpl_vars['email']->value;?>


<?php echo __("Email Message");?>
: <?php echo $_smarty_tpl->tpl_vars['message']->value;?>


<?php echo __($_smarty_tpl->tpl_vars['system']->value['system_title']);?>
 <?php echo __("Team");
}
}
