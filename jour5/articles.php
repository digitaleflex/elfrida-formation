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
$page = min($page, max(1, $total_pages));

// Calculer l'offset pour la pagination
$offset = ($page - 1) * $articles_par_page;

// Requête finale avec pagination
$sql .= " ORDER BY date_creation DESC LIMIT " . $articles_par_page . " OFFSET " . $offset;

$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$articles = $stmt->fetchAll();

// Si c'est une requête AJAX, retourner seulement les articles
if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest') {
    $html = '';
    if (!empty($articles)) {
        foreach ($articles as $article) {
            $html .= '<div class="col">';
            $html .= '<article class="card h-100 article-card border-0 shadow-sm">';
            $html .= '<div class="card-body">';
            $html .= '<div class="article-meta mb-3">';
            $html .= '<small class="text-muted">';
            $html .= '<i class="far fa-calendar-alt me-1"></i>';
            $html .= date('d/m/Y', strtotime($article['date_creation']));
            $html .= '</small>';
            $html .= '</div>';
            $html .= '<h3 class="card-title h4">';
            $html .= '<a href="article.php?id=' . $article['id'] . '" class="text-decoration-none">';
            $html .= htmlspecialchars($article['titre']);
            $html .= '</a>';
            $html .= '</h3>';
            $html .= '<p class="card-text">';
            $extrait = substr(strip_tags($article['contenu']), 0, 150);
            $html .= htmlspecialchars($extrait) . '...';
            $html .= '</p>';
            $html .= '</div>';
            $html .= '<div class="card-footer bg-transparent border-0">';
            $html .= '<a href="article.php?id=' . $article['id'] . '" class="btn btn-outline-primary btn-sm">';
            $html .= 'Lire la suite <i class="fas fa-arrow-right ms-2"></i>';
            $html .= '</a>';
            $html .= '</div>';
            $html .= '</article>';
            $html .= '</div>';
        }
    } else {
        $html = '<div class="col-12"><div class="alert alert-info">Aucun article trouvé.</div></div>';
    }
    echo $html;
    exit;
}
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
            <form class="search-form" id="searchForm">
                <div class="input-group">
                    <input type="search" name="recherche" class="form-control" 
                           id="searchInput"
                           placeholder="Rechercher un article..." 
                           value="<?php echo htmlspecialchars($recherche); ?>">
                    <button class="btn btn-primary" type="submit">
                        <i class="fas fa-search me-2"></i>Rechercher
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Liste des articles -->
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4 mb-4" id="articlesList">
        <?php if (empty($articles)): ?>
            <div class="col-12">
                <div class="alert alert-info">
                    <i class="fas fa-info-circle me-2"></i>
                    Aucun article ne correspond à votre recherche.
                </div>
            </div>
        <?php else: ?>
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
        <?php endif; ?>
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
</div>

<script>
// Fonction pour débouncer les appels
function debounce(func, wait) {
    let timeout;
    return function executedFunction(...args) {
        const later = () => {
            clearTimeout(timeout);
            func(...args);
        };
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
    };
}

// Fonction pour mettre à jour les articles
function updateArticles(searchTerm) {
    const articlesContainer = document.getElementById('articlesList');
    
    // Afficher un indicateur de chargement
    articlesContainer.innerHTML = '<div class="col-12 text-center"><div class="spinner-border text-primary" role="status"><span class="visually-hidden">Chargement...</span></div></div>';

    // Faire la requête AJAX
    fetch(`articles.php?recherche=${encodeURIComponent(searchTerm)}`, {
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => response.text())
    .then(html => {
        articlesContainer.innerHTML = html;
        
        // Mettre à jour l'URL sans recharger la page
        const newUrl = searchTerm ? 
            `?recherche=${encodeURIComponent(searchTerm)}` : 
            window.location.pathname;
        window.history.pushState({ searchTerm }, '', newUrl);
    })
    .catch(error => {
        console.error('Erreur:', error);
        articlesContainer.innerHTML = '<div class="col-12"><div class="alert alert-danger">Une erreur est survenue lors de la recherche.</div></div>';
    });
}

// Écouteur d'événements pour la recherche
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const searchForm = document.getElementById('searchForm');

    // Gérer la saisie dans le champ de recherche
    searchInput.addEventListener('input', debounce(function(e) {
        updateArticles(e.target.value);
    }, 300));

    // Gérer la soumission du formulaire
    searchForm.addEventListener('submit', function(e) {
        e.preventDefault();
        updateArticles(searchInput.value);
    });

    // Gérer la navigation dans l'historique
    window.addEventListener('popstate', function(e) {
        if (e.state && e.state.searchTerm !== undefined) {
            searchInput.value = e.state.searchTerm;
            updateArticles(e.state.searchTerm);
        }
    });
});
</script>

<?php require_once('includes/footer.php'); ?> 