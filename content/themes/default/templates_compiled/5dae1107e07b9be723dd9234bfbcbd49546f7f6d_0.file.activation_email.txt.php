<?php
/* Smarty version 4.3.4, created on 2024-02-14 13:21:40
  from '/home/u994747101/domains/ebokoli.com/public_html/content/themes/default/templates/emails/activation_email.txt' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.4',
  'unifunc' => 'content_65ccbe64d6ba33_49117182',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '5dae1107e07b9be723dd9234bfbcbd49546f7f6d' => 
    array (
      0 => '/home/u994747101/domains/ebokoli.com/public_html/content/themes/default/templates/emails/activation_email.txt',
      1 => 1707771806,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_65ccbe64d6ba33_49117182 (Smarty_Internal_Template $_smarty_tpl) {
echo __("Hi");?>
 <?php echo $_smarty_tpl->tpl_vars['name']->value;?>
,

<?php echo __("To complete the activation process, please follow this link");?>
:
<?php echo $_smarty_tpl->tpl_vars['system']->value['system_url'];?>
/activation/<?php echo $_smarty_tpl->tpl_vars['email_verification_code']->value;?>


<?php echo __("Activiation Code");?>
: <?php echo $_smarty_tpl->tpl_vars['email_verification_code']->value;?>


<?php echo __("Welcome to");?>
 <?php echo __($_smarty_tpl->tpl_vars['system']->value['system_title']);?>


<?php echo __($_smarty_tpl->tpl_vars['system']->value['system_title']);?>
 <?php echo __("Team");
}
}
