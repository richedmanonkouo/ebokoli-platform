<?php

/**
 * Wallet Savings & Loans Extension
 * Methods pour gérer l'épargne et les emprunts
 *
 * @package Sngine
 * @author Extension EBOKOLI
 */

// Note: Ces méthodes doivent être ajoutées à la classe User dans class-user.php

/**
 * wallet_get_savings
 * Récupère toutes les épargnes de l'utilisateur
 *
 * @param string $status Filtre par statut (all, active, completed, cancelled)
 * @return array
 */
public function wallet_get_savings($status = 'all')
{
    global $db;
    $savings = [];

    $where_clause = sprintf("user_id = %s", secure($this->_data['user_id'], 'int'));
    if ($status != 'all') {
        $where_clause .= sprintf(" AND status = %s", secure($status));
    }

    $get_savings = $db->query("SELECT * FROM wallet_savings WHERE " . $where_clause . " ORDER BY saving_id DESC") or _error('SQL_ERROR_THROWEN');

    if ($get_savings->num_rows > 0) {
        while ($saving = $get_savings->fetch_assoc()) {
            // Calculer les intérêts accumulés
            $saving['accumulated_interest'] = $this->calculate_savings_interest($saving);
            $saving['current_value'] = $saving['amount'] + $saving['accumulated_interest'];
            $savings[] = $saving;
        }
    }

    return $savings;
}


/**
 * wallet_get_loans
 * Récupère tous les emprunts de l'utilisateur
 *
 * @param string $status Filtre par statut (all, pending, active, completed, defaulted, cancelled)
 * @return array
 */
public function wallet_get_loans($status = 'all')
{
    global $db;
    $loans = [];

    $where_clause = sprintf("user_id = %s", secure($this->_data['user_id'], 'int'));
    if ($status != 'all') {
        $where_clause .= sprintf(" AND status = %s", secure($status));
    }

    $get_loans = $db->query("SELECT * FROM wallet_loans WHERE " . $where_clause . " ORDER BY loan_id DESC") or _error('SQL_ERROR_THROWEN');

    if ($get_loans->num_rows > 0) {
        while ($loan = $get_loans->fetch_assoc()) {
            // Calculer le nombre de paiements restants
            $loan['payments_made'] = $this->get_loan_payments_count($loan['loan_id']);
            $loan['payments_remaining'] = $loan['duration_months'] - $loan['payments_made'];
            $loans[] = $loan;
        }
    }

    return $loans;
}


/**
 * wallet_create_saving
 * Crée une nouvelle épargne
 *
 * @param float $amount Montant à épargner
 * @param float $interest_rate Taux d'intérêt annuel
 * @param string $maturity_date Date de maturité (optionnel)
 * @param string $description Description
 * @return void
 */
public function wallet_create_saving($amount, $interest_rate = 0, $maturity_date = null, $description = '')
{
    global $db, $system, $date;

    /* check if wallet enabled */
    if (!$system['wallet_enabled']) {
        throw new Exception(__("This feature has been disabled by the admin"));
    }

    /* validate amount */
    if (!is_numeric($amount) || $amount <= 0) {
        throw new Exception(__("Invalid amount"));
    }

    /* check viewer balance */
    if ($this->_data['user_wallet_balance'] < $amount) {
        throw new Exception(__("Insufficient balance in your wallet"));
    }

    /* decrease wallet balance */
    $db->query(sprintf('UPDATE users SET user_wallet_balance = user_wallet_balance - %1$s, user_total_savings = user_total_savings + %1$s WHERE user_id = %2$s', secure($amount, 'float'), secure($this->_data['user_id'], 'int'))) or _error('SQL_ERROR_THROWEN');

    /* insert saving record */
    $db->query(sprintf(
        "INSERT INTO wallet_savings (user_id, amount, interest_rate, start_date, maturity_date, status, description) VALUES (%s, %s, %s, %s, %s, 'active', %s)",
        secure($this->_data['user_id'], 'int'),
        secure($amount, 'float'),
        secure($interest_rate, 'float'),
        secure($date),
        ($maturity_date ? secure($maturity_date) : 'NULL'),
        secure($description)
    )) or _error('SQL_ERROR_THROWEN');

    /* log transaction */
    $this->wallet_set_transaction($this->_data['user_id'], 'saving', $db->insert_id, $amount, 'out');
}


/**
 * wallet_withdraw_saving
 * Retirer une épargne
 *
 * @param int $saving_id ID de l'épargne
 * @return void
 */
public function wallet_withdraw_saving($saving_id)
{
    global $db, $system;

    /* check if wallet enabled */
    if (!$system['wallet_enabled']) {
        throw new Exception(__("This feature has been disabled by the admin"));
    }

    /* get saving */
    $get_saving = $db->query(sprintf("SELECT * FROM wallet_savings WHERE saving_id = %s AND user_id = %s AND status = 'active'", secure($saving_id, 'int'), secure($this->_data['user_id'], 'int'))) or _error('SQL_ERROR_THROWEN');

    if ($get_saving->num_rows == 0) {
        throw new Exception(__("Saving not found or already withdrawn"));
    }

    $saving = $get_saving->fetch_assoc();

    /* calculate interest */
    $accumulated_interest = $this->calculate_savings_interest($saving);
    $total_amount = $saving['amount'] + $accumulated_interest;

    /* update wallet balance */
    $db->query(sprintf('UPDATE users SET user_wallet_balance = user_wallet_balance + %1$s, user_total_savings = user_total_savings - %2$s WHERE user_id = %3$s', secure($total_amount, 'float'), secure($saving['amount'], 'float'), secure($this->_data['user_id'], 'int'))) or _error('SQL_ERROR_THROWEN');

    /* update saving status */
    $db->query(sprintf("UPDATE wallet_savings SET status = 'completed' WHERE saving_id = %s", secure($saving_id, 'int'))) or _error('SQL_ERROR_THROWEN');

    /* log transaction */
    $this->wallet_set_transaction($this->_data['user_id'], 'saving_withdraw', $saving_id, $total_amount, 'in');
}


/**
 * wallet_request_loan
 * Demander un emprunt
 *
 * @param float $amount Montant demandé
 * @param int $duration_months Durée en mois
 * @param float $interest_rate Taux d'intérêt annuel
 * @param string $description Description
 * @return void
 */
public function wallet_request_loan($amount, $duration_months, $interest_rate = 0, $description = '')
{
    global $db, $system, $date;

    /* check if wallet enabled */
    if (!$system['wallet_enabled']) {
        throw new Exception(__("This feature has been disabled by the admin"));
    }

    /* validate amount */
    if (!is_numeric($amount) || $amount <= 0) {
        throw new Exception(__("Invalid amount"));
    }

    /* validate duration */
    if (!is_numeric($duration_months) || $duration_months <= 0) {
        throw new Exception(__("Invalid duration"));
    }

    /* calculate monthly payment using formula: P = [r*PV] / [1 - (1+r)^-n] */
    $monthly_interest_rate = ($interest_rate / 100) / 12;
    if ($monthly_interest_rate > 0) {
        $monthly_payment = ($monthly_interest_rate * $amount) / (1 - pow(1 + $monthly_interest_rate, -$duration_months));
    } else {
        $monthly_payment = $amount / $duration_months;
    }

    $total_amount = $monthly_payment * $duration_months;
    $due_date = date('Y-m-d H:i:s', strtotime("+{$duration_months} months"));

    /* insert loan record */
    $db->query(sprintf(
        "INSERT INTO wallet_loans (user_id, amount, interest_rate, duration_months, monthly_payment, amount_remaining, loan_date, due_date, status, description) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, 'pending', %s)",
        secure($this->_data['user_id'], 'int'),
        secure($amount, 'float'),
        secure($interest_rate, 'float'),
        secure($duration_months, 'int'),
        secure($monthly_payment, 'float'),
        secure($total_amount, 'float'),
        secure($date),
        secure($due_date),
        secure($description)
    )) or _error('SQL_ERROR_THROWEN');
}


/**
 * wallet_approve_loan
 * Approuver un emprunt (Admin uniquement)
 *
 * @param int $loan_id ID de l'emprunt
 * @return void
 */
public function wallet_approve_loan($loan_id)
{
    global $db, $system;

    /* check admin */
    if (!$this->_is_admin) {
        throw new Exception(__("You do not have permission"));
    }

    /* get loan */
    $get_loan = $db->query(sprintf("SELECT * FROM wallet_loans WHERE loan_id = %s AND status = 'pending'", secure($loan_id, 'int'))) or _error('SQL_ERROR_THROWEN');

    if ($get_loan->num_rows == 0) {
        throw new Exception(__("Loan not found or already processed"));
    }

    $loan = $get_loan->fetch_assoc();

    /* update user balance */
    $db->query(sprintf('UPDATE users SET user_wallet_balance = user_wallet_balance + %1$s, user_total_loans = user_total_loans + %2$s WHERE user_id = %3$s', secure($loan['amount'], 'float'), secure($loan['amount_remaining'], 'float'), secure($loan['user_id'], 'int'))) or _error('SQL_ERROR_THROWEN');

    /* update loan status */
    $db->query(sprintf("UPDATE wallet_loans SET status = 'active' WHERE loan_id = %s", secure($loan_id, 'int'))) or _error('SQL_ERROR_THROWEN');

    /* log transaction */
    $this->wallet_set_transaction($loan['user_id'], 'loan', $loan_id, $loan['amount'], 'in');
}


/**
 * wallet_pay_loan
 * Payer un remboursement d'emprunt
 *
 * @param int $loan_id ID de l'emprunt
 * @param float $amount Montant du paiement
 * @return void
 */
public function wallet_pay_loan($loan_id, $amount)
{
    global $db, $system, $date;

    /* check if wallet enabled */
    if (!$system['wallet_enabled']) {
        throw new Exception(__("This feature has been disabled by the admin"));
    }

    /* get loan */
    $get_loan = $db->query(sprintf("SELECT * FROM wallet_loans WHERE loan_id = %s AND user_id = %s AND status = 'active'", secure($loan_id, 'int'), secure($this->_data['user_id'], 'int'))) or _error('SQL_ERROR_THROWEN');

    if ($get_loan->num_rows == 0) {
        throw new Exception(__("Loan not found"));
    }

    $loan = $get_loan->fetch_assoc();

    /* validate amount */
    if (!is_numeric($amount) || $amount <= 0) {
        throw new Exception(__("Invalid amount"));
    }

    if ($amount > $loan['amount_remaining']) {
        throw new Exception(__("Amount exceeds remaining balance"));
    }

    /* check wallet balance */
    if ($this->_data['user_wallet_balance'] < $amount) {
        throw new Exception(__("Insufficient balance"));
    }

    /* update wallet balance */
    $db->query(sprintf('UPDATE users SET user_wallet_balance = user_wallet_balance - %1$s WHERE user_id = %2$s', secure($amount, 'float'), secure($this->_data['user_id'], 'int'))) or _error('SQL_ERROR_THROWEN');

    /* update loan */
    $new_remaining = $loan['amount_remaining'] - $amount;
    $new_paid = $loan['amount_paid'] + $amount;
    $new_status = ($new_remaining <= 0) ? 'completed' : 'active';

    $db->query(sprintf("UPDATE wallet_loans SET amount_paid = %s, amount_remaining = %s, status = %s WHERE loan_id = %s", secure($new_paid, 'float'), secure($new_remaining, 'float'), secure($new_status), secure($loan_id, 'int'))) or _error('SQL_ERROR_THROWEN');

    /* update user total loans if completed */
    if ($new_status == 'completed') {
        $db->query(sprintf('UPDATE users SET user_total_loans = user_total_loans - %s WHERE user_id = %s', secure($loan['amount'], 'float'), secure($this->_data['user_id'], 'int'))) or _error('SQL_ERROR_THROWEN');
    }

    /* insert payment record */
    $db->query(sprintf(
        "INSERT INTO wallet_loan_payments (loan_id, user_id, amount, payment_date) VALUES (%s, %s, %s, %s)",
        secure($loan_id, 'int'),
        secure($this->_data['user_id'], 'int'),
        secure($amount, 'float'),
        secure($date)
    )) or _error('SQL_ERROR_THROWEN');

    /* log transaction */
    $this->wallet_set_transaction($this->_data['user_id'], 'loan_payment', $loan_id, $amount, 'out');
}


/**
 * wallet_get_loan_payments
 * Récupère l'historique des paiements d'un emprunt
 *
 * @param int $loan_id ID de l'emprunt
 * @return array
 */
public function wallet_get_loan_payments($loan_id)
{
    global $db;
    $payments = [];

    $get_payments = $db->query(sprintf("SELECT * FROM wallet_loan_payments WHERE loan_id = %s AND user_id = %s ORDER BY payment_id DESC", secure($loan_id, 'int'), secure($this->_data['user_id'], 'int'))) or _error('SQL_ERROR_THROWEN');

    if ($get_payments->num_rows > 0) {
        while ($payment = $get_payments->fetch_assoc()) {
            $payments[] = $payment;
        }
    }

    return $payments;
}


/**
 * calculate_savings_interest
 * Calcule les intérêts accumulés pour une épargne
 *
 * @param array $saving Données de l'épargne
 * @return float
 */
private function calculate_savings_interest($saving)
{
    if ($saving['interest_rate'] <= 0) {
        return 0;
    }

    $start = new DateTime($saving['start_date']);
    $now = new DateTime();
    $interval = $start->diff($now);
    $days = $interval->days;

    // Intérêt simple: I = P * r * t
    // où P = principal, r = taux annuel, t = temps en années
    $years = $days / 365;
    $interest = $saving['amount'] * ($saving['interest_rate'] / 100) * $years;

    return round($interest, 2);
}


/**
 * get_loan_payments_count
 * Compte le nombre de paiements effectués pour un emprunt
 *
 * @param int $loan_id ID de l'emprunt
 * @return int
 */
private function get_loan_payments_count($loan_id)
{
    global $db;

    $get_count = $db->query(sprintf("SELECT COUNT(*) as count FROM wallet_loan_payments WHERE loan_id = %s", secure($loan_id, 'int'))) or _error('SQL_ERROR_THROWEN');
    $result = $get_count->fetch_assoc();

    return $result['count'];
}


/**
 * wallet_get_transactions_by_type
 * Récupère les transactions filtrées par type
 *
 * @param string $filter Type de filtre: 'all', 'savings', 'loans'
 * @return array
 */
public function wallet_get_transactions_by_type($filter = 'all')
{
    global $db;
    $transactions = [];

    $where_clause = sprintf("wallet_transactions.user_id = %s", secure($this->_data['user_id'], 'int'));

    if ($filter == 'savings') {
        $where_clause .= " AND (wallet_transactions.node_type = 'saving' OR wallet_transactions.node_type = 'saving_withdraw')";
    } elseif ($filter == 'loans') {
        $where_clause .= " AND (wallet_transactions.node_type = 'loan' OR wallet_transactions.node_type = 'loan_payment')";
    }

    $get_transactions = $db->query("SELECT wallet_transactions.*, users.user_name, users.user_firstname, users.user_lastname, users.user_gender, users.user_picture FROM wallet_transactions LEFT JOIN users ON (wallet_transactions.node_type='user' OR wallet_transactions.node_type='tip') AND wallet_transactions.node_id = users.user_id WHERE " . $where_clause . " ORDER BY wallet_transactions.transaction_id DESC") or _error('SQL_ERROR_THROWEN');

    if ($get_transactions->num_rows > 0) {
        while ($transaction = $get_transactions->fetch_assoc()) {
            if ($transaction['node_type'] == "user" || $transaction['node_type'] == "tip") {
                $transaction['user_picture'] = get_picture($transaction['user_picture'], $transaction['user_gender']);
            }
            $transactions[] = $transaction;
        }
    }

    return $transactions;
}

?>
