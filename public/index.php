<?php
// public/index.php

// démarrer la session
session_start();

// constantes
define('BASE_URL', 'http://localhost/projet-web/public'); // adapte si besoin
define('APP', dirname(__DIR__) . '/app');

// afficher les erreurs en dev (désactiver en prod)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// autoloader + routeur
require_once APP . '/core/Autoloader.php';
Autoloader::register();

require_once APP . '/core/Router.php';

// dispatcher
$router = new Router();
$router->dispatch();
