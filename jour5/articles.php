<?php
require_once('includes/config.php');
require_once('includes/db.php');
require_once('includes/header.php');

// Nombre d'articles par page
$articles_par_page = 6;

// Page courante
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$page = max(1, $page);

// Terme de recherche
$recherche = isset($_GET['recherche']) ? trim($_GET['recherche']) : '';

// Construction de la requête
$params = [];
$sql = "SELECT * FROM articles";

if (!empty($recherche)) {
    $sql .= " WHERE titre LIKE ? OR contenu LIKE ?";
    $params[] = "%{$recherche}%";
    $params[] = "%{$recherche}%";
}

// Compter le nombre total d'articles
$stmt = $pdo->prepare("SELECT COUNT(*) FROM (" . $sql . ") AS count_table");
$stmt->execute($params);
$total_articles = $stmt->fetchColumn();

// Calculer le nombre total de pages
$total_pages = ceil($total_articles / $articles_par_page);
$page = min($page, $total_pages);

// Calculer l'offset pour la pagination
$offset = ($page - 1) * $articles_par_page;

// Requête finale avec pagination
$sql .= " ORDER BY date_creation DESC LIMIT ? OFFSET ?";
$params[] = $articles_par_page;
$params[] = $offset;

$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$articles = $stmt->fetchAll();
?>

<div class="container py-5">
    <!-- En-tête de la page -->
    <header class="text-center mb-5">
        <h1 class="display-4 mb-3">
            <?php if (!empty($recherche)): ?>
                Résultats de recherche pour "<?php echo htmlspecialchars($recherche); ?>"
            <?php else: ?>
                Tous nos articles
            <?php endif; ?>
        </h1>
        <div class="section-divider my-4"></div>
    </header>

    <!-- Formulaire de recherche -->
    <div class="row justify-content-center mb-5">
        <div class="col-md-8">
            <form class="search-form" action="" method="GET">
                <div class="input-group">
                    <input type="search" name="recherche" class="form-control" 
                           placeholder="Rechercher un article..." 
                           value="<?php echo htmlspecialchars($recherche); ?>">
                    <button class="btn btn-primary" type="submit">
                        <i class="fas fa-search me-2"></i>Rechercher
                    </button>
                </div>
            </form>
        </div>
    </div>

    <?php if (empty($articles) && !empty($recherche)): ?>
        <!-- Message si aucun résultat -->
        <div class="alert alert-info text-center">
            <i class="fas fa-info-circle me-2"></i>
            Aucun article ne correspond à votre recherche "<?php echo htmlspecialchars($recherche); ?>".
            <br>
            <a href="articles.php" class="btn btn-outline-primary mt-3">
                <i class="fas fa-arrow-left me-2"></i>Voir tous les articles
            </a>
        </div>
    <?php else: ?>
        <!-- Liste des articles -->
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4 mb-4">
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
                                <a href="article.php?id=<?php echo $article['id']; ?>" class="text-decoration-none">
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
                        <div class="card-footer bg-transparent border-0">
                            <a href="article.php?id=<?php echo $article['id']; ?>" 
                               class="btn btn-outline-primary btn-sm">
                                Lire la suite <i class="fas fa-arrow-right ms-2"></i>
                            </a>
                        </div>
                    </article>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Pagination -->
        <?php if ($total_pages > 1): ?>
            <nav aria-label="Navigation des articles" class="mt-5">
                <ul class="pagination justify-content-center">
                    <?php if ($page > 1): ?>
                        <li class="page-item">
                            <a class="page-link" href="?page=<?php echo $page-1; ?><?php echo !empty($recherche) ? '&recherche='.urlencode($recherche) : ''; ?>">
                                <i class="fas fa-chevron-left me-1"></i> Précédent
                            </a>
                        </li>
                    <?php endif; ?>

                    <?php for ($i = max(1, $page-2); $i <= min($total_pages, $page+2); $i++): ?>
                        <li class="page-item <?php echo $i === $page ? 'active' : ''; ?>">
                            <a class="page-link" href="?page=<?php echo $i; ?><?php echo !empty($recherche) ? '&recherche='.urlencode($recherche) : ''; ?>">
                                <?php echo $i; ?>
                            </a>
                        </li>
                    <?php endfor; ?>

                    <?php if ($page < $total_pages): ?>
                        <li class="page-item">
                            <a class="page-link" href="?page=<?php echo $page+1; ?><?php echo !empty($recherche) ? '&recherche='.urlencode($recherche) : ''; ?>">
                                Suivant <i class="fas fa-chevron-right ms-1"></i>
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </nav>
        <?php endif; ?>
    <?php endif; ?>
</div>

<?php require_once('includes/footer.php'); ?> 