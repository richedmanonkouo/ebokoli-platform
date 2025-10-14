<?php
/**
 * AJAX handler for admin savings management
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
    case 'withdraw':
      // withdraw saving
      $saving_id = (int)$_POST['saving_id'];
      $user_id = (int)$_POST['user_id'];

      // admin withdraw saving
      $result = $user->admin_withdraw_saving($saving_id, $user_id);

      if ($result) {
        return_json(['success' => true, 'message' => __("Saving withdrawn successfully")]);
      } else {
        return_json(['success' => false, 'message' => __("Failed to withdraw saving")]);
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
