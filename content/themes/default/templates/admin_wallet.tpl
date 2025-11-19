{include file='_head.tpl'}
{include file='_header.tpl'}

<!-- page header -->
<div class="page-header bg-gradient-primary">
  <div class="circle-2"></div>
  <div class="circle-3"></div>
  <div class="inner">
    <h2>{__("Gestion Wallet Clients")}</h2>
    <p class="text-xlg">{__("Administration des épargnes et emprunts")}</p>
  </div>
</div>
<!-- page header -->

<!-- page content -->
<div class="{if $system['fluid_design']}container-fluid{else}container{/if} mt-20 sg-offcanvas">
  <div class="row">

    <!-- side panel -->
    <div class="col-12 d-block d-md-none sg-offcanvas-sidebar">
      {include file='_sidebar.tpl'}
    </div>
    <!-- side panel -->

    <!-- content panel -->
    <div class="col-12 sg-offcanvas-mainbar">

      {if $view == "users"}

        <!-- Liste des utilisateurs -->
        <div class="card">
          <div class="card-header with-icon">
            <i class="fa fa-users mr10"></i>
            {__("Liste des Clients")}
            <div class="float-end">
              <span class="badge bg-primary">{$users|@count} {__("clients")}</span>
            </div>
          </div>
          <div class="card-body">

            {if $users}
              <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover js_dataTable">
                  <thead>
                    <tr>
                      <th>{__("Client")}</th>
                      <th>{__("Email")}</th>
                      <th>{__("Wallet")}</th>
                      <th>{__("Épargnes")}</th>
                      <th>{__("Emprunts")}</th>
                      <th>{__("Actions")}</th>
                    </tr>
                  </thead>
                  <tbody>
                    {foreach $users as $user_item}
                      <tr>
                        <td>
                          <div class="d-flex align-items-center">
                            <img src="{$user_item['user_picture']}" class="rounded-circle" width="40" height="40" style="margin-right: 10px;">
                            <div>
                              <strong>{$user_item['user_firstname']} {$user_item['user_lastname']}</strong><br>
                              <small class="text-muted">@{$user_item['user_name']}</small>
                            </div>
                          </div>
                        </td>
                        <td>{$user_item['user_email']}</td>
                        <td><span class="badge bg-info badge-lg">{print_money($user_item['user_wallet_balance']|number_format:2)}</span></td>
                        <td><span class="badge bg-success badge-lg">{print_money($user_item['user_total_savings']|number_format:2)}</span></td>
                        <td><span class="badge bg-warning badge-lg">{print_money($user_item['user_total_loans']|number_format:2)}</span></td>
                        <td>
                          <a href="{$system['system_url']}/admin_wallet.php?view=manage&user_id={$user_item['user_id']}" class="btn btn-sm btn-primary">
                            <i class="fa fa-cog"></i> {__("Gérer")}
                          </a>
                        </td>
                      </tr>
                    {/foreach}
                  </tbody>
                </table>
              </div>
            {else}
              <div class="text-center p-5">
                <i class="fa fa-users fa-5x text-muted mb-3"></i>
                <h4>{__("Aucun client")}</h4>
              </div>
            {/if}

          </div>
        </div>

      {elseif $view == "manage"}

        <!-- Gestion d'un client -->
        <div class="mb-3">
          <a href="{$system['system_url']}/admin_wallet.php" class="btn btn-light">
            <i class="fa fa-arrow-left"></i> {__("Retour à la liste")}
          </a>
        </div>

        <!-- Client Info -->
        <div class="card mb-3">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col-auto">
                <img src="{$client['user_picture']}" class="rounded-circle" width="80" height="80">
              </div>
              <div class="col">
                <h3 class="mb-1">{$client['user_firstname']} {$client['user_lastname']}</h3>
                <p class="text-muted mb-1">@{$client['user_name']} • {$client['user_email']}</p>
                <p class="mb-0">
                  <span class="badge bg-info me-2">Wallet: {print_money($client['user_wallet_balance']|number_format:2)}</span>
                  <span class="badge bg-success me-2">Épargnes: {print_money($client['user_total_savings']|number_format:2)}</span>
                  <span class="badge bg-warning">Emprunts: {print_money($client['user_total_loans']|number_format:2)}</span>
                </p>
              </div>
            </div>
          </div>
        </div>

        <!-- Carte ÉPARGNE -->
        <div class="card mb-3">
          <div class="card-header bg-success text-white">
            <div class="row align-items-center">
              <div class="col">
                <h5 class="mb-0">
                  <i class="fa fa-piggy-bank mr10"></i>
                  {__("CARTE ÉPARGNE")}
                </h5>
              </div>
              <div class="col-auto">
                <span class="badge bg-white text-success">
                  {if $client['user_total_savings'] > 0}✅ Active{else}❌ Inactive{/if}
                </span>
              </div>
            </div>
          </div>
          <div class="card-body">

            <!-- Statistiques Épargne -->
            <div class="row mb-3">
              <div class="col-md-12">
                <div class="stat-panel bg-gradient-success">
                  <div class="stat-cell">
                    <i class="fa fa-piggy-bank bg-icon"></i>
                    <div class="h3 mtb10">{print_money($client['user_total_savings']|number_format:2)}</div>
                    <span class="text-white">{__("Total Épargné")}</span>
                  </div>
                </div>
              </div>
            </div>

            <!-- Boutons Actions Épargne -->
            <div class="row mb-3">
              <div class="col-md-4">
                <button class="btn btn-success btn-block" data-bs-toggle="modal" data-bs-target="#admin-savings-deposit-modal" onclick="setSavingsUserId({$client['user_id']})">
                  <i class="fa fa-plus-circle"></i> {__("Versement")}
                </button>
              </div>
              <div class="col-md-4">
                <button class="btn btn-danger btn-block" data-bs-toggle="modal" data-bs-target="#admin-savings-withdraw-modal" onclick="setSavingsUserId({$client['user_id']})">
                  <i class="fa fa-minus-circle"></i> {__("Retrait")}
                </button>
              </div>
              <div class="col-md-4">
                <button class="btn btn-warning btn-block" data-bs-toggle="modal" data-bs-target="#admin-savings-edit-modal" onclick="setSavingsUserId({$client['user_id']})">
                  <i class="fa fa-edit"></i> {__("Modifier")}
                </button>
              </div>
            </div>

            <!-- Liste des épargnes -->
            {if $savings}
              <h6 class="mt-4 mb-3">{__("Épargnes Actives")}</h6>
              <div class="table-responsive">
                <table class="table table-sm table-bordered">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>{__("Montant")}</th>
                      <th>{__("Date")}</th>
                      <th>{__("Date Maturité")}</th>
                      <th>{__("Statut")}</th>
                    </tr>
                  </thead>
                  <tbody>
                    {foreach $savings as $saving}
                      <tr>
                        <td>{$saving['saving_id']}</td>
                        <td><strong>{print_money($saving['amount']|number_format:2)}</strong></td>
                        <td>{$saving['start_date']|date_format:"%d/%m/%Y"}</td>
                        <td>{if $saving['maturity_date']}{$saving['maturity_date']|date_format:"%d/%m/%Y"}{else}<span class="text-muted">-</span>{/if}</td>
                        <td>
                          {if $saving['status'] == 'active'}
                            <span class="badge bg-success">{__("Active")}</span>
                          {elseif $saving['status'] == 'completed'}
                            <span class="badge bg-secondary">{__("Complétée")}</span>
                          {else}
                            <span class="badge bg-danger">{__("Annulée")}</span>
                          {/if}
                        </td>
                      </tr>
                    {/foreach}
                  </tbody>
                </table>
              </div>
            {else}
              <div class="alert alert-info mt-3">
                <i class="fa fa-info-circle"></i> {__("Aucune épargne pour ce client")}
              </div>
            {/if}

          </div>
        </div>

        <!-- Carte EMPRUNTS -->
        <div class="card mb-3">
          <div class="card-header bg-warning text-dark">
            <div class="row align-items-center">
              <div class="col">
                <h5 class="mb-0">
                  <i class="fa fa-hand-holding-usd mr10"></i>
                  {__("CARTE EMPRUNTS")}
                </h5>
              </div>
              <div class="col-auto">
                <span class="badge bg-white text-warning">
                  {if $client['user_total_loans'] > 0}✅ En cours{else}❌ Aucun{/if}
                </span>
              </div>
            </div>
          </div>
          <div class="card-body">

            <!-- Statistiques Emprunts -->
            <div class="row mb-3">
              <div class="col-md-12">
                <div class="stat-panel bg-gradient-warning">
                  <div class="stat-cell">
                    <i class="fa fa-hand-holding-usd bg-icon"></i>
                    <div class="h3 mtb10">{print_money($client['user_total_loans']|number_format:2)}</div>
                    <span class="text-dark">{__("Total Emprunts en Cours")}</span>
                  </div>
                </div>
              </div>
            </div>

            <!-- Boutons Actions Emprunts -->
            <div class="row mb-3">
              <div class="col-md-6">
                <button class="btn btn-warning btn-block" data-bs-toggle="modal" data-bs-target="#admin-loan-create-modal" onclick="setLoanUserId({$client['user_id']})">
                  <i class="fa fa-hand-holding-usd"></i> {__("Prêter")}
                </button>
              </div>
              <div class="col-md-6">
                <button class="btn btn-info btn-block" data-bs-toggle="modal" data-bs-target="#admin-loan-edit-modal" onclick="setLoanUserId({$client['user_id']})">
                  <i class="fa fa-edit"></i> {__("Modifier")}
                </button>
              </div>
            </div>

            <!-- Liste des emprunts -->
            {if $loans}
              <h6 class="mt-4 mb-3">{__("Emprunts Actifs")}</h6>
              <div class="table-responsive">
                <table class="table table-sm table-bordered">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>{__("Montant")}</th>
                      <th>{__("Durée")}</th>
                      <th>{__("Mensualité")}</th>
                      <th>{__("Payé")}</th>
                      <th>{__("Restant")}</th>
                      <th>{__("Date")}</th>
                      <th>{__("Statut")}</th>
                    </tr>
                  </thead>
                  <tbody>
                    {foreach $loans as $loan}
                      <tr>
                        <td>{$loan['loan_id']}</td>
                        <td><strong>{print_money($loan['amount']|number_format:2)}</strong></td>
                        <td>{$loan['duration_months']} mois</td>
                        <td>{print_money($loan['monthly_payment']|number_format:2)}</td>
                        <td><span class="text-success">{print_money($loan['amount_paid']|number_format:2)}</span></td>
                        <td><span class="text-danger">{print_money($loan['amount_remaining']|number_format:2)}</span></td>
                        <td>{$loan['loan_date']|date_format:"%d/%m/%Y"}</td>
                        <td>
                          {if $loan['status'] == 'pending'}
                            <span class="badge bg-warning">{__("En attente")}</span>
                          {elseif $loan['status'] == 'active'}
                            <span class="badge bg-primary">{__("Actif")}</span>
                          {elseif $loan['status'] == 'completed'}
                            <span class="badge bg-success">{__("Remboursé")}</span>
                          {elseif $loan['status'] == 'defaulted'}
                            <span class="badge bg-danger">{__("Défaut")}</span>
                          {else}
                            <span class="badge bg-secondary">{__("Annulé")}</span>
                          {/if}
                        </td>
                      </tr>
                    {/foreach}
                  </tbody>
                </table>
              </div>
            {else}
              <div class="alert alert-info mt-3">
                <i class="fa fa-info-circle"></i> {__("Aucun emprunt pour ce client")}
              </div>
            {/if}

          </div>
        </div>

        <!-- HISTORIQUE DES TRANSACTIONS -->
        <div class="card">
          <div class="card-header with-icon">
            <i class="fa fa-history mr10"></i>
            {__("Historique des Transactions")}
          </div>
          <div class="card-body">

            {if $transactions}
              <div class="table-responsive">
                <table class="table table-sm table-striped">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>{__("Type")}</th>
                      <th>{__("Montant")}</th>
                      <th>{__("Direction")}</th>
                      <th>{__("Date")}</th>
                    </tr>
                  </thead>
                  <tbody>
                    {foreach $transactions as $transaction}
                      <tr>
                        <td>{$transaction['transaction_id']}</td>
                        <td>
                          {if $transaction['node_type'] == 'saving'}
                            <span class="badge bg-success">Épargne</span>
                          {elseif $transaction['node_type'] == 'saving_withdraw'}
                            <span class="badge bg-info">Retrait Épargne</span>
                          {elseif $transaction['node_type'] == 'loan'}
                            <span class="badge bg-warning">Emprunt</span>
                          {elseif $transaction['node_type'] == 'loan_payment'}
                            <span class="badge bg-primary">Remboursement</span>
                          {else}
                            <span class="badge bg-secondary">{$transaction['node_type']}</span>
                          {/if}
                        </td>
                        <td>{print_money($transaction['amount']|number_format:2)}</td>
                        <td>
                          {if $transaction['type'] == 'out'}
                            <span class="text-danger"><i class="fa fa-arrow-down"></i> Sortie</span>
                          {else}
                            <span class="text-success"><i class="fa fa-arrow-up"></i> Entrée</span>
                          {/if}
                        </td>
                        <td>{$transaction['date']|date_format:"%d/%m/%Y %H:%M"}</td>
                      </tr>
                    {/foreach}
                  </tbody>
                </table>
              </div>
            {else}
              <div class="alert alert-info">
                <i class="fa fa-info-circle"></i> {__("Aucune transaction")}
              </div>
            {/if}

          </div>
        </div>

      {/if}

    </div>
    <!-- content panel -->

  </div>
</div>
<!-- page content -->

<!-- MODALS ADMIN -->

<!-- Modal Versement Épargne (Admin) -->
<div class="modal fade" id="admin-savings-deposit-modal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-success text-white">
        <h5 class="modal-title">
          <i class="fa fa-plus-circle"></i> {__("Versement Épargne (Admin)")}
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <form class="js_ajax-forms" data-url="admin/admin_savings.php?do=deposit">
        <input type="hidden" name="user_id" id="savings-user-id" value="">
        <div class="modal-body">
          <div class="form-group">
            <label>{__("Montant à verser")} ({$system['system_currency']})</label>
            <input type="number" step="0.01" class="form-control" name="amount" required min="0.01">
            <small class="text-muted">{__("Ce montant sera débité du wallet et ajouté à l'épargne")}</small>
          </div>
          <div class="form-group">
            <label>{__("Taux d'intérêt")} (%)</label>
            <input type="number" step="0.01" class="form-control" name="interest_rate" value="0" min="0" max="100">
            <small class="text-muted">{__("Taux d'intérêt annuel (ex: 5 pour 5%)")}</small>
          </div>
          <div class="form-group">
            <label>{__("Date de maturité")} ({__("Optionnel")})</label>
            <input type="date" class="form-control" name="maturity_date">
          </div>
          <div class="form-group">
            <label>{__("Description")}</label>
            <textarea class="form-control" name="description" rows="2"></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{__("Annuler")}</button>
          <button type="submit" class="btn btn-success">{__("Confirmer le Versement")}</button>
        </div>
        <div class="alert alert-success mt15 mb0 x-hidden"></div>
        <div class="alert alert-danger mt15 mb0 x-hidden"></div>
      </form>
    </div>
  </div>
</div>

<!-- Modal Retrait Épargne (Admin) -->
<div class="modal fade" id="admin-savings-withdraw-modal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-danger text-white">
        <h5 class="modal-title">
          <i class="fa fa-minus-circle"></i> {__("Retrait Épargne (Admin)")}
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <form class="js_ajax-forms" data-url="admin/admin_savings.php?do=withdraw">
        <input type="hidden" name="user_id" id="savings-withdraw-user-id" value="">
        <div class="modal-body">
          <div class="alert alert-warning">
            <i class="fa fa-exclamation-triangle"></i>
            {__("Cette action retirera TOUTE l'épargne et désactivera la carte Épargne")}
          </div>
          <p>{__("Êtes-vous sûr de vouloir continuer ?")}</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{__("Annuler")}</button>
          <button type="submit" class="btn btn-danger">{__("Confirmer le Retrait")}</button>
        </div>
        <div class="alert alert-success mt15 mb0 x-hidden"></div>
        <div class="alert alert-danger mt15 mb0 x-hidden"></div>
      </form>
    </div>
  </div>
</div>

<!-- Modal Modifier Épargne (Admin) -->
<div class="modal fade" id="admin-savings-edit-modal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-warning text-dark">
        <h5 class="modal-title">
          <i class="fa fa-edit"></i> {__("Modifier Épargne (Admin)")}
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <form class="js_ajax-forms" data-url="admin/admin_savings.php?do=edit">
        <div class="modal-body">
          <div class="form-group">
            <label>{__("Sélectionner l'épargne à modifier")}</label>
            <select class="form-control" name="saving_id" id="savings-edit-id" required onchange="loadSavingData(this.value)">
              <option value="">{__("-- Choisir une épargne --")}</option>
              {if $savings}
                {foreach $savings as $saving}
                  {if $saving['status'] == 'active'}
                    <option value="{$saving['saving_id']}"
                            data-amount="{$saving['amount']}"
                            data-rate="{$saving['interest_rate']}"
                            data-maturity="{$saving['maturity_date']}"
                            data-description="{$saving['description']}">
                      #{$saving['saving_id']} - {print_money($saving['amount']|number_format:2)} ({$saving['interest_rate']}%)
                    </option>
                  {/if}
                {/foreach}
              {/if}
            </select>
          </div>
          <div class="form-group">
            <label>{__("Nouveau montant")} ({$system['system_currency']})</label>
            <input type="number" step="0.01" class="form-control" name="amount" id="savings-edit-amount" required min="0.01">
            <small class="text-muted">{__("La différence sera ajustée dans le wallet")}</small>
          </div>
          <div class="form-group">
            <label>{__("Taux d'intérêt")} (%)</label>
            <input type="number" step="0.01" class="form-control" name="interest_rate" id="savings-edit-rate" value="0" min="0" max="100">
            <small class="text-muted">{__("Taux d'intérêt annuel (ex: 5 pour 5%)")}</small>
          </div>
          <div class="form-group">
            <label>{__("Date de maturité")} ({__("Optionnel")})</label>
            <input type="date" class="form-control" name="maturity_date" id="savings-edit-maturity">
          </div>
          <div class="form-group">
            <label>{__("Description")}</label>
            <textarea class="form-control" name="description" id="savings-edit-description" rows="2"></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{__("Annuler")}</button>
          <button type="submit" class="btn btn-warning">{__("Enregistrer les Modifications")}</button>
        </div>
        <div class="alert alert-success mt15 mb0 x-hidden"></div>
        <div class="alert alert-danger mt15 mb0 x-hidden"></div>
      </form>
    </div>
  </div>
</div>

<!-- Modal Créer/Prêter (Admin) -->
<div class="modal fade" id="admin-loan-create-modal" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-warning text-dark">
        <h5 class="modal-title">
          <i class="fa fa-hand-holding-usd"></i> {__("Prêter au Client (Admin)")}
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <form class="js_ajax-forms" data-url="admin/admin_loans.php?do=create">
        <input type="hidden" name="user_id" id="loan-user-id" value="">
        <div class="modal-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>{__("Montant du prêt")} ({$system['system_currency']})</label>
                <input type="number" step="0.01" class="form-control" name="amount" required min="0.01">
                <small class="text-muted">{__("Sera crédité dans le wallet du client")}</small>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>{__("Durée")} ({__("mois")})</label>
                <input type="number" class="form-control" name="duration_months" required min="1">
              </div>
            </div>
          </div>
          <div class="form-group">
            <label>{__("Taux d'intérêt")} (%)</label>
            <input type="number" step="0.01" class="form-control" name="interest_rate" value="0" min="0" max="100">
            <small class="text-muted">{__("Taux d'intérêt annuel (ex: 10 pour 10%)")}</small>
          </div>
          <div class="form-group">
            <label>{__("Description")}</label>
            <textarea class="form-control" name="description" rows="2" placeholder="{__("Motif du prêt...")}"></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{__("Annuler")}</button>
          <button type="submit" class="btn btn-warning">{__("Accorder le Prêt")}</button>
        </div>
        <div class="alert alert-success mt15 mb0 x-hidden"></div>
        <div class="alert alert-danger mt15 mb0 x-hidden"></div>
      </form>
    </div>
  </div>
</div>

<!-- Modal Modifier Emprunt (Admin) -->
<div class="modal fade" id="admin-loan-edit-modal" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-info text-white">
        <h5 class="modal-title">
          <i class="fa fa-edit"></i> {__("Modifier Emprunt (Admin)")}
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <form class="js_ajax-forms" data-url="admin/admin_loans.php?do=edit">
        <div class="modal-body">
          <div class="form-group">
            <label>{__("Sélectionner l'emprunt à modifier")}</label>
            <select class="form-control" name="loan_id" id="loan-edit-id" required onchange="loadLoanData(this.value)">
              <option value="">{__("-- Choisir un emprunt --")}</option>
              {if $loans}
                {foreach $loans as $loan}
                  {if $loan['status'] == 'active'}
                    <option value="{$loan['loan_id']}"
                            data-amount="{$loan['amount']}"
                            data-duration="{$loan['duration_months']}"
                            data-rate="{$loan['interest_rate']}"
                            data-description="{$loan['description']}">
                      #{$loan['loan_id']} - {print_money($loan['amount']|number_format:2)} ({$loan['duration_months']} mois, {$loan['interest_rate']}%)
                    </option>
                  {/if}
                {/foreach}
              {/if}
            </select>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>{__("Nouveau montant")} ({$system['system_currency']})</label>
                <input type="number" step="0.01" class="form-control" name="amount" id="loan-edit-amount" required min="0.01">
                <small class="text-muted">{__("La différence sera ajustée dans le wallet")}</small>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>{__("Nouvelle durée")} ({__("mois")})</label>
                <input type="number" class="form-control" name="duration_months" id="loan-edit-duration" required min="1">
              </div>
            </div>
          </div>
          <div class="form-group">
            <label>{__("Taux d'intérêt")} (%)</label>
            <input type="number" step="0.01" class="form-control" name="interest_rate" id="loan-edit-rate" value="0" min="0" max="100">
            <small class="text-muted">{__("Taux d'intérêt annuel (ex: 10 pour 10%)")}</small>
          </div>
          <div class="form-group">
            <label>{__("Description")}</label>
            <textarea class="form-control" name="description" id="loan-edit-description" rows="2"></textarea>
          </div>
          <div class="alert alert-info">
            <i class="fa fa-info-circle"></i> {__("Les paiements mensuels et la date d'échéance seront recalculés automatiquement")}
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{__("Annuler")}</button>
          <button type="submit" class="btn btn-info">{__("Enregistrer les Modifications")}</button>
        </div>
        <div class="alert alert-success mt15 mb0 x-hidden"></div>
        <div class="alert alert-danger mt15 mb0 x-hidden"></div>
      </form>
    </div>
  </div>
</div>

<script>
function setSavingsUserId(userId) {
  document.getElementById('savings-user-id').value = userId;
  document.getElementById('savings-withdraw-user-id').value = userId;
}

function setLoanUserId(userId) {
  document.getElementById('loan-user-id').value = userId;
}

function loadSavingData(savingId) {
  if (!savingId) return;

  var select = document.getElementById('savings-edit-id');
  var option = select.options[select.selectedIndex];

  document.getElementById('savings-edit-amount').value = option.getAttribute('data-amount');
  document.getElementById('savings-edit-rate').value = option.getAttribute('data-rate');
  document.getElementById('savings-edit-maturity').value = option.getAttribute('data-maturity') || '';
  document.getElementById('savings-edit-description').value = option.getAttribute('data-description') || '';
}

function loadLoanData(loanId) {
  if (!loanId) return;

  var select = document.getElementById('loan-edit-id');
  var option = select.options[select.selectedIndex];

  document.getElementById('loan-edit-amount').value = option.getAttribute('data-amount');
  document.getElementById('loan-edit-duration').value = option.getAttribute('data-duration');
  document.getElementById('loan-edit-rate').value = option.getAttribute('data-rate');
  document.getElementById('loan-edit-description').value = option.getAttribute('data-description') || '';
}
</script>

{include file='_footer.tpl'}
