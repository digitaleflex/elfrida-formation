<?php
// Configuration de base
define('DB_HOST', 'localhost');
define('DB_NAME', 'auth_project');
define('DB_USER', 'root'); // À modifier si nécessaire
define('DB_PASSWORD', ''); // À modifier si nécessaire

try {
    // Connexion à la base de données
    $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8", DB_USER, DB_PASSWORD);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}
?>
