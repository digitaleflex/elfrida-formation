<?php
// Inclusion des fichiers nécessaires
require_once __DIR__ . '/src/models/Patient.php';
require_once __DIR__ . '/src/models/RendezVous.php';

// Récupérer tous les rendez-vous
$rendezVousList = RendezVous::getAll();

// Récupérer tous les patients pour affichage rapide
$patientsList = Patient::getAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gestion des Rendez-vous Médicaux</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Gestion des Rendez-vous Médicaux</h1>
        
        <!-- Liens pour ajouter un patient ou un rendez-vous -->
        <div class="mb-4">
            <a href="src/views/add_patient.php" class="btn btn-success">Ajouter un Patient</a>
            <a href="src/views/add_rdv.php" class="btn btn-primary">Ajouter un Rendez-vous</a>
        </div>

        <!-- Table des Rendez-vous -->
        <h2>Liste des Rendez-vous</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom du Patient</th>
                    <th>Date du Rendez-vous</th>
                    <th>Heure</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($rendezVousList)): ?>
                    <tr>
                        <td colspan="5" class="text-center">Aucun rendez-vous trouvé.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($rendezVousList as $rdv): ?>
                        <tr>
                            <td><?= $rdv['id'] ?></td>
                            <td>
                                <?php 
                                    // Trouver le nom du patient associé
                                    $patient = array_filter($patientsList, fn($p) => $p['id'] == $rdv['patient_id']);
                                    echo reset($patient)['nom'] . ' ' . reset($patient)['prenom'];
                                ?>
                            </td>
                            <td><?= $rdv['date_rdv'] ?></td>
                            <td><?= $rdv['heure_rdv'] ?></td>
                            <td>
                                <a href="src/controllers/rdvController.php?delete=<?= $rdv['id'] ?>" class="btn btn-danger btn-sm">Supprimer</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
