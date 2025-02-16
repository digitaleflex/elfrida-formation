<?php
// Connexion à la base de données
$host = 'localhost';
$dbname = 'restaurant';
$username = 'root'; // Remplacez par votre utilisateur MySQL
$password = ''; // Remplacez par votre mot de passe MySQL

header('Content-Type: application/json');

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);

    // Récupérer les commandes avec le nom du client
    $stmt = $pdo->query("SELECT commandes.id, clients.nom, commandes.produit, commandes.statut 
                         FROM commandes 
                         INNER JOIN clients ON commandes.client_id = clients.id 
                         ORDER BY commandes.id DESC");

    echo json_encode($stmt->fetchAll());

} catch (PDOException $e) {
    echo json_encode(["error" => "Erreur de connexion : " . $e->getMessage()]);
}
?>
