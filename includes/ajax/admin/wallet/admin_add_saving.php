<?php
/**
 * Modal for admin to add saving to user
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
    $maturity_date = !empty($_POST['maturity_date']) ? $_POST['maturity_date'] : null;
    $description = $_POST['description'];

    // create saving
    $result = $user->admin_add_saving($user_id, $amount, $interest_rate, $maturity_date, $description);

    if ($result) {
      modal("SUCCESS", __("Success"), __("Saving added successfully"));
    } else {
      modal("ERROR", __("Error"), __("Failed to add saving"));
    }
  } catch (Exception $e) {
    modal("ERROR", __("Error"), $e->getMessage());
  }
}
?>

<div class="modal-header">
  <h6 class="modal-title">{__("Add Saving (Versement)")}</h6>
  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<form class="js_ajax-forms" data-url="includes/ajax/admin/wallet/admin_add_saving.php?user_id=<?php echo $user_id; ?>">
  <div class="modal-body">
    <div class="form-group">
      <label class="form-label">{__("Amount")}</label>
      <input type="number" class="form-control" name="amount" step="0.01" min="1" required>
    </div>

    <div class="form-group">
      <label class="form-label">{__("Interest Rate")} (%)</label>
      <input type="number" class="form-control" name="interest_rate" step="0.01" min="0" value="5.00" required>
    </div>

    <div class="form-group">
      <label class="form-label">{__("Maturity Date")} ({__("Optional")})</label>
      <input type="date" class="form-control" name="maturity_date">
    </div>

    <div class="form-group">
      <label class="form-label">{__("Description")}</label>
      <textarea class="form-control" name="description" rows="3" placeholder="{__("Optional description")}"></textarea>
    </div>

    <!-- error handler -->
    <div class="alert alert-danger mt15 mb0 x-hidden"></div>
    <!-- error handler -->
  </div>
  <div class="modal-footer">
    <button type="submit" class="btn btn-primary">{__("Add Saving")}</button>
  </div>
</form>
