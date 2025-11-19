<?php

/**
 * admin_loans
 * Gestion administrative des emprunts clients
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
 * Helper function: Valider une durée en mois
 */
function validate_duration($duration_months, $field_name = "Duration") {
  if (!isset($duration_months) || !is_numeric($duration_months)) {
    throw new Exception(__("Invalid {$field_name}"));
  }

  $duration_months = (int)$duration_months;

  if ($duration_months <= 0) {
    throw new Exception(__("{$field_name} must be greater than zero"));
  }

  if ($duration_months > 360) {
    throw new Exception(__("{$field_name} is too long (max: 360 months / 30 years)"));
  }

  return $duration_months;
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

    case 'create':
      // Créer/Prêter au client (Admin)

      /* valid inputs */
      if (!isset($_POST['user_id']) || !is_numeric($_POST['user_id'])) {
        throw new Exception(__("Invalid user ID"));
      }

      $user_id = (int)$_POST['user_id'];

      // Validation stricte du montant
      $amount = validate_amount($_POST['amount'] ?? null, "Loan amount");

      // Validation de la durée
      $duration_months = validate_duration($_POST['duration_months'] ?? null, "Loan duration");

      // CORRECTION: Récupérer le taux d'intérêt du formulaire au lieu de forcer à 0
      $interest_rate = 0;
      if (isset($_POST['interest_rate']) && is_numeric($_POST['interest_rate'])) {
        $interest_rate = (float)$_POST['interest_rate'];
        if ($interest_rate < 0 || $interest_rate > 100) {
          throw new Exception(__("Interest rate must be between 0 and 100"));
        }
        $interest_rate = round($interest_rate, 2);
      }

      // Validate and sanitize description
      $description = isset($_POST['description']) ? trim($_POST['description']) : '';
      if (strlen($description) > 500) {
        throw new Exception(__("Description too long (max 500 characters)"));
      }

      global $db, $date;

      // Calculate monthly payment avec intérêts
      $monthly_interest_rate = ($interest_rate / 100) / 12;
      if ($monthly_interest_rate > 0) {
        // Formule d'amortissement
        $monthly_payment = ($monthly_interest_rate * $amount) / (1 - pow(1 + $monthly_interest_rate, -$duration_months));
      } else {
        // Sans intérêt
        $monthly_payment = $amount / $duration_months;
      }
      $monthly_payment = round($monthly_payment, 2);

      $total_amount = $monthly_payment * $duration_months;
      $due_date = date('Y-m-d H:i:s', strtotime("+{$duration_months} months"));

      // DÉBUT DE LA TRANSACTION ATOMIQUE
      $db->query("START TRANSACTION") or _error('SQL_ERROR_THROWEN');

      try {
        // Verrouiller la ligne utilisateur
        $get_user = $db->query(sprintf(
          "SELECT user_wallet_balance, user_total_loans FROM users WHERE user_id = %s FOR UPDATE",
          secure($user_id, 'int')
        )) or _error('SQL_ERROR_THROWEN');

        if ($get_user->num_rows == 0) {
          throw new Exception(__("User not found"));
        }

        // Insert loan record (active directly - no approval needed for admin)
        $db->query(sprintf(
          "INSERT INTO wallet_loans (user_id, amount, interest_rate, duration_months, monthly_payment, amount_remaining, loan_date, due_date, status, description) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, 'active', %s)",
          secure($user_id, 'int'),
          secure($amount, 'float'),
          secure($interest_rate, 'float'),
          secure($duration_months, 'int'),
          secure($monthly_payment, 'float'),
          secure($total_amount, 'float'),
          secure($date),
          secure($due_date),
          secure($description)
        )) or _error('SQL_ERROR_THROWEN');

        $loan_id = $db->insert_id;

        // Credit wallet (add money to client)
        // Update total_loans
        $db->query(sprintf(
          'UPDATE users SET user_wallet_balance = user_wallet_balance + %1$s, user_total_loans = user_total_loans + %2$s WHERE user_id = %3$s',
          secure($amount, 'float'),
          secure($total_amount, 'float'),
          secure($user_id, 'int')
        )) or _error('SQL_ERROR_THROWEN');

        // Log transaction
        $db->query(sprintf(
          "INSERT INTO wallet_transactions (user_id, type, amount, node_type, node_id, date) VALUES (%s, 'in', %s, 'loan', %s, %s)",
          secure($user_id, 'int'),
          secure($amount, 'float'),
          secure($loan_id, 'int'),
          secure($date)
        )) or _error('SQL_ERROR_THROWEN');

        // COMMIT
        $db->query("COMMIT") or _error('SQL_ERROR_THROWEN');

        // Log audit
        log_audit(
          'CREATE_LOAN',
          $user_id,
          sprintf(
            "Amount: %s, Interest: %s%%, Duration: %s months, Monthly: %s, Total to repay: %s",
            $amount,
            $interest_rate,
            $duration_months,
            $monthly_payment,
            $total_amount
          )
        );

        // Return success
        return_json(['callback' => 'window.location.reload();']);

      } catch (Exception $e) {
        $db->query("ROLLBACK");
        throw $e;
      }
      break;

    case 'edit':
      // Modifier un emprunt existant (Admin)

      /* valid inputs */
      if (!isset($_POST['loan_id']) || !is_numeric($_POST['loan_id'])) {
        throw new Exception(__("Invalid loan ID"));
      }

      $loan_id = (int)$_POST['loan_id'];

      // Validation stricte du montant
      $new_amount = validate_amount($_POST['amount'] ?? null, "Loan amount");

      // Validation de la durée
      $new_duration_months = validate_duration($_POST['duration_months'] ?? null, "Loan duration");

      // CORRECTION: Récupérer le taux d'intérêt du formulaire
      $new_interest_rate = 0;
      if (isset($_POST['interest_rate']) && is_numeric($_POST['interest_rate'])) {
        $new_interest_rate = (float)$_POST['interest_rate'];
        if ($new_interest_rate < 0 || $new_interest_rate > 100) {
          throw new Exception(__("Interest rate must be between 0 and 100"));
        }
        $new_interest_rate = round($new_interest_rate, 2);
      }

      // Validate and sanitize description
      $new_description = isset($_POST['description']) ? trim($_POST['description']) : '';
      if (strlen($new_description) > 500) {
        throw new Exception(__("Description too long (max 500 characters)"));
      }

      global $db, $date;

      // Recalculate monthly payment
      $monthly_interest_rate = ($new_interest_rate / 100) / 12;
      if ($monthly_interest_rate > 0) {
        $new_monthly_payment = ($monthly_interest_rate * $new_amount) / (1 - pow(1 + $monthly_interest_rate, -$new_duration_months));
      } else {
        $new_monthly_payment = $new_amount / $new_duration_months;
      }
      $new_monthly_payment = round($new_monthly_payment, 2);

      $new_total_amount = $new_monthly_payment * $new_duration_months;

      // DÉBUT DE LA TRANSACTION ATOMIQUE
      $db->query("START TRANSACTION") or _error('SQL_ERROR_THROWEN');

      try {
        // Get current loan data avec verrouillage
        $get_loan = $db->query(sprintf(
          "SELECT * FROM wallet_loans WHERE loan_id = %s FOR UPDATE",
          secure($loan_id, 'int')
        )) or _error('SQL_ERROR_THROWEN');

        if ($get_loan->num_rows == 0) {
          throw new Exception(__("Loan not found"));
        }

        $current_loan = $get_loan->fetch_assoc();
        $user_id = $current_loan['user_id'];
        $old_amount = (float)$current_loan['amount'];
        $old_total_amount = (float)$current_loan['amount_remaining'];
        $old_amount_paid = (float)$current_loan['amount_paid'];

        // Vérifier si le prêt a déjà des paiements
        if ($old_amount_paid > 0) {
          throw new Exception(__("Cannot edit a loan that has payments. Create a new loan instead."));
        }

        $amount_difference = $new_amount - $old_amount;
        $total_difference = $new_total_amount - $old_total_amount;

        // Recalculate due date based on new duration from loan_date
        $loan_date = new DateTime($current_loan['loan_date']);
        $new_due_date = clone $loan_date;
        $new_due_date->modify("+{$new_duration_months} months");
        $new_due_date_str = $new_due_date->format('Y-m-d H:i:s');

        // Verrouiller la ligne utilisateur
        $get_user = $db->query(sprintf(
          "SELECT user_wallet_balance, user_total_loans FROM users WHERE user_id = %s FOR UPDATE",
          secure($user_id, 'int')
        )) or _error('SQL_ERROR_THROWEN');

        if ($get_user->num_rows == 0) {
          throw new Exception(__("User not found"));
        }

        // Update wallet balance if amount changed
        if ($amount_difference != 0) {
          $db->query(sprintf(
            'UPDATE users SET user_wallet_balance = user_wallet_balance + %1$s WHERE user_id = %2$s',
            secure($amount_difference, 'float'),
            secure($user_id, 'int')
          )) or _error('SQL_ERROR_THROWEN');
        }

        // Update user_total_loans
        if ($total_difference != 0) {
          $db->query(sprintf(
            'UPDATE users SET user_total_loans = user_total_loans + %1$s WHERE user_id = %2$s',
            secure($total_difference, 'float'),
            secure($user_id, 'int')
          )) or _error('SQL_ERROR_THROWEN');
        }

        // Update loan record with new amount_remaining (since no payments yet)
        $db->query(sprintf(
          "UPDATE wallet_loans SET amount = %s, interest_rate = %s, duration_months = %s, monthly_payment = %s, amount_remaining = %s, due_date = %s, description = %s WHERE loan_id = %s",
          secure($new_amount, 'float'),
          secure($new_interest_rate, 'float'),
          secure($new_duration_months, 'int'),
          secure($new_monthly_payment, 'float'),
          secure($new_total_amount, 'float'),
          secure($new_due_date_str),
          secure($new_description),
          secure($loan_id, 'int')
        )) or _error('SQL_ERROR_THROWEN');

        // COMMIT
        $db->query("COMMIT") or _error('SQL_ERROR_THROWEN');

        // Log audit
        log_audit(
          'EDIT_LOAN',
          $user_id,
          sprintf(
            "Loan ID: %s, Old amount: %s -> New: %s, Interest: %s%%, Duration: %s months, Monthly: %s",
            $loan_id,
            $old_amount,
            $new_amount,
            $new_interest_rate,
            $new_duration_months,
            $new_monthly_payment
          )
        );

        // Return success
        return_json(['callback' => 'window.location.reload();']);

      } catch (Exception $e) {
        $db->query("ROLLBACK");
        throw $e;
      }
      break;

    case 'record_payment':
      // Enregistrer un paiement de prêt (Admin)

      /* valid inputs */
      if (!isset($_POST['loan_id']) || !is_numeric($_POST['loan_id'])) {
        throw new Exception(__("Invalid loan ID"));
      }
      if (!isset($_POST['user_id']) || !is_numeric($_POST['user_id'])) {
        throw new Exception(__("Invalid user ID"));
      }

      $loan_id = (int)$_POST['loan_id'];
      $user_id = (int)$_POST['user_id'];

      // Validation stricte du montant
      $payment_amount = validate_amount($_POST['amount'] ?? null, "Payment amount");

      // Validate and sanitize description
      $payment_description = isset($_POST['description']) ? trim($_POST['description']) : 'Admin recorded payment';
      if (strlen($payment_description) > 255) {
        throw new Exception(__("Description too long (max 255 characters)"));
      }

      global $db, $date;

      // DÉBUT DE LA TRANSACTION ATOMIQUE
      $db->query("START TRANSACTION") or _error('SQL_ERROR_THROWEN');

      try {
        // Get loan data avec verrouillage
        $get_loan = $db->query(sprintf(
          "SELECT * FROM wallet_loans WHERE loan_id = %s AND user_id = %s FOR UPDATE",
          secure($loan_id, 'int'),
          secure($user_id, 'int')
        )) or _error('SQL_ERROR_THROWEN');

        if ($get_loan->num_rows == 0) {
          throw new Exception(__("Loan not found"));
        }

        $loan = $get_loan->fetch_assoc();

        if ($loan['status'] != 'active') {
          throw new Exception(__("Cannot record payment for a non-active loan"));
        }

        $amount_remaining = (float)$loan['amount_remaining'];

        // Vérifier que le montant ne dépasse pas le restant
        if ($payment_amount > $amount_remaining) {
          throw new Exception(__("Payment amount exceeds remaining balance") . " (Remaining: {$amount_remaining})");
        }

        // Verrouiller la ligne utilisateur
        $get_user = $db->query(sprintf(
          "SELECT user_wallet_balance, user_total_loans FROM users WHERE user_id = %s FOR UPDATE",
          secure($user_id, 'int')
        )) or _error('SQL_ERROR_THROWEN');

        if ($get_user->num_rows == 0) {
          throw new Exception(__("User not found"));
        }

        $user_data = $get_user->fetch_assoc();

        // Vérifier que l'utilisateur a assez dans son wallet
        if ($user_data['user_wallet_balance'] < $payment_amount) {
          throw new Exception(__("User has insufficient balance in wallet") . " (Available: {$user_data['user_wallet_balance']})");
        }

        // Debit wallet
        $db->query(sprintf(
          'UPDATE users SET user_wallet_balance = user_wallet_balance - %1$s WHERE user_id = %2$s',
          secure($payment_amount, 'float'),
          secure($user_id, 'int')
        )) or _error('SQL_ERROR_THROWEN');

        // Update loan
        $new_amount_paid = (float)$loan['amount_paid'] + $payment_amount;
        $new_amount_remaining = $amount_remaining - $payment_amount;

        $new_status = $loan['status'];
        if ($new_amount_remaining <= 0.01) {
          // Prêt remboursé
          $new_status = 'completed';
          $new_amount_remaining = 0;

          // Update user_total_loans
          $db->query(sprintf(
            'UPDATE users SET user_total_loans = user_total_loans - %1$s WHERE user_id = %2$s',
            secure($amount_remaining, 'float'),
            secure($user_id, 'int')
          )) or _error('SQL_ERROR_THROWEN');
        }

        $db->query(sprintf(
          "UPDATE wallet_loans SET amount_paid = %s, amount_remaining = %s, status = %s WHERE loan_id = %s",
          secure($new_amount_paid, 'float'),
          secure($new_amount_remaining, 'float'),
          secure($new_status),
          secure($loan_id, 'int')
        )) or _error('SQL_ERROR_THROWEN');

        // Insert payment record
        $db->query(sprintf(
          "INSERT INTO wallet_loan_payments (loan_id, user_id, amount, payment_date, description) VALUES (%s, %s, %s, %s, %s)",
          secure($loan_id, 'int'),
          secure($user_id, 'int'),
          secure($payment_amount, 'float'),
          secure($date),
          secure($payment_description)
        )) or _error('SQL_ERROR_THROWEN');

        // Log transaction
        $db->query(sprintf(
          "INSERT INTO wallet_transactions (user_id, type, amount, node_type, node_id, date) VALUES (%s, 'out', %s, 'loan_payment', %s, %s)",
          secure($user_id, 'int'),
          secure($payment_amount, 'float'),
          secure($loan_id, 'int'),
          secure($date)
        )) or _error('SQL_ERROR_THROWEN');

        // COMMIT
        $db->query("COMMIT") or _error('SQL_ERROR_THROWEN');

        // Log audit
        log_audit(
          'RECORD_LOAN_PAYMENT',
          $user_id,
          sprintf(
            "Loan ID: %s, Payment: %s, New remaining: %s, Status: %s",
            $loan_id,
            $payment_amount,
            $new_amount_remaining,
            $new_status
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
