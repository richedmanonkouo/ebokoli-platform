<?php
/**
 * wallet menu - Page de menu pour choisir entre épargnes et emprunts
 *
 * @package Sngine
 * @author EBOKOLI Extension
 */

// fetch bootloader
require('bootloader.php');

// check if wallet enabled
if (!$system['wallet_enabled']) {
  _error(404);
}

// user access
user_access();

try {

  // page header
  page_header(__("Wallet") . ' | ' . __($system['system_title']));

  // get user wallet balance
  $wallet_balance = $user->_data['user_wallet_balance'];

  // get quick stats
  $savings_count = 0;
  $loans_count = 0;
  $total_savings_amount = 0;
  $total_loans_amount = 0;

  if (method_exists($user, 'wallet_get_savings')) {
    $savings = $user->wallet_get_savings('active');
    $savings_count = count($savings);
    foreach ($savings as $saving) {
      $total_savings_amount += $saving['current_value'];
    }
  }

  if (method_exists($user, 'wallet_get_loans')) {
    $loans = $user->wallet_get_loans('active');
    $loans_count = count($loans);
    foreach ($loans as $loan) {
      $total_loans_amount += $loan['amount_remaining'];
    }
  }

  /* assign variables */
  $smarty->assign('wallet_balance', $wallet_balance);
  $smarty->assign('savings_count', $savings_count);
  $smarty->assign('loans_count', $loans_count);
  $smarty->assign('total_savings_amount', $total_savings_amount);
  $smarty->assign('total_loans_amount', $total_loans_amount);

} catch (Exception $e) {
  _error(__("Error"), $e->getMessage());
}

// page footer
page_footer('wallet_menu');
?>
