<?php
require_once('includes/db.php');
require_once('includes/header.php');

// Récupérer l'article le plus récent pour la section hero
$stmt = $pdo->prepare("SELECT * FROM articles ORDER BY date_creation DESC LIMIT 1");
$stmt->execute();
$featured_article = $stmt->fetch();

// Récupérer les autres articles
$stmt = $pdo->prepare("SELECT * FROM articles WHERE id != ? ORDER BY date_creation DESC LIMIT 6");
$stmt->execute([$featured_article['id']]);
$articles = $stmt->fetchAll();
?>

<!-- Section Hero avec l'article en vedette -->
<section class="hero-section mb-5">
    <div class="container">
        <div class="card hero-card border-0 overflow-hidden">
            <div class="card-body p-md-5 position-relative">
                <div class="hero-content">
                    <span class="badge bg-primary mb-3">Article à la une</span>
                    <h1 class="display-4 mb-3 hero-title">
                        <?php echo htmlspecialchars($featured_article['titre']); ?>
                    </h1>
                    <p class="lead mb-4">
                        <?php 
                        $extrait = substr(strip_tags($featured_article['contenu']), 0, 200);
                        echo htmlspecialchars($extrait) . '...'; 
                        ?>
                    </p>
                    <div class="hero-meta mb-4">
                        <span class="text-muted">
                            <i class="far fa-calendar-alt me-2"></i>
                            <?php echo date('d/m/Y', strtotime($featured_article['date_creation'])); ?>
                        </span>
                    </div>
                    <a href="articles/article.php?id=<?php echo $featured_article['id']; ?>" 
                       class="btn btn-primary btn-lg">
                        Lire l'article <i class="fas fa-arrow-right ms-2"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Section Articles récents -->
<section class="recent-articles py-5">
    <div class="container">
        <div class="section-header text-center mb-5">
            <h2 class="display-5 mb-3">Articles récents</h2>
            <div class="section-divider mb-4"></div>
            <p class="lead text-muted">Découvrez nos derniers articles sur la technologie et le développement</p>
        </div>

        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            <?php foreach ($articles as $article): ?>
                <div class="col">
                    <article class="card h-100 article-card border-0 shadow-sm">
                        <div class="card-body">
                            <div class="article-meta mb-3">
                                <small class="text-muted">
                                    <i class="far fa-calendar-alt me-1"></i>
                                    <?php echo date('d/m/Y', strtotime($article['date_creation'])); ?>
                                </small>
                            </div>
                            <h3 class="card-title h4">
                                <a href="articles/article.php?id=<?php echo $article['id']; ?>" class="stretched-link">
                                    <?php echo htmlspecialchars($article['titre']); ?>
                                </a>
                            </h3>
                            <p class="card-text">
                                <?php 
                                $extrait = substr(strip_tags($article['contenu']), 0, 150);
                                echo htmlspecialchars($extrait) . '...'; 
                                ?>
                            </p>
                        </div>
                        <div class="card-footer bg-transparent border-0 mt-auto">
                            <div class="d-flex align-items-center text-muted">
                                <i class="fas fa-tag me-2"></i>
                                <span>Technologie</span>
                            </div>
                        </div>
                    </article>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="text-center mt-5">
            <a href="articles.php" class="btn btn-outline-primary btn-lg">
                Voir tous les articles <i class="fas fa-arrow-right ms-2"></i>
            </a>
        </div>
    </div>
</section>

<!-- Section Newsletter -->
<section class="newsletter-section py-5 bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <h3 class="mb-4">Restez informé</h3>
                <p class="text-muted mb-4">Abonnez-vous à notre newsletter pour recevoir nos derniers articles et actualités</p>
                <form class="newsletter-form">
                    <div class="input-group input-group-lg">
                        <input type="email" class="form-control" placeholder="Votre adresse email">
                        <button class="btn btn-primary" type="submit">
                            S'abonner <i class="fas fa-paper-plane ms-2"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<?php require_once('includes/footer.php'); ?>
