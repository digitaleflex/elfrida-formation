<?php
require_once('includes/config.php');
require_once('includes/header.php');
?>

<div class="container py-5">
    <!-- En-tête de la page -->
    <header class="text-center mb-5">
        <h1 class="display-4 mb-3">À propos de <?php echo SITE_TITLE; ?></h1>
        <p class="lead text-muted"><?php echo SITE_DESCRIPTION; ?></p>
        <div class="section-divider my-4"></div>
    </header>

    <!-- Notre mission -->
    <section class="about-section mb-5">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <h2 class="h3 mb-4">Notre Mission</h2>
                        <p class="text-muted">
                            Chez <?php echo SITE_TITLE; ?>, notre mission est de rendre la technologie accessible à tous. 
                            Nous croyons que le partage des connaissances est essentiel pour faire progresser 
                            l'industrie du développement web et technologique.
                        </p>
                        <ul class="list-unstyled mt-4">
                            <li class="mb-3">
                                <i class="fas fa-check-circle text-primary me-2"></i>
                                Partager des connaissances techniques de qualité
                            </li>
                            <li class="mb-3">
                                <i class="fas fa-check-circle text-primary me-2"></i>
                                Accompagner les développeurs dans leur progression
                            </li>
                            <li class="mb-3">
                                <i class="fas fa-check-circle text-primary me-2"></i>
                                Créer une communauté d'entraide dynamique
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <div class="row g-4">
                            <div class="col-6">
                                <div class="text-center">
                                    <i class="fas fa-users text-primary fa-3x mb-3"></i>
                                    <h3 class="h5">Communauté</h3>
                                    <p class="text-muted small">Plus de 1000 membres actifs</p>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="text-center">
                                    <i class="fas fa-book text-primary fa-3x mb-3"></i>
                                    <h3 class="h5">Articles</h3>
                                    <p class="text-muted small">Plus de 100 articles publiés</p>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="text-center">
                                    <i class="fas fa-comments text-primary fa-3x mb-3"></i>
                                    <h3 class="h5">Discussions</h3>
                                    <p class="text-muted small">Échanges enrichissants</p>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="text-center">
                                    <i class="fas fa-graduation-cap text-primary fa-3x mb-3"></i>
                                    <h3 class="h5">Formation</h3>
                                    <p class="text-muted small">Contenus pédagogiques</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Notre équipe -->
    <section class="team-section mb-5">
        <h2 class="text-center h3 mb-5">Notre Équipe</h2>
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <!-- Membre 1 -->
            <div class="col">
                <div class="card team-card h-100 border-0 shadow-sm">
                    <div class="card-body text-center p-4">
                        <div class="team-avatar mb-3">
                            <img src="https://via.placeholder.com/150" alt="Sophie Martin" 
                                 class="rounded-circle img-fluid" style="width: 120px; height: 120px;">
                        </div>
                        <h3 class="h5 mb-2">Sophie Martin</h3>
                        <p class="text-muted mb-3">Rédactrice en Chef</p>
                        <p class="small text-muted">
                            Passionnée par les nouvelles technologies et le partage de connaissances.
                        </p>
                        <div class="social-links mt-3">
                            <a href="#" class="text-muted me-2"><i class="fab fa-twitter"></i></a>
                            <a href="#" class="text-muted me-2"><i class="fab fa-linkedin-in"></i></a>
                            <a href="#" class="text-muted"><i class="fab fa-github"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Membre 2 -->
            <div class="col">
                <div class="card team-card h-100 border-0 shadow-sm">
                    <div class="card-body text-center p-4">
                        <div class="team-avatar mb-3">
                            <img src="https://via.placeholder.com/150" alt="Thomas Dubois" 
                                 class="rounded-circle img-fluid" style="width: 120px; height: 120px;">
                        </div>
                        <h3 class="h5 mb-2">Thomas Dubois</h3>
                        <p class="text-muted mb-3">Développeur Senior</p>
                        <p class="small text-muted">
                            Expert en développement web et architectures modernes.
                        </p>
                        <div class="social-links mt-3">
                            <a href="#" class="text-muted me-2"><i class="fab fa-twitter"></i></a>
                            <a href="#" class="text-muted me-2"><i class="fab fa-linkedin-in"></i></a>
                            <a href="#" class="text-muted"><i class="fab fa-github"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Membre 3 -->
            <div class="col">
                <div class="card team-card h-100 border-0 shadow-sm">
                    <div class="card-body text-center p-4">
                        <div class="team-avatar mb-3">
                            <img src="https://via.placeholder.com/150" alt="Julie Bernard" 
                                 class="rounded-circle img-fluid" style="width: 120px; height: 120px;">
                        </div>
                        <h3 class="h5 mb-2">Julie Bernard</h3>
                        <p class="text-muted mb-3">Responsable Communauté</p>
                        <p class="small text-muted">
                            Spécialiste de la gestion de communauté et du support utilisateur.
                        </p>
                        <div class="social-links mt-3">
                            <a href="#" class="text-muted me-2"><i class="fab fa-twitter"></i></a>
                            <a href="#" class="text-muted me-2"><i class="fab fa-linkedin-in"></i></a>
                            <a href="#" class="text-muted"><i class="fab fa-github"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contactez-nous -->
    <section class="contact-section">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4 text-center">
                <h2 class="h3 mb-4">Contactez-nous</h2>
                <p class="text-muted mb-4">
                    Vous avez des questions ou des suggestions ? N'hésitez pas à nous contacter !
                </p>
                <a href="mailto:contact@example.com" class="btn btn-primary">
                    <i class="fas fa-envelope me-2"></i>Nous écrire
                </a>
            </div>
        </div>
    </section>
</div>

<?php require_once('includes/footer.php'); ?> 