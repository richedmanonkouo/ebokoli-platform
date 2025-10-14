<div class="card">
  <div class="card-header with-icon with-nav">
    <!-- panel title -->
    <div class="mb20">
      <i class="fa fa-piggy-bank mr10"></i>{__("Wallet")} &rsaquo; {__("Savings Management")}
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
        <a class="nav-link active" href="{$system['system_url']}/{$control_panel['url']}/wallet/savings">{__("Savings")}</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{$system['system_url']}/{$control_panel['url']}/wallet/loans">{__("Loans")}</a>
      </li>
    </ul>
    <!-- panel nav -->
  </div>

  <div class="card-body">

    <!-- Quick Actions -->
    <div class="mb-3">
      <button class="btn btn-primary" data-toggle="modal" data-url="includes/ajax/admin/wallet/create_saving_modal.php">
        <i class="fa fa-plus mr5"></i>{__("Créer Épargne")}
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
            <th>{__("Current Value")}</th>
            <th>{__("Accumulated Interest")}</th>
            <th>{__("Start Date")}</th>
            <th>{__("Maturity Date")}</th>
            <th>{__("Status")}</th>
            <th>{__("Actions")}</th>
          </tr>
        </thead>
        <tbody>
          {if $rows}
            {foreach $rows as $row}
              <tr>
                <td>{$row['saving_id']}</td>
                <td>
                  <a target="_blank" href="{$system['system_url']}/{$row['user_name']}">
                    <img class="tbl-image" src="{$row['user_picture']}">
                    {$row['user_firstname']} {$row['user_lastname']}
                  </a>
                </td>
                <td>{print_money($row['amount'])}</td>
                <td>{$row['interest_rate']}%</td>
                <td>{print_money($row['current_value']|number_format:2)}</td>
                <td>{print_money($row['accumulated_interest']|number_format:2)}</td>
                <td>{$row['start_date']|date_format:"%e %B %Y"}</td>
                <td>{if $row['maturity_date']}{$row['maturity_date']|date_format:"%e %B %Y"}{else}-{/if}</td>
                <td>
                  {if $row['status'] == "active"}
                    <span class="badge badge-lg badge-success">{__("Active")}</span>
                  {elseif $row['status'] == "completed"}
                    <span class="badge badge-lg badge-secondary">{__("Completed")}</span>
                  {else}
                    <span class="badge badge-lg badge-danger">{__("Cancelled")}</span>
                  {/if}
                </td>
                <td>
                  <button class="btn btn-sm btn-icon btn-rounded btn-info js_admin-edit-saving" data-id="{$row['saving_id']}" data-bs-toggle="tooltip" title='{__("Edit")}'>
                    <i class="fa fa-edit"></i>
                  </button>
                  {if $row['status'] == "active"}
                    <button class="btn btn-sm btn-icon btn-rounded btn-success js_admin-withdraw-saving" data-id="{$row['saving_id']}" data-bs-toggle="tooltip" title='{__("Withdraw")}'>
                      <i class="fa fa-money-bill-wave"></i>
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
