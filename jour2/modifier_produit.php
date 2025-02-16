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

// Gestion de la soumission du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'] ?? '';
    $prix = $_POST['prix'] ?? '';
    $stock = $_POST['stock'] ?? '';

    // Validation des données
    $errors = [];
    if (empty($nom)) {
        $errors[] = "Le nom est obligatoire.";
    }
    if (empty($prix) || !is_numeric($prix)) {
        $errors[] = "Le prix doit être un nombre valide.";
    }
    if (empty($stock) || !is_numeric($stock)) {
        $errors[] = "Le stock doit être un nombre valide.";
    }

    // Si aucune erreur, mettre à jour dans la base de données
    if (empty($errors)) {
        try {
            $stmt = $pdo->prepare("UPDATE produits SET nom = :nom, prix = :prix, stock = :stock WHERE id = :id");
            $stmt->execute([':nom' => $nom, ':prix' => $prix, ':stock' => $stock, ':id' => $id]);
            header("Location: index.php");
            exit;
        } catch (PDOException $e) {
            $errors[] = "Une erreur est survenue : " . $e->getMessage();
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
    <style>
        .error {
            color: red;
            font-size: 0.9em;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Modifier un Produit</h1>

        <?php if (!empty($errors)): ?>
            <div class="alert alert-danger">
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li><?= htmlspecialchars($error) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form method="POST" action="" class="row g-3">
            <div class="col-md-6">
                <label for="nom" class="form-label">Nom :</label>
                <input type="text" name="nom" id="nom" class="form-control" value="<?= htmlspecialchars($_POST['nom'] ?? $produit['nom']) ?>" required>
                <small class="error"><?= isset($errors) && in_array("Le nom est obligatoire.", $errors) ? "Le nom est obligatoire." : "" ?></small>
            </div>
            <div class="col-md-6">
                <label for="prix" class="form-label">Prix :</label>
                <input type="number" step="0.01" name="prix" id="prix" class="form-control" value="<?= htmlspecialchars($_POST['prix'] ?? $produit['prix']) ?>" required>
                <small class="error"><?= isset($errors) && in_array("Le prix doit être un nombre valide.", $errors) ? "Le prix doit être un nombre valide." : "" ?></small>
            </div>
            <div class="col-md-6">
                <label for="stock" class="form-label">Stock :</label>
                <input type="number" name="stock" id="stock" class="form-control" value="<?= htmlspecialchars($_POST['stock'] ?? $produit['stock']) ?>" required>
                <small class="error"><?= isset($errors) && in_array("Le stock doit être un nombre valide.", $errors) ? "Le stock doit être un nombre valide." : "" ?></small>
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary">Modifier</button>
                <a href="index.php" class="btn btn-secondary ms-2">Annuler</a>
            </div>
        </form>
    </div>

    <!-- Validation côté client avec JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.querySelector('form');
            form.addEventListener('submit', function (event) {
                let isValid = true;

                // Vérifier le nom
                const nom = document.getElementById('nom').value.trim();
                if (nom === '') {
                    showError('nom', 'Le nom est obligatoire.');
                    isValid = false;
                } else {
                    clearError('nom');
                }

                // Vérifier le prix
                const prix = document.getElementById('prix').value.trim();
                if (prix === '' || isNaN(prix)) {
                    showError('prix', 'Le prix doit être un nombre valide.');
                    isValid = false;
                } else {
                    clearError('prix');
                }

                // Vérifier le stock
                const stock = document.getElementById('stock').value.trim();
                if (stock === '' || isNaN(stock)) {
                    showError('stock', 'Le stock doit être un nombre valide.');
                    isValid = false;
                } else {
                    clearError('stock');
                }

                if (!isValid) {
                    event.preventDefault();
                }
            });

            function showError(fieldId, message) {
                const field = document.getElementById(fieldId);
                const errorElement = field.nextElementSibling;
                errorElement.textContent = message;
                errorElement.classList.add('error');
            }

            function clearError(fieldId) {
                const field = document.getElementById(fieldId);
                const errorElement = field.nextElementSibling;
                errorElement.textContent = '';
                errorElement.classList.remove('error');
            }
        });
    </script>
</body>
</html>