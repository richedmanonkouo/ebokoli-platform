<?php

/**
 * admin_wallet
 * Page d'administration pour gérer les wallets, épargnes et emprunts des clients
 *
 * @package Sngine
 * @author EBOKOLI Extension
 */

// fetch bootloader
require('bootloader.php');

// check admin access
if (!$user->_is_admin) {
  _error(404);
}

// check if wallet enabled
if (!$system['wallet_enabled']) {
  _error(404);
}

try {

  // Get view
  $view = (isset($_GET['view'])) ? $_GET['view'] : 'users';

  switch ($view) {
    case 'users':
      // Liste de tous les utilisateurs
      page_header(__("Wallet Management") . ' | ' . __($system['system_title']));

      // Get all users with wallet data
      global $db;
      $get_users = $db->query("SELECT user_id, user_name, user_firstname, user_lastname, user_email, user_picture, user_gender, user_wallet_balance, user_total_savings, user_total_loans FROM users WHERE user_activated = '1' ORDER BY user_id DESC") or _error('SQL_ERROR_THROWEN');

      $users = [];
      if ($get_users->num_rows > 0) {
        while ($user_data = $get_users->fetch_assoc()) {
          $user_data['user_picture'] = get_picture($user_data['user_picture'], $user_data['user_gender']);
          $users[] = $user_data;
        }
      }

      /* assign variables */
      $smarty->assign('users', $users);
      break;

    case 'manage':
      // Gestion d'un utilisateur spécifique
      if (!isset($_GET['user_id']) || !is_numeric($_GET['user_id'])) {
        _error(404);
      }

      $user_id = (int)$_GET['user_id'];

      // Get user data
      global $db;
      $get_user_data = $db->query(sprintf("SELECT * FROM users WHERE user_id = %s", secure($user_id, 'int'))) or _error('SQL_ERROR_THROWEN');

      if ($get_user_data->num_rows == 0) {
        _error(404);
      }

      $client = $get_user_data->fetch_assoc();
      $client['user_picture'] = get_picture($client['user_picture'], $client['user_gender']);

      // Get savings
      $get_savings = $db->query(sprintf("SELECT * FROM wallet_savings WHERE user_id = %s ORDER BY saving_id DESC", secure($user_id, 'int'))) or _error('SQL_ERROR_THROWEN');
      $savings = [];
      if ($get_savings->num_rows > 0) {
        while ($saving = $get_savings->fetch_assoc()) {
          $saving['accumulated_interest'] = 0;
          $saving['current_value'] = $saving['amount'];
          $savings[] = $saving;
        }
      }

      // Get loans
      $get_loans = $db->query(sprintf("SELECT * FROM wallet_loans WHERE user_id = %s ORDER BY loan_id DESC", secure($user_id, 'int'))) or _error('SQL_ERROR_THROWEN');
      $loans = [];
      if ($get_loans->num_rows > 0) {
        while ($loan = $get_loans->fetch_assoc()) {
          $loans[] = $loan;
        }
      }

      // Get transactions
      $get_transactions = $db->query(sprintf("SELECT * FROM wallet_transactions WHERE user_id = %s ORDER BY transaction_id DESC LIMIT 50", secure($user_id, 'int'))) or _error('SQL_ERROR_THROWEN');
      $transactions = [];
      if ($get_transactions->num_rows > 0) {
        while ($transaction = $get_transactions->fetch_assoc()) {
          $transactions[] = $transaction;
        }
      }

      page_header(__("Manage Wallet") . " - " . $client['user_firstname'] . " " . $client['user_lastname'] . ' | ' . __($system['system_title']));

      /* assign variables */
      $smarty->assign('client', $client);
      $smarty->assign('savings', $savings);
      $smarty->assign('loans', $loans);
      $smarty->assign('transactions', $transactions);
      break;

    default:
      _error(404);
      break;
  }

  /* assign variables */
  $smarty->assign('view', $view);

} catch (Exception $e) {
  _error(__("Error"), $e->getMessage());
}

// page footer
page_footer('admin_wallet');

?>
