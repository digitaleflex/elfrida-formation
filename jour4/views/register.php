<?php
include '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    
    if (!empty($username) && !empty($password)) {
        // Vérifier si l'utilisateur existe déjà
        $stmt = $pdo->prepare("SELECT id FROM utilisateurs WHERE username = ?");
        $stmt->execute([$username]);
        
        if ($stmt->rowCount() == 0) {
            // Hachage du mot de passe
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            
            // Insérer l'utilisateur
            $stmt = $pdo->prepare("INSERT INTO utilisateurs (username, password) VALUES (?, ?)");
            if ($stmt->execute([$username, $hashed_password])) {
                echo "Inscription réussie. <a href='login.php'>Connectez-vous</a>";
            } else {
                echo "Erreur lors de l'inscription.";
            }
        } else {
            echo "Nom d'utilisateur déjà pris.";
        }
    } else {
        echo "Veuillez remplir tous les champs.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
    <h2>Inscription</h2>
    <form method="POST" action="register.php">
        <div class="mb-3">
            <label class="form-label">Nom d'utilisateur</label>
            <input type="text" name="username" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Mot de passe</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">S'inscrire</button>
    </form>
    <p>Déjà inscrit ? <a href="login.php">Connectez-vous ici</a></p>
</body>
</html>
