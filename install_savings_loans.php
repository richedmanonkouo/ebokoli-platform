<?php
/**
 * Installation Script - Savings & Loans Module
 * Execute this file once to install the module
 * Access via: http://localhost:8080/install_savings_loans.php
 */

// Use existing bootstrap to get DB connection
require('bootloader.php');

echo "<!DOCTYPE html>
<html>
<head>
    <meta charset='UTF-8'>
    <title>Installation - Savings & Loans Module</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 800px; margin: 50px auto; padding: 20px; }
        .success { color: green; padding: 10px; background: #d4edda; border: 1px solid green; margin: 10px 0; }
        .error { color: red; padding: 10px; background: #f8d7da; border: 1px solid red; margin: 10px 0; }
        .info { color: blue; padding: 10px; background: #d1ecf1; border: 1px solid blue; margin: 10px 0; }
        h1 { color: #333; }
        pre { background: #f4f4f4; padding: 10px; overflow-x: auto; }
    </style>
</head>
<body>
    <h1>📊 Installation du Module Épargne & Emprunts</h1>";

try {
    // Use existing database connection
    global $db;
    echo "<div class='info'>🔌 Utilisation de la connexion DB existante...</div>";
    echo "<div class='success'>✅ Connexion réussie à la base de données</div>";

    // Read SQL file
    echo "<div class='info'>📄 Lecture du fichier SQL...</div>";
    $sql_file = __DIR__ . '/wallet_savings_loans.sql';

    if (!file_exists($sql_file)) {
        throw new Exception("Fichier SQL introuvable : $sql_file");
    }

    $sql = file_get_contents($sql_file);

    // Split queries
    $queries = array_filter(array_map('trim', explode(';', $sql)));

    echo "<div class='info'>📝 Exécution de " . count($queries) . " requêtes SQL...</div>";

    $success_count = 0;
    $error_count = 0;

    // Execute queries
    foreach ($queries as $query) {
        if (empty($query) || strpos($query, '--') === 0) {
            continue;
        }

        if ($db->query($query)) {
            $success_count++;
            echo "<div class='success'>✓ Requête exécutée avec succès</div>";
        } else {
            $error_count++;
            echo "<div class='error'>✗ Erreur : " . $db->error . "</div>";
            echo "<pre>" . htmlspecialchars(substr($query, 0, 200)) . "...</pre>";
        }
    }

    echo "<h2>📊 Résumé de l'installation</h2>";
    echo "<div class='success'>✅ Requêtes réussies : $success_count</div>";

    if ($error_count > 0) {
        echo "<div class='error'>❌ Erreurs : $error_count</div>";
    }

    // Verify tables
    echo "<h2>🔍 Vérification des tables créées</h2>";

    $tables = ['wallet_savings', 'wallet_loans', 'wallet_loan_payments'];

    foreach ($tables as $table) {
        $result = $db->query("SHOW TABLES LIKE '$table'");
        if ($result && $result->num_rows > 0) {
            echo "<div class='success'>✓ Table '$table' existe</div>";
        } else {
            echo "<div class='error'>✗ Table '$table' n'existe pas</div>";
        }
    }

    // Check if user columns exist
    echo "<h2>🔍 Vérification des colonnes users</h2>";
    $result = $db->query("SHOW COLUMNS FROM users LIKE 'user_total_savings'");
    if ($result && $result->num_rows > 0) {
        echo "<div class='success'>✓ Colonne 'user_total_savings' ajoutée</div>";
    } else {
        echo "<div class='error'>✗ Colonne 'user_total_savings' manquante</div>";
    }

    $result = $db->query("SHOW COLUMNS FROM users LIKE 'user_total_loans'");
    if ($result && $result->num_rows > 0) {
        echo "<div class='success'>✓ Colonne 'user_total_loans' ajoutée</div>";
    } else {
        echo "<div class='error'>✗ Colonne 'user_total_loans' manquante</div>";
    }

    echo "<h2>🎉 Installation terminée !</h2>";
    echo "<div class='success'><strong>Prochaines étapes :</strong><br>
    1. Intégrez les méthodes dans class-user.php<br>
    2. Ajoutez le JavaScript dans votre template<br>
    3. Testez les fonctionnalités sur votre site<br><br>
    <a href='wallet'>🔗 Aller au Wallet</a></div>";

    echo "<div class='info'><strong>⚠️ Important :</strong> Supprimez ce fichier (install_savings_loans.php) après l'installation pour des raisons de sécurité !</div>";

} catch (Exception $e) {
    echo "<div class='error'><strong>❌ Erreur :</strong> " . $e->getMessage() . "</div>";
}

echo "</body></html>";
?>
