<?php
// Inclure la connexion à la base de données et démarrer la session
include 'includes/db.php';
session_start();

// Vérification si l'utilisateur est déjà connecté
if (isset($_SESSION['user_id'])) {
    header('Location: views/dashboard.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenue sur le projet d'authentification</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
    <h2 class="mb-4">Bienvenue sur notre projet d'authentification</h2>
    <p>Connectez-vous ou inscrivez-vous pour accéder à votre espace personnel.</p>

    <!-- Liens pour se connecter ou s'inscrire -->
    <div class="d-flex justify-content-center mt-4">
        <a href="views/login.php" class="btn btn-primary mx-2">Se connecter</a>
        <a href="views/register.php" class="btn btn-secondary mx-2">S'inscrire</a>
    </div>
</body>
</html>
