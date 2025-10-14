<?php
/**
 * Test direct du module wallet
 * Contourne le système de vérification d'URL
 */

// Configuration directe
define('ABSPATH', __DIR__ . '/');
require_once(ABSPATH . 'includes/config.php');

echo "<!DOCTYPE html><html><head><meta charset='utf-8'><title>Test Wallet</title>";
echo "<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css'>";
echo "</head><body class='p-5'>";

echo "<h1>Test du Module Wallet - EBOKOLI</h1>";
echo "<hr>";

// Test connexion DB
$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME, DB_PORT);
if ($mysqli->connect_error) {
    die("<div class='alert alert-danger'>❌ Erreur DB: " . $mysqli->connect_error . "</div>");
}
echo "<div class='alert alert-success'>✅ Connexion DB réussie</div>";

// Vérifier l'utilisateur de test
$result = $mysqli->query("SELECT * FROM users WHERE user_id = 1");
if ($result && $result->num_rows > 0) {
    $user = $result->fetch_assoc();
    echo "<div class='card mb-3'>";
    echo "<div class='card-header'><h3>👤 Utilisateur de Test</h3></div>";
    echo "<div class='card-body'>";
    echo "<p><strong>Username:</strong> " . $user['user_name'] . "</p>";
    echo "<p><strong>Email:</strong> " . $user['user_email'] . "</p>";
    echo "<p><strong>Solde Wallet:</strong> $" . $user['user_wallet_balance'] . "</p>";
    echo "</div></div>";
}

// Vérifier les épargnes
echo "<div class='card mb-3'>";
echo "<div class='card-header'><h3>💰 Épargnes</h3></div>";
echo "<div class='card-body'>";
$result = $mysqli->query("SELECT * FROM wallet_savings WHERE user_id = 1");
if ($result && $result->num_rows > 0) {
    echo "<table class='table'><thead><tr><th>ID</th><th>Montant</th><th>Taux</th><th>Date début</th><th>Statut</th></tr></thead><tbody>";
    while ($saving = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $saving['saving_id'] . "</td>";
        echo "<td>$" . $saving['amount'] . "</td>";
        echo "<td>" . $saving['interest_rate'] . "%</td>";
        echo "<td>" . $saving['start_date'] . "</td>";
        echo "<td>" . $saving['status'] . "</td>";
        echo "</tr>";
    }
    echo "</tbody></table>";
} else {
    echo "<p class='text-muted'>Aucune épargne pour le moment</p>";
}
echo "</div></div>";

// Vérifier les emprunts
echo "<div class='card mb-3'>";
echo "<div class='card-header'><h3>💳 Emprunts</h3></div>";
echo "<div class='card-body'>";
$result = $mysqli->query("SELECT * FROM wallet_loans WHERE user_id = 1");
if ($result && $result->num_rows > 0) {
    echo "<table class='table'><thead><tr><th>ID</th><th>Montant</th><th>Taux</th><th>Mensualité</th><th>Reste à payer</th><th>Statut</th></tr></thead><tbody>";
    while ($loan = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $loan['loan_id'] . "</td>";
        echo "<td>$" . $loan['amount'] . "</td>";
        echo "<td>" . $loan['interest_rate'] . "%</td>";
        echo "<td>$" . $loan['monthly_payment'] . "</td>";
        echo "<td>$" . $loan['amount_remaining'] . "</td>";
        echo "<td>" . $loan['status'] . "</td>";
        echo "</tr>";
    }
    echo "</tbody></table>";
} else {
    echo "<p class='text-muted'>Aucun emprunt pour le moment</p>";
}
echo "</div></div>";

// Formulaire pour créer une épargne
echo "<div class='card mb-3'>";
echo "<div class='card-header'><h3>➕ Créer une Épargne</h3></div>";
echo "<div class='card-body'>";
echo "<form method='POST' action='wallet_test.php'>";
echo "<div class='mb-3'><label>Montant ($)</label><input type='number' name='saving_amount' class='form-control' step='0.01' required></div>";
echo "<div class='mb-3'><label>Taux d'intérêt (%)</label><input type='number' name='saving_rate' class='form-control' step='0.01' value='5.00' required></div>";
echo "<div class='mb-3'><label>Date d'échéance</label><input type='date' name='saving_maturity' class='form-control'></div>";
echo "<button type='submit' name='create_saving' class='btn btn-primary'>Créer l'épargne</button>";
echo "</form>";
echo "</div></div>";

// Traitement de la création d'épargne
if (isset($_POST['create_saving'])) {
    $amount = floatval($_POST['saving_amount']);
    $rate = floatval($_POST['saving_rate']);
    $maturity = !empty($_POST['saving_maturity']) ? "'" . $mysqli->real_escape_string($_POST['saving_maturity']) . "'" : "NULL";

    $sql = "INSERT INTO wallet_savings (user_id, amount, interest_rate, start_date, maturity_date, status)
            VALUES (1, $amount, $rate, NOW(), $maturity, 'active')";

    if ($mysqli->query($sql)) {
        echo "<div class='alert alert-success'>✅ Épargne créée avec succès!</div>";
        echo "<script>setTimeout(function(){ location.reload(); }, 1500);</script>";
    } else {
        echo "<div class='alert alert-danger'>❌ Erreur: " . $mysqli->error . "</div>";
    }
}

$mysqli->close();

echo "<hr><p class='text-muted'>Pour accéder au site complet: <a href='http://localhost:8080'>http://localhost:8080</a></p>";
echo "</body></html>";
?>
