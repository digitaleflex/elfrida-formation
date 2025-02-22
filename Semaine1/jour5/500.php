<?php
require_once('includes/config.php');
require_once('includes/header.php');
?>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8 text-center">
            <div class="error-page">
                <h1 class="display-1 text-danger mb-3">500</h1>
                <h2 class="h3 mb-4">Erreur interne du serveur</h2>
                <p class="lead text-muted mb-4">
                    Désolé, une erreur inattendue s'est produite. Notre équipe technique a été notifiée et travaille à résoudre le problème.
                </p>
                <p class="text-muted mb-5">
                    En attendant, vous pouvez essayer de :
                </p>
                <div class="error-actions d-flex flex-column flex-md-row justify-content-center gap-3 mb-5">
                    <a href="javascript:location.reload()" class="btn btn-outline-primary">
                        <i class="fas fa-sync-alt me-2"></i>Rafraîchir la page
                    </a>
                    <a href="/index.php" class="btn btn-primary">
                        <i class="fas fa-home me-2"></i>Retour à l'accueil
                    </a>
                    <a href="/articles.php" class="btn btn-outline-primary">
                        <i class="fas fa-newspaper me-2"></i>Voir les articles
                    </a>
                </div>
            </div>

            <!-- Section de support -->
            <div class="support-section mt-5 pt-5 border-top">
                <h3 class="h4 mb-4">Besoin d'aide ?</h3>
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <i class="fas fa-envelope text-primary fa-2x mb-3"></i>
                                <h4 class="h5 mb-3">Contactez notre support</h4>
                                <p class="text-muted mb-3">
                                    Si le problème persiste, n'hésitez pas à nous contacter
                                </p>
                                <a href="mailto:support@example.com" class="btn btn-sm btn-primary">
                                    <i class="fas fa-paper-plane me-2"></i>Envoyer un email
                                </a>
                            </div>
                        </div>
                    </div>
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
.support-section .card {
    transition: transform 0.3s ease;
}
.support-section .card:hover {
    transform: translateY(-5px);
}
</style>

<?php require_once('includes/footer.php'); ?> 