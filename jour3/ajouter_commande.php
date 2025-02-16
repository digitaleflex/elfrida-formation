<?php
// Connexion à la base de données
$host = 'localhost';
$dbname = 'restaurant';
$username = 'root'; // Remplacez par votre utilisateur MySQL
$password = ''; // Remplacez par votre mot de passe MySQL

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}

// Vérifier si les données ont été envoyées via POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nom = trim($_POST['nom']);
    $email = trim($_POST['email']);
    $produit = trim($_POST['produit']);

    // Vérifier si les champs ne sont pas vides
    if (empty($nom) || empty($email) || empty($produit)) {
        die("Tous les champs sont requis.");
    }

    try {
        // Vérifier si le client existe déjà
        $stmt = $pdo->prepare("SELECT id FROM clients WHERE email = ?");
        $stmt->execute([$email]);
        $client = $stmt->fetch();

        if (!$client) {
            // Insérer un nouveau client
            $stmt = $pdo->prepare("INSERT INTO clients (nom, email) VALUES (?, ?)");
            $stmt->execute([$nom, $email]);
            $client_id = $pdo->lastInsertId();
        } else {
            $client_id = $client['id'];
        }

        // Insérer la commande
        $stmt = $pdo->prepare("INSERT INTO commandes (client_id, produit, statut) VALUES (?, ?, 'en attente')");
        $stmt->execute([$client_id, $produit]);

        echo "Commande ajoutée avec succès !";
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
} else {
    echo "Méthode non autorisée.";
}
?>
