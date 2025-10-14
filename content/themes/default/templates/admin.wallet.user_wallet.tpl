<div class="card">
  <div class="card-header with-icon">
    <i class="fa fa-user-circle mr10"></i>{__("Wallet")} &rsaquo; {__("User Wallet Management")}
    <div class="float-end">
      <a href="{$system['system_url']}/{$control_panel['url']}/wallet/savings" class="btn btn-md btn-light">
        <i class="fa fa-arrow-circle-left mr5"></i>{__("Go Back")}
      </a>
    </div>
  </div>

  <div class="card-body">
    <!-- User Info -->
    <div class="row mb-4">
      <div class="col-md-12">
        <div class="card bg-light">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col-md-2 text-center">
                <img src="{$user_data['user_picture']}" class="rounded-circle" width="100" height="100">
              </div>
              <div class="col-md-10">
                <h4>{$user_data['user_firstname']} {$user_data['user_lastname']}</h4>
                <p class="mb-1"><strong>{__("Username")}:</strong> <a href="{$system['system_url']}/{$user_data['user_name']}" target="_blank">@{$user_data['user_name']}</a></p>
                <p class="mb-1"><strong>{__("Email")}:</strong> {$user_data['user_email']}</p>
                <p class="mb-1"><strong>{__("Wallet Balance")}:</strong> <span class="badge badge-lg badge-success">{print_money($user_data['user_wallet_balance'])}</span></p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Savings Section -->
    <div class="row mb-4">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header bg-primary text-white">
            <div class="float-start">
              <i class="fa fa-piggy-bank mr10"></i>{__("Savings")}
            </div>
            <div class="float-end">
              <button type="button" class="btn btn-sm btn-light" data-toggle="modal" data-url="admin/wallet/admin_add_saving.php?user_id={$user_data['user_id']}">
                <i class="fa fa-plus mr5"></i>{__("Versement")}
              </button>
            </div>
          </div>
          <div class="card-body">
            {if $savings}
              <div class="table-responsive">
                <table class="table table-sm table-bordered">
                  <thead>
                    <tr>
                      <th>{__("ID")}</th>
                      <th>{__("Amount")}</th>
                      <th>{__("Interest Rate")}</th>
                      <th>{__("Current Value")}</th>
                      <th>{__("Interest")}</th>
                      <th>{__("Start Date")}</th>
                      <th>{__("Status")}</th>
                      <th>{__("Actions")}</th>
                    </tr>
                  </thead>
                  <tbody>
                    {foreach $savings as $saving}
                      <tr>
                        <td>{$saving['saving_id']}</td>
                        <td>{print_money($saving['amount'])}</td>
                        <td>{$saving['interest_rate']}%</td>
                        <td><strong>{print_money($saving['current_value']|number_format:2)}</strong></td>
                        <td class="text-success">+{print_money($saving['accumulated_interest']|number_format:2)}</td>
                        <td>{$saving['start_date']|date_format:"%e/%m/%Y"}</td>
                        <td>
                          {if $saving['status'] == "active"}
                            <span class="badge badge-success">{__("Active")}</span>
                          {elseif $saving['status'] == "completed"}
                            <span class="badge badge-secondary">{__("Completed")}</span>
                          {else}
                            <span class="badge badge-danger">{__("Cancelled")}</span>
                          {/if}
                        </td>
                        <td>
                          {if $saving['status'] == "active"}
                            <button type="button" class="btn btn-sm btn-success js_admin-withdraw-saving" data-id="{$saving['saving_id']}" data-user-id="{$user_data['user_id']}">
                              <i class="fa fa-hand-holding-usd"></i> {__("Retrait")}
                            </button>
                            <button type="button" class="btn btn-sm btn-info" data-toggle="modal" data-url="admin/wallet/admin_edit_saving.php?id={$saving['saving_id']}">
                              <i class="fa fa-edit"></i> {__("Modifier")}
                            </button>
                          {/if}
                        </td>
                      </tr>
                    {/foreach}
                  </tbody>
                </table>
              </div>
            {else}
              <div class="text-center text-muted p-3">
                <i class="fa fa-piggy-bank fa-3x mb-3"></i>
                <p>{__("No savings yet")}</p>
              </div>
            {/if}
          </div>
        </div>
      </div>
    </div>

    <!-- Loans Section -->
    <div class="row mb-4">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header bg-warning text-dark">
            <div class="float-start">
              <i class="fa fa-hand-holding-usd mr10"></i>{__("Loans")}
            </div>
            <div class="float-end">
              <button type="button" class="btn btn-sm btn-dark" data-toggle="modal" data-url="admin/wallet/admin_create_loan.php?user_id={$user_data['user_id']}">
                <i class="fa fa-plus mr5"></i>{__("Prêter")}
              </button>
            </div>
          </div>
          <div class="card-body">
            {if $loans}
              <div class="table-responsive">
                <table class="table table-sm table-bordered">
                  <thead>
                    <tr>
                      <th>{__("ID")}</th>
                      <th>{__("Amount")}</th>
                      <th>{__("Interest Rate")}</th>
                      <th>{__("Monthly Payment")}</th>
                      <th>{__("Paid")}</th>
                      <th>{__("Remaining")}</th>
                      <th>{__("Due Date")}</th>
                      <th>{__("Status")}</th>
                      <th>{__("Actions")}</th>
                    </tr>
                  </thead>
                  <tbody>
                    {foreach $loans as $loan}
                      <tr>
                        <td>{$loan['loan_id']}</td>
                        <td>{print_money($loan['amount'])}</td>
                        <td>{$loan['interest_rate']}%</td>
                        <td>{print_money($loan['monthly_payment'])}</td>
                        <td class="text-success">{print_money($loan['amount_paid'])}</td>
                        <td class="text-danger"><strong>{print_money($loan['amount_remaining'])}</strong></td>
                        <td>{$loan['due_date']|date_format:"%e/%m/%Y"}</td>
                        <td>
                          {if $loan['status'] == "pending"}
                            <span class="badge badge-warning">{__("Pending")}</span>
                          {elseif $loan['status'] == "active"}
                            <span class="badge badge-success">{__("Active")}</span>
                          {elseif $loan['status'] == "completed"}
                            <span class="badge badge-secondary">{__("Completed")}</span>
                          {else}
                            <span class="badge badge-danger">{__("Defaulted")}</span>
                          {/if}
                        </td>
                        <td>
                          {if $loan['status'] == "pending"}
                            <button type="button" class="btn btn-sm btn-success js_admin-approve-loan" data-id="{$loan['loan_id']}" data-user-id="{$user_data['user_id']}">
                              <i class="fa fa-check"></i> {__("Approve")}
                            </button>
                          {/if}
                          {if $loan['status'] == "active"}
                            <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-url="admin/wallet/admin_record_payment.php?loan_id={$loan['loan_id']}&user_id={$user_data['user_id']}">
                              <i class="fa fa-money-check"></i> {__("Paiement")}
                            </button>
                          {/if}
                          {if $loan['status'] == "active" || $loan['status'] == "pending"}
                            <button type="button" class="btn btn-sm btn-info" data-toggle="modal" data-url="admin/wallet/admin_edit_loan.php?id={$loan['loan_id']}">
                              <i class="fa fa-edit"></i> {__("Modifier")}
                            </button>
                          {/if}
                        </td>
                      </tr>
                    {/foreach}
                  </tbody>
                </table>
              </div>
            {else}
              <div class="text-center text-muted p-3">
                <i class="fa fa-hand-holding-usd fa-3x mb-3"></i>
                <p>{__("No loans yet")}</p>
              </div>
            {/if}
          </div>
        </div>
      </div>
    </div>

    <!-- Transactions History -->
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header bg-secondary text-white">
            <i class="fa fa-history mr10"></i>{__("Recent Transactions")} ({__("Savings & Loans")})
          </div>
          <div class="card-body">
            {if $transactions}
              <div class="table-responsive">
                <table class="table table-sm table-striped">
                  <thead>
                    <tr>
                      <th>{__("Date")}</th>
                      <th>{__("Type")}</th>
                      <th>{__("Amount")}</th>
                      <th>{__("Description")}</th>
                    </tr>
                  </thead>
                  <tbody>
                    {foreach $transactions as $transaction}
                      <tr>
                        <td>{$transaction['date']|date_format:"%e/%m/%Y %H:%M"}</td>
                        <td>
                          {if $transaction['type'] == "savings"}
                            <span class="badge badge-primary">{__("Savings")}</span>
                          {else}
                            <span class="badge badge-warning">{__("Loans")}</span>
                          {/if}
                        </td>
                        <td>{print_money($transaction['amount'])}</td>
                        <td>{$transaction['description']}</td>
                      </tr>
                    {/foreach}
                  </tbody>
                </table>
              </div>
            {else}
              <div class="text-center text-muted p-3">
                <i class="fa fa-history fa-3x mb-3"></i>
                <p>{__("No transactions yet")}</p>
              </div>
            {/if}
          </div>
        </div>
      </div>
    </div>

  </div>
</div>

<script>
  // Admin withdraw saving
  $(document).on('click', '.js_admin-withdraw-saving', function() {
    var saving_id = $(this).data('id');
    var user_id = $(this).data('user-id');

    confirm('{__("Are you sure you want to withdraw this saving? The full amount with interest will be transferred to the user wallet.")}').then(function() {
      $.post('includes/ajax/admin/wallet_admin_savings.php', {
        action: 'withdraw',
        saving_id: saving_id,
        user_id: user_id
      }, function(response) {
        if (response.success) {
          window.location.reload();
        } else {
          alert(response.message || '{__("An error occurred")}');
        }
      }, 'json');
    });
  });

  // Admin approve loan
  $(document).on('click', '.js_admin-approve-loan', function() {
    var loan_id = $(this).data('id');
    var user_id = $(this).data('user-id');

    confirm('{__("Are you sure you want to approve this loan? The amount will be transferred to the user wallet.")}').then(function() {
      $.post('includes/ajax/admin/wallet_admin_loans.php', {
        action: 'approve',
        loan_id: loan_id,
        user_id: user_id
      }, function(response) {
        if (response.success) {
          window.location.reload();
        } else {
          alert(response.message || '{__("An error occurred")}');
        }
      }, 'json');
    });
  });
</script>
