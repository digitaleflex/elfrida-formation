<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'];
    $poste = $_POST['poste'];
    $email = $_POST['email'];

    // Validation des données
    if (empty($nom) || empty($poste) || empty($email)) {
        $error = "Tous les champs sont obligatoires.";
    } else {
        try {
            $stmt = $pdo->prepare("INSERT INTO employes (nom, poste, email) VALUES (:nom, :poste, :email)");
            $stmt->execute([':nom' => $nom, ':poste' => $poste, ':email' => $email]);
            header("Location: index.php");
            exit;
        } catch (PDOException $e) {
            $error = "Une erreur est survenue : " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un Employé</title>
    <!-- Inclusion de Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Ajouter un Employé</h1>
        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>
        <form method="POST" action="" class="row g-3">
            <div class="col-md-6">
                <label for="nom" class="form-label">Nom :</label>
                <input type="text" name="nom" id="nom" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label for="poste" class="form-label">Poste :</label>
                <input type="text" name="poste" id="poste" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label for="email" class="form-label">Email :</label>
                <input type="email" name="email" id="email" class="form-control" required>
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary">Ajouter</button>
                <a href="index.php" class="btn btn-secondary ms-2">Annuler</a>
            </div>
        </form>
    </div>
</body>
</html>