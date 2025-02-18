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
        ?>
        <div class="article-full py-4">
            <div class="container">
                <!-- Article principal -->
                <div class="card border-0 shadow-sm mb-5">
                    <div class="card-body p-md-5">
                        <div class="article-meta mb-4">
                            <span class="text-muted">
                                <i class="far fa-calendar-alt me-2"></i>
                                Publié le <?php echo date('d/m/Y', strtotime($article['date_creation'])); ?>
                            </span>
                        </div>
                        <h1 class="display-5 mb-4 header-title"><?php echo htmlspecialchars($article['titre']); ?></h1>
                        <div class="article-content lead">
                            <?php echo nl2br(htmlspecialchars($article['contenu'])); ?>
                        </div>
                        <hr class="my-5">
                        <div class="article-share">
                            <div class="d-flex align-items-center">
                                <span class="me-3">Partager :</span>
                                <a href="#" class="btn btn-outline-primary btn-sm me-2">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                                <a href="#" class="btn btn-outline-info btn-sm me-2">
                                    <i class="fab fa-twitter"></i>
                                </a>
                                <a href="#" class="btn btn-outline-success btn-sm">
                                    <i class="fab fa-whatsapp"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Section commentaires -->
                <div class="comments-section">
                    <h3 class="mb-4">
                        <i class="far fa-comments me-2"></i>
                        Commentaires
                    </h3>

                    <?php
                    // Affichage des commentaires
                    $stmt = $pdo->prepare("SELECT * FROM commentaires WHERE article_id = ? ORDER BY date_creation DESC");
                    $stmt->execute([$article_id]);
                    $commentaires = $stmt->fetchAll();

                    if ($commentaires) {
                        foreach ($commentaires as $commentaire) {
                            ?>
                            <div class="comment-card card border-0 shadow-sm mb-3">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <h5 class="card-title mb-0">
                                            <i class="far fa-user-circle me-2"></i>
                                            <?php echo htmlspecialchars($commentaire['auteur']); ?>
                                        </h5>
                                        <small class="text-muted">
                                            <i class="far fa-clock me-1"></i>
                                            <?php echo date('d/m/Y à H:i', strtotime($commentaire['date_creation'])); ?>
                                        </small>
                                    </div>
                                    <p class="card-text"><?php echo nl2br(htmlspecialchars($commentaire['commentaire'])); ?></p>
                                </div>
                            </div>
                            <?php
                        }
                    } else {
                        echo '<div class="alert alert-info">
                                <i class="fas fa-info-circle me-2"></i>
                                Soyez le premier à commenter cet article !
                              </div>';
                    }
                    ?>

                    <!-- Formulaire d'ajout de commentaire -->
                    <div class="card border-0 shadow-sm mt-5">
                        <div class="card-header bg-transparent border-0 pt-4 px-4">
                            <h4 class="mb-0">
                                <i class="far fa-comment-dots me-2"></i>
                                Ajouter un commentaire
                            </h4>
                        </div>
                        <div class="card-body p-4">
                            <?php if (isset($_POST['submit_comment'])): ?>
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <i class="fas fa-check-circle me-2"></i>
                                    Votre commentaire a été ajouté avec succès !
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            <?php endif; ?>

                            <form method="post" action="" class="comment-form" id="commentForm">
                                <input type="hidden" name="article_id" value="<?php echo $article_id; ?>">
                                
                                <div class="mb-3">
                                    <label for="auteur" class="form-label">Votre nom</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="far fa-user"></i></span>
                                        <input type="text" class="form-control" id="auteur" name="auteur" required>
                                    </div>
                                </div>
                                
                                <div class="mb-4">
                                    <label for="commentaire" class="form-label">Votre commentaire</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="far fa-comment"></i></span>
                                        <textarea class="form-control" id="commentaire" name="commentaire" rows="4" required></textarea>
                                    </div>
                                </div>
                                
                                <button type="submit" name="submit_comment" class="btn btn-primary">
                                    <i class="fas fa-paper-plane me-2"></i>
                                    Publier le commentaire
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
    } else {
        echo '<div class="alert alert-warning">
                <i class="fas fa-exclamation-triangle me-2"></i>
                Article non trouvé.
              </div>';
    }
} else {
    echo '<div class="alert alert-warning">
            <i class="fas fa-exclamation-triangle me-2"></i>
            Article non spécifié.
          </div>';
}

require_once('../includes/footer.php');
?>
