<!-- Modal: Pay Loan -->
<div class="modal-header">
  <h6 class="modal-title">
    <i class="fa fa-money-bill-wave mr10"></i><?php echo __("Payer un Remboursement"); ?>
  </h6>
  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<form class="js_ajax-forms" data-url="core/wallet_loans.php?do=pay">
  <div class="modal-body">
    <input type="hidden" name="loan_id" value="<?php echo $_GET['loan_id']; ?>">

    <div class="form-group">
      <label class="form-label"><?php echo __("Montant du paiement"); ?></label>
      <input type="number" step="0.01" min="1" class="form-control" name="amount" required>
      <div class="form-text">
        <?php echo __("Solde disponible"); ?>: <strong><?php echo print_money($user->_data['user_wallet_balance']); ?></strong>
      </div>
    </div>

    <div class="alert alert-warning">
      <i class="fa fa-exclamation-triangle mr5"></i>
      <?php echo __("Le montant sera déduit de votre solde wallet"); ?>
    </div>

    <!-- success -->
    <div class="alert alert-success mt15 mb0 x-hidden"></div>
    <!-- success -->

    <!-- error -->
    <div class="alert alert-danger mt15 mb0 x-hidden"></div>
    <!-- error -->
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-light" data-bs-dismiss="modal"><?php echo __("Annuler"); ?></button>
    <button type="submit" class="btn btn-success"><?php echo __("Effectuer le paiement"); ?></button>
  </div>
</form>
