<?php
/**
 * Router pour le serveur PHP dev
 * Simule les règles .htaccess pour permettre les URLs propres
 */

// Récupérer l'URI demandée
$request_uri = $_SERVER['REQUEST_URI'];
$script_name = $_SERVER['SCRIPT_NAME'];

// Nettoyer l'URI
$uri = parse_url($request_uri, PHP_URL_PATH);
$uri = trim($uri, '/');

// Debug désactivé en production (décommenter pour debug)
// $debug_log = fopen(__DIR__ . '/router_debug.log', 'a');
// fwrite($debug_log, "\n=== " . date('Y-m-d H:i:s') . " ===\n");
// fwrite($debug_log, "REQUEST_URI: $request_uri\n");
// fwrite($debug_log, "URI nettoyée: $uri\n");

// Si c'est un fichier statique qui existe (pas PHP), le servir directement
if ($uri && file_exists($uri) && !is_dir($uri)) {
    // Ne servir directement que les fichiers non-PHP
    $extension = pathinfo($uri, PATHINFO_EXTENSION);
    if (!in_array($extension, ['php'])) {
        // fwrite($debug_log, "Fichier statique trouvé: $uri\n");
        // fclose($debug_log);
        return false; // Laisser le serveur PHP servir le fichier
    }
}

// Routes personnalisées
$routes = [
    // Wallet routes
    'wallet' => 'wallet.php',
    'wallet/payments' => 'wallet.php?view=payments',
    'wallet/savings' => 'wallet.php?view=savings',
    'wallet/loans' => 'wallet.php?view=loans',

    // Admin routes
    'admincp' => 'admin.php',
    'admincp/(.+)' => 'admin.php?view=$1',

    // Settings
    'settings' => 'settings.php',
    'settings/(.+)' => 'settings.php?view=$1',

    // Messages
    'messages' => 'messages.php',
    'messages/(.+)' => 'messages.php?cid=$1',

    // Notifications
    'notifications' => 'notifications.php',

    // Search
    'search/(.+)' => 'search.php?query=$1',
    'search' => 'search.php',

    // Static pages
    'static/(.+)' => 'static.php?url=$1',

    // Pages
    'page/(.+)' => 'page.php?name=$1',

    // Groups
    'groups' => 'groups.php',
    'group/(.+)' => 'group.php?username=$1',

    // Events
    'events' => 'events.php',
    'event/(.+)' => 'event.php?event_id=$1',

    // Posts
    'posts/(.+)' => 'post.php?post_id=$1',
    'photo/(.+)' => 'photo.php?photo_id=$1',

    // Market
    'market' => 'market.php',
    'market/(.+)' => 'market.php?view=$1',

    // Jobs
    'jobs' => 'jobs.php',
    'jobs/(.+)' => 'jobs.php?view=$1',

    // Funding
    'funding' => 'funding.php',
    'funding/(.+)' => 'funding.php?view=$1',

    // Forums
    'forums' => 'forums.php',

    // Offers
    'offers' => 'offers.php',

    // Movies
    'movies' => 'movies.php',

    // Games
    'games' => 'games.php',

    // Developers
    'developers' => 'developers.php',
    'developers/(.+)' => 'developers.php?view=$1',

    // Directory
    'directory' => 'directory.php',
    'directory/(.+)' => 'directory.php?view=$1',

    // Blogs
    'blogs' => 'blogs.php',
    'blogs/(.+)' => 'blogs.php?view=$1',
];

// Vérifier les routes avec paramètres
foreach ($routes as $pattern => $target) {
    if (strpos($pattern, '(') !== false) {
        // Route avec regex
        $regex = '#^' . $pattern . '$#';
        if (preg_match($regex, $uri, $matches)) {
            error_log("Router - Route regex trouvée: $pattern -> $target");
            array_shift($matches); // Enlever le match complet

            // Remplacer les $1, $2, etc. par les valeurs capturées
            $target_replaced = $target;
            foreach ($matches as $index => $match) {
                $target_replaced = str_replace('$' . ($index + 1), $match, $target_replaced);
            }

            $_SERVER['SCRIPT_NAME'] = '/' . explode('?', $target_replaced)[0];
            if (strpos($target_replaced, '?') !== false) {
                list($file, $query) = explode('?', $target_replaced, 2);
                parse_str($query, $params);
                $_GET = array_merge($_GET, $params);
                $_REQUEST = array_merge($_REQUEST, $params);
            } else {
                $file = $target_replaced;
            }
            error_log("Router - Chargement fichier: $file");
            require $file;
            exit;
        }
    } else {
        // Route simple
        if ($uri === $pattern) {
            // fwrite($debug_log, "✓ Route simple trouvée: $pattern -> $target\n");
            $_SERVER['SCRIPT_NAME'] = '/' . explode('?', $target)[0];
            if (strpos($target, '?') !== false) {
                list($file, $query) = explode('?', $target, 2);
                parse_str($query, $params);
                $_GET = array_merge($_GET, $params);
                $_REQUEST = array_merge($_REQUEST, $params);
            } else {
                $file = $target;
            }
            // fwrite($debug_log, "Chargement fichier: $file\n");
            // fclose($debug_log);
            require $file;
            exit;
        }
    }
}

// fwrite($debug_log, "✗ Aucune route trouvée\n");

// Si pas de correspondance et que l'URI n'est pas vide
// C'est peut-être un profil utilisateur
if ($uri && !strpos($uri, '.') && !strpos($uri, '/')) {
    // fwrite($debug_log, "→ Tentative de routage vers profil: $uri\n");
    // fclose($debug_log);
    // Vérifier si c'est un username valide
    $_GET['username'] = $uri;
    $_REQUEST['username'] = $uri;
    $_SERVER['SCRIPT_NAME'] = '/profile.php';
    require 'profile.php';
    exit;
}

// Route par défaut (homepage)
if (empty($uri) || $uri === 'index.php') {
    // fwrite($debug_log, "→ Route par défaut (homepage)\n");
    // fclose($debug_log);
    require 'index.php';
    exit;
}

// Si rien ne correspond, 404
// fwrite($debug_log, "→ 404 Not Found\n");
// fclose($debug_log);
http_response_code(404);
echo "404 - Page not found";
exit;
?>
