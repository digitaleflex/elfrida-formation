<?php
// Inclusion des fichiers nécessaires
require_once __DIR__ . '/src/models/Patient.php';
require_once __DIR__ . '/src/models/RendezVous.php';
require_once __DIR__ . '/src/utils/flash.php';

// Récupérer tous les rendez-vous
$rendezVousList = RendezVous::getAll();

// Récupérer tous les patients pour affichage rapide
$patientsList = Patient::getAll();

$flash = Flash::getMessage();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gestion des Rendez-vous Médicaux</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <!-- Ajout de Font Awesome pour de jolies icônes -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
        }
        
        .glass-container {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
            border: 1px solid rgba(255, 255, 255, 0.18);
            margin-top: 20px;
        }
        
        .table {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(4px);
            border-radius: 15px;
        }
        
        .table thead th {
            border-bottom: none;
            color: #fff;
            font-weight: 500;
            padding: 15px;
            background: rgba(0, 0, 0, 0.2);
        }
        
        .table td {
            border: none;
            padding: 15px;
            color: #2d3748;
            background: rgba(255, 255, 255, 0.9);
        }

        .table tr:last-child td:first-child {
            border-bottom-left-radius: 15px;
        }

        .table tr:last-child td:last-child {
            border-bottom-right-radius: 15px;
        }

        .table thead tr:first-child th:first-child {
            border-top-left-radius: 15px;
        }

        .table thead tr:first-child th:last-child {
            border-top-right-radius: 15px;
        }
        
        .actions-column {
            display: flex;
            gap: 8px;
            justify-content: flex-end;
        }

        .btn-delete {
            padding: 5px 10px;
            border-radius: 6px;
            font-size: 0.9em;
        }

        .btn-delete-patient {
            background: rgba(220, 53, 69, 0.1);
            color: #dc3545;
            border: 1px solid rgba(220, 53, 69, 0.2);
        }

        .btn-delete-patient:hover {
            background: rgba(220, 53, 69, 0.2);
            color: #dc3545;
        }

        .btn-delete-rdv {
            background: rgba(255, 193, 7, 0.1);
            color: #ffc107;
            border: 1px solid rgba(255, 193, 7, 0.2);
        }

        .btn-delete-rdv:hover {
            background: rgba(255, 193, 7, 0.2);
            color: #ffc107;
        }
        
        .btn-glass {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(4px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: white;
            transition: all 0.3s ease;
        }
        
        .btn-glass:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateY(-2px);
            color: white;
        }
        
        .btn-glass-danger {
            background: rgba(220, 53, 69, 0.1);
            color: #ff4444;
        }
        
        .btn-glass-danger:hover {
            background: rgba(220, 53, 69, 0.2);
            color: #ff4444;
        }
        
        .btn-glass-success {
            background: rgba(40, 167, 69, 0.1);
            color: #00C851;
        }
        
        .btn-glass-success:hover {
            background: rgba(40, 167, 69, 0.2);
            color: #00C851;
        }

        h1, h2 {
            color: white;
            font-weight: 300;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.2);
        }

        .action-buttons {
            display: flex;
            gap: 10px;
        }

        .patient-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .notification {
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 15px 25px;
            border-radius: 10px;
            color: white;
            backdrop-filter: blur(10px);
            animation: slideIn 0.5s ease-out, fadeOut 0.5s ease-out 3s forwards;
            z-index: 1000;
        }

        .notification.success {
            background: rgba(40, 167, 69, 0.9);
            border: 1px solid rgba(40, 167, 69, 0.2);
        }

        .notification.error {
            background: rgba(220, 53, 69, 0.9);
            border: 1px solid rgba(220, 53, 69, 0.2);
        }

        @keyframes slideIn {
            from { transform: translateX(100%); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }

        @keyframes fadeOut {
            from { opacity: 1; }
            to { opacity: 0; visibility: hidden; }
        }
    </style>
</head>
<body>
    <?php if ($flash): ?>
        <div class="notification <?= $flash['type'] ?>">
            <?= $flash['message'] ?>
        </div>
    <?php endif; ?>
    
    <div class="container">
        <div class="glass-container">
            <h1 class="mb-4"><i class="fas fa-hospital-user me-3"></i>Gestion des Rendez-vous Médicaux</h1>
            
            <!-- Liens pour ajouter un patient ou un rendez-vous -->
            <div class="mb-4">
                <a href="src/views/add_patient.php" class="btn btn-glass btn-glass-success me-2">
                    <i class="fas fa-user-plus me-2"></i>Ajouter un Patient
                </a>
                <a href="src/views/add_rdv.php" class="btn btn-glass">
                    <i class="fas fa-calendar-plus me-2"></i>Ajouter un Rendez-vous
                </a>
            </div>

            <!-- Table des Rendez-vous -->
            <h2 class="mb-4"><i class="fas fa-calendar-check me-3"></i>Liste des Rendez-vous</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Patient</th>
                        <th>Date</th>
                        <th>Heure</th>
                        <th class="text-end">Actions</th>
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
                                        $patient = array_filter($patientsList, fn($p) => $p['id'] == $rdv['patient_id']);
                                        $patient = reset($patient);
                                    ?>
                                    <span><i class="fas fa-user me-2"></i><?= $patient['nom'] . ' ' . $patient['prenom'] ?></span>
                                </td>
                                <td><i class="far fa-calendar me-2"></i><?= $rdv['date_rdv'] ?></td>
                                <td><i class="far fa-clock me-2"></i><?= $rdv['heure_rdv'] ?></td>
                                <td>
                                    <div class="actions-column">
                                        <a href="src/controllers/rdvController.php?delete=<?= $rdv['id'] ?>" 
                                           class="btn btn-delete btn-delete-rdv"
                                           onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce rendez-vous ?')">
                                            <i class="fas fa-calendar-minus"></i>
                                        </a>
                                        <a href="src/controllers/patientController.php?delete=<?= $patient['id'] ?>" 
                                           class="btn btn-delete btn-delete-patient"
                                           onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce patient ?')">
                                            <i class="fas fa-user-minus"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
