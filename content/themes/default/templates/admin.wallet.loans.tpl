<div class="card">
  <div class="card-header with-icon with-nav">
    <!-- panel title -->
    <div class="mb20">
      <i class="fa fa-hand-holding-usd mr10"></i>{__("Wallet")} &rsaquo; {__("Loans Management")}
    </div>
    <!-- panel title -->

    <!-- panel nav -->
    <ul class="nav nav-tabs">
      <li class="nav-item">
        <a class="nav-link" href="{$system['system_url']}/{$control_panel['url']}/wallet">{__("Settings")}</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{$system['system_url']}/{$control_panel['url']}/wallet/payments">{__("Payment Requests")}</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{$system['system_url']}/{$control_panel['url']}/wallet/savings">{__("Savings")}</a>
      </li>
      <li class="nav-item">
        <a class="nav-link active" href="{$system['system_url']}/{$control_panel['url']}/wallet/loans">{__("Loans")}</a>
      </li>
    </ul>
    <!-- panel nav -->
  </div>

  <div class="card-body">

    <!-- Quick Actions -->
    <div class="mb-3">
      <button class="btn btn-primary" data-toggle="modal" data-url="includes/ajax/admin/wallet/create_loan_modal.php">
        <i class="fa fa-plus mr5"></i>{__("Créer Emprunt")}
      </button>
    </div>
    <!-- Quick Actions -->

    <div class="table-responsive">
      <table class="table table-striped table-bordered table-hover js_dataTable">
        <thead>
          <tr>
            <th>{__("ID")}</th>
            <th>{__("User")}</th>
            <th>{__("Amount")}</th>
            <th>{__("Interest Rate")}</th>
            <th>{__("Duration")}</th>
            <th>{__("Monthly Payment")}</th>
            <th>{__("Amount Paid")}</th>
            <th>{__("Amount Remaining")}</th>
            <th>{__("Loan Date")}</th>
            <th>{__("Due Date")}</th>
            <th>{__("Status")}</th>
            <th>{__("Actions")}</th>
          </tr>
        </thead>
        <tbody>
          {if $rows}
            {foreach $rows as $row}
              <tr>
                <td>{$row['loan_id']}</td>
                <td>
                  <a target="_blank" href="{$system['system_url']}/{$row['user_name']}">
                    <img class="tbl-image" src="{$row['user_picture']}">
                    {$row['user_firstname']} {$row['user_lastname']}
                  </a>
                </td>
                <td>{print_money($row['amount'])}</td>
                <td>{$row['interest_rate']}%</td>
                <td>{$row['duration_months']} {__("months")}</td>
                <td>{print_money($row['monthly_payment'])}</td>
                <td>{print_money($row['amount_paid'])}</td>
                <td>{print_money($row['amount_remaining'])}</td>
                <td>{$row['loan_date']|date_format:"%e %B %Y"}</td>
                <td>{$row['due_date']|date_format:"%e %B %Y"}</td>
                <td>
                  {if $row['status'] == "pending"}
                    <span class="badge badge-lg badge-warning">{__("Pending")}</span>
                  {elseif $row['status'] == "active"}
                    <span class="badge badge-lg badge-success">{__("Active")}</span>
                  {elseif $row['status'] == "completed"}
                    <span class="badge badge-lg badge-secondary">{__("Completed")}</span>
                  {elseif $row['status'] == "defaulted"}
                    <span class="badge badge-lg badge-danger">{__("Defaulted")}</span>
                  {else}
                    <span class="badge badge-lg badge-dark">{__("Cancelled")}</span>
                  {/if}
                </td>
                <td>
                  <button class="btn btn-sm btn-icon btn-rounded btn-info js_admin-edit-loan" data-id="{$row['loan_id']}" data-bs-toggle="tooltip" title='{__("Edit")}'>
                    <i class="fa fa-edit"></i>
                  </button>
                  {if $row['status'] == "active"}
                    <button class="btn btn-sm btn-icon btn-rounded btn-success js_admin-record-payment" data-id="{$row['loan_id']}" data-bs-toggle="tooltip" title='{__("Record Payment")}'>
                      <i class="fa fa-money-check"></i>
                    </button>
                  {/if}
                  {if $row['status'] == "pending"}
                    <button class="btn btn-sm btn-icon btn-rounded btn-warning js_admin-approve-loan" data-id="{$row['loan_id']}" data-bs-toggle="tooltip" title='{__("Approve")}'>
                      <i class="fa fa-check"></i>
                    </button>
                  {/if}
                  <a href="{$system['system_url']}/{$control_panel['url']}/wallet/user_wallet?id={$row['user_id']}" class="btn btn-sm btn-icon btn-rounded btn-primary" data-bs-toggle="tooltip" title='{__("Manage User")}'>
                    <i class="fa fa-cog"></i>
                  </a>
                </td>
              </tr>
            {/foreach}
          {/if}
        </tbody>
      </table>
    </div>
  </div>
</div>
