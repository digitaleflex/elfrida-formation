<?php
if (isset($article_id)) {
    // Récupérer tous les commentaires associés à l'article
    $stmt = $pdo->prepare("SELECT auteur, commentaire, date_creation FROM commentaires WHERE article_id = ? ORDER BY date_creation DESC");
    $stmt->execute([$article_id]);
    $commentaires = $stmt->fetchAll();

    echo '<div class="mt-5">';
    echo '<h3 class="mb-4">Commentaires</h3>';
    
    if ($commentaires) {
        foreach ($commentaires as $commentaire) {
            echo '<div class="card mb-3">';
            echo '<div class="card-body">';
            echo '<div class="d-flex justify-content-between">';
            echo '<h5 class="card-title">' . htmlspecialchars($commentaire['auteur']) . '</h5>';
            echo '<small class="text-muted">Le ' . date('d/m/Y à H:i', strtotime($commentaire['date_creation'])) . '</small>';
            echo '</div>';
            echo '<p class="card-text">' . nl2br(htmlspecialchars($commentaire['commentaire'])) . '</p>';
            echo '</div>';
            echo '</div>';
        }
    } else {
        echo '<div class="alert alert-info">Aucun commentaire pour cet article.</div>';
    }
    echo '</div>';
}
?>
