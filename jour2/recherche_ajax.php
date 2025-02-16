<?php
require 'db.php';

// Récupérer la requête de recherche
$query = isset($_GET['query']) ? trim($_GET['query']) : '';

if (!empty($query)) {
    // Préparer la requête SQL
    $stmt = $pdo->prepare("SELECT * FROM produits WHERE nom LIKE :query LIMIT 10");
    $stmt->execute([':query' => "%$query%"]);
    $resultats = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (!empty($resultats)) {
        // Générer la liste des résultats
        foreach ($resultats as $produit) {
            echo '<a href="index.php#produit-' . htmlspecialchars($produit['id']) . '" class="list-group-item list-group-item-action">';
            echo htmlspecialchars($produit['nom']);
            echo '</a>';
        }
    } else {
        echo '<div class="list-group-item">Aucun produit trouvé correspondant à votre recherche.</div>';
    }
} else {
    echo '<div class="list-group-item">Veuillez entrer un terme de recherche.</div>';
}
?>