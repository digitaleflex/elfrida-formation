<?php
// Paramètres de connexion à la base de données
$host = 'localhost';
$dbname = 'auth_project';
$username = 'root'; // À modifier si besoin
$password = ''; // À modifier si besoin

try {
    // Connexion à la base de données avec PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}
