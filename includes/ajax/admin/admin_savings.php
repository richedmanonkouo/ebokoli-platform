<?php

/**
 * admin_savings
 * Gestion administrative des épargnes clients
 *
 * @package Sngine
 * @author EBOKOLI Extension
 * @version 2.0 - Production Ready avec transactions atomiques
 */

// fetch bootloader
require('../../../bootloader.php');

// check AJAX request
is_ajax();

// check admin
if (!$user->_is_admin) {
  modal("ERROR", __("Error"), __("You don't have permission to access this"));
}

// check wallet enabled
if (!$system['wallet_enabled']) {
  modal("ERROR", __("Error"), __("This feature has been disabled by the admin"));
}

/**
 * Helper function: Valider un montant strictement
 */
function validate_amount($amount, $field_name = "Amount") {
  if (!isset($amount) || !is_numeric($amount)) {
    throw new Exception(__("Invalid {$field_name}"));
  }

  $amount = (float)$amount;

  if ($amount <= 0) {
    throw new Exception(__("{$field_name} must be greater than zero"));
  }

  if ($amount > 999999999.99) {
    throw new Exception(__("{$field_name} is too large (max: 999,999,999.99)"));
  }

  // Vérifier qu'on a max 2 décimales
  if (round($amount, 2) != $amount) {
    throw new Exception(__("{$field_name} can only have up to 2 decimal places"));
  }

  return $amount;
}

/**
 * Helper function: Calculer les intérêts accumulés
 * Formule: Intérêts = Montant × (Taux / 100) × (Jours écoulés / 365)
 */
function calculate_interest($amount, $interest_rate, $start_date) {
  global $date;

  $start = new DateTime($start_date);
  $now = new DateTime($date);
  $days_elapsed = $start->diff($now)->days;

  $interest = $amount * ($interest_rate / 100) * ($days_elapsed / 365);

  return round($interest, 2);
}

/**
 * Helper function: Logger une action d'audit
 */
function log_audit($action, $user_id, $details) {
  global $db, $date, $user;

  $admin_id = $user->_data['user_id'];
  $admin_name = $user->_data['user_firstname'] . ' ' . $user->_data['user_lastname'];

  $log_entry = sprintf(
    "[%s] Admin %s (ID:%s) - %s - User ID:%s - %s",
    $date,
    $admin_name,
    $admin_id,
    $action,
    $user_id,
    $details
  );

  error_log($log_entry);

  // Optionnel: Stocker aussi en base de données dans une table d'audit
  // $db->query("INSERT INTO audit_logs (admin_id, action, user_id, details, date) VALUES (...)");
}

try {

  switch ($_GET['do']) {

    case 'deposit':
      // Versement épargne pour un client (Admin)

      /* valid inputs */
      if (!isset($_POST['user_id']) || !is_numeric($_POST['user_id'])) {
        throw new Exception(__("Invalid user ID"));
      }

      $user_id = (int)$_POST['user_id'];

      // Validation stricte du montant
      $amount = validate_amount($_POST['amount'] ?? null, "Deposit amount");

      // CORRECTION: Récupérer le taux d'intérêt du formulaire au lieu de forcer à 0
      $interest_rate = 0;
      if (isset($_POST['interest_rate']) && is_numeric($_POST['interest_rate'])) {
        $interest_rate = (float)$_POST['interest_rate'];
        if ($interest_rate < 0 || $interest_rate > 100) {
          throw new Exception(__("Interest rate must be between 0 and 100"));
        }
        $interest_rate = round($interest_rate, 2);
      }

      // Validate and sanitize maturity_date
      $maturity_date = null;
      if (!empty($_POST['maturity_date'])) {
        $date_obj = DateTime::createFromFormat('Y-m-d', $_POST['maturity_date']);
        if ($date_obj && $date_obj->format('Y-m-d') === $_POST['maturity_date']) {
          // Vérifier que la date est dans le futur
          $now = new DateTime();
          if ($date_obj < $now) {
            throw new Exception(__("Maturity date must be in the future"));
          }
          $maturity_date = $_POST['maturity_date'];
        } else {
          throw new Exception(__("Invalid maturity date format (expected: YYYY-MM-DD)"));
        }
      }

      // Validate and sanitize description
      $description = isset($_POST['description']) ? trim($_POST['description']) : '';
      if (strlen($description) > 500) {
        throw new Exception(__("Description too long (max 500 characters)"));
      }

      global $db, $date;

      // DÉBUT DE LA TRANSACTION ATOMIQUE
      $db->query("START TRANSACTION") or _error('SQL_ERROR_THROWEN');

      try {
        // Get client data avec verrouillage de la ligne
        $get_client = $db->query(sprintf(
          "SELECT user_wallet_balance, user_total_savings FROM users WHERE user_id = %s FOR UPDATE",
          secure($user_id, 'int')
        )) or _error('SQL_ERROR_THROWEN');

        if ($get_client->num_rows == 0) {
          throw new Exception(__("User not found"));
        }

        $client = $get_client->fetch_assoc();

        // Check balance
        if ($client['user_wallet_balance'] < $amount) {
          throw new Exception(__("Client has insufficient balance in wallet") . " (Available: " . $client['user_wallet_balance'] . ")");
        }

        // Decrease wallet balance, increase total_savings
        $db->query(sprintf(
          'UPDATE users SET user_wallet_balance = user_wallet_balance - %1$s, user_total_savings = user_total_savings + %1$s WHERE user_id = %2$s',
          secure($amount, 'float'),
          secure($user_id, 'int')
        )) or _error('SQL_ERROR_THROWEN');

        // Insert saving record
        $db->query(sprintf(
          "INSERT INTO wallet_savings (user_id, amount, interest_rate, start_date, maturity_date, status, description) VALUES (%s, %s, %s, %s, %s, 'active', %s)",
          secure($user_id, 'int'),
          secure($amount, 'float'),
          secure($interest_rate, 'float'),
          secure($date),
          ($maturity_date ? secure($maturity_date) : 'NULL'),
          secure($description)
        )) or _error('SQL_ERROR_THROWEN');

        $saving_id = $db->insert_id;

        // Log transaction
        $db->query(sprintf(
          "INSERT INTO wallet_transactions (user_id, type, amount, node_type, node_id, date) VALUES (%s, 'out', %s, 'saving', %s, %s)",
          secure($user_id, 'int'),
          secure($amount, 'float'),
          secure($saving_id, 'int'),
          secure($date)
        )) or _error('SQL_ERROR_THROWEN');

        // COMMIT - Tout s'est bien passé
        $db->query("COMMIT") or _error('SQL_ERROR_THROWEN');

        // Log audit
        log_audit(
          'CREATE_SAVING',
          $user_id,
          "Amount: {$amount}, Interest: {$interest_rate}%, Maturity: " . ($maturity_date ?? 'None')
        );

        // Return success
        return_json(['callback' => 'window.location.reload();']);

      } catch (Exception $e) {
        // ROLLBACK en cas d'erreur
        $db->query("ROLLBACK");
        throw $e;
      }
      break;

    case 'withdraw':
      // CORRECTION: Support retrait individuel OU total

      /* valid inputs */
      if (!isset($_POST['user_id']) || !is_numeric($_POST['user_id'])) {
        throw new Exception(__("Invalid user ID"));
      }

      $user_id = (int)$_POST['user_id'];

      // NOUVEAU: Support retrait d'une épargne spécifique
      $saving_id = null;
      if (isset($_POST['saving_id']) && is_numeric($_POST['saving_id']) && $_POST['saving_id'] > 0) {
        $saving_id = (int)$_POST['saving_id'];
      }

      global $db, $date;

      // DÉBUT DE LA TRANSACTION ATOMIQUE
      $db->query("START TRANSACTION") or _error('SQL_ERROR_THROWEN');

      try {
        // Verrouiller la ligne utilisateur
        $get_user = $db->query(sprintf(
          "SELECT user_wallet_balance, user_total_savings FROM users WHERE user_id = %s FOR UPDATE",
          secure($user_id, 'int')
        )) or _error('SQL_ERROR_THROWEN');

        if ($get_user->num_rows == 0) {
          throw new Exception(__("User not found"));
        }

        // Get savings to withdraw
        if ($saving_id) {
          // Retrait d'une épargne spécifique
          $get_savings = $db->query(sprintf(
            "SELECT * FROM wallet_savings WHERE saving_id = %s AND user_id = %s AND status = 'active' FOR UPDATE",
            secure($saving_id, 'int'),
            secure($user_id, 'int')
          )) or _error('SQL_ERROR_THROWEN');

          if ($get_savings->num_rows == 0) {
            throw new Exception(__("Saving not found or already withdrawn"));
          }
        } else {
          // Retrait de TOUTES les épargnes actives (comportement original)
          $get_savings = $db->query(sprintf(
            "SELECT * FROM wallet_savings WHERE user_id = %s AND status = 'active' FOR UPDATE",
            secure($user_id, 'int')
          )) or _error('SQL_ERROR_THROWEN');

          if ($get_savings->num_rows == 0) {
            throw new Exception(__("No active savings found for this user"));
          }
        }

        $total_principal = 0;
        $total_interest = 0;
        $savings_withdrawn = [];

        while ($saving = $get_savings->fetch_assoc()) {
          $principal = (float)$saving['amount'];

          // CORRECTION: Calculer les intérêts accumulés
          $interest = calculate_interest(
            $principal,
            (float)$saving['interest_rate'],
            $saving['start_date']
          );

          $total_principal += $principal;
          $total_interest += $interest;
          $savings_withdrawn[] = $saving['saving_id'];

          // Mark saving as completed
          $db->query(sprintf(
            "UPDATE wallet_savings SET status = 'completed' WHERE saving_id = %s",
            secure($saving['saving_id'], 'int')
          )) or _error('SQL_ERROR_THROWEN');
        }

        $grand_total = $total_principal + $total_interest;

        // Credit wallet with principal + interest
        // Decrease total_savings by principal only (interest is bonus)
        $db->query(sprintf(
          'UPDATE users SET user_wallet_balance = user_wallet_balance + %1$s, user_total_savings = user_total_savings - %2$s WHERE user_id = %3$s',
          secure($grand_total, 'float'),
          secure($total_principal, 'float'),
          secure($user_id, 'int')
        )) or _error('SQL_ERROR_THROWEN');

        // Log transaction
        $db->query(sprintf(
          "INSERT INTO wallet_transactions (user_id, type, amount, node_type, node_id, date) VALUES (%s, 'in', %s, 'saving_withdraw', %s, %s)",
          secure($user_id, 'int'),
          secure($grand_total, 'float'),
          secure($saving_id ?? 0, 'int'),
          secure($date)
        )) or _error('SQL_ERROR_THROWEN');

        // COMMIT
        $db->query("COMMIT") or _error('SQL_ERROR_THROWEN');

        // Log audit
        log_audit(
          'WITHDRAW_SAVING',
          $user_id,
          sprintf(
            "Principal: %s, Interest: %s, Total: %s, Savings: [%s]",
            $total_principal,
            $total_interest,
            $grand_total,
            implode(', ', $savings_withdrawn)
          )
        );

        // Return success with details
        return_json([
          'callback' => 'window.location.reload();',
          'message' => sprintf(
            __("Withdrawal successful! Principal: %s, Interest: %s, Total credited: %s"),
            $total_principal,
            $total_interest,
            $grand_total
          )
        ]);

      } catch (Exception $e) {
        $db->query("ROLLBACK");
        throw $e;
      }
      break;

    case 'edit':
      // Modifier une épargne existante (Admin)

      /* valid inputs */
      if (!isset($_POST['saving_id']) || !is_numeric($_POST['saving_id'])) {
        throw new Exception(__("Invalid saving ID"));
      }

      $saving_id = (int)$_POST['saving_id'];

      // Validation stricte du montant
      $new_amount = validate_amount($_POST['amount'] ?? null, "Amount");

      // CORRECTION: Récupérer le taux d'intérêt du formulaire
      $new_interest_rate = 0;
      if (isset($_POST['interest_rate']) && is_numeric($_POST['interest_rate'])) {
        $new_interest_rate = (float)$_POST['interest_rate'];
        if ($new_interest_rate < 0 || $new_interest_rate > 100) {
          throw new Exception(__("Interest rate must be between 0 and 100"));
        }
        $new_interest_rate = round($new_interest_rate, 2);
      }

      // Validate and sanitize maturity_date
      $new_maturity_date = null;
      if (!empty($_POST['maturity_date'])) {
        $date_obj = DateTime::createFromFormat('Y-m-d', $_POST['maturity_date']);
        if ($date_obj && $date_obj->format('Y-m-d') === $_POST['maturity_date']) {
          $new_maturity_date = $_POST['maturity_date'];
        } else {
          throw new Exception(__("Invalid maturity date format (expected: YYYY-MM-DD)"));
        }
      }

      // Validate and sanitize description
      $new_description = isset($_POST['description']) ? trim($_POST['description']) : '';
      if (strlen($new_description) > 500) {
        throw new Exception(__("Description too long (max 500 characters)"));
      }

      global $db;

      // DÉBUT DE LA TRANSACTION ATOMIQUE
      $db->query("START TRANSACTION") or _error('SQL_ERROR_THROWEN');

      try {
        // Get current saving data avec verrouillage
        $get_saving = $db->query(sprintf(
          "SELECT * FROM wallet_savings WHERE saving_id = %s FOR UPDATE",
          secure($saving_id, 'int')
        )) or _error('SQL_ERROR_THROWEN');

        if ($get_saving->num_rows == 0) {
          throw new Exception(__("Saving not found"));
        }

        $current_saving = $get_saving->fetch_assoc();
        $user_id = $current_saving['user_id'];
        $old_amount = (float)$current_saving['amount'];
        $amount_difference = $new_amount - $old_amount;

        // Get user data avec verrouillage
        $get_user = $db->query(sprintf(
          "SELECT user_wallet_balance FROM users WHERE user_id = %s FOR UPDATE",
          secure($user_id, 'int')
        )) or _error('SQL_ERROR_THROWEN');

        $user_data = $get_user->fetch_assoc();

        // Check if amount increased and user has sufficient balance
        if ($amount_difference > 0) {
          if ($user_data['user_wallet_balance'] < $amount_difference) {
            throw new Exception(__("Client has insufficient balance for this increase") . " (Need: {$amount_difference}, Available: {$user_data['user_wallet_balance']})");
          }
        }

        // Update wallet balance and total_savings
        if ($amount_difference != 0) {
          $db->query(sprintf(
            'UPDATE users SET user_wallet_balance = user_wallet_balance - %1$s, user_total_savings = user_total_savings + %1$s WHERE user_id = %2$s',
            secure($amount_difference, 'float'),
            secure($user_id, 'int')
          )) or _error('SQL_ERROR_THROWEN');
        }

        // Update saving record
        $db->query(sprintf(
          "UPDATE wallet_savings SET amount = %s, interest_rate = %s, maturity_date = %s, description = %s WHERE saving_id = %s",
          secure($new_amount, 'float'),
          secure($new_interest_rate, 'float'),
          ($new_maturity_date ? secure($new_maturity_date) : 'NULL'),
          secure($new_description),
          secure($saving_id, 'int')
        )) or _error('SQL_ERROR_THROWEN');

        // COMMIT
        $db->query("COMMIT") or _error('SQL_ERROR_THROWEN');

        // Log audit
        log_audit(
          'EDIT_SAVING',
          $user_id,
          sprintf(
            "Saving ID: %s, Old amount: %s, New amount: %s, Interest: %s%%",
            $saving_id,
            $old_amount,
            $new_amount,
            $new_interest_rate
          )
        );

        // Return success
        return_json(['callback' => 'window.location.reload();']);

      } catch (Exception $e) {
        $db->query("ROLLBACK");
        throw $e;
      }
      break;

    default:
      _error(400);
      break;
  }

} catch (Exception $e) {
  modal("ERROR", __("Error"), $e->getMessage());
}

?>
