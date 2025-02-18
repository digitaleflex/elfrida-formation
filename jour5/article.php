<?php
require_once('includes/db.php');
require_once('includes/header.php');

// Récupération de l'ID de l'article
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Récupération de l'article
$stmt = $pdo->prepare("SELECT * FROM articles WHERE id = ?");
$stmt->execute([$id]);
$article = $stmt->fetch();

// Si l'article n'existe pas, redirection vers la page d'articles
if (!$article) {
    header('Location: articles.php');
    exit();
}
?>

<div class="container article-full py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <!-- Bouton retour -->
            <a href="articles.php" class="btn btn-outline-primary mb-4">
                <i class="fas fa-arrow-left me-2"></i>Retour aux articles
            </a>

            <!-- Article -->
            <article class="card shadow-sm">
                <div class="card-body p-md-5">
                    <h1 class="card-title mb-4"><?php echo htmlspecialchars($article['titre']); ?></h1>
                    
                    <div class="article-meta d-flex align-items-center text-muted mb-4">
                        <span class="me-3">
                            <i class="far fa-calendar-alt me-2"></i>
                            <?php echo date('d/m/Y', strtotime($article['date_creation'])); ?>
                        </span>
                    </div>

                    <div class="article-content">
                        <?php echo nl2br(htmlspecialchars($article['contenu'])); ?>
                    </div>
                </div>
            </article>

            <!-- Section commentaires -->
            <section class="comments-section mt-5 pt-5">
                <h2 class="mb-4">Commentaires</h2>

                <!-- Formulaire de commentaire -->
                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        <form action="add_comment.php" method="POST" class="comment-form">
                            <input type="hidden" name="article_id" value="<?php echo $article['id']; ?>">
                            
                            <div class="mb-3">
                                <label for="auteur" class="form-label">Votre nom</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-user"></i>
                                    </span>
                                    <input type="text" class="form-control" id="auteur" name="auteur" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="commentaire" class="form-label">Votre commentaire</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-comment"></i>
                                    </span>
                                    <textarea class="form-control" id="commentaire" name="commentaire" rows="4" required></textarea>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">
                                Publier le commentaire <i class="fas fa-paper-plane ms-2"></i>
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Liste des commentaires -->
                <?php
                $stmt = $pdo->prepare("SELECT * FROM commentaires WHERE article_id = ? ORDER BY date_creation DESC");
                $stmt->execute([$id]);
                $commentaires = $stmt->fetchAll();

                foreach ($commentaires as $commentaire):
                ?>
                <div class="card comment-card mb-3">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <h5 class="card-title comment-author mb-0">
                                <?php echo htmlspecialchars($commentaire['auteur']); ?>
                            </h5>
                            <small class="text-muted">
                                <?php echo date('d/m/Y H:i', strtotime($commentaire['date_creation'])); ?>
                            </small>
                        </div>
                        <p class="card-text">
                            <?php echo nl2br(htmlspecialchars($commentaire['commentaire'])); ?>
                        </p>
                    </div>
                </div>
                <?php endforeach; ?>
            </section>
        </div>
    </div>
</div>

<?php require_once('includes/footer.php'); ?> 