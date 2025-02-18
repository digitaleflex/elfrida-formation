<?php
require_once('includes/db.php');
require_once('includes/header.php');

if (isset($_GET['id'])) {
    $article_id = $_GET['id'];

    // Récupérer l'article par ID
    $stmt = $pdo->prepare("SELECT * FROM articles WHERE id = ?");
    $stmt->execute([$article_id]);
    $article = $stmt->fetch();

    if ($article) {
        ?>
        <div class="container">
            <!-- Bouton retour -->
            <a href="index.php" class="btn btn-outline-primary mb-4">
                <i class="fas fa-arrow-left me-2"></i>Retour aux articles
            </a>

            <div class="card mb-4 shadow-sm">
                <div class="card-body p-4">
                    <h1 class="card-title mb-3"><?php echo htmlspecialchars($article['titre']); ?></h1>
                    <p class="text-muted mb-4">
                        <i class="far fa-calendar-alt me-2"></i>
                        Publié le <?php echo date('d/m/Y', strtotime($article['date_creation'])); ?>
                    </p>
                    <div class="card-text article-content">
                        <?php echo nl2br(htmlspecialchars($article['contenu'])); ?>
                    </div>
                </div>
            </div>

            <!-- Section commentaires -->
            <div class="comments-section mt-5">
                <h3 class="mb-4">Commentaires</h3>

                <!-- Formulaire d'ajout de commentaire -->
                <div class="card mb-4 shadow-sm">
                    <div class="card-body">
                        <form id="commentForm" class="comment-form">
                            <input type="hidden" name="article_id" value="<?php echo $article_id; ?>">
                            
                            <div class="mb-3">
                                <label for="auteur" class="form-label">Votre nom</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                    <input type="text" class="form-control" id="auteur" name="auteur" required>
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label for="commentaire" class="form-label">Votre commentaire</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-comment"></i></span>
                                    <textarea class="form-control" id="commentaire" name="commentaire" rows="4" required></textarea>
                                </div>
                            </div>
                            
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-paper-plane me-2"></i>Publier le commentaire
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Liste des commentaires -->
                <div id="commentsList">
                    <?php
                    $stmt = $pdo->prepare("SELECT * FROM commentaires WHERE article_id = ? ORDER BY date_creation DESC");
                    $stmt->execute([$article_id]);
                    $commentaires = $stmt->fetchAll();

                    if ($commentaires) {
                        foreach ($commentaires as $commentaire) {
                            ?>
                            <div class="card comment-card mb-3">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <h5 class="card-title mb-0">
                                            <i class="far fa-user-circle me-2"></i>
                                            <?php echo htmlspecialchars($commentaire['auteur']); ?>
                                        </h5>
                                        <small class="text-muted">
                                            <i class="far fa-clock me-1"></i>
                                            <?php echo date('d/m/Y à H:i', strtotime($commentaire['date_creation'])); ?>
                                        </small>
                                    </div>
                                    <p class="card-text">
                                        <?php echo nl2br(htmlspecialchars($commentaire['commentaire'])); ?>
                                    </p>
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
                </div>
            </div>
        </div>

        <!-- Template pour les nouveaux commentaires -->
        <template id="commentTemplate">
            <div class="card comment-card mb-3">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <h5 class="card-title mb-0">
                            <i class="far fa-user-circle me-2"></i>
                            <span class="comment-author"></span>
                        </h5>
                        <small class="text-muted">
                            <i class="far fa-clock me-1"></i>
                            <span class="comment-date"></span>
                        </small>
                    </div>
                    <p class="card-text comment-content"></p>
                </div>
            </div>
        </template>

        <script>
        document.getElementById('commentForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            
            // Désactiver le bouton pendant l'envoi
            const submitButton = this.querySelector('button[type="submit"]');
            submitButton.disabled = true;
            submitButton.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Envoi en cours...';
            
            fetch('add_comment.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Ajouter le nouveau commentaire
                    const template = document.getElementById('commentTemplate');
                    const clone = template.content.cloneNode(true);
                    
                    clone.querySelector('.comment-author').textContent = data.commentaire.auteur;
                    clone.querySelector('.comment-date').textContent = data.commentaire.date;
                    clone.querySelector('.comment-content').innerHTML = data.commentaire.commentaire;
                    
                    const commentsList = document.getElementById('commentsList');
                    if (commentsList.querySelector('.alert')) {
                        commentsList.innerHTML = ''; // Supprimer le message "Soyez le premier..."
                    }
                    commentsList.insertBefore(clone, commentsList.firstChild);
                    
                    // Réinitialiser le formulaire
                    this.reset();
                    
                    // Afficher un message de succès
                    const alert = document.createElement('div');
                    alert.className = 'alert alert-success alert-dismissible fade show';
                    alert.innerHTML = `
                        <i class="fas fa-check-circle me-2"></i>${data.message}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    `;
                    this.parentNode.insertBefore(alert, this);
                } else {
                    // Afficher un message d'erreur
                    const alert = document.createElement('div');
                    alert.className = 'alert alert-danger alert-dismissible fade show';
                    alert.innerHTML = `
                        <i class="fas fa-exclamation-circle me-2"></i>${data.message}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    `;
                    this.parentNode.insertBefore(alert, this);
                }
            })
            .catch(error => {
                console.error('Erreur:', error);
                const alert = document.createElement('div');
                alert.className = 'alert alert-danger alert-dismissible fade show';
                alert.innerHTML = `
                    <i class="fas fa-exclamation-circle me-2"></i>Une erreur est survenue lors de l'envoi du commentaire.
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                `;
                this.parentNode.insertBefore(alert, this);
            })
            .finally(() => {
                // Réactiver le bouton
                submitButton.disabled = false;
                submitButton.innerHTML = '<i class="fas fa-paper-plane me-2"></i>Publier le commentaire';
            });
        });
        </script>
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

require_once('includes/footer.php');
?> 