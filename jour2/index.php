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
    <!-- Inclusion de jQuery pour AJAX -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        /* Style pour les résultats de recherche */
        .search-results {
            position: absolute;
            background-color: white;
            border: 1px solid #ccc;
            max-height: 200px;
            overflow-y: auto;
            width: 100%;
            z-index: 1000;
            display: none;
        }
        .search-results a {
            display: block;
            padding: 10px;
            text-decoration: none;
            color: black;
        }
        .search-results a:hover {
            background-color: #f0f0f0;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Liste des Produits</h1>
        <a href="ajouter_produit.php" class="btn btn-primary mb-3">Ajouter un Produit</a>

        <!-- Barre de recherche -->
        <div class="input-group mb-3">
            <input type="text" id="searchInput" class="form-control" placeholder="Rechercher un produit...">
            <div class="search-results"></div>
        </div>

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

    <!-- Script pour la recherche en temps réel -->
    <script>
        $(document).ready(function () {
            $('#searchInput').on('input', function () {
                var query = $(this).val();

                // Masquer les résultats si la requête est vide
                if (query === '') {
                    $('.search-results').hide();
                    return;
                }

                // Envoyer une requête AJAX pour obtenir les résultats
                $.ajax({
                    url: 'recherche_ajax.php',
                    method: 'GET',
                    data: { query: query },
                    success: function (response) {
                        $('.search-results').html(response).show();
                    }
                });
            });

            // Cacher les résultats lorsque l'utilisateur clique en dehors de la barre de recherche
            $(document).on('click', function (e) {
                if (!$(e.target).closest('#searchInput, .search-results').length) {
                    $('.search-results').hide();
                }
            });

            // Redirection vers la page du produit lorsqu'un résultat est cliqué
            $('.search-results').on('click', 'a', function () {
                window.location.href = $(this).attr('href');
            });
        });
    </script>

    <!-- Inclusion de JavaScript Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>