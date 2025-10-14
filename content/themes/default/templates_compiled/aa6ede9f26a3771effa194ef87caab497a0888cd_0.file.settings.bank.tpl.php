<?php
/* Smarty version 4.3.4, created on 2024-04-02 06:47:34
  from '/home/u994747101/domains/ebokoli.com/public_html/content/themes/default/templates/settings.bank.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.4',
  'unifunc' => 'content_660baa068e8250_71101609',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'aa6ede9f26a3771effa194ef87caab497a0888cd' => 
    array (
      0 => '/home/u994747101/domains/ebokoli.com/public_html/content/themes/default/templates/settings.bank.tpl',
      1 => 1707770536,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:__svg_icons.tpl' => 1,
    'file:_no_transactions.tpl' => 1,
  ),
),false)) {
function content_660baa068e8250_71101609 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="card-header with-icon">
  <?php $_smarty_tpl->_subTemplateRender('file:__svg_icons.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('icon'=>"bank",'class'=>"main-icon mr15",'width'=>"24px",'height'=>"24px"), 0, false);
?>
  <?php echo __("Bank Transfers");?>

</div>
<div class="card-body">
  <div class="heading-small mb20">
    <?php echo __("Transactions History");?>

  </div>
  <div class="pl-md-4">
    <?php if ($_smarty_tpl->tpl_vars['transfers']->value) {?>
      <div class="table-responsive mt20">
        <table class="table table-striped table-bordered table-hover">
          <thead>
            <tr>
              <th><?php echo __("ID");?>
</th>
              <th><?php echo __("Type");?>
</th>
              <th><?php echo __("Time");?>
</th>
              <th><?php echo __("Status");?>
</th>
            </tr>
          </thead>
          <tbody>
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['transfers']->value, 'transfer');
$_smarty_tpl->tpl_vars['transfer']->iteration = 0;
$_smarty_tpl->tpl_vars['transfer']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['transfer']->value) {
$_smarty_tpl->tpl_vars['transfer']->do_else = false;
$_smarty_tpl->tpl_vars['transfer']->iteration++;
$__foreach_transfer_0_saved = $_smarty_tpl->tpl_vars['transfer'];
?>
              <tr>
                <td><?php echo $_smarty_tpl->tpl_vars['transfer']->iteration;?>
</td>
                <td>
                  <?php if ($_smarty_tpl->tpl_vars['transfer']->value['handle'] == "packages") {?>
                    <?php echo __($_smarty_tpl->tpl_vars['transfer']->value['package_name']);?>
 <?php echo __("Package");?>
 = <strong><?php echo print_money($_smarty_tpl->tpl_vars['transfer']->value['package_price']);?>
</strong>
                  <?php } elseif ($_smarty_tpl->tpl_vars['transfer']->value['handle'] == "wallet") {?>
                    <?php echo __("Add Wallet Balance");?>
 = <strong><?php echo print_money($_smarty_tpl->tpl_vars['transfer']->value['price']);?>
</strong>
                  <?php } elseif ($_smarty_tpl->tpl_vars['transfer']->value['handle'] == "donate") {?>
                    <?php echo __("Funding Donation");?>
 = <strong><?php echo print_money($_smarty_tpl->tpl_vars['transfer']->value['price']);?>
</strong>
                  <?php } elseif ($_smarty_tpl->tpl_vars['transfer']->value['handle'] == "subscribe") {?>
                    <?php echo __("Subscribe");?>
 = <strong><?php echo print_money($_smarty_tpl->tpl_vars['transfer']->value['price']);?>
</strong>
                  <?php } elseif ($_smarty_tpl->tpl_vars['transfer']->value['handle'] == "paid_post") {?>
                    <?php echo __("Paid Post");?>
 = <strong><?php echo print_money($_smarty_tpl->tpl_vars['transfer']->value['price']);?>
</strong>
                  <?php } elseif ($_smarty_tpl->tpl_vars['transfer']->value['handle'] == "movies") {?>
                    <?php echo __("Movies");?>
 = <strong><?php echo print_money($_smarty_tpl->tpl_vars['transfer']->value['price']);?>
</strong>
                  <?php }?>
                </td>
                <td>
                  <span class="js_moment" data-time="<?php echo $_smarty_tpl->tpl_vars['transfer']->value['time'];?>
"><?php echo $_smarty_tpl->tpl_vars['transfer']->value['time'];?>
</span>
                </td>
                <td>
                  <?php if ($_smarty_tpl->tpl_vars['transfer']->value['status'] == '0') {?>
                    <span class="badge rounded-pill badge-lg bg-warning"><?php echo __("Pending");?>
</span>
                  <?php } elseif ($_smarty_tpl->tpl_vars['transfer']->value['status'] == '1') {?>
                    <span class="badge rounded-pill badge-lg bg-success"><?php echo __("Approved");?>
</span>
                  <?php } else { ?>
                    <span class="badge rounded-pill badge-lg bg-danger"><?php echo __("Declined");?>
</span>
                  <?php }?>
                </td>
              </tr>
            <?php
$_smarty_tpl->tpl_vars['transfer'] = $__foreach_transfer_0_saved;
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
          </tbody>
        </table>
      </div>
    <?php } else { ?>
      <?php $_smarty_tpl->_subTemplateRender('file:_no_transactions.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
    <?php }?>
  </div>
</div><?php }
}
