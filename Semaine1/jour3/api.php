<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type");

// Connexion à la base de données
require_once 'config.php'; // Assurez-vous que ce fichier contient la connexion à la BD

// Récupération de la méthode HTTP
$method = $_SERVER['REQUEST_METHOD'];

// Récupération des données JSON (si applicable)
$data = json_decode(file_get_contents("php://input"), true);

switch ($method) {
    case 'GET':
        // Lire les commandes
        $sql = "SELECT commandes.id, clients.nom, clients.email, commandes.produit, commandes.statut 
                FROM commandes
                JOIN clients ON commandes.client_id = clients.id";
        $result = $conn->query($sql);

        $commandes = [];
        while ($row = $result->fetch_assoc()) {
            $commandes[] = $row;
        }

        echo json_encode(["success" => true, "commandes" => $commandes]);
        break;

    case 'POST':
        // Ajouter une commande
        if (!isset($data['nom'], $data['email'], $data['produit'])) {
            echo json_encode(["success" => false, "message" => "Données incomplètes"]);
            exit;
        }

        // Vérifier si le client existe déjà
        $sql = "SELECT id FROM clients WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $data['email']);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($client_id);
            $stmt->fetch();
        } else {
            // Insérer un nouveau client
            $sql = "INSERT INTO clients (nom, email) VALUES (?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ss", $data['nom'], $data['email']);
            $stmt->execute();
            $client_id = $stmt->insert_id;
        }

        // Insérer la commande
        $sql = "INSERT INTO commandes (client_id, produit, statut) VALUES (?, ?, 'en attente')";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("is", $client_id, $data['produit']);
        if ($stmt->execute()) {
            echo json_encode(["success" => true, "message" => "Commande ajoutée"]);
        } else {
            echo json_encode(["success" => false, "message" => "Erreur d'ajout"]);
        }
        break;

    case 'PUT':
        // Modifier une commande
        if (!isset($data['id'], $data['statut'])) {
            echo json_encode(["success" => false, "message" => "Données incomplètes"]);
            exit;
        }

        $sql = "UPDATE commandes SET statut = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $data['statut'], $data['id']);
        if ($stmt->execute()) {
            echo json_encode(["success" => true, "message" => "Commande mise à jour"]);
        } else {
            echo json_encode(["success" => false, "message" => "Erreur de mise à jour"]);
        }
        break;

    case 'DELETE':
        // Supprimer une commande
        if (!isset($data['id'])) {
            echo json_encode(["success" => false, "message" => "ID manquant"]);
            exit;
        }

        $sql = "DELETE FROM commandes WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $data['id']);
        if ($stmt->execute()) {
            echo json_encode(["success" => true, "message" => "Commande supprimée"]);
        } else {
            echo json_encode(["success" => false, "message" => "Erreur de suppression"]);
        }
        break;

    default:
        echo json_encode(["success" => false, "message" => "Méthode non autorisée"]);
        break;
}

// Fermer la connexion
$conn->close();
?>
