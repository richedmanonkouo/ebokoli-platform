<?php
/**
 * Modal for admin to create loan for user
 */

// fetch bootloader
require('../../../../bootloader.php');

// check admin permission
if (!$user->_is_admin) {
  modal("ERROR", __("Error"), __("You don't have permission to access this"));
}

// get user_id
$user_id = (isset($_GET['user_id'])) ? (int)$_GET['user_id'] : 0;

// check if form submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  try {
    $amount = (float)$_POST['amount'];
    $interest_rate = (float)$_POST['interest_rate'];
    $duration_months = (int)$_POST['duration_months'];
    $description = $_POST['description'];

    // create loan
    $result = $user->admin_create_loan($user_id, $amount, $interest_rate, $duration_months, $description);

    if ($result) {
      modal("SUCCESS", __("Success"), __("Loan created and approved successfully"));
    } else {
      modal("ERROR", __("Error"), __("Failed to create loan"));
    }
  } catch (Exception $e) {
    modal("ERROR", __("Error"), $e->getMessage());
  }
}
?>

<div class="modal-header">
  <h6 class="modal-title">{__("Create Loan (Prêter)")}</h6>
  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<form class="js_ajax-forms" data-url="includes/ajax/admin/wallet/admin_create_loan.php?user_id=<?php echo $user_id; ?>">
  <div class="modal-body">
    <div class="form-group">
      <label class="form-label">{__("Loan Amount")}</label>
      <input type="number" class="form-control" name="amount" step="0.01" min="1" required>
    </div>

    <div class="form-group">
      <label class="form-label">{__("Interest Rate")} (%)</label>
      <input type="number" class="form-control" name="interest_rate" step="0.01" min="0" value="10.00" required>
    </div>

    <div class="form-group">
      <label class="form-label">{__("Duration")} ({__("months")})</label>
      <input type="number" class="form-control" name="duration_months" min="1" max="120" value="12" required>
      <small class="form-text text-muted">{__("Loan duration in months (1-120)")}</small>
    </div>

    <div class="form-group">
      <label class="form-label">{__("Description")}</label>
      <textarea class="form-control" name="description" rows="3" placeholder="{__("Optional description")}"></textarea>
    </div>

    <div class="alert alert-info">
      <i class="fa fa-info-circle"></i> {__("The loan will be automatically approved and the amount will be added to the user's wallet.")}
    </div>

    <!-- error handler -->
    <div class="alert alert-danger mt15 mb0 x-hidden"></div>
    <!-- error handler -->
  </div>
  <div class="modal-footer">
    <button type="submit" class="btn btn-primary">{__("Create Loan")}</button>
  </div>
</form>
