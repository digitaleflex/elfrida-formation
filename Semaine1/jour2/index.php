<?php
require 'db.php';

// Récupération des produits
$stmt = $pdo->prepare("SELECT * FROM produits");
$stmt->execute();
$produits = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (!$produits) {
    $produits = [];
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des Produits</title>
    <!-- Inclusion de Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Liste des Produits</h1>
        <a href="ajouter_produit.php" class="btn btn-primary mb-3">Ajouter un Produit</a>
        <form action="recherche.php" method="GET" class="mb-3">
            <input type="text" name="query" class="form-control" placeholder="Rechercher un produit...">
        </form>

        <?php if (empty($produits)): ?>
            <p class="text-muted">Aucun produit trouvé.</p>
        <?php else: ?>
            <table class="table table-striped table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Prix</th>
                        <th>Stock</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($produits as $produit): ?>
                        <tr>
                            <td><?= htmlspecialchars($produit['id']) ?></td>
                            <td><?= htmlspecialchars($produit['nom']) ?></td>
                            <td><?= htmlspecialchars(number_format($produit['prix'], 2)) ?> F CFA</td>
                            <td><?= htmlspecialchars($produit['stock']) ?></td>
                            <td>
                                <a href="modifier_produit.php?id=<?= $produit['id'] ?>" class="btn btn-sm btn-warning me-2">Modifier</a>
                                
                                <!-- Bouton pour ouvrir la modale -->
                                <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal<?= $produit['id'] ?>">
                                    Supprimer
                                </button>

                                <!-- Modale pour confirmation de suppression -->
                                <div class="modal fade" id="deleteModal<?= $produit['id'] ?>" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteModalLabel">Confirmation de suppression</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Êtes-vous sûr de vouloir supprimer le produit "<strong><?= htmlspecialchars($produit['nom']) ?></strong>" ?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                                <a href="supprimer_produit.php?id=<?= $produit['id'] ?>" class="btn btn-danger">Supprimer</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>

    <!-- Inclusion de JavaScript Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>