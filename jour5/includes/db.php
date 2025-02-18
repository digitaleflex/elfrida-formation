<?php
// Inclusion du fichier de configuration
require_once('config.php');

try {
    // Connexion à la base de données avec PDO
    $pdo = new PDO(
        "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8",
        DB_USER,
        DB_PASS,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
        ]
    );
} catch (PDOException $e) {
    // En cas d'erreur, afficher un message d'erreur
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}
?> 