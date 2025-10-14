<?php
/* Smarty version 4.3.4, created on 2025-10-14 10:35:45
  from 'C:\Users\HP\Documents\App_EBOKOLI\public_html\content\themes\default\templates\sign.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.4',
  'unifunc' => 'content_68ee2781eed273_39405100',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '0c4c7a9f259c64b3c6235d624170a36a9ed8bac6' => 
    array (
      0 => 'C:\\Users\\HP\\Documents\\App_EBOKOLI\\public_html\\content\\themes\\default\\templates\\sign.tpl',
      1 => 1707770532,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:_head.tpl' => 1,
    'file:_header.tpl' => 1,
    'file:_sign_form.tpl' => 1,
    'file:_footer.tpl' => 1,
  ),
),false)) {
function content_68ee2781eed273_39405100 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender('file:_head.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
$_smarty_tpl->_subTemplateRender('file:_header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<!-- page content -->
<div class="container mt30">
  <div class="row">
    <div class="col-md-6 col-lg-5 mx-md-auto">
      <!-- sign in/up form -->
      <?php $_smarty_tpl->_subTemplateRender('file:_sign_form.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
      <!-- sign in/up form -->
    </div>
  </div>
</div>
<!-- page content -->

<?php $_smarty_tpl->_subTemplateRender('file:_footer.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
