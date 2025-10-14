<?php
/* Smarty version 4.3.4, created on 2024-02-16 20:39:17
  from '/home/u994747101/domains/ebokoli.com/public_html/content/themes/default/templates/ajax.chat.conversation.messages.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.4',
  'unifunc' => 'content_65cfc7f529e592_97916549',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b8de0ca00ef634d3ecdda470bf971a50eac50e3e' => 
    array (
      0 => '/home/u994747101/domains/ebokoli.com/public_html/content/themes/default/templates/ajax.chat.conversation.messages.tpl',
      1 => 1707770463,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:ajax.chat.messages.tpl' => 1,
  ),
),false)) {
function content_65cfc7f529e592_97916549 (Smarty_Internal_Template $_smarty_tpl) {
if ($_smarty_tpl->tpl_vars['conversation']->value['total_messages'] >= $_smarty_tpl->tpl_vars['system']->value['max_results']) {?>
  <!-- see-more -->
  <div class="alert alert-chat see-more small js_see-more" data-id=<?php echo $_smarty_tpl->tpl_vars['conversation']->value['conversation_id'];?>
 data-get="messages">
    <span><?php echo __("Loading Older Messages");?>
</span>
    <div class="loader loader_small x-hidden"></div>
  </div>
  <!-- see-more -->
<?php }?>

<ul>
  <?php $_smarty_tpl->_subTemplateRender('file:ajax.chat.messages.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('messages'=>$_smarty_tpl->tpl_vars['conversation']->value['messages']), 0, false);
?>
</ul><?php }
}
