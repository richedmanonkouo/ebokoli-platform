<?php
/**
 * Modal for admin to edit saving
 */

// fetch bootloader
require('../../../../bootloader.php');

// check admin permission
if (!$user->_is_admin) {
  modal("ERROR", __("Error"), __("You don't have permission to access this"));
}

// get saving_id
$saving_id = (isset($_GET['id'])) ? (int)$_GET['id'] : 0;

// get saving data
$get_saving = $db->query(sprintf("SELECT * FROM wallet_savings WHERE saving_id = %s", secure($saving_id, 'int'))) or _error('SQL_ERROR');
if ($get_saving->num_rows == 0) {
  modal("ERROR", __("Error"), __("Saving not found"));
}
$saving = $get_saving->fetch_assoc();

// check if form submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  try {
    $amount = (float)$_POST['amount'];
    $interest_rate = (float)$_POST['interest_rate'];
    $maturity_date = !empty($_POST['maturity_date']) ? $_POST['maturity_date'] : null;
    $status = $_POST['status'];

    // update saving
    $result = $user->admin_edit_saving($saving_id, $amount, $interest_rate, $maturity_date, $status);

    if ($result) {
      modal("SUCCESS", __("Success"), __("Saving updated successfully"));
    } else {
      modal("ERROR", __("Error"), __("Failed to update saving"));
    }
  } catch (Exception $e) {
    modal("ERROR", __("Error"), $e->getMessage());
  }
}
?>

<div class="modal-header">
  <h6 class="modal-title"><?php echo __("Edit Saving"); ?></h6>
  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<form class="js_ajax-forms" data-url="includes/ajax/admin/wallet/admin_edit_saving.php?id=<?php echo $saving_id; ?>">
  <div class="modal-body">
    <div class="form-group">
      <label class="form-label"><?php echo __("Amount"); ?></label>
      <input type="number" class="form-control" name="amount" step="0.01" min="1" value="<?php echo $saving['amount']; ?>" required>
    </div>

    <div class="form-group">
      <label class="form-label"><?php echo __("Interest Rate"); ?> (%)</label>
      <input type="number" class="form-control" name="interest_rate" step="0.01" min="0" value="<?php echo $saving['interest_rate']; ?>" required>
    </div>

    <div class="form-group">
      <label class="form-label"><?php echo __("Maturity Date"); ?> (<?php echo __("Optional"); ?>)</label>
      <input type="date" class="form-control" name="maturity_date" value="<?php echo $saving['maturity_date'] ? date('Y-m-d', strtotime($saving['maturity_date'])) : ''; ?>">
    </div>

    <div class="form-group">
      <label class="form-label"><?php echo __("Status"); ?></label>
      <select class="form-select" name="status" required>
        <option value="active" <?php echo ($saving['status'] == 'active') ? 'selected' : ''; ?>><?php echo __("Active"); ?></option>
        <option value="completed" <?php echo ($saving['status'] == 'completed') ? 'selected' : ''; ?>><?php echo __("Completed"); ?></option>
        <option value="cancelled" <?php echo ($saving['status'] == 'cancelled') ? 'selected' : ''; ?>><?php echo __("Cancelled"); ?></option>
      </select>
    </div>

    <!-- error handler -->
    <div class="alert alert-danger mt15 mb0 x-hidden"></div>
    <!-- error handler -->
  </div>
  <div class="modal-footer">
    <button type="submit" class="btn btn-primary"><?php echo __("Update Saving"); ?></button>
  </div>
</form>
