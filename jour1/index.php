<?php
require 'db.php';

// Vérifie si $pdo est défini et est une instance valide de PDO
if (!isset($pdo) || !$pdo instanceof PDO) {
    die('La connexion à la base de données a échoué.');
}

// Récupération des employés
$stmt = $pdo->prepare("SELECT * FROM employes");
$stmt->execute();
$employes = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Vérification si $employes est défini et non vide
if (!$employes) {
    $employes = []; // Si aucune donnée, initialiser comme un tableau vide
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des Employés</title>
    <!-- Inclusion de Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Liste des Employés</h1>
        <a href="ajouter_employe.php" class="btn btn-primary mb-3">Ajouter un Employé</a>

        <?php if (empty($employes)): ?>
            <p class="text-muted">Aucun employé trouvé.</p>
        <?php else: ?>
            <table class="table table-striped table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Poste</th>
                        <th>Email</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($employes as $employe): ?>
                        <tr>
                            <td><?= htmlspecialchars($employe['id']) ?></td>
                            <td><?= htmlspecialchars($employe['nom']) ?></td>
                            <td><?= htmlspecialchars($employe['poste']) ?></td>
                            <td><?= htmlspecialchars($employe['email']) ?></td>
                            <td>
                                <a href="modifier_employe.php?id=<?= $employe['id'] ?>" class="btn btn-sm btn-warning me-2">Modifier</a>
                                <a href="supprimer_employe.php?id=<?= $employe['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet employé ?')">Supprimer</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</body>
</html>