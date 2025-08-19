<?php
// config.php

// 🔹 Afficher les erreurs en mode développement
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// 🔹 Informations de connexion à la base de données
define('DB_HOST', 'localhost');
define('DB_NAME', 'projet_web');
define('DB_USER', 'root'); // utilisateur par défaut XAMPP
define('DB_PASS', '');     // mot de passe par défaut XAMPP (vide)

// 🔹 Paramètres globaux
define('BASE_URL', 'http://localhost/projet-web/'); // adapte selon ton dossier
define('APP_NAME', 'Plateforme de gestion d’événements');

// 🔹 Connexion PDO (singleton)
try {
    $pdo = new PDO(
        "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8",
        DB_USER,
        DB_PASS,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // gestion des erreurs
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // fetch associatif
            PDO::ATTR_EMULATE_PREPARES => false, // vraie préparation
        ]
    );
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}
