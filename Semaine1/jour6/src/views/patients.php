<?php
require_once __DIR__ . '/../models/Patient.php';
require_once __DIR__ . '/../utils/flash.php';

$patients = Patient::getAll();
$flash = Flash::getMessage();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Liste des Patients</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
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

        .btn-delete {
            padding: 5px 10px;
            border-radius: 6px;
            font-size: 0.9em;
            background: rgba(220, 53, 69, 0.1);
            color: #dc3545;
            border: 1px solid rgba(220, 53, 69, 0.2);
        }

        .btn-delete:hover {
            background: rgba(220, 53, 69, 0.2);
            color: #dc3545;
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

        h2 {
            color: white;
            font-weight: 300;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.2);
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

        .glass-modal {
            background: rgba(67, 67, 67, 0.85);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 15px;
        }

        .modal-header .btn-close {
            filter: invert(1) grayscale(100%) brightness(200%);
        }

        .btn-glass-danger {
            background: rgba(220, 53, 69, 0.2);
            color: #ff4444;
        }

        .btn-glass-danger:hover {
            background: rgba(220, 53, 69, 0.3);
        }

        .text-warning {
            color: #ffc107 !important;
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
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2><i class="fas fa-users me-3"></i>Liste des Patients</h2>
                <div>
                    <a href="add_patient.php" class="btn btn-glass me-2">
                        <i class="fas fa-user-plus me-2"></i>Ajouter un Patient
                    </a>
                    <a href="../../index.Php" class="btn btn-glass">
                        <i class="fas fa-calendar me-2"></i>Rendez-vous
                    </a>
                </div>
            </div>

            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Téléphone</th>
                        <th>Email</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($patients)): ?>
                        <tr>
                            <td colspan="6" class="text-center">Aucun patient enregistré.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($patients as $patient): ?>
                            <tr>
                                <td><?= $patient['id'] ?></td>
                                <td><?= htmlspecialchars($patient['nom']) ?></td>
                                <td><?= htmlspecialchars($patient['prenom']) ?></td>
                                <td><i class="fas fa-phone me-2"></i><?= htmlspecialchars($patient['telephone']) ?></td>
                                <td><i class="fas fa-envelope me-2"></i><?= htmlspecialchars($patient['email']) ?></td>
                                <td class="text-end">
                                    <a href="../controllers/patientController.php?delete=<?= $patient['id'] ?>" 
                                       class="btn btn-delete"
                                       onclick="return confirmerSuppressionPatient(<?= $patient['id'] ?>, '<?= htmlspecialchars($patient['nom'] . ' ' . $patient['prenom']) ?>')">
                                        <i class="fas fa-user-minus"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="modal fade" id="confirmationModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content glass-modal">
                <div class="modal-header border-0">
                    <h5 class="modal-title text-white">Confirmation de suppression</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body text-white">
                    <div class="d-flex align-items-center mb-3">
                        <i class="fas fa-exclamation-triangle text-warning me-3 fa-2x"></i>
                        <span id="confirmationMessage"></span>
                    </div>
                    <p class="small text-white-50">Cette action est irréversible.</p>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-glass" data-bs-dismiss="modal">Annuler</button>
                    <button type="button" class="btn btn-glass btn-glass-danger" id="confirmDelete">Supprimer</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    let deleteUrl = '';
    const modal = new bootstrap.Modal(document.getElementById('confirmationModal'));

    function confirmerSuppressionPatient(id, nom) {
        const message = `
            <div>
                <p class="mb-2">Vous êtes sur le point de supprimer le patient :</p>
                <p class="fw-bold mb-3">${nom}</p>
                <div class="patient-info mb-3">
                    <p class="mb-0 text-warning">
                        <i class="fas fa-info-circle me-2"></i>
                        Si ce patient a des rendez-vous programmés, vous devez d'abord les supprimer.
                    </p>
                </div>
            </div>
        `;
        
        document.getElementById('confirmationMessage').innerHTML = message;
        deleteUrl = `../controllers/patientController.php?delete=${id}`;
        modal.show();
        return false;
    }

    document.getElementById('confirmDelete').addEventListener('click', function() {
        window.location.href = deleteUrl;
    });
    </script>
</body>
</html> 