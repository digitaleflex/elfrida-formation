<?php
require_once __DIR__ . '/../models/Patient.php';

$patients = Patient::getAll(); // Récupérer la liste des patients pour le menu déroulant
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ajouter un Rendez-vous</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Ajouter un Rendez-vous</h2>
        <form action="../controllers/rdvController.php" method="POST">
            <div class="mb-3">
                <label for="patient_id" class="form-label">Patient</label>
                <select class="form-control" id="patient_id" name="patient_id" required>
                    <option value="">Sélectionner un patient</option>
                    <?php foreach ($patients as $patient): ?>
                        <option value="<?= $patient['id'] ?>">
                            <?= htmlspecialchars($patient['nom'] . ' ' . $patient['prenom']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="date_rdv" class="form-label">Date</label>
                <input type="date" class="form-control" id="date_rdv" name="date_rdv" required>
            </div>
            <div class="mb-3">
                <label for="heure_rdv" class="form-label">Heure</label>
                <input type="time" class="form-control" id="heure_rdv" name="heure_rdv" required>
            </div>
            <button type="submit" class="btn btn-primary">Ajouter</button>
            <a href="../../index.Php" class="btn btn-secondary">Retour</a>
        </form>
    </div>
</body>
</html>
