<?php
require_once('includes/db.php');
require_once('includes/header.php');

// Pagination
$articles_par_page = 6;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $articles_par_page;

// Recherche
$recherche = isset($_GET['recherche']) ? $_GET['recherche'] : '';
$where_clause = $recherche ? "WHERE titre LIKE :recherche OR contenu LIKE :recherche" : "";

// Compte total d'articles
$stmt = $pdo->prepare("SELECT COUNT(*) FROM articles $where_clause");
if ($recherche) {
    $stmt->bindValue(':recherche', "%$recherche%", PDO::PARAM_STR);
}
$stmt->execute();
$total_articles = $stmt->fetchColumn();
$total_pages = ceil($total_articles / $articles_par_page);

// Récupération des articles
$stmt = $pdo->prepare("SELECT * FROM articles $where_clause ORDER BY date_creation DESC LIMIT :limit OFFSET :offset");
if ($recherche) {
    $stmt->bindValue(':recherche', "%$recherche%", PDO::PARAM_STR);
}
$stmt->bindValue(':limit', $articles_par_page, PDO::PARAM_INT);
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
$stmt->execute();
$articles = $stmt->fetchAll();
?>

<div class="articles-section py-5">
    <div class="container">
        <!-- Barre de recherche -->
        <div class="row mb-5">
            <div class="col-lg-8 mx-auto">
                <form action="articles.php" method="GET" class="search-form">
                    <div class="input-group">
                        <input type="text" name="recherche" class="form-control form-control-lg" 
                               placeholder="Rechercher un article..." 
                               value="<?php echo htmlspecialchars($recherche); ?>">
                        <button class="btn btn-primary" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <?php if ($recherche): ?>
            <div class="row mb-4">
                <div class="col-12">
                    <div class="alert alert-info">
                        <i class="fas fa-search me-2"></i>
                        Résultats de recherche pour : "<?php echo htmlspecialchars($recherche); ?>"
                        <a href="articles.php" class="float-end text-decoration-none">
                            <i class="fas fa-times"></i> Effacer la recherche
                        </a>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <!-- Liste des articles -->
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            <?php foreach ($articles as $article): ?>
                <div class="col">
                    <article class="card h-100 article-card">
                        <div class="card-body">
                            <div class="article-meta mb-3">
                                <small class="text-muted">
                                    <i class="far fa-calendar-alt me-1"></i>
                                    <?php echo date('d/m/Y', strtotime($article['date_creation'])); ?>
                                </small>
                            </div>
                            <h3 class="card-title h5">
                                <a href="articles/article.php?id=<?php echo $article['id']; ?>">
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
                            <a href="articles/article.php?id=<?php echo $article['id']; ?>" 
                               class="btn btn-outline-primary btn-sm">
                                Lire la suite <i class="fas fa-arrow-right ms-1"></i>
                            </a>
                        </div>
                    </article>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Pagination -->
        <?php if ($total_pages > 1): ?>
            <div class="row mt-5">
                <div class="col-12">
                    <nav aria-label="Navigation des articles">
                        <ul class="pagination justify-content-center">
                            <?php if ($page > 1): ?>
                                <li class="page-item">
                                    <a class="page-link" href="?page=<?php echo $page-1; ?><?php echo $recherche ? '&recherche='.urlencode($recherche) : ''; ?>">
                                        <i class="fas fa-chevron-left"></i>
                                    </a>
                                </li>
                            <?php endif; ?>

                            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                                <li class="page-item <?php echo $i == $page ? 'active' : ''; ?>">
                                    <a class="page-link" href="?page=<?php echo $i; ?><?php echo $recherche ? '&recherche='.urlencode($recherche) : ''; ?>">
                                        <?php echo $i; ?>
                                    </a>
                                </li>
                            <?php endfor; ?>

                            <?php if ($page < $total_pages): ?>
                                <li class="page-item">
                                    <a class="page-link" href="?page=<?php echo $page+1; ?><?php echo $recherche ? '&recherche='.urlencode($recherche) : ''; ?>">
                                        <i class="fas fa-chevron-right"></i>
                                    </a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </nav>
                </div>
            </div>
        <?php endif; ?>

        <?php if (empty($articles)): ?>
            <div class="row">
                <div class="col-12 text-center">
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle me-2"></i>
                        Aucun article trouvé.
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php require_once('includes/footer.php'); ?> 