<!-- Modal: Request Loan -->
<div class="modal-header">
  <h6 class="modal-title">
    <i class="fa fa-hand-holding-usd mr10"></i><?php echo __("Demander un Emprunt"); ?>
  </h6>
  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<form class="js_ajax-forms" data-url="core/wallet_loans.php?do=request">
  <div class="modal-body">
    <div class="form-group">
      <label class="form-label"><?php echo __("Montant de l'emprunt"); ?></label>
      <input type="number" step="0.01" min="1" class="form-control" name="amount" required>
      <div class="form-text">
        <?php echo __("Montant que vous souhaitez emprunter"); ?>
      </div>
    </div>

    <div class="form-group">
      <label class="form-label"><?php echo __("Durée (en mois)"); ?></label>
      <select class="form-select" name="duration_months" required>
        <option value="3">3 <?php echo __("mois"); ?></option>
        <option value="6">6 <?php echo __("mois"); ?></option>
        <option value="12" selected>12 <?php echo __("mois"); ?></option>
        <option value="18">18 <?php echo __("mois"); ?></option>
        <option value="24">24 <?php echo __("mois"); ?></option>
        <option value="36">36 <?php echo __("mois"); ?></option>
      </select>
    </div>

    <div class="form-group">
      <label class="form-label"><?php echo __("Motif de l'emprunt"); ?></label>
      <textarea class="form-control" name="description" rows="3" placeholder="<?php echo __("Ex: Achat d'équipement, frais médicaux, etc."); ?>" required></textarea>
    </div>

    <div class="alert alert-info">
      <i class="fa fa-info-circle mr5"></i>
      <?php echo __("Le montant sera immédiatement crédité à votre wallet. L'emprunt est sans taux d'intérêt et doit être remboursé sur la durée choisie."); ?>
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
    <button type="submit" class="btn btn-primary"><?php echo __("Créer l'emprunt"); ?></button>
  </div>
</form>
