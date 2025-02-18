<?php
require_once __DIR__ . '/../models/RendezVous.php';
require_once __DIR__ . '/../models/Patient.php';
$rdvs = RendezVous::getAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gestion des Rendez-vous</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2 class="my-4">Liste des Rendez-vous</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nom du Patient</th>
                    <th>Date</th>
                    <th>Heure</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($rdvs as $rdv): ?>
                    <tr>
                        <td><?= htmlspecialchars($rdv["nom"]) . " " . htmlspecialchars($rdv["prenom"]) ?></td>
                        <td><?= htmlspecialchars($rdv["date_rdv"]) ?></td>
                        <td><?= htmlspecialchars($rdv["heure_rdv"]) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <a href="add_rdv.php" class="btn btn-primary">Ajouter un Rendez-vous</a>
    </div>
</body>
</html>
