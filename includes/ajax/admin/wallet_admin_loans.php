<?php
/**
 * AJAX handler for admin loans management
 */

// fetch bootloader
require('../../../bootloader.php');

// check AJAX request
if (!is_ajax()) {
  _error(__("Error"), __("Invalid request"));
}

// check admin permission
if (!$user->_is_admin) {
  _error(__("Error"), __("You don't have permission to access this"));
}

try {
  // get action
  $action = $_POST['action'];

  switch ($action) {
    case 'approve':
      // approve loan
      $loan_id = (int)$_POST['loan_id'];
      $user_id = (int)$_POST['user_id'];

      // admin approve loan
      $result = $user->admin_approve_loan($loan_id, $user_id);

      if ($result) {
        return_json(['success' => true, 'message' => __("Loan approved successfully")]);
      } else {
        return_json(['success' => false, 'message' => __("Failed to approve loan")]);
      }
      break;

    default:
      return_json(['success' => false, 'message' => __("Invalid action")]);
      break;
  }
} catch (Exception $e) {
  return_json(['success' => false, 'message' => $e->getMessage()]);
}
?>
