<?php

/**
 * wallet_loans
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
    case 'request':
      /* valid inputs */
      if (!isset($_POST['amount']) || !is_numeric($_POST['amount']) || $_POST['amount'] <= 0) {
        throw new Exception(__("You must enter valid amount"));
      }
      if (!isset($_POST['duration_months']) || !is_numeric($_POST['duration_months']) || $_POST['duration_months'] <= 0) {
        throw new Exception(__("You must enter valid duration"));
      }
      if (!isset($_POST['interest_rate']) || !is_numeric($_POST['interest_rate']) || $_POST['interest_rate'] < 0) {
        throw new Exception(__("You must enter valid interest rate"));
      }
      if (empty($_POST['description'])) {
        throw new Exception(__("You must enter a description"));
      }

      $amount = $_POST['amount'];
      $duration_months = $_POST['duration_months'];
      $interest_rate = $_POST['interest_rate'];
      $description = $_POST['description'];

      /* request loan */
      $user->wallet_request_loan($amount, $duration_months, $interest_rate, $description);

      /* return */
      modal("SUCCESS", __("Success"), __("Your loan request has been submitted. You will be notified once approved."));
      break;

    case 'pay':
      /* valid inputs */
      if (!isset($_POST['loan_id']) || !is_numeric($_POST['loan_id'])) {
        throw new Exception(__("Invalid loan ID"));
      }
      if (!isset($_POST['amount']) || !is_numeric($_POST['amount']) || $_POST['amount'] <= 0) {
        throw new Exception(__("You must enter valid amount"));
      }

      $loan_id = $_POST['loan_id'];
      $amount = $_POST['amount'];

      /* pay loan */
      $user->wallet_pay_loan($loan_id, $amount);

      /* return */
      return_json(array('callback' => 'window.location.reload();'));
      break;

    case 'approve':
      /* check admin permission */
      if (!$user->_is_admin) {
        throw new Exception(__("You do not have permission"));
      }

      /* valid inputs */
      if (!isset($_POST['loan_id']) || !is_numeric($_POST['loan_id'])) {
        throw new Exception(__("Invalid loan ID"));
      }

      $loan_id = $_POST['loan_id'];

      /* approve loan */
      $user->wallet_approve_loan($loan_id);

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
