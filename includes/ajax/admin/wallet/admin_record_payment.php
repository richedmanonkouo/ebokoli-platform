<?php
/**
 * Modal for admin to record loan payment
 */

// fetch bootloader
require('../../../../bootloader.php');

// check admin permission
if (!$user->_is_admin) {
  modal("ERROR", __("Error"), __("You don't have permission to access this"));
}

// get loan_id and user_id
$loan_id = (isset($_GET['loan_id'])) ? (int)$_GET['loan_id'] : 0;
$user_id = (isset($_GET['user_id'])) ? (int)$_GET['user_id'] : 0;

// get loan details
$get_loan = $db->query(sprintf("SELECT * FROM wallet_loans WHERE loan_id = %s", secure($loan_id))) or _error("SQL_ERROR");
if ($get_loan->num_rows == 0) {
  modal("ERROR", __("Error"), __("Loan not found"));
}
$loan = $get_loan->fetch_assoc();

// check if form submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  try {
    $amount = (float)$_POST['amount'];
    $description = $_POST['description'];

    // record payment
    $result = $user->admin_record_loan_payment($loan_id, $user_id, $amount, $description);

    if ($result) {
      modal("SUCCESS", __("Success"), __("Payment recorded successfully"));
    } else {
      modal("ERROR", __("Error"), __("Failed to record payment"));
    }
  } catch (Exception $e) {
    modal("ERROR", __("Error"), $e->getMessage());
  }
}
?>

<div class="modal-header">
  <h6 class="modal-title"><i class="fa fa-money-check mr5"></i><?php echo __("Record Loan Payment"); ?></h6>
  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<form class="js_ajax-forms" data-url="includes/ajax/admin/wallet/admin_record_payment.php?loan_id=<?php echo $loan_id; ?>&user_id=<?php echo $user_id; ?>">
  <div class="modal-body">

    <!-- Loan Info -->
    <div class="alert alert-info">
      <strong><?php echo __("Loan Information"); ?>:</strong><br>
      <?php echo __("Amount"); ?>: <strong><?php echo print_money($loan['amount']); ?></strong><br>
      <?php echo __("Amount Paid"); ?>: <span class="text-success"><?php echo print_money($loan['amount_paid']); ?></span><br>
      <?php echo __("Amount Remaining"); ?>: <span class="text-danger"><strong><?php echo print_money($loan['amount_remaining']); ?></strong></span>
    </div>

    <div class="form-group">
      <label class="form-label"><?php echo __("Payment Amount"); ?></label>
      <input type="number" class="form-control" name="amount" step="0.01" min="1" max="<?php echo $loan['amount_remaining']; ?>" required>
      <small class="form-text text-muted"><?php echo __("Maximum"); ?>: <?php echo print_money($loan['amount_remaining']); ?></small>
    </div>

    <div class="form-group">
      <label class="form-label"><?php echo __("Description"); ?></label>
      <textarea class="form-control" name="description" rows="3" placeholder="<?php echo __("Payment description (optional)"); ?>"></textarea>
    </div>

    <!-- error handler -->
    <div class="alert alert-danger mt15 mb0 x-hidden"></div>
    <!-- error handler -->
  </div>
  <div class="modal-footer">
    <button type="submit" class="btn btn-primary"><?php echo __("Record Payment"); ?></button>
  </div>
</form>
