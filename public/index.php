<?php

// ➤ Afficher toutes les erreurs PHP (développement uniquement)
ini_set('display_errors', 1);
error_reporting(E_ALL);

// ➤ Définir le chemin absolu vers le dossier "app"
define('APP', dirname(__DIR__) . '/app');

// ➤ Définir l'URL de base du projet (à adapter si tu changes le nom du dossier)
define('BASE_URL', '/projet-web/public');

// ➤ Charger l'autoloader pour les classes
require_once APP . '/core/Autoloader.php';
Autoloader::register();

// ➤ Démarrer la session (utile pour auth, messages flash, etc.)
session_start();

// ➤ Lancer le routeur MVC
$router = new Router();
$router->dispatch();
