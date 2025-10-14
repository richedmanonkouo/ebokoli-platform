<?php
/**
 * Modal for admin to edit loan
 */

// fetch bootloader
require('../../../../bootloader.php');

// check admin permission
if (!$user->_is_admin) {
  modal("ERROR", __("Error"), __("You don't have permission to access this"));
}

// get loan_id
$loan_id = (isset($_GET['id'])) ? (int)$_GET['id'] : 0;

// get loan data
$get_loan = $db->query(sprintf("SELECT * FROM wallet_loans WHERE loan_id = %s", secure($loan_id, 'int'))) or _error('SQL_ERROR');
if ($get_loan->num_rows == 0) {
  modal("ERROR", __("Error"), __("Loan not found"));
}
$loan = $get_loan->fetch_assoc();

// check if form submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  try {
    $amount = (float)$_POST['amount'];
    $interest_rate = (float)$_POST['interest_rate'];
    $duration_months = (int)$_POST['duration_months'];
    $status = $_POST['status'];

    // update loan
    $result = $user->admin_edit_loan($loan_id, $amount, $interest_rate, $duration_months, $status);

    if ($result) {
      modal("SUCCESS", __("Success"), __("Loan updated successfully"));
    } else {
      modal("ERROR", __("Error"), __("Failed to update loan"));
    }
  } catch (Exception $e) {
    modal("ERROR", __("Error"), $e->getMessage());
  }
}
?>

<div class="modal-header">
  <h6 class="modal-title"><?php echo __("Edit Loan"); ?></h6>
  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<form class="js_ajax-forms" data-url="includes/ajax/admin/wallet/admin_edit_loan.php?id=<?php echo $loan_id; ?>">
  <div class="modal-body">
    <div class="form-group">
      <label class="form-label"><?php echo __("Loan Amount"); ?></label>
      <input type="number" class="form-control" name="amount" step="0.01" min="1" value="<?php echo $loan['amount']; ?>" required>
    </div>

    <div class="form-group">
      <label class="form-label"><?php echo __("Interest Rate"); ?> (%)</label>
      <input type="number" class="form-control" name="interest_rate" step="0.01" min="0" value="<?php echo $loan['interest_rate']; ?>" required>
    </div>

    <div class="form-group">
      <label class="form-label"><?php echo __("Duration"); ?> (<?php echo __("months"); ?>)</label>
      <input type="number" class="form-control" name="duration_months" min="1" max="120" value="<?php echo $loan['duration_months']; ?>" required>
    </div>

    <div class="form-group">
      <label class="form-label"><?php echo __("Status"); ?></label>
      <select class="form-select" name="status" required>
        <option value="pending" <?php echo ($loan['status'] == 'pending') ? 'selected' : ''; ?>><?php echo __("Pending"); ?></option>
        <option value="active" <?php echo ($loan['status'] == 'active') ? 'selected' : ''; ?>><?php echo __("Active"); ?></option>
        <option value="completed" <?php echo ($loan['status'] == 'completed') ? 'selected' : ''; ?>><?php echo __("Completed"); ?></option>
        <option value="defaulted" <?php echo ($loan['status'] == 'defaulted') ? 'selected' : ''; ?>><?php echo __("Defaulted"); ?></option>
        <option value="cancelled" <?php echo ($loan['status'] == 'cancelled') ? 'selected' : ''; ?>><?php echo __("Cancelled"); ?></option>
      </select>
    </div>

    <div class="alert alert-info">
      <i class="fa fa-info-circle"></i> <?php echo __("Monthly payment and remaining amount will be recalculated automatically."); ?>
    </div>

    <!-- error handler -->
    <div class="alert alert-danger mt15 mb0 x-hidden"></div>
    <!-- error handler -->
  </div>
  <div class="modal-footer">
    <button type="submit" class="btn btn-primary"><?php echo __("Update Loan"); ?></button>
  </div>
</form>
