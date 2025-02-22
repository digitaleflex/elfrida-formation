<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo SITE_TITLE; ?></title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?php echo dirname($_SERVER['PHP_SELF']) === '/' ? '' : dirname($_SERVER['PHP_SELF']); ?>/css/style.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4">
        <div class="container">
            <a class="navbar-brand" href="<?php echo dirname($_SERVER['PHP_SELF']) === '/' ? '' : dirname($_SERVER['PHP_SELF']); ?>/index.php">
                <i class="fas fa-blog me-2"></i><?php echo SITE_TITLE; ?>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) === 'index.php' ? 'active' : ''; ?>" 
                           href="<?php echo dirname($_SERVER['PHP_SELF']) === '/' ? '' : dirname($_SERVER['PHP_SELF']); ?>/index.php">
                            <i class="fas fa-home me-1"></i>Accueil
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) === 'articles.php' ? 'active' : ''; ?>" 
                           href="<?php echo dirname($_SERVER['PHP_SELF']) === '/' ? '' : dirname($_SERVER['PHP_SELF']); ?>/articles.php">
                            <i class="fas fa-newspaper me-1"></i>Articles
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) === 'about.php' ? 'active' : ''; ?>" 
                           href="<?php echo dirname($_SERVER['PHP_SELF']) === '/' ? '' : dirname($_SERVER['PHP_SELF']); ?>/about.php">
                            <i class="fas fa-info-circle me-1"></i>À propos
                        </a>
                    </li>
                </ul>
                <form class="d-flex" action="<?php echo dirname($_SERVER['PHP_SELF']) === '/' ? '' : dirname($_SERVER['PHP_SELF']); ?>/articles.php" method="GET">
                    <div class="input-group">
                        <input class="form-control" type="search" name="recherche" 
                               placeholder="Rechercher..." aria-label="Search"
                               value="<?php echo isset($_GET['recherche']) ? htmlspecialchars($_GET['recherche']) : ''; ?>">
                        <button class="btn btn-outline-light" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </nav>

    <?php if (basename($_SERVER['PHP_SELF']) === 'index.php'): ?>
    <div class="container">
        <header class="text-center mb-5">
            <h1 class="display-4 header-title"><?php echo SITE_TITLE; ?></h1>
            <p class="lead text-muted"><?php echo SITE_DESCRIPTION; ?></p>
        </header>
    </div>
    <?php endif; ?>
