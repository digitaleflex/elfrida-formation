<?php
require 'db.php';

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$id = $_GET['id'];

// Récupération des données du produit
$stmt = $pdo->prepare("SELECT * FROM produits WHERE id = :id");
$stmt->execute([':id' => $id]);
$produit = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$produit) {
    header("Location: index.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'];
    $prix = $_POST['prix'];
    $stock = $_POST['stock'];

    // Validation des données
    if (empty($nom) || empty($prix) || empty($stock)) {
        $error = "Tous les champs sont obligatoires.";
    } else {
        try {
            $stmt = $pdo->prepare("UPDATE produits SET nom = :nom, prix = :prix, stock = :stock WHERE id = :id");
            $stmt->execute([':nom' => $nom, ':prix' => $prix, ':stock' => $stock, ':id' => $id]);
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
    <title>Modifier un Produit</title>
    <!-- Inclusion de Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Modifier un Produit</h1>
        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>
        <form method="POST" action="" class="row g-3">
            <div class="col-md-6">
                <label for="nom" class="form-label">Nom :</label>
                <input type="text" name="nom" id="nom" class="form-control" value="<?= htmlspecialchars($produit['nom']) ?>" required>
            </div>
            <div class="col-md-6">
                <label for="prix" class="form-label">Prix :</label>
                <input type="number" step="0.01" name="prix" id="prix" class="form-control" value="<?= htmlspecialchars($produit['prix']) ?>" required>
            </div>
            <div class="col-md-6">
                <label for="stock" class="form-label">Stock :</label>
                <input type="number" name="stock" id="stock" class="form-control" value="<?= htmlspecialchars($produit['stock']) ?>" required>
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary">Modifier</button>
                <a href="index.php" class="btn btn-secondary ms-2">Annuler</a>
            </div>
        </form>
    </div>
</body>
</html>