<?php
require_once('includes/db.php');
require_once('includes/header.php');

// Récupérer tous les articles
$stmt = $pdo->prepare("SELECT * FROM articles ORDER BY date_creation DESC");
$stmt->execute();
$articles = $stmt->fetchAll();

if ($articles) {
    echo '<div class="row">';
    foreach ($articles as $article) {
        echo '<div class="col-md-6 mb-4">';
        echo '<div class="card h-100 shadow-sm">';
        echo '<div class="card-body">';
        echo '<h2 class="card-title h4"><a href="articles/article.php?id=' . $article['id'] . '" class="text-decoration-none">' . htmlspecialchars($article['titre']) . '</a></h2>';
        echo '<p class="card-text">' . nl2br(htmlspecialchars(substr($article['contenu'], 0, 200))) . '...</p>';
        echo '<a href="articles/article.php?id=' . $article['id'] . '" class="btn btn-primary">Lire la suite</a>';
        echo '</div>';
        echo '<div class="card-footer text-muted">';
        echo 'Publié le ' . date('d/m/Y', strtotime($article['date_creation']));
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }
    echo '</div>';
} else {
    echo '<div class="alert alert-info">Aucun article disponible.</div>';
}

require_once('includes/footer.php');
?>
