<?php

date_default_timezone_set('Europe/Paris');

require_once __DIR__ . '/../app/config/Constants.php';

// session_set_cookie_params([
//     'lifetime' => 0,
//     'path' => '/',
//     'domain' => 'web4all.local',    // ton domaine
//     'secure' => false,              // mettre true -> HTTPS obligatoire
//     'httponly' => true,             // impossible d’y accéder via JS
//     'samesite' => 'Strict'          // ou Lax selon besoin
// ]);
session_start();

require_once __DIR__ . '/../app/core/Autoloader.php';
Autoloader::register();

// Initialisation permissions guest si non définies
if (!isset($_SESSION['permissions'])) {

    $db = Database::getInstance();

    $stmt = $db->prepare("
        SELECT permission
        FROM permission
        WHERE id_role = 4 AND allowed = true
    ");
    $stmt->execute();

    $_SESSION['permissions'] = $stmt->fetchAll(PDO::FETCH_COLUMN);
}


$router = new Router();
$router->dispatch();
