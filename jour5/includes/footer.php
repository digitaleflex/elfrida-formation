    </div> <!-- Fermeture du container principal -->

    <footer class="bg-dark text-white py-4 mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-3 mb-md-0">
                    <h5 class="mb-3">À propos</h5>
                    <p class="mb-0"><?php echo SITE_DESCRIPTION; ?></p>
                    <div class="mt-3">
                        <a href="<?php echo dirname($_SERVER['PHP_SELF']) === '/' ? '' : dirname($_SERVER['PHP_SELF']); ?>/about.php" 
                           class="btn btn-outline-light btn-sm">
                            <i class="fas fa-info-circle me-2"></i>En savoir plus
                        </a>
                    </div>
                </div>
                <div class="col-md-4 mb-3 mb-md-0">
                    <h5 class="mb-3">Liens rapides</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <a href="<?php echo dirname($_SERVER['PHP_SELF']) === '/' ? '' : dirname($_SERVER['PHP_SELF']); ?>/index.php" 
                               class="text-white-50 text-decoration-none hover-link">
                                <i class="fas fa-home me-2"></i>Accueil
                            </a>
                        </li>
                        <li class="mb-2">
                            <a href="<?php echo dirname($_SERVER['PHP_SELF']) === '/' ? '' : dirname($_SERVER['PHP_SELF']); ?>/articles.php" 
                               class="text-white-50 text-decoration-none hover-link">
                                <i class="fas fa-newspaper me-2"></i>Articles
                            </a>
                        </li>
                        <li class="mb-2">
                            <a href="<?php echo dirname($_SERVER['PHP_SELF']) === '/' ? '' : dirname($_SERVER['PHP_SELF']); ?>/about.php" 
                               class="text-white-50 text-decoration-none hover-link">
                                <i class="fas fa-info-circle me-2"></i>À propos
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h5 class="mb-3">Suivez-nous</h5>
                    <div class="social-links">
                        <a href="https://twitter.com/" target="_blank" class="text-white me-3 social-hover">
                            <i class="fab fa-twitter fa-lg"></i>
                        </a>
                        <a href="https://linkedin.com/" target="_blank" class="text-white me-3 social-hover">
                            <i class="fab fa-linkedin-in fa-lg"></i>
                        </a>
                        <a href="https://github.com/" target="_blank" class="text-white me-3 social-hover">
                            <i class="fab fa-github fa-lg"></i>
                        </a>
                        <a href="https://youtube.com/" target="_blank" class="text-white social-hover">
                            <i class="fab fa-youtube fa-lg"></i>
                        </a>
                    </div>
                    <div class="mt-3">
                        <a href="mailto:contact@example.com" class="text-white-50 text-decoration-none hover-link">
                            <i class="fas fa-envelope me-2"></i>contact@example.com
                        </a>
                    </div>
                </div>
            </div>
            <hr class="my-4 bg-light opacity-25">
            <div class="row align-items-center">
                <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                    <p class="mb-0 text-white-50">
                        &copy; <?php echo date('Y'); ?> <?php echo SITE_TITLE; ?> - Tous droits réservés
                    </p>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <ul class="list-inline mb-0">
                        <li class="list-inline-item">
                            <a href="<?php echo dirname($_SERVER['PHP_SELF']) === '/' ? '' : dirname($_SERVER['PHP_SELF']); ?>/mentions-legales.php" 
                               class="text-white-50 text-decoration-none hover-link">
                                Mentions légales
                            </a>
                        </li>
                        <li class="list-inline-item ms-3">
                            <a href="<?php echo dirname($_SERVER['PHP_SELF']) === '/' ? '' : dirname($_SERVER['PHP_SELF']); ?>/confidentialite.php" 
                               class="text-white-50 text-decoration-none hover-link">
                                Politique de confidentialité
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Custom JS -->
    <script>
        // Activation des tooltips Bootstrap
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        });

        // Animation des liens au survol
        document.querySelectorAll('.hover-link').forEach(link => {
            link.addEventListener('mouseenter', function() {
                this.style.opacity = '1';
                this.style.transform = 'translateX(5px)';
            });
            link.addEventListener('mouseleave', function() {
                this.style.opacity = '0.5';
                this.style.transform = 'translateX(0)';
            });
        });

        // Animation des icônes sociales
        document.querySelectorAll('.social-hover').forEach(icon => {
            icon.addEventListener('mouseenter', function() {
                this.style.transform = 'scale(1.2)';
                this.style.color = '#4a90e2';
            });
            icon.addEventListener('mouseleave', function() {
                this.style.transform = 'scale(1)';
                this.style.color = '#fff';
            });
        });
    </script>

    <style>
        .hover-link {
            transition: all 0.3s ease;
        }
        .social-hover {
            transition: all 0.3s ease;
            display: inline-block;
        }
        .social-hover:hover {
            text-decoration: none;
        }
    </style>
</body>
</html> 