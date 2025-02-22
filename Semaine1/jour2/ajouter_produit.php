<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'];
    $prix = $_POST['prix'];
    $stock = $_POST['stock'];

    // Validation des données
    if (empty($nom) || empty($prix) || empty($stock)) {
        $error = "Tous les champs sont obligatoires.";
    } else {
        try {
            $stmt = $pdo->prepare("INSERT INTO produits (nom, prix, stock) VALUES (:nom, :prix, :stock)");
            $stmt->execute([':nom' => $nom, ':prix' => $prix, ':stock' => $stock]);
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
    <title>Ajouter un Produit</title>
    <!-- Inclusion de Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Ajouter un Produit</h1>
        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>
        <form method="POST" action="" class="row g-3">
            <div class="col-md-6">
                <label for="nom" class="form-label">Nom :</label>
                <input type="text" name="nom" id="nom" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label for="prix" class="form-label">Prix :</label>
                <input type="number" step="0.01" name="prix" id="prix" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label for="stock" class="form-label">Stock :</label>
                <input type="number" name="stock" id="stock" class="form-control" required>
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary">Ajouter</button>
                <a href="index.php" class="btn btn-secondary ms-2">Annuler</a>
            </div>
        </form>
    </div>
</body>
</html>