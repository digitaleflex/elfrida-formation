<?php
require_once('includes/config.php');
require_once('includes/db.php');
require_once('includes/header.php');

// Récupérer quelques articles aléatoires pour les suggestions
$stmt = $pdo->query("SELECT * FROM articles ORDER BY RAND() LIMIT 3");
$articles_suggeres = $stmt->fetchAll();
?>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8 text-center">
            <!-- Section Erreur -->
            <div class="error-content mb-5">
                <div class="error-number mb-4">
                    <span class="display-1 text-primary fw-bold">4</span>
                    <span class="display-1 text-primary fw-bold rotating">0</span>
                    <span class="display-1 text-primary fw-bold">4</span>
                </div>
                <h1 class="h2 mb-4">Oups ! Page introuvable</h1>
                <p class="lead text-muted mb-5">
                    La page que vous recherchez semble avoir disparu dans le cyberespace...
                </p>
                <div class="error-actions d-flex justify-content-center gap-3">
                    <a href="/index.php" class="btn btn-primary btn-lg">
                        <i class="fas fa-home me-2"></i>Retour à l'accueil
                    </a>
                    <a href="/articles.php" class="btn btn-outline-primary btn-lg">
                        <i class="fas fa-newspaper me-2"></i>Voir les articles
                    </a>
                </div>
            </div>

            <!-- Section Suggestions -->
            <?php if (!empty($articles_suggeres)): ?>
            <div class="suggestions-section mt-5 pt-5 border-top">
                <h2 class="h4 mb-4">Articles qui pourraient vous intéresser</h2>
                <div class="row g-4">
                    <?php foreach ($articles_suggeres as $article): ?>
                    <div class="col-md-4">
                        <div class="card h-100 border-0 shadow-sm article-card">
                            <div class="card-body">
                                <div class="article-meta mb-2">
                                    <small class="text-muted">
                                        <i class="far fa-calendar-alt me-1"></i>
                                        <?php echo date('d/m/Y', strtotime($article['date_creation'])); ?>
                                    </small>
                                </div>
                                <h3 class="h6 card-title">
                                    <a href="/article.php?id=<?php echo $article['id']; ?>" 
                                       class="text-decoration-none text-dark stretched-link">
                                        <?php echo htmlspecialchars($article['titre']); ?>
                                    </a>
                                </h3>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endif; ?>

            <!-- Section Support -->
            <div class="support-section mt-5 pt-5 border-top">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <h3 class="h5 mb-3">Besoin d'aide ?</h3>
                        <p class="text-muted mb-3">
                            Si vous pensez qu'il s'agit d'une erreur, n'hésitez pas à nous contacter.
                        </p>
                        <a href="mailto:support@example.com" class="btn btn-outline-primary">
                            <i class="fas fa-envelope me-2"></i>Contacter le support
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Animations pour la page 404 */
.error-number {
    position: relative;
    display: inline-flex;
    gap: 0.5rem;
}

.rotating {
    display: inline-block;
    animation: rotate 10s infinite linear;
    transform-origin: center;
}

@keyframes rotate {
    0% { transform: rotateY(0deg); }
    100% { transform: rotateY(360deg); }
}

.error-content {
    animation: fadeInUp 0.5s ease-out;
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.article-card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.article-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
}

.support-section .card {
    transition: transform 0.3s ease;
}

.support-section .card:hover {
    transform: translateY(-5px);
}

.btn {
    transition: all 0.3s ease;
}

.btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}
</style>

<?php require_once('includes/footer.php'); ?> 