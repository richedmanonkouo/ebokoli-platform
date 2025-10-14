<?php
/**
 * AJAX Endpoint - Get Wallet Data
 * Retourne les données du wallet en JSON pour mise à jour temps réel
 *
 * @package Sngine
 * @author Extension EBOKOLI
 */

// fetch bootloader
require('../../../bootloader.php');

// check AJAX request
if (!$_SERVER['HTTP_X_REQUESTED_WITH'] || $_SERVER['HTTP_X_REQUESTED_WITH'] != 'XMLHttpRequest') {
    _error(404);
}

// user access
user_access(true);

// check wallet enabled
if (!$system['wallet_enabled']) {
    _error(400, __("This feature has been disabled"));
}

try {
    $response = [];
    $view = isset($_GET['view']) ? $_GET['view'] : '';

    switch ($view) {
        case 'savings':
            // Get savings data
            $savings = $user->wallet_get_savings();
            $savings_transactions = $user->wallet_get_transactions_by_type('savings');

            $response['success'] = true;
            $response['savings'] = $savings;
            $response['savings_transactions'] = $savings_transactions;
            $response['user_total_savings'] = $user->_data['user_total_savings'];
            $response['user_wallet_balance'] = $user->_data['user_wallet_balance'];
            break;

        case 'loans':
            // Get loans data
            $loans = $user->wallet_get_loans();
            $loans_transactions = $user->wallet_get_transactions_by_type('loans');

            $response['success'] = true;
            $response['loans'] = $loans;
            $response['loans_transactions'] = $loans_transactions;
            $response['user_total_loans'] = $user->_data['user_total_loans'];
            $response['user_wallet_balance'] = $user->_data['user_wallet_balance'];
            break;

        case 'wallet':
        default:
            // Get wallet transactions
            $transactions = $user->wallet_get_transactions();

            $response['success'] = true;
            $response['transactions'] = $transactions;
            $response['user_wallet_balance'] = $user->_data['user_wallet_balance'];
            break;
    }

    // Return JSON response
    header('Content-Type: application/json');
    echo json_encode($response);

} catch (Exception $e) {
    header('Content-Type: application/json');
    echo json_encode([
        'success' => false,
        'error' => $e->getMessage()
    ]);
}
?>
