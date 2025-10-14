<?php
/* Smarty version 4.3.4, created on 2025-10-14 11:01:24
  from 'C:\Users\HP\Documents\App_EBOKOLI\public_html\content\themes\default\templates\wallet.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.4',
  'unifunc' => 'content_68ee2d84e87785_72358430',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '0f9cf46a5a743e53e6c2d1d48c17f7c008431612' => 
    array (
      0 => 'C:\\Users\\HP\\Documents\\App_EBOKOLI\\public_html\\content\\themes\\default\\templates\\wallet.tpl',
      1 => 1760422878,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:_head.tpl' => 1,
    'file:_header.tpl' => 1,
    'file:_sidebar.tpl' => 1,
    'file:__svg_icons.tpl' => 15,
    'file:_no_transactions.tpl' => 2,
    'file:_footer.tpl' => 1,
  ),
),false)) {
function content_68ee2d84e87785_72358430 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'C:\\Users\\HP\\Documents\\App_EBOKOLI\\public_html\\vendor\\smarty\\smarty\\libs\\plugins\\modifier.number_format.php','function'=>'smarty_modifier_number_format',),));
$_smarty_tpl->_subTemplateRender('file:_head.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
$_smarty_tpl->_subTemplateRender('file:_header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<!-- page header -->
<div class="page-header">
  <img class="floating-img d-none d-md-block" src="<?php echo $_smarty_tpl->tpl_vars['system']->value['system_url'];?>
/content/themes/<?php echo $_smarty_tpl->tpl_vars['system']->value['theme'];?>
/images/headers/undraw_wallet_aym5.svg">
  <div class="circle-2"></div>
  <div class="circle-3"></div>
  <div class="inner">
    <h2><?php echo __("Wallet");?>
</h2>
    <p class="text-xlg"><?php echo __("Send and Transfer Money");?>
</p>
  </div>
</div>
<!-- page header -->

<!-- page content -->
<div class="<?php if ($_smarty_tpl->tpl_vars['system']->value['fluid_design']) {?>container-fluid<?php } else { ?>container<?php }?> sg-offcanvas" style="margin-top: -25px;">
  <div class="row">

    <!-- side panel -->
    <div class="col-12 d-block d-md-none sg-offcanvas-sidebar">
      <?php $_smarty_tpl->_subTemplateRender('file:_sidebar.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
    </div>
    <!-- side panel -->

    <!-- content panel -->
    <div class="col-12 sg-offcanvas-mainbar">

      <!-- tabs -->
      <div class="position-relative">
        <div class="content-tabs rounded-sm shadow-sm clearfix">
          <ul>
            <li <?php if ($_smarty_tpl->tpl_vars['view']->value == '') {?>class="active" <?php }?>>
              <a href="<?php echo $_smarty_tpl->tpl_vars['system']->value['system_url'];?>
/wallet">
                <?php $_smarty_tpl->_subTemplateRender('file:__svg_icons.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('icon'=>"wallet",'class'=>"main-icon mr10",'width'=>"24px",'height'=>"24px"), 0, false);
?>
                <?php echo __("Wallet");?>

              </a>
            </li>
            <li <?php if ($_smarty_tpl->tpl_vars['view']->value == "savings") {?>class="active" <?php }?>>
              <a href="<?php echo $_smarty_tpl->tpl_vars['system']->value['system_url'];?>
/wallet/savings">
                <?php $_smarty_tpl->_subTemplateRender('file:__svg_icons.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('icon'=>"wallet",'class'=>"main-icon mr10",'width'=>"24px",'height'=>"24px"), 0, true);
?>
                <?php echo __("Épargne");?>

              </a>
            </li>
            <li <?php if ($_smarty_tpl->tpl_vars['view']->value == "loans") {?>class="active" <?php }?>>
              <a href="<?php echo $_smarty_tpl->tpl_vars['system']->value['system_url'];?>
/wallet/loans">
                <?php $_smarty_tpl->_subTemplateRender('file:__svg_icons.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('icon'=>"wallet",'class'=>"main-icon mr10",'width'=>"24px",'height'=>"24px"), 0, true);
?>
                <?php echo __("Emprunts");?>

              </a>
            </li>
            <?php if ($_smarty_tpl->tpl_vars['system']->value['wallet_withdrawal_enabled']) {?>
              <li <?php if ($_smarty_tpl->tpl_vars['view']->value == "payments") {?>class="active" <?php }?>>
                <a href="<?php echo $_smarty_tpl->tpl_vars['system']->value['system_url'];?>
/wallet/payments">
                  <?php $_smarty_tpl->_subTemplateRender('file:__svg_icons.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('icon'=>"payments",'class'=>"main-icon mr10",'width'=>"24px",'height'=>"24px"), 0, true);
?>
                  <?php echo __("Payments");?>

                </a>
              </li>
            <?php }?>
          </ul>
        </div>
      </div>
      <!-- tabs -->

      <?php if ($_smarty_tpl->tpl_vars['view']->value == '') {?>

        <!-- wallet -->
        <div class="card mt20">
          <div class="card-header with-icon">
            <?php $_smarty_tpl->_subTemplateRender('file:__svg_icons.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('icon'=>"wallet",'class'=>"main-icon mr10",'width'=>"24px",'height'=>"24px"), 0, true);
?>
            <?php echo __("Wallet");?>

          </div>
          <div class="card-body page-content">
            <?php if ($_smarty_tpl->tpl_vars['wallet_transfer_amount']->value) {?>
              <div class="alert alert-success mb20">
                <i class="fas fa-check-circle mr5"></i>
                <?php echo __("Your");?>
 <span class="badge rounded-pill badge-lg bg-secondary"><?php echo print_money(smarty_modifier_number_format($_smarty_tpl->tpl_vars['wallet_transfer_amount']->value,2));?>
</span> <?php echo __("transfer transaction successfuly sent");?>

              </div>
            <?php }?>
            <?php if ($_smarty_tpl->tpl_vars['wallet_replenish_amount']->value) {?>
              <div class="alert alert-success mb20">
                <i class="fas fa-check-circle mr5"></i>
                <?php echo __("Congratulation! Your wallet credit replenished successfully with");?>
 <span class="badge rounded-pill badge-lg bg-secondary"><?php echo print_money(smarty_modifier_number_format($_smarty_tpl->tpl_vars['wallet_replenish_amount']->value,2));?>
</span>
              </div>
            <?php }?>
            <?php if ($_smarty_tpl->tpl_vars['wallet_withdraw_affiliates_amount']->value) {?>
              <div class="alert alert-success mb20">
                <i class="fas fa-check-circle mr5"></i>
                <?php echo __("Congratulation! Your wallet credit replenished successfully with");?>
 <span class="badge rounded-pill badge-lg bg-secondary"><?php echo print_money(smarty_modifier_number_format($_smarty_tpl->tpl_vars['wallet_withdraw_affiliates_amount']->value,2));?>
</span> <?php echo __("from your affiliates credit");?>

              </div>
            <?php }?>
            <?php if ($_smarty_tpl->tpl_vars['wallet_withdraw_points_amount']->value) {?>
              <div class="alert alert-success mb20">
                <i class="fas fa-check-circle mr5"></i>
                <?php echo __("Congratulation! Your wallet credit replenished successfully with");?>
 <span class="badge rounded-pill badge-lg bg-secondary"><?php echo print_money(smarty_modifier_number_format($_smarty_tpl->tpl_vars['wallet_withdraw_points_amount']->value,2));?>
</span> <?php echo __("from your points credit");?>

              </div>
            <?php }?>
            <?php if ($_smarty_tpl->tpl_vars['wallet_withdraw_market_amount']->value) {?>
              <div class="alert alert-success mb20">
                <i class="fas fa-check-circle mr5"></i>
                <?php echo __("Congratulation! Your wallet credit replenished successfully with");?>
 <span class="badge rounded-pill badge-lg bg-secondary"><?php echo print_money(smarty_modifier_number_format($_smarty_tpl->tpl_vars['wallet_withdraw_market_amount']->value,2));?>
</span> <?php echo __("from your market credit");?>

              </div>
            <?php }?>
            <?php if ($_smarty_tpl->tpl_vars['wallet_withdraw_funding_amount']->value) {?>
              <div class="alert alert-success mb20">
                <i class="fas fa-check-circle mr5"></i>
                <?php echo __("Congratulation! Your wallet credit replenished successfully with");?>
 <span class="badge rounded-pill badge-lg bg-secondary"><?php echo print_money(smarty_modifier_number_format($_smarty_tpl->tpl_vars['wallet_withdraw_funding_amount']->value,2));?>
</span> <?php echo __("from your funding credit");?>

              </div>
            <?php }?>
            <?php if ($_smarty_tpl->tpl_vars['wallet_withdraw_monetization_amount']->value) {?>
              <div class="alert alert-success mb20">
                <i class="fas fa-check-circle mr5"></i>
                <?php echo __("Congratulation! Your wallet credit replenished successfully with");?>
 <span class="badge rounded-pill badge-lg bg-secondary"><?php echo print_money(smarty_modifier_number_format($_smarty_tpl->tpl_vars['wallet_withdraw_monetization_amount']->value,2));?>
</span> <?php echo __("from your monetization credit");?>

              </div>
            <?php }?>
            <?php if ($_smarty_tpl->tpl_vars['wallet_package_payment_amount']->value) {?>
              <div class="alert alert-success mb20">
                <i class="fas fa-check-circle mr5"></i>
                <?php echo __("Your");?>
 <span class="badge rounded-pill badge-lg bg-secondary"><?php echo print_money(smarty_modifier_number_format($_smarty_tpl->tpl_vars['wallet_package_payment_amount']->value,2));?>
</span> <?php echo __("payment transaction successfuly done");?>

              </div>
            <?php }?>
            <?php if ($_smarty_tpl->tpl_vars['wallet_monetization_payment_amount']->value) {?>
              <div class="alert alert-success mb20">
                <i class="fas fa-check-circle mr5"></i>
                <?php echo __("Your");?>
 <span class="badge rounded-pill badge-lg bg-secondary"><?php echo print_money(smarty_modifier_number_format($_smarty_tpl->tpl_vars['wallet_monetization_payment_amount']->value,2));?>
</span> <?php echo __("payment transaction successfuly done");?>

              </div>
            <?php }?>
            <?php if ($_smarty_tpl->tpl_vars['wallet_paid_post_amount']->value) {?>
              <div class="alert alert-success mb20">
                <i class="fas fa-check-circle mr5"></i>
                <?php echo __("Your");?>
 <span class="badge rounded-pill badge-lg bg-secondary"><?php echo print_money(smarty_modifier_number_format($_smarty_tpl->tpl_vars['wallet_paid_post_amount']->value,2));?>
</span> <?php echo __("payment transaction successfuly done");?>

              </div>
            <?php }?>

            <div class="row">
              <!-- credit -->
              <div class="col-md-5">
                <div class="section-title mb20">
                  <?php echo __("Your Credit");?>

                </div>
                <div class="stat-panel bg-gradient-info">
                  <div class="stat-cell small">
                    <i class="fa fa-money-bill-alt bg-icon"></i>
                    <div class="h3 mtb10">
                      <?php echo print_money(smarty_modifier_number_format($_smarty_tpl->tpl_vars['user']->value->_data['user_wallet_balance'],2));?>

                    </div>
                  </div>
                </div>
              </div>
              <!-- credit -->

              <!-- send & recieve money -->
              <div class="col-md-7">
                <div class="section-title mb20">
                  <?php echo __("Send & Recieve Money");?>

                </div>
                <div class="d-grid">
                  <?php if ($_smarty_tpl->tpl_vars['system']->value['wallet_transfer_enabled']) {?>
                    <button class="btn btn-outline-primary mb10" data-toggle="modal" data-url="#wallet-transfer">
                      <?php $_smarty_tpl->_subTemplateRender('file:__svg_icons.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('icon'=>"wallet_transfer",'class'=>"main-icon mr10",'width'=>"24px",'height'=>"24px"), 0, true);
?>
                      <?php echo __("Send Money");?>

                    </button>
                  <?php }?>
                </div>

                <div class="d-grid gap-2">
                  <button class="btn btn-outline-primary" data-toggle="modal" data-url="#wallet-replenish">
                    <?php $_smarty_tpl->_subTemplateRender('file:__svg_icons.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('icon'=>"payments",'class'=>"main-icon mr10",'width'=>"24px",'height'=>"24px"), 0, true);
?>
                    <?php echo __("Replenish Credit");?>

                  </button>
                  <?php if ($_smarty_tpl->tpl_vars['system']->value['affiliates_enabled'] && $_smarty_tpl->tpl_vars['system']->value['affiliates_money_transfer_enabled']) {?>
                    <button class="btn btn-outline-primary" data-toggle="modal" data-url="#wallet-withdraw-affiliates">
                      <?php $_smarty_tpl->_subTemplateRender('file:__svg_icons.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('icon'=>"affiliates",'class'=>"main-icon mr10",'width'=>"24px",'height'=>"24px"), 0, true);
?>
                      <?php echo __("Affiliates Credit");?>

                    </button>
                  <?php }?>
                  <?php if ($_smarty_tpl->tpl_vars['system']->value['points_enabled'] && $_smarty_tpl->tpl_vars['system']->value['points_money_transfer_enabled']) {?>
                    <button class="btn btn-outline-primary" data-toggle="modal" data-url="#wallet-withdraw-points">
                      <?php $_smarty_tpl->_subTemplateRender('file:__svg_icons.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('icon'=>"points",'class'=>"main-icon mr10",'width'=>"24px",'height'=>"24px"), 0, true);
?>
                      <?php echo __("Points Credit");?>

                    </button>
                  <?php }?>
                  <?php if ($_smarty_tpl->tpl_vars['user']->value->_data['can_sell_products'] && $_smarty_tpl->tpl_vars['system']->value['market_money_transfer_enabled']) {?>
                    <button class="btn btn-outline-primary" data-toggle="modal" data-url="#wallet-withdraw-market">
                      <?php $_smarty_tpl->_subTemplateRender('file:__svg_icons.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('icon'=>"market",'class'=>"main-icon mr10",'width'=>"24px",'height'=>"24px"), 0, true);
?>
                      <?php echo __("Marketplace Credit");?>

                    </button>
                  <?php }?>
                  <?php if ($_smarty_tpl->tpl_vars['user']->value->_data['can_raise_funding'] && $_smarty_tpl->tpl_vars['system']->value['funding_money_transfer_enabled']) {?>
                    <button class="btn btn-outline-primary" data-toggle="modal" data-url="#wallet-withdraw-funding">
                      <?php $_smarty_tpl->_subTemplateRender('file:__svg_icons.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('icon'=>"funding",'class'=>"main-icon mr10",'width'=>"24px",'height'=>"24px"), 0, true);
?>
                      <?php echo __("Funding Credit");?>

                    </button>
                  <?php }?>
                  <?php if ($_smarty_tpl->tpl_vars['user']->value->_data['can_monetize_content'] && $_smarty_tpl->tpl_vars['system']->value['monetization_money_transfer_enabled']) {?>
                    <button class="btn btn-outline-primary" data-toggle="modal" data-url="#wallet-withdraw-monetization">
                      <?php $_smarty_tpl->_subTemplateRender('file:__svg_icons.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('icon'=>"monetization",'class'=>"main-icon mr10",'width'=>"24px",'height'=>"24px"), 0, true);
?>
                      <?php echo __("Monetization Credit");?>

                    </button>
                  <?php }?>
                </div>
              </div>
              <!-- send & recieve money -->

              <!-- wallet transactions -->
              <div class="col-12 mt20">
                <div class="section-title mt10 mb20">
                  <?php echo __("Wallet Transactions");?>

                </div>
                <?php if ($_smarty_tpl->tpl_vars['transactions']->value) {?>
                  <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover js_dataTable">
                      <thead>
                        <tr>
                          <th><?php echo __("ID");?>
</th>
                          <th><?php echo __("Amount");?>
</th>
                          <th><?php echo __("From / To");?>
</th>
                          <th><?php echo __("Time");?>
</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['transactions']->value, 'transaction');
$_smarty_tpl->tpl_vars['transaction']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['transaction']->value) {
$_smarty_tpl->tpl_vars['transaction']->do_else = false;
?>
                          <tr>
                            <td><?php echo $_smarty_tpl->tpl_vars['transaction']->value['transaction_id'];?>
</td>
                            <td>
                              <?php if ($_smarty_tpl->tpl_vars['transaction']->value['type'] == "out") {?>
                                <span class="badge rounded-pill badge-lg bg-danger mr5"><i class="far fa-arrow-alt-circle-down"></i></span>
                                <strong class="text-danger"><?php echo print_money(smarty_modifier_number_format($_smarty_tpl->tpl_vars['transaction']->value['amount'],2));?>
</strong>
                              <?php } else { ?>
                                <span class="badge rounded-pill badge-lg bg-success mr5"><i class="far fa-arrow-alt-circle-up"></i></span>
                                <strong class="text-success"><?php echo print_money(smarty_modifier_number_format($_smarty_tpl->tpl_vars['transaction']->value['amount'],2));?>
</strong>
                              <?php }?>
                            </td>
                            <td>
                              <?php if ($_smarty_tpl->tpl_vars['transaction']->value['type'] == "out") {?>
                                <span class="badge rounded-pill badge-lg bg-danger mr10"><?php echo __("To");?>
</span>
                              <?php } else { ?>
                                <span class="badge rounded-pill badge-lg bg-success mr10"><?php echo __("From");?>
</span>
                              <?php }?>
                              <?php if ($_smarty_tpl->tpl_vars['transaction']->value['node_type'] == "user" || $_smarty_tpl->tpl_vars['transaction']->value['node_type'] == "tip") {?>
                                <?php if ($_smarty_tpl->tpl_vars['transaction']->value['node_type'] == "tip") {?>
                                  <span class="badge rounded-pill badge-lg bg-secondary mr10"><?php echo __("Tip");?>
</span>
                                <?php }?>
                                <a target="_blank" href="<?php echo $_smarty_tpl->tpl_vars['system']->value['system_url'];?>
/<?php echo $_smarty_tpl->tpl_vars['transaction']->value['user_name'];?>
">
                                  <img class="tbl-image" src="<?php echo $_smarty_tpl->tpl_vars['transaction']->value['user_picture'];?>
" style="float: none;">
                                  <?php if ($_smarty_tpl->tpl_vars['system']->value['show_usernames_enabled']) {?>
                                    <?php echo $_smarty_tpl->tpl_vars['transaction']->value['user_name'];?>

                                  <?php } else { ?>
                                    <?php echo $_smarty_tpl->tpl_vars['transaction']->value['user_firstname'];?>
 <?php echo $_smarty_tpl->tpl_vars['transaction']->value['user_lastname'];?>

                                  <?php }?>
                                </a>
                              <?php } elseif ($_smarty_tpl->tpl_vars['transaction']->value['node_type'] == "recharge") {?>
                                <?php echo __("Replenish Credit");?>

                              <?php } elseif ($_smarty_tpl->tpl_vars['transaction']->value['node_type'] == "withdraw_wallet") {?>
                                <?php echo __("Wallet Withdrawal");?>

                              <?php } elseif ($_smarty_tpl->tpl_vars['transaction']->value['node_type'] == "withdraw_affiliates") {?>
                                <?php echo __("Affiliates Credit");?>

                              <?php } elseif ($_smarty_tpl->tpl_vars['transaction']->value['node_type'] == "withdraw_points") {?>
                                <?php echo __("Points Credit");?>

                              <?php } elseif ($_smarty_tpl->tpl_vars['transaction']->value['node_type'] == "withdraw_market") {?>
                                <?php echo __("Market Credit");?>

                              <?php } elseif ($_smarty_tpl->tpl_vars['transaction']->value['node_type'] == "withdraw_funding") {?>
                                <?php echo __("Funding Credit");?>

                              <?php } elseif ($_smarty_tpl->tpl_vars['transaction']->value['node_type'] == "withdraw_monetization") {?>
                                <?php echo __("Monetization Credit");?>

                              <?php } elseif ($_smarty_tpl->tpl_vars['transaction']->value['node_type'] == "package_payment") {?>
                                <?php echo __("Buy Pro Package");?>

                              <?php } elseif ($_smarty_tpl->tpl_vars['transaction']->value['node_type'] == "subscribe_profile" || $_smarty_tpl->tpl_vars['transaction']->value['node_type'] == "subscribe_user") {?>
                                <?php echo __("Subscribe to Profile");?>

                              <?php } elseif ($_smarty_tpl->tpl_vars['transaction']->value['node_type'] == "subscribe_page") {?>
                                <?php echo __("Subscribe to Page");?>

                              <?php } elseif ($_smarty_tpl->tpl_vars['transaction']->value['node_type'] == "subscribe_group") {?>
                                <?php echo __("Subscribe to Group");?>

                              <?php } elseif ($_smarty_tpl->tpl_vars['transaction']->value['node_type'] == "paid_post") {?>
                                <?php echo __("Paid Post");?>

                              <?php } elseif ($_smarty_tpl->tpl_vars['transaction']->value['node_type'] == "market") {?>
                                <?php echo __("Market Purchase");?>

                              <?php }?>
                            </td>
                            <td><span class="js_moment" data-time="<?php echo $_smarty_tpl->tpl_vars['transaction']->value['date'];?>
"><?php echo $_smarty_tpl->tpl_vars['transaction']->value['date'];?>
</span></td>
                          </tr>
                        <?php
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
              <!-- wallet transactions -->
            </div>
          </div>
        </div>
        <!-- wallet -->

      <?php } elseif ($_smarty_tpl->tpl_vars['view']->value == "payments") {?>

        <!-- payments -->
        <div class="card mt20">
          <div class="card-header with-icon">
            <?php $_smarty_tpl->_subTemplateRender('file:__svg_icons.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('icon'=>"payments",'class'=>"main-icon mr10",'width'=>"24px",'height'=>"24px"), 0, true);
?>
            <?php echo __("Payments");?>

          </div>
          <div class="card-body page-content">
            <div class="section-title mt10 mb20">
              <?php echo __("Withdrawal Request");?>

            </div>
            <form class="js_ajax-forms" data-url="users/withdraw.php?type=wallet">
              <div class="row form-group">
                <label class="col-md-3 form-label">
                  <?php echo __("Your Balance");?>

                </label>
                <div class="col-md-9">
                  <h6>
                    <span class="badge badge-lg bg-info">
                      <?php echo print_money(smarty_modifier_number_format($_smarty_tpl->tpl_vars['user']->value->_data['user_wallet_balance'],2));?>

                    </span>
                  </h6>
                </div>
              </div>

              <div class="row form-group">
                <label class="col-md-3 form-label">
                  <?php echo __("Amount");?>
 (<?php echo $_smarty_tpl->tpl_vars['system']->value['system_currency'];?>
)
                </label>
                <div class="col-md-9">
                  <input type="text" class="form-control" name="amount">
                  <div class="form-text">
                    <?php echo __("The minimum withdrawal request amount is");?>
 <?php echo print_money($_smarty_tpl->tpl_vars['system']->value['wallet_min_withdrawal']);?>

                  </div>
                </div>
              </div>

              <div class="row form-group">
                <label class="col-md-3 form-label">
                  <?php echo __("Payment Method");?>

                </label>
                <div class="col-md-9">
                  <?php if (in_array("paypal",$_smarty_tpl->tpl_vars['system']->value['wallet_payment_method_array'])) {?>
                    <div class="form-check form-check-inline">
                      <input type="radio" name="method" id="method_paypal" value="paypal" class="form-check-input">
                      <label class="form-check-label" for="method_paypal"><?php echo __("PayPal");?>
</label>
                    </div>
                  <?php }?>
                  <?php if (in_array("skrill",$_smarty_tpl->tpl_vars['system']->value['wallet_payment_method_array'])) {?>
                    <div class="form-check form-check-inline">
                      <input type="radio" name="method" id="method_skrill" value="skrill" class="form-check-input">
                      <label class="form-check-label" for="method_skrill"><?php echo __("Skrill");?>
</label>
                    </div>
                  <?php }?>
                  <?php if (in_array("moneypoolscash",$_smarty_tpl->tpl_vars['system']->value['wallet_payment_method_array'])) {?>
                    <div class="form-check form-check-inline">
                      <input type="radio" name="method" id="method_moneypoolscash" value="moneypoolscash" class="form-check-input">
                      <label class="form-check-label" for="method_moneypoolscash"><?php echo __("MoneyPoolsCash");?>
</label>
                    </div>
                  <?php }?>
                  <?php if (in_array("bank",$_smarty_tpl->tpl_vars['system']->value['wallet_payment_method_array'])) {?>
                    <div class="form-check form-check-inline">
                      <input type="radio" name="method" id="method_bank" value="bank" class="form-check-input">
                      <label class="form-check-label" for="method_bank"><?php echo __("Bank Transfer");?>
</label>
                    </div>
                  <?php }?>
                  <?php if (in_array("custom",$_smarty_tpl->tpl_vars['system']->value['wallet_payment_method_array'])) {?>
                    <div class="form-check form-check-inline">
                      <input type="radio" name="method" id="method_custom" value="custom" class="form-check-input">
                      <label class="form-check-label" for="method_custom"><?php echo __($_smarty_tpl->tpl_vars['system']->value['wallet_payment_method_custom']);?>
</label>
                    </div>
                  <?php }?>
                </div>
              </div>

              <div class="row form-group">
                <label class="col-md-3 form-label">
                  <?php echo __("Transfer To");?>

                </label>
                <div class="col-md-9">
                  <input type="text" class="form-control" name="method_value">
                </div>
              </div>

              <div class="row">
                <div class="col-md-9 offset-md-3">
                  <button type="submit" class="btn btn-primary"><?php echo __("Make a withdrawal");?>
</button>
                </div>
              </div>

              <!-- success -->
              <div class="alert alert-success mt15 mb0 x-hidden"></div>
              <!-- success -->

              <!-- error -->
              <div class="alert alert-danger mt15 mb0 x-hidden"></div>
              <!-- error -->
            </form>

            <div class="section-title mt20 mb20">
              <?php echo __("Withdrawal History");?>

            </div>
            <?php if ($_smarty_tpl->tpl_vars['payments']->value) {?>
              <div class="table-responsive mt20">
                <table class="table table-striped table-bordered table-hover">
                  <thead>
                    <tr>
                      <th><?php echo __("ID");?>
</th>
                      <th><?php echo __("Amount");?>
</th>
                      <th><?php echo __("Method");?>
</th>
                      <th><?php echo __("Transfer To");?>
</th>
                      <th><?php echo __("Time");?>
</th>
                      <th><?php echo __("Status");?>
</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['payments']->value, 'payment');
$_smarty_tpl->tpl_vars['payment']->iteration = 0;
$_smarty_tpl->tpl_vars['payment']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['payment']->value) {
$_smarty_tpl->tpl_vars['payment']->do_else = false;
$_smarty_tpl->tpl_vars['payment']->iteration++;
$__foreach_payment_1_saved = $_smarty_tpl->tpl_vars['payment'];
?>
                      <tr>
                        <td><?php echo $_smarty_tpl->tpl_vars['payment']->iteration;?>
</td>
                        <td><?php echo print_money(smarty_modifier_number_format($_smarty_tpl->tpl_vars['payment']->value['amount'],2));?>
</td>
                        <td>
                          <?php if ($_smarty_tpl->tpl_vars['payment']->value['method'] == "custom") {?>
                            <?php echo $_smarty_tpl->tpl_vars['system']->value['wallet_payment_method_custom'];?>

                          <?php } else { ?>
                            <?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'ucfirst' ][ 0 ], array( $_smarty_tpl->tpl_vars['payment']->value['method'] ));?>

                          <?php }?>
                        </td>
                        <td><?php echo $_smarty_tpl->tpl_vars['payment']->value['method_value'];?>
</td>
                        <td>
                          <span class="js_moment" data-time="<?php echo $_smarty_tpl->tpl_vars['payment']->value['time'];?>
"><?php echo $_smarty_tpl->tpl_vars['payment']->value['time'];?>
</span>
                        </td>
                        <td>
                          <?php if ($_smarty_tpl->tpl_vars['payment']->value['status'] == '0') {?>
                            <span class="badge rounded-pill badge-lg bg-warning"><?php echo __("Pending");?>
</span>
                          <?php } elseif ($_smarty_tpl->tpl_vars['payment']->value['status'] == '1') {?>
                            <span class="badge rounded-pill badge-lg bg-success"><?php echo __("Approved");?>
</span>
                          <?php } else { ?>
                            <span class="badge rounded-pill badge-lg bg-danger"><?php echo __("Declined");?>
</span>
                          <?php }?>
                        </td>
                      </tr>
                    <?php
$_smarty_tpl->tpl_vars['payment'] = $__foreach_payment_1_saved;
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                  </tbody>
                </table>
              </div>
            <?php } else { ?>
              <?php $_smarty_tpl->_subTemplateRender('file:_no_transactions.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
            <?php }?>
          </div>
        </div>
        <!-- payments -->

      <?php } elseif ($_smarty_tpl->tpl_vars['view']->value == "savings") {?>

        <!-- savings -->
        <div class="card mt20">
          <div class="card-header with-icon with-icon-tabs">
            <div class="float-end">
              <span class="badge bg-info p-2">
                <i class="fa fa-eye mr5"></i><?php echo __("Vue Consultation");?>

              </span>
            </div>
            <?php $_smarty_tpl->_subTemplateRender('file:__svg_icons.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('icon'=>"wallet",'class'=>"main-icon mr10",'width'=>"24px",'height'=>"24px"), 0, true);
?>
            <?php echo __("Mes Épargnes");?>

          </div>
          <div class="card-body page-content">

            <!-- Info Message -->
            <div class="alert alert-info mb20">
              <i class="fa fa-info-circle mr5"></i>
              <strong><?php echo __("Information");?>
</strong> : <?php echo __("Vos épargnes sont gérées par l'administration. Pour toute demande, veuillez contacter un administrateur.");?>

            </div>

            <!-- Total Savings -->
            <div class="row mb20">
              <div class="col-md-12">
                <div class="stat-panel bg-gradient-success">
                  <div class="stat-cell">
                    <i class="fa fa-piggy-bank bg-icon"></i>
                    <div class="h3 mtb10">
                      <?php echo print_money(smarty_modifier_number_format($_smarty_tpl->tpl_vars['user']->value->_data['user_total_savings'],2));?>

                    </div>
                    <span class="text-muted"><?php echo __("Total Épargné");?>
</span>
                  </div>
                </div>
              </div>
            </div>

            <!-- Active Savings -->
            <?php if ($_smarty_tpl->tpl_vars['savings']->value) {?>
              <div class="section-title mb20">
                <?php echo __("Épargnes Actives");?>

              </div>
              <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover">
                  <thead>
                    <tr>
                      <th><?php echo __("ID");?>
</th>
                      <th><?php echo __("Montant");?>
</th>
                      <th><?php echo __("Taux d'intérêt");?>
</th>
                      <th><?php echo __("Intérêts Accumulés");?>
</th>
                      <th><?php echo __("Valeur Actuelle");?>
</th>
                      <th><?php echo __("Date de Début");?>
</th>
                      <th><?php echo __("Statut");?>
</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['savings']->value, 'saving');
$_smarty_tpl->tpl_vars['saving']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['saving']->value) {
$_smarty_tpl->tpl_vars['saving']->do_else = false;
?>
                      <tr>
                        <td><?php echo $_smarty_tpl->tpl_vars['saving']->value['saving_id'];?>
</td>
                        <td><strong class="text-success"><?php echo print_money(smarty_modifier_number_format($_smarty_tpl->tpl_vars['saving']->value['amount'],2));?>
</strong></td>
                        <td><?php echo $_smarty_tpl->tpl_vars['saving']->value['interest_rate'];?>
%</td>
                        <td><span class="badge rounded-pill badge-lg bg-info"><?php echo print_money(smarty_modifier_number_format($_smarty_tpl->tpl_vars['saving']->value['accumulated_interest'],2));?>
</span></td>
                        <td><strong class="text-primary"><?php echo print_money(smarty_modifier_number_format($_smarty_tpl->tpl_vars['saving']->value['current_value'],2));?>
</strong></td>
                        <td><span class="js_moment" data-time="<?php echo $_smarty_tpl->tpl_vars['saving']->value['start_date'];?>
"><?php echo $_smarty_tpl->tpl_vars['saving']->value['start_date'];?>
</span></td>
                        <td>
                          <?php if ($_smarty_tpl->tpl_vars['saving']->value['status'] == 'active') {?>
                            <span class="badge rounded-pill badge-lg bg-success"><?php echo __("Active");?>
</span>
                          <?php } elseif ($_smarty_tpl->tpl_vars['saving']->value['status'] == 'completed') {?>
                            <span class="badge rounded-pill badge-lg bg-secondary"><?php echo __("Complétée");?>
</span>
                          <?php } else { ?>
                            <span class="badge rounded-pill badge-lg bg-danger"><?php echo __("Annulée");?>
</span>
                          <?php }?>
                        </td>
                      </tr>
                    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                  </tbody>
                </table>
              </div>
            <?php } else { ?>
              <div class="text-center mtb20">
                <div class="mb10">
                  <i class="fa fa-piggy-bank fa-5x text-muted"></i>
                </div>
                <h4 class="text-muted"><?php echo __("Aucune épargne pour le moment");?>
</h4>
                <p class="text-muted"><?php echo __("L'administrateur créera vos épargnes");?>
</p>
              </div>
            <?php }?>

            <!-- Savings Transactions -->
            <?php if ($_smarty_tpl->tpl_vars['savings_transactions']->value) {?>
              <div class="section-title mt20 mb20">
                <?php echo __("Historique des Transactions d'Épargne");?>

              </div>
              <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover">
                  <thead>
                    <tr>
                      <th><?php echo __("ID");?>
</th>
                      <th><?php echo __("Type");?>
</th>
                      <th><?php echo __("Montant");?>
</th>
                      <th><?php echo __("Date");?>
</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['savings_transactions']->value, 'transaction');
$_smarty_tpl->tpl_vars['transaction']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['transaction']->value) {
$_smarty_tpl->tpl_vars['transaction']->do_else = false;
?>
                      <tr>
                        <td><?php echo $_smarty_tpl->tpl_vars['transaction']->value['transaction_id'];?>
</td>
                        <td>
                          <?php if ($_smarty_tpl->tpl_vars['transaction']->value['node_type'] == 'saving') {?>
                            <span class="badge rounded-pill badge-lg bg-warning"><?php echo __("Dépôt Épargne");?>
</span>
                          <?php } else { ?>
                            <span class="badge rounded-pill badge-lg bg-success"><?php echo __("Retrait Épargne");?>
</span>
                          <?php }?>
                        </td>
                        <td>
                          <?php if ($_smarty_tpl->tpl_vars['transaction']->value['type'] == "out") {?>
                            <span class="text-danger">-<?php echo print_money(smarty_modifier_number_format($_smarty_tpl->tpl_vars['transaction']->value['amount'],2));?>
</span>
                          <?php } else { ?>
                            <span class="text-success">+<?php echo print_money(smarty_modifier_number_format($_smarty_tpl->tpl_vars['transaction']->value['amount'],2));?>
</span>
                          <?php }?>
                        </td>
                        <td><span class="js_moment" data-time="<?php echo $_smarty_tpl->tpl_vars['transaction']->value['date'];?>
"><?php echo $_smarty_tpl->tpl_vars['transaction']->value['date'];?>
</span></td>
                      </tr>
                    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                  </tbody>
                </table>
              </div>
            <?php }?>

          </div>
        </div>
        <!-- savings -->

      <?php } elseif ($_smarty_tpl->tpl_vars['view']->value == "loans") {?>

        <!-- loans -->
        <div class="card mt20">
          <div class="card-header with-icon with-icon-tabs">
            <div class="float-end">
              <span class="badge bg-warning p-2">
                <i class="fa fa-eye mr5"></i><?php echo __("Vue Consultation");?>

              </span>
            </div>
            <?php $_smarty_tpl->_subTemplateRender('file:__svg_icons.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('icon'=>"wallet",'class'=>"main-icon mr10",'width'=>"24px",'height'=>"24px"), 0, true);
?>
            <?php echo __("Mes Emprunts");?>

          </div>
          <div class="card-body page-content">

            <!-- Info Message -->
            <div class="alert alert-warning mb20">
              <i class="fa fa-info-circle mr5"></i>
              <strong><?php echo __("Information");?>
</strong> : <?php echo __("Vos emprunts sont gérés par l'administration. Pour toute demande, veuillez contacter un administrateur.");?>

            </div>

            <!-- Total Loans -->
            <div class="row mb20">
              <div class="col-md-12">
                <div class="stat-panel bg-gradient-warning">
                  <div class="stat-cell">
                    <i class="fa fa-hand-holding-usd bg-icon"></i>
                    <div class="h3 mtb10">
                      <?php echo print_money(smarty_modifier_number_format($_smarty_tpl->tpl_vars['user']->value->_data['user_total_loans'],2));?>

                    </div>
                    <span class="text-muted"><?php echo __("Total Emprunts en Cours");?>
</span>
                  </div>
                </div>
              </div>
            </div>

            <!-- Active Loans -->
            <?php if ($_smarty_tpl->tpl_vars['loans']->value) {?>
              <div class="section-title mb20">
                <?php echo __("Mes Emprunts");?>

              </div>
              <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover">
                  <thead>
                    <tr>
                      <th><?php echo __("ID");?>
</th>
                      <th><?php echo __("Montant");?>
</th>
                      <th><?php echo __("Taux");?>
</th>
                      <th><?php echo __("Durée");?>
</th>
                      <th><?php echo __("Paiement Mensuel");?>
</th>
                      <th><?php echo __("Montant Payé");?>
</th>
                      <th><?php echo __("Reste à Payer");?>
</th>
                      <th><?php echo __("Date");?>
</th>
                      <th><?php echo __("Statut");?>
</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['loans']->value, 'loan');
$_smarty_tpl->tpl_vars['loan']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['loan']->value) {
$_smarty_tpl->tpl_vars['loan']->do_else = false;
?>
                      <tr>
                        <td><?php echo $_smarty_tpl->tpl_vars['loan']->value['loan_id'];?>
</td>
                        <td><strong class="text-primary"><?php echo print_money(smarty_modifier_number_format($_smarty_tpl->tpl_vars['loan']->value['amount'],2));?>
</strong></td>
                        <td><?php echo $_smarty_tpl->tpl_vars['loan']->value['interest_rate'];?>
%</td>
                        <td><?php echo $_smarty_tpl->tpl_vars['loan']->value['duration_months'];?>
 <?php echo __("mois");?>
</td>
                        <td><span class="badge rounded-pill badge-lg bg-info"><?php echo print_money(smarty_modifier_number_format($_smarty_tpl->tpl_vars['loan']->value['monthly_payment'],2));?>
</span></td>
                        <td><span class="text-success"><?php echo print_money(smarty_modifier_number_format($_smarty_tpl->tpl_vars['loan']->value['amount_paid'],2));?>
</span></td>
                        <td><strong class="text-danger"><?php echo print_money(smarty_modifier_number_format($_smarty_tpl->tpl_vars['loan']->value['amount_remaining'],2));?>
</strong></td>
                        <td><span class="js_moment" data-time="<?php echo $_smarty_tpl->tpl_vars['loan']->value['loan_date'];?>
"><?php echo $_smarty_tpl->tpl_vars['loan']->value['loan_date'];?>
</span></td>
                        <td>
                          <?php if ($_smarty_tpl->tpl_vars['loan']->value['status'] == 'pending') {?>
                            <span class="badge rounded-pill badge-lg bg-warning"><?php echo __("En Attente");?>
</span>
                          <?php } elseif ($_smarty_tpl->tpl_vars['loan']->value['status'] == 'active') {?>
                            <span class="badge rounded-pill badge-lg bg-primary"><?php echo __("Actif");?>
</span>
                          <?php } elseif ($_smarty_tpl->tpl_vars['loan']->value['status'] == 'completed') {?>
                            <span class="badge rounded-pill badge-lg bg-success"><?php echo __("Remboursé");?>
</span>
                          <?php } elseif ($_smarty_tpl->tpl_vars['loan']->value['status'] == 'defaulted') {?>
                            <span class="badge rounded-pill badge-lg bg-danger"><?php echo __("Défaut");?>
</span>
                          <?php } else { ?>
                            <span class="badge rounded-pill badge-lg bg-secondary"><?php echo __("Annulé");?>
</span>
                          <?php }?>
                        </td>
                      </tr>
                    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                  </tbody>
                </table>
              </div>
            <?php } else { ?>
              <div class="text-center mtb20">
                <div class="mb10">
                  <i class="fa fa-hand-holding-usd fa-5x text-muted"></i>
                </div>
                <h4 class="text-muted"><?php echo __("Aucun emprunt");?>
</h4>
                <p class="text-muted"><?php echo __("Vous n'avez aucun emprunt en cours");?>
</p>
              </div>
            <?php }?>

            <!-- Loans Transactions -->
            <?php if ($_smarty_tpl->tpl_vars['loans_transactions']->value) {?>
              <div class="section-title mt20 mb20">
                <?php echo __("Historique des Transactions d'Emprunt");?>

              </div>
              <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover">
                  <thead>
                    <tr>
                      <th><?php echo __("ID");?>
</th>
                      <th><?php echo __("Type");?>
</th>
                      <th><?php echo __("Montant");?>
</th>
                      <th><?php echo __("Date");?>
</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['loans_transactions']->value, 'transaction');
$_smarty_tpl->tpl_vars['transaction']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['transaction']->value) {
$_smarty_tpl->tpl_vars['transaction']->do_else = false;
?>
                      <tr>
                        <td><?php echo $_smarty_tpl->tpl_vars['transaction']->value['transaction_id'];?>
</td>
                        <td>
                          <?php if ($_smarty_tpl->tpl_vars['transaction']->value['node_type'] == 'loan') {?>
                            <span class="badge rounded-pill badge-lg bg-info"><?php echo __("Emprunt Reçu");?>
</span>
                          <?php } else { ?>
                            <span class="badge rounded-pill badge-lg bg-warning"><?php echo __("Remboursement");?>
</span>
                          <?php }?>
                        </td>
                        <td>
                          <?php if ($_smarty_tpl->tpl_vars['transaction']->value['type'] == "out") {?>
                            <span class="text-danger">-<?php echo print_money(smarty_modifier_number_format($_smarty_tpl->tpl_vars['transaction']->value['amount'],2));?>
</span>
                          <?php } else { ?>
                            <span class="text-success">+<?php echo print_money(smarty_modifier_number_format($_smarty_tpl->tpl_vars['transaction']->value['amount'],2));?>
</span>
                          <?php }?>
                        </td>
                        <td><span class="js_moment" data-time="<?php echo $_smarty_tpl->tpl_vars['transaction']->value['date'];?>
"><?php echo $_smarty_tpl->tpl_vars['transaction']->value['date'];?>
</span></td>
                      </tr>
                    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                  </tbody>
                </table>
              </div>
            <?php }?>

          </div>
        </div>
        <!-- loans -->

      <?php }?>
    </div>
    <!-- content panel -->

  </div>
</div>
<!-- page content -->

<?php $_smarty_tpl->_subTemplateRender('file:_footer.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
