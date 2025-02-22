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

    <!-- Notre histoire -->
    <section class="about-section mb-5">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <h2 class="h3 mb-4">Notre Histoire</h2>
                        <p class="text-muted">
                            Fondé en 2024, <?php echo SITE_TITLE; ?> est né de la passion pour le partage 
                            de connaissances et l'innovation technologique. Notre plateforme a évolué pour 
                            devenir un hub incontournable pour les développeurs et passionnés de technologie.
                        </p>
                        <div class="timeline mt-4">
                            <div class="timeline-item mb-3">
                                <span class="badge bg-primary">2024</span>
                                <p class="ms-3 mb-0">Lancement de la plateforme</p>
                            </div>
                            <div class="timeline-item mb-3">
                                <span class="badge bg-primary">2024</span>
                                <p class="ms-3 mb-0">Plus de 1000 membres actifs</p>
                            </div>
                            <div class="timeline-item">
                                <span class="badge bg-primary">2024</span>
                                <p class="ms-3 mb-0">Lancement de la section formation</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="row g-4">
                    <div class="col-6">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-body text-center p-4">
                                <i class="fas fa-users text-primary fa-3x mb-3"></i>
                                <h3 class="h5">Communauté</h3>
                                <div class="display-6 text-primary mb-2">1000+</div>
                                <p class="text-muted small mb-0">Membres actifs</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-body text-center p-4">
                                <i class="fas fa-book text-primary fa-3x mb-3"></i>
                                <h3 class="h5">Articles</h3>
                                <div class="display-6 text-primary mb-2">100+</div>
                                <p class="text-muted small mb-0">Publications</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-body text-center p-4">
                                <i class="fas fa-comments text-primary fa-3x mb-3"></i>
                                <h3 class="h5">Discussions</h3>
                                <div class="display-6 text-primary mb-2">500+</div>
                                <p class="text-muted small mb-0">Échanges</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-body text-center p-4">
                                <i class="fas fa-graduation-cap text-primary fa-3x mb-3"></i>
                                <h3 class="h5">Formation</h3>
                                <div class="display-6 text-primary mb-2">50+</div>
                                <p class="text-muted small mb-0">Tutoriels</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Nos valeurs -->
    <section class="values-section mb-5">
        <h2 class="text-center h3 mb-5">Nos Valeurs</h2>
        <div class="row g-4">
            <div class="col-md-3">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body text-center p-4">
                        <i class="fas fa-lightbulb text-primary fa-3x mb-3"></i>
                        <h3 class="h5 mb-3">Innovation</h3>
                        <p class="text-muted small mb-0">
                            Toujours à la pointe des nouvelles technologies et tendances.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body text-center p-4">
                        <i class="fas fa-hands-helping text-primary fa-3x mb-3"></i>
                        <h3 class="h5 mb-3">Entraide</h3>
                        <p class="text-muted small mb-0">
                            Une communauté solidaire et bienveillante.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body text-center p-4">
                        <i class="fas fa-award text-primary fa-3x mb-3"></i>
                        <h3 class="h5 mb-3">Excellence</h3>
                        <p class="text-muted small mb-0">
                            Un contenu de qualité et vérifié.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body text-center p-4">
                        <i class="fas fa-users text-primary fa-3x mb-3"></i>
                        <h3 class="h5 mb-3">Inclusion</h3>
                        <p class="text-muted small mb-0">
                            Accessible à tous, du débutant à l'expert.
                        </p>
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
                        <p class="small text-muted mb-3">
                            Passionnée par les nouvelles technologies et le partage de connaissances.
                            Plus de 10 ans d'expérience en développement web.
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
                        <p class="small text-muted mb-3">
                            Expert en architectures modernes et performance web.
                            Contributeur open source actif.
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
                        <p class="small text-muted mb-3">
                            Experte en gestion de communauté et support utilisateur.
                            Passionnée par l'expérience utilisateur.
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
                    Vous avez des questions ou des suggestions ? Notre équipe est là pour vous aider !
                </p>
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="d-flex justify-content-center gap-3">
                            <a href="mailto:contact@example.com" class="btn btn-primary">
                                <i class="fas fa-envelope me-2"></i>Email
                            </a>
                            <a href="#" class="btn btn-outline-primary">
                                <i class="fab fa-twitter me-2"></i>Twitter
                            </a>
                            <a href="#" class="btn btn-outline-primary">
                                <i class="fab fa-linkedin-in me-2"></i>LinkedIn
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<style>
.timeline-item {
    display: flex;
    align-items: center;
}
.team-card .team-avatar img {
    transition: transform 0.3s ease;
}
.team-card:hover .team-avatar img {
    transform: scale(1.1);
}
.social-links a {
    transition: color 0.3s ease;
}
.social-links a:hover {
    color: var(--primary-color) !important;
}
.section-divider {
    width: 60px;
    height: 3px;
    background: var(--primary-color);
    margin: 0 auto;
}
</style>

<?php require_once('includes/footer.php'); ?> 