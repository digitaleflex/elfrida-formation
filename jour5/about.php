<?php
require_once('includes/db.php');
require_once('includes/header.php');
?>

<div class="about-section py-5">
    <div class="container">
        <!-- Section Introduction -->
        <div class="row mb-5">
            <div class="col-lg-8 mx-auto text-center">
                <i class="fas fa-book-open fa-3x mb-3 text-primary"></i>
                <h2 class="display-5 header-title mb-4">Notre Histoire</h2>
                <p class="lead">Bienvenue sur notre blog, un espace dédié au partage de connaissances et d'expériences.</p>
                <hr class="my-4">
            </div>
        </div>

        <!-- Section Mission -->
        <div class="row mb-5">
            <div class="col-md-4 mb-4">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body text-center">
                        <i class="fas fa-bullseye fa-2x text-primary mb-3"></i>
                        <h3 class="h4 mb-3">Notre Mission</h3>
                        <p class="text-muted">Partager des connaissances de qualité et créer une communauté d'apprentissage dynamique.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body text-center">
                        <i class="fas fa-eye fa-2x text-primary mb-3"></i>
                        <h3 class="h4 mb-3">Notre Vision</h3>
                        <p class="text-muted">Devenir une référence dans le partage de connaissances et l'échange d'idées.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body text-center">
                        <i class="fas fa-heart fa-2x text-primary mb-3"></i>
                        <h3 class="h4 mb-3">Nos Valeurs</h3>
                        <p class="text-muted">Qualité, authenticité, partage et respect de notre communauté.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Section Équipe -->
        <div class="row mb-5">
            <div class="col-12 text-center mb-4">
                <h2 class="display-6 header-title">Notre Équipe</h2>
                <p class="lead text-muted">Les personnes qui font vivre ce blog au quotidien</p>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card team-card border-0 shadow-sm">
                    <div class="card-body text-center">
                        <div class="team-avatar mb-3">
                            <i class="fas fa-user-circle fa-4x text-primary"></i>
                        </div>
                        <h4 class="mb-2">Jean Dupont</h4>
                        <p class="text-muted mb-3">Fondateur & Rédacteur en Chef</p>
                        <div class="social-links">
                            <a href="#" class="text-primary me-2"><i class="fab fa-twitter"></i></a>
                            <a href="#" class="text-primary me-2"><i class="fab fa-linkedin"></i></a>
                            <a href="#" class="text-primary"><i class="fab fa-github"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card team-card border-0 shadow-sm">
                    <div class="card-body text-center">
                        <div class="team-avatar mb-3">
                            <i class="fas fa-user-circle fa-4x text-primary"></i>
                        </div>
                        <h4 class="mb-2">Marie Martin</h4>
                        <p class="text-muted mb-3">Rédactrice Senior</p>
                        <div class="social-links">
                            <a href="#" class="text-primary me-2"><i class="fab fa-twitter"></i></a>
                            <a href="#" class="text-primary me-2"><i class="fab fa-linkedin"></i></a>
                            <a href="#" class="text-primary"><i class="fab fa-github"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card team-card border-0 shadow-sm">
                    <div class="card-body text-center">
                        <div class="team-avatar mb-3">
                            <i class="fas fa-user-circle fa-4x text-primary"></i>
                        </div>
                        <h4 class="mb-2">Paul Bernard</h4>
                        <p class="text-muted mb-3">Développeur Web</p>
                        <div class="social-links">
                            <a href="#" class="text-primary me-2"><i class="fab fa-twitter"></i></a>
                            <a href="#" class="text-primary me-2"><i class="fab fa-linkedin"></i></a>
                            <a href="#" class="text-primary"><i class="fab fa-github"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Section Contact -->
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-5">
                        <h3 class="text-center mb-4">Contactez-nous</h3>
                        <form>
                            <div class="mb-3">
                                <label for="name" class="form-label">Votre nom</label>
                                <input type="text" class="form-control" id="name" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Votre email</label>
                                <input type="email" class="form-control" id="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="message" class="form-label">Votre message</label>
                                <textarea class="form-control" id="message" rows="4" required></textarea>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary px-5">Envoyer</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once('includes/footer.php'); ?> 