<?php
$host = 'localhost';
$dbname = 'restaurant';
$username = 'root';
$password = '';

try {
    $conn = new mysqli($host, $username, $password, $dbname);
    if ($conn->connect_error) {
        throw new Exception("Erreur de connexion : " . $conn->connect_error);
    }
} catch (Exception $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}
?>
