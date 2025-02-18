<?php
require_once('includes/config.php');
require_once('includes/header.php');
?>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8 text-center">
            <div class="error-page">
                <h1 class="display-1 text-primary mb-3">404</h1>
                <h2 class="h3 mb-4">Page non trouvée</h2>
                <p class="lead text-muted mb-5">
                    Désolé, la page que vous recherchez n'existe pas ou a été déplacée.
                </p>
                <div class="error-actions">
                    <a href="/index.php" class="btn btn-primary me-3">
                        <i class="fas fa-home me-2"></i>Retour à l'accueil
                    </a>
                    <a href="/articles.php" class="btn btn-outline-primary">
                        <i class="fas fa-newspaper me-2"></i>Voir les articles
                    </a>
                </div>
            </div>

            <!-- Suggestions d'articles -->
            <div class="mt-5 pt-5 border-top">
                <h3 class="h4 mb-4">Articles qui pourraient vous intéresser</h3>
                <div class="row row-cols-1 row-cols-md-2 g-4">
                    <?php
                    // Récupérer quelques articles aléatoires
                    $stmt = $pdo->query("SELECT * FROM articles ORDER BY RAND() LIMIT 2");
                    while ($article = $stmt->fetch()) {
                        ?>
                        <div class="col">
                            <div class="card h-100 shadow-sm">
                                <div class="card-body">
                                    <h4 class="card-title h5">
                                        <a href="/article.php?id=<?php echo $article['id']; ?>" class="text-decoration-none">
                                            <?php echo htmlspecialchars($article['titre']); ?>
                                        </a>
                                    </h4>
                                    <p class="card-text small">
                                        <?php 
                                        $extrait = substr(strip_tags($article['contenu']), 0, 100);
                                        echo htmlspecialchars($extrait) . '...'; 
                                        ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.error-page {
    padding: 40px 0;
}
.error-page .display-1 {
    font-size: 8rem;
    font-weight: 700;
    text-shadow: 2px 2px 4px rgba(0,0,0,0.1);
}
.error-actions {
    margin-bottom: 40px;
}
.card {
    transition: transform 0.3s ease;
}
.card:hover {
    transform: translateY(-5px);
}
</style>

<?php require_once('includes/footer.php'); ?> 