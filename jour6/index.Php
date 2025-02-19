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

        /* Ajout de tooltips pour les boutons de suppression */
        .actions-column a {
            position: relative;
        }

        .tooltip {
            visibility: hidden;
            position: absolute;
            bottom: 100%;
            left: 50%;
            transform: translateX(-50%);
            background: rgba(0, 0, 0, 0.8);
            color: white;
            padding: 5px 10px;
            border-radius: 4px;
            font-size: 12px;
            white-space: nowrap;
            opacity: 0;
            transition: opacity 0.3s;
        }

        .actions-column a:hover .tooltip {
            visibility: visible;
            opacity: 1;
        }

        /* Amélioration de l'animation des notifications */
        .notification {
            /* ... styles existants ... */
            transform-origin: top right;
            animation: 
                slideIn 0.5s ease-out,
                shake 0.5s ease-out 0.5s,
                fadeOut 0.5s ease-out 3.5s forwards;
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            75% { transform: translateX(5px); }
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

        .search-container {
            position: relative;
            max-width: 500px;
        }

        .glass-search {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 12px;
            padding: 10px 15px;
            display: flex;
            align-items: center;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .search-icon {
            color: rgba(255, 255, 255, 0.7);
            margin-right: 10px;
        }

        .search-input {
            background: transparent;
            border: none;
            color: white;
            flex-grow: 1;
            padding: 5px;
        }

        .search-input:focus {
            outline: none;
            box-shadow: none;
            background: transparent;
            color: white;
        }

        .search-input::placeholder {
            color: rgba(255, 255, 255, 0.6);
        }

        .search-results {
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            background: rgba(67, 67, 67, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 12px;
            margin-top: 5px;
            display: none;
            z-index: 1000;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .search-result-item {
            padding: 12px 15px;
            color: white;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 10px;
            transition: all 0.3s ease;
        }

        .search-result-item:hover {
            background: rgba(255, 255, 255, 0.1);
        }

        .search-result-item:first-child {
            border-top-left-radius: 12px;
            border-top-right-radius: 12px;
        }

        .search-result-item:last-child {
            border-bottom-left-radius: 12px;
            border-bottom-right-radius: 12px;
        }

        .patient-details {
            flex-grow: 1;
        }

        .patient-name {
            font-weight: 500;
            margin-bottom: 2px;
        }

        .patient-info {
            font-size: 0.85em;
            color: rgba(255, 255, 255, 0.7);
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
                <a href="src/views/patients.php" class="btn btn-glass me-2">
                    <i class="fas fa-users me-2"></i>Liste des Patients
                </a>
                <a href="src/views/add_rdv.php" class="btn btn-glass">
                    <i class="fas fa-calendar-plus me-2"></i>Ajouter un Rendez-vous
                </a>
            </div>

            <!-- Après les boutons d'action -->
            <div class="search-container mb-4">
                <div class="search-box glass-search">
                    <i class="fas fa-search search-icon"></i>
                    <input type="text" id="searchPatient" class="form-control search-input" placeholder="Rechercher un patient...">
                </div>
                <div id="searchResults" class="search-results"></div>
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
                                           onclick="return confirmerSuppressionRDV(<?= $rdv['id'] ?>, '<?= $rdv['date_rdv'] ?>', '<?= $rdv['heure_rdv'] ?>')">
                                            <i class="fas fa-calendar-minus"></i>
                                            <span class="tooltip">Supprimer le rendez-vous</span>
                                        </a>
                                        <a href="src/controllers/patientController.php?delete=<?= $patient['id'] ?>" 
                                           class="btn btn-delete btn-delete-patient"
                                           onclick="return confirmerSuppressionPatient(<?= $patient['id'] ?>, '<?= htmlspecialchars($patient['nom'] . ' ' . $patient['prenom']) ?>')">
                                            <i class="fas fa-user-minus"></i>
                                            <span class="tooltip">Supprimer le patient</span>
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

    <!-- Ajout du HTML pour la boîte de dialogue personnalisée -->
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

    <!-- Modification du script JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    let deleteUrl = '';
    const modal = new bootstrap.Modal(document.getElementById('confirmationModal'));

    function confirmerSuppressionPatient(id, nom) {
        const message = `
            <div>
                <p class="mb-2">Vous êtes sur le point de supprimer le patient :</p>
                <p class="fw-bold mb-3">${nom}</p>
                <p class="mb-0 text-warning">
                    <i class="fas fa-info-circle me-2"></i>
                    Si ce patient a des rendez-vous programmés, vous devez d'abord les supprimer.
                </p>
            </div>
        `;
        
        document.getElementById('confirmationMessage').innerHTML = message;
        deleteUrl = `src/controllers/patientController.php?delete=${id}`;
        modal.show();
        return false;
    }

    function confirmerSuppressionRDV(id, date, heure) {
        const formattedDate = new Date(date).toLocaleDateString('fr-FR', {
            weekday: 'long',
            day: 'numeric',
            month: 'long',
            year: 'numeric'
        });
        
        const message = `
            <div>
                <p class="mb-2">Vous êtes sur le point de supprimer le rendez-vous du :</p>
                <p class="fw-bold mb-2">${formattedDate}</p>
                <p class="fw-bold mb-3">à ${heure}</p>
                <p class="mb-0 text-warning">
                    <i class="fas fa-info-circle me-2"></i>
                    Les rendez-vous passés ne peuvent pas être supprimés.
                </p>
            </div>
        `;
        
        document.getElementById('confirmationMessage').innerHTML = message;
        deleteUrl = `src/controllers/rdvController.php?delete=${id}`;
        modal.show();
        return false;
    }

    document.getElementById('confirmDelete').addEventListener('click', function() {
        window.location.href = deleteUrl;
    });

    const searchInput = document.getElementById('searchPatient');
    const searchResults = document.getElementById('searchResults');
    let searchTimeout;

    searchInput.addEventListener('input', function() {
        clearTimeout(searchTimeout);
        const search = this.value.trim();
        
        if (search.length < 2) {
            searchResults.style.display = 'none';
            return;
        }

        searchTimeout = setTimeout(() => {
            fetch(`src/controllers/searchController.php?search=${encodeURIComponent(search)}`)
                .then(response => response.json())
                .then(data => {
                    searchResults.innerHTML = '';
                    if (data.length > 0) {
                        data.forEach(patient => {
                            const div = document.createElement('div');
                            div.className = 'search-result-item';
                            div.innerHTML = `
                                <i class="fas fa-user"></i>
                                <div class="patient-details">
                                    <div class="patient-name">${patient.nom} ${patient.prenom}</div>
                                    <div class="patient-info">
                                        <i class="fas fa-phone-alt me-1"></i>${patient.telephone}
                                        <i class="fas fa-envelope ms-2 me-1"></i>${patient.email}
                                    </div>
                                </div>
                            `;
                            div.addEventListener('click', () => {
                                // Vous pouvez ajouter une action au clic ici
                                // Par exemple, rediriger vers la page du patient
                                searchInput.value = `${patient.nom} ${patient.prenom}`;
                                searchResults.style.display = 'none';
                            });
                            searchResults.appendChild(div);
                        });
                        searchResults.style.display = 'block';
                    } else {
                        searchResults.innerHTML = '<div class="search-result-item">Aucun résultat trouvé</div>';
                        searchResults.style.display = 'block';
                    }
                })
                .catch(error => console.error('Erreur:', error));
        }, 300); // Délai de 300ms pour éviter trop de requêtes
    });

    // Fermer les résultats quand on clique ailleurs
    document.addEventListener('click', function(e) {
        if (!searchResults.contains(e.target) && e.target !== searchInput) {
            searchResults.style.display = 'none';
        }
    });
    </script>
</body>
</html>
