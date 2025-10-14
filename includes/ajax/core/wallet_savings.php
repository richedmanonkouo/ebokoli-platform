<?php

/**
 * wallet_savings
 *
 * @package Sngine
 * @author Extension EBOKOLI
 */

// fetch bootstrap
require('../../../bootloader.php');

// check AJAX Request
is_ajax();

// check user logged in
if (!$user->_logged_in) {
  modal("MESSAGE", __("Error"), __("You need to login first"));
}

// check demo account
if ($user->_data['user_demo']) {
  modal("ERROR", __("Demo Restriction"), __("You can't do this with demo account"));
}

// check wallet enabled
if (!$system['wallet_enabled']) {
  modal("ERROR", __("Error"), __("This feature has been disabled by the admin"));
}

try {

  switch ($_GET['do']) {
    case 'create':
      /* valid inputs */
      if (!isset($_POST['amount']) || !is_numeric($_POST['amount']) || $_POST['amount'] <= 0) {
        throw new Exception(__("You must enter valid amount"));
      }
      if (!isset($_POST['interest_rate']) || !is_numeric($_POST['interest_rate']) || $_POST['interest_rate'] < 0) {
        throw new Exception(__("You must enter valid interest rate"));
      }

      $amount = $_POST['amount'];
      $interest_rate = $_POST['interest_rate'];
      $maturity_date = (!empty($_POST['maturity_date'])) ? $_POST['maturity_date'] : null;
      $description = $_POST['description'];

      /* create saving */
      $user->wallet_create_saving($amount, $interest_rate, $maturity_date, $description);

      /* return */
      modal("SUCCESS", __("Success"), __("Your saving has been created successfully"));
      break;

    case 'withdraw':
      /* valid inputs */
      if (!isset($_POST['saving_id']) || !is_numeric($_POST['saving_id'])) {
        throw new Exception(__("Invalid saving ID"));
      }

      $saving_id = $_POST['saving_id'];

      /* withdraw saving */
      $user->wallet_withdraw_saving($saving_id);

      /* return */
      return_json(array('callback' => 'window.location.reload();'));
      break;

    default:
      _error(400);
      break;
  }
} catch (Exception $e) {
  modal("ERROR", __("Error"), $e->getMessage());
}

?>
