<?php
require_once __DIR__ . '/../models/Patient.php';
require_once __DIR__ . '/../utils/flash.php';

$patients = Patient::getAll(); // Récupérer la liste des patients pour le menu déroulant
$flash = Flash::getMessage();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ajouter un Rendez-vous</title>
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
        
        h2 {
            color: white;
            font-weight: 300;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.2);
        }
        
        .form-label {
            color: white;
            font-weight: 300;
        }
        
        .form-control, .form-select {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: white;
            backdrop-filter: blur(4px);
        }
        
        .form-control:focus, .form-select:focus {
            background: rgba(255, 255, 255, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.3);
            color: white;
            box-shadow: 0 0 0 0.25rem rgba(255, 255, 255, 0.1);
        }
        
        .form-select {
            background: rgba(255, 255, 255, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.3);
            color: white;
            backdrop-filter: blur(4px);
            padding: 10px 15px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 1em;
            height: auto;
            appearance: none;
            -webkit-appearance: none;
        }
        
        .form-select:focus {
            background: rgba(255, 255, 255, 0.2);
            border-color: rgba(255, 255, 255, 0.4);
            box-shadow: 0 0 0 0.25rem rgba(255, 255, 255, 0.1);
            outline: none;
        }
        
        .form-select option {
            background: #764ba2;
            color: white;
            padding: 12px;
            font-size: 1em;
            border: none;
        }
        
        .form-select option:hover,
        .form-select option:focus,
        .form-select option:checked {
            background: #8659b5;
            color: white;
        }
        
        .form-control::placeholder {
            color: rgba(255, 255, 255, 0.6);
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
        
        .btn-glass-success {
            background: rgba(40, 167, 69, 0.1);
            color: #00C851;
        }
        
        .btn-glass-success:hover {
            background: rgba(40, 167, 69, 0.2);
            color: #00C851;
        }

        .input-group-text {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: white;
        }

        /* Animation pour les champs de formulaire */
        .form-floating {
            position: relative;
            transition: all 0.3s ease;
        }

        .form-control:focus + .form-floating-label,
        .form-control:not(:placeholder-shown) + .form-floating-label {
            transform: translateY(-1.5rem) scale(0.85);
            color: white;
        }

        /* Styles pour Select2 */
        .select2-container--default .select2-selection--single {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 6px;
            height: 38px;
            backdrop-filter: blur(4px);
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            color: white;
            line-height: 38px;
            padding-left: 12px;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 36px;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow b {
            border-color: white transparent transparent transparent;
        }

        .select2-dropdown {
            background: rgba(118, 75, 162, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .select2-container--default .select2-results__option {
            color: white;
            padding: 8px 12px;
        }

        .select2-container--default .select2-results__option--highlighted[aria-selected] {
            background-color: rgba(255, 255, 255, 0.2);
            color: white;
        }

        .select2-container--default .select2-results__option[aria-selected=true] {
            background-color: rgba(255, 255, 255, 0.3);
        }

        .select2-search--dropdown .select2-search__field {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: white;
        }

        /* Style pour la flèche personnalisée */
        .select-wrapper {
            position: relative;
        }
        
        .select-wrapper::after {
            content: '▼';
            position: absolute;
            top: 50%;
            right: 15px;
            transform: translateY(-50%);
            color: white;
            pointer-events: none;
            font-size: 0.8em;
        }
        
        /* Amélioration du style de la liste déroulante native */
        .form-select::-ms-expand {
            display: none;
        }
        
        .form-select optgroup {
            background: #764ba2;
            color: white;
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
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
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
            <h2 class="mb-4">
                <i class="fas fa-calendar-plus me-3"></i>Ajouter un Rendez-vous
            </h2>
            <form action="../controllers/rdvController.php" method="POST">
                <div class="mb-4">
                    <label for="patient_id" class="form-label">
                        <i class="fas fa-user me-2"></i>Patient
                    </label>
                    <div class="select-wrapper">
                        <select class="form-select" id="patient_id" name="patient_id" required>
                            <option value="">Sélectionner un patient</option>
                            <?php foreach ($patients as $patient): ?>
                                <option value="<?= $patient['id'] ?>">
                                    <?= htmlspecialchars($patient['nom'] . ' ' . $patient['prenom']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="mb-4">
                    <label for="date_rdv" class="form-label">
                        <i class="fas fa-calendar me-2"></i>Date
                    </label>
                    <input type="date" class="form-control" id="date_rdv" name="date_rdv" required>
                </div>
                <div class="mb-4">
                    <label for="heure_rdv" class="form-label">
                        <i class="fas fa-clock me-2"></i>Heure
                    </label>
                    <input type="time" class="form-control" id="heure_rdv" name="heure_rdv" required>
                </div>
                <div class="mt-4">
                    <button type="submit" class="btn btn-glass btn-glass-success me-2">
                        <i class="fas fa-save me-2"></i>Enregistrer
                    </button>
                    <a href="../../index.Php" class="btn btn-glass">
                        <i class="fas fa-arrow-left me-2"></i>Retour
                    </a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
