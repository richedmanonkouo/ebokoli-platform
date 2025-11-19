<?php
/**
 * Rechargement Manuel du Wallet (Admin)
 * Avec conversion EUR → XAF
 * Exécuter: php admin_recharge_wallet.php
 */

$config_file = __DIR__ . '/includes/config.php';
if (!file_exists($config_file)) {
  echo "❌ Fichier config.php non trouvé\n";
  exit(1);
}

require($config_file);

$db = new mysqli($mysqlhost, $mysqlusername, $mysqlpassword, $mysqldatabase);

if ($db->connect_error) {
  echo "❌ ERREUR connexion : " . $db->connect_error . "\n";
  exit(1);
}

echo "\n╔════════════════════════════════════════╗\n";
echo "║  RECHARGEMENT WALLET (Admin)           ║\n";
echo "║  Conversion EUR → XAF                  ║\n";
echo "╚════════════════════════════════════════╝\n\n";

// Taux de conversion EUR → XAF (à jour au 16 oct 2025)
$EUR_TO_XAF = 655.957; // 1 EUR = 655.957 XAF

echo "💱 Taux de conversion : 1 EUR = $EUR_TO_XAF XAF\n\n";

// Liste des utilisateurs
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
echo "UTILISATEURS\n";
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n\n";

$users = $db->query("SELECT user_id, user_name, user_firstname, user_lastname, user_wallet_balance
                     FROM users
                     WHERE user_activated = '1'
                     ORDER BY user_id ASC
                     LIMIT 20");

if (!$users || $users->num_rows == 0) {
  echo "❌ Aucun utilisateur trouvé\n";
  exit(1);
}

$user_list = [];
while ($u = $users->fetch_assoc()) {
  $user_list[$u['user_id']] = $u;
  printf("[%d] %s %s (@%s) - Wallet: %.2f XAF\n",
    $u['user_id'],
    $u['user_firstname'],
    $u['user_lastname'],
    $u['user_name'],
    $u['user_wallet_balance']
  );
}

// Sélection de l'utilisateur
echo "\n━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
echo "Entrez l'ID de l'utilisateur : ";
$handle = fopen("php://stdin", "r");
$user_id = trim(fgets($handle));

if (!isset($user_list[$user_id])) {
  echo "❌ ID utilisateur invalide\n";
  exit(1);
}

$selected_user = $user_list[$user_id];
echo "\n✅ Utilisateur sélectionné : " . $selected_user['user_firstname'] . " " . $selected_user['user_lastname'] . "\n";
echo "   Solde actuel : " . number_format($selected_user['user_wallet_balance'], 2) . " XAF\n\n";

// Montant à recharger
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
echo "MONTANT À RECHARGER\n";
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n\n";
echo "Choisissez la devise :\n";
echo "  1. EUR (Euro)\n";
echo "  2. XAF (Franc CFA)\n";
echo "Votre choix (1 ou 2) : ";

$currency_choice = trim(fgets($handle));

if ($currency_choice == '1') {
  echo "\nMontant en EUR : ";
  $amount_eur = (float)trim(fgets($handle));

  if ($amount_eur <= 0) {
    echo "❌ Montant invalide\n";
    exit(1);
  }

  $amount_xaf = $amount_eur * $EUR_TO_XAF;

  echo "\n💱 Conversion :\n";
  echo "   " . number_format($amount_eur, 2) . " EUR\n";
  echo "   = " . number_format($amount_xaf, 2) . " XAF\n\n";
} else {
  echo "\nMontant en XAF : ";
  $amount_xaf = (float)trim(fgets($handle));

  if ($amount_xaf <= 0) {
    echo "❌ Montant invalide\n";
    exit(1);
  }

  $amount_eur = $amount_xaf / $EUR_TO_XAF;

  echo "\n📊 Information :\n";
  echo "   " . number_format($amount_xaf, 2) . " XAF\n";
  echo "   ≈ " . number_format($amount_eur, 2) . " EUR\n\n";
}

// Confirmation
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
echo "CONFIRMATION\n";
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n\n";
echo "Utilisateur : " . $selected_user['user_firstname'] . " " . $selected_user['user_lastname'] . "\n";
echo "Solde actuel : " . number_format($selected_user['user_wallet_balance'], 2) . " XAF\n";
echo "Recharge : " . number_format($amount_xaf, 2) . " XAF\n";
echo "Nouveau solde : " . number_format($selected_user['user_wallet_balance'] + $amount_xaf, 2) . " XAF\n\n";

echo "Confirmer le rechargement ? (oui/non) : ";
$confirm = trim(fgets($handle));

if (strtolower($confirm) !== 'oui' && strtolower($confirm) !== 'o' && strtolower($confirm) !== 'yes') {
  echo "\n❌ Rechargement annulé\n";
  exit(0);
}

// Effectuer le rechargement
$new_balance = $selected_user['user_wallet_balance'] + $amount_xaf;

$update = $db->prepare("UPDATE users SET user_wallet_balance = ? WHERE user_id = ?");
$update->bind_param("di", $new_balance, $user_id);

if ($update->execute()) {
  echo "\n✅ RECHARGEMENT RÉUSSI !\n\n";

  // Enregistrer la transaction
  $date = date('Y-m-d H:i:s');
  $insert_transaction = $db->prepare("INSERT INTO wallet_transactions (user_id, type, amount, node_type, node_id, date) VALUES (?, 'in', ?, 'recharge', 0, ?)");
  $insert_transaction->bind_param("ids", $user_id, $amount_xaf, $date);
  $insert_transaction->execute();

  echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
  echo "📊 RÉSUMÉ\n";
  echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
  echo "Utilisateur : " . $selected_user['user_firstname'] . " " . $selected_user['user_lastname'] . "\n";
  echo "Montant rechargé : " . number_format($amount_xaf, 2) . " XAF\n";
  echo "Nouveau solde : " . number_format($new_balance, 2) . " XAF\n";
  echo "Transaction enregistrée : OUI\n";
  echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n\n";
} else {
  echo "\n❌ ERREUR lors du rechargement : " . $db->error . "\n";
  exit(1);
}

fclose($handle);
?>
