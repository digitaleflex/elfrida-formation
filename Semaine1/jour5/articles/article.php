<?php
require_once('../includes/db.php');
require_once('../includes/header.php');

if (isset($_GET['id'])) {
    $article_id = $_GET['id'];

    // Récupérer l'article par ID
    $stmt = $pdo->prepare("SELECT * FROM articles WHERE id = ?");
    $stmt->execute([$article_id]);
    $article = $stmt->fetch();

    if ($article) {
        echo '<div class="card mb-4">';
        echo '<div class="card-body">';
        echo '<h2 class="card-title">' . htmlspecialchars($article['titre']) . '</h2>';
        echo '<p class="text-muted">Publié le ' . date('d/m/Y', strtotime($article['date_creation'])) . '</p>';
        echo '<div class="card-text">' . nl2br(htmlspecialchars($article['contenu'])) . '</div>';
        echo '</div>';
        echo '</div>';

        // Afficher les commentaires associés
        require_once('../commentaires/afficher_commentaires.php');
        
        // Formulaire d'ajout de commentaire
        require_once('../commentaires/ajouter_commentaire.php');
    } else {
        echo '<div class="alert alert-warning">Article non trouvé.</div>';
    }
} else {
    echo '<div class="alert alert-warning">Article non spécifié.</div>';
}

require_once('../includes/footer.php');
?>
