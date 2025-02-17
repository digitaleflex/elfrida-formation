<?php
session_start();
include '../includes/db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$stmt = $pdo->prepare("SELECT * FROM utilisateurs WHERE id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

$success_message = '';
$error_message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['update_profile'])) {
        $new_username = trim($_POST['username']);
        $current_password = trim($_POST['current_password']);
        $new_password = trim($_POST['new_password']);
        
        // Vérifier le mot de passe actuel
        if (password_verify($current_password, $user['password'])) {
            try {
                if (!empty($new_password)) {
                    // Mettre à jour le nom d'utilisateur et le mot de passe
                    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
                    $stmt = $pdo->prepare("UPDATE utilisateurs SET username = ?, password = ? WHERE id = ?");
                    $stmt->execute([$new_username, $hashed_password, $user_id]);
                } else {
                    // Mettre à jour uniquement le nom d'utilisateur
                    $stmt = $pdo->prepare("UPDATE utilisateurs SET username = ? WHERE id = ?");
                    $stmt->execute([$new_username, $user_id]);
                }
                
                $success_message = "Profil mis à jour avec succès !";
                $_SESSION['username'] = $new_username;
                
                // Recharger les informations de l'utilisateur
                $stmt = $pdo->prepare("SELECT * FROM utilisateurs WHERE id = ?");
                $stmt->execute([$user_id]);
                $user = $stmt->fetch(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                $error_message = "Erreur lors de la mise à jour du profil.";
            }
        } else {
            $error_message = "Mot de passe actuel incorrect.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Profil | Paramètres</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <style>
        /* Styles de base du dashboard */
        :root {
            --primary-color: #6366F1;
            --secondary-color: #1E293B;
            --background-color: #F8FAFC;
            --sidebar-width: 280px;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--background-color);
            min-height: 100vh;
        }

        .dashboard-container {
            display: flex;
            min-height: 100vh;
        }

        /* Styles spécifiques au profil */
        .profile-section {
            background: white;
            padding: 2rem;
            border-radius: 1rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            margin-bottom: 2rem;
        }

        .profile-header {
            display: flex;
            align-items: center;
            gap: 2rem;
            margin-bottom: 2rem;
            padding-bottom: 2rem;
            border-bottom: 1px solid #E2E8F0;
        }

        .profile-avatar {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            background: var(--primary-color);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3rem;
            position: relative;
        }

        .avatar-edit {
            position: absolute;
            bottom: 0;
            right: 0;
            background: white;
            border: 2px solid var(--primary-color);
            width: 32px;
            height: 32px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary-color);
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .avatar-edit:hover {
            background: var(--primary-color);
            color: white;
        }

        .profile-info h2 {
            color: var(--secondary-color);
            margin-bottom: 0.5rem;
        }

        .profile-info p {
            color: #64748B;
            margin-bottom: 0;
        }

        .form-section {
            background: white;
            padding: 2rem;
            border-radius: 1rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        .form-group {
            margin-bottom: 1.5rem;
            position: relative;
        }

        .form-label {
            font-weight: 500;
            color: var(--secondary-color);
            margin-bottom: 0.5rem;
            display: block;
        }

        .form-control {
            padding: 0.75rem 1rem;
            border-radius: 0.5rem;
            border: 2px solid #E2E8F0;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
        }

        .password-toggle {
            position: absolute;
            right: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #64748B;
            cursor: pointer;
            transition: color 0.3s ease;
        }

        .password-toggle:hover {
            color: var(--primary-color);
        }

        .btn-save {
            background: var(--primary-color);
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 0.5rem;
            border: none;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.3s ease;
        }

        .btn-save:hover {
            background: #4F46E5;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(99, 102, 241, 0.2);
        }

        .alert {
            border-radius: 0.5rem;
            margin-bottom: 1.5rem;
            padding: 1rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .alert-success {
            background-color: #F0FDF4;
            border: 1px solid #DCFCE7;
            color: #16A34A;
        }

        .alert-danger {
            background-color: #FEF2F2;
            border: 1px solid #FEE2E2;
            color: #DC2626;
        }

        .profile-tabs {
            display: flex;
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .profile-tab {
            padding: 0.75rem 1.5rem;
            border-radius: 0.5rem;
            color: #64748B;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .profile-tab.active {
            background: white;
            color: var(--primary-color);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        .profile-tab:hover:not(.active) {
            background: #F1F5F9;
        }

        .main-content {
            margin-left: var(--sidebar-width);
            flex: 1;
            padding: 2rem;
            max-width: 1000px;
            margin: 0 auto;
            width: 100%;
        }

        .dashboard-header {
            text-align: center;
            margin-bottom: 3rem;
            padding: 2rem 0;
        }

        .dashboard-header h1 {
            color: var(--secondary-color);
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .dashboard-header p {
            color: #64748B;
            font-size: 1.1rem;
        }

        .profile-tabs {
            display: flex;
            gap: 1rem;
            margin-bottom: 2rem;
            justify-content: center;
        }

        .profile-tab {
            padding: 1rem 2rem;
            border-radius: 0.75rem;
            font-weight: 500;
        }

        .profile-section {
            max-width: 700px;
            margin: 0 auto;
            background: white;
            padding: 3rem;
            border-radius: 1.5rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05), 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }

        .profile-header {
            display: flex;
            align-items: center;
            gap: 2.5rem;
            margin-bottom: 3rem;
            padding-bottom: 2.5rem;
            border-bottom: 2px solid #E2E8F0;
        }

        .profile-avatar {
            width: 140px;
            height: 140px;
            font-size: 3.5rem;
            box-shadow: 0 4px 6px rgba(99, 102, 241, 0.2);
        }

        .avatar-edit {
            width: 38px;
            height: 38px;
            bottom: 5px;
            right: 5px;
        }

        .form-group {
            margin-bottom: 2rem;
        }

        .form-control {
            padding: 1rem 1.25rem;
            font-size: 1.05rem;
        }

        .btn-save {
            padding: 1rem 2rem;
            font-size: 1.05rem;
            width: 100%;
            justify-content: center;
            margin-top: 2rem;
        }

        .alert {
            max-width: 700px;
            margin: 0 auto 2rem auto;
            padding: 1.25rem;
        }

        /* Animation pour les transitions */
        .profile-section {
            animation: fadeIn 0.5s ease-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Style amélioré pour le texte d'aide */
        .text-muted {
            background-color: #F8FAFC;
            padding: 0.75rem 1rem;
            border-radius: 0.5rem;
            margin-top: 0.75rem;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        /* Amélioration du responsive */
        @media (max-width: 768px) {
            .main-content {
                padding: 1rem;
            }

            .profile-section {
                padding: 1.5rem;
            }

            .profile-header {
                flex-direction: column;
                text-align: center;
                gap: 1.5rem;
            }

            .profile-avatar {
                margin: 0 auto;
            }

            .profile-tabs {
                flex-direction: column;
            }

            .profile-tab {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <!-- Copier la sidebar du dashboard ici -->
        
        <main class="main-content">
            <div class="dashboard-header">
                <h1>Mon Profil</h1>
                <p>Gérez vos informations personnelles</p>
            </div>

            <?php if ($success_message): ?>
            <div class="alert alert-success">
                <i class="ri-checkbox-circle-line"></i>
                <?php echo $success_message; ?>
            </div>
            <?php endif; ?>

            <?php if ($error_message): ?>
            <div class="alert alert-danger">
                <i class="ri-error-warning-line"></i>
                <?php echo $error_message; ?>
            </div>
            <?php endif; ?>

            <div class="profile-tabs">
                <div class="profile-tab active">
                    <i class="ri-user-settings-line"></i>
                    Informations générales
                </div>
                <div class="profile-tab">
                    <i class="ri-shield-keyhole-line"></i>
                    Sécurité
                </div>
            </div>

            <div class="profile-section">
                <div class="profile-header">
                    <div class="profile-avatar">
                        <?php echo strtoupper(substr($user['username'], 0, 1)); ?>
                        <div class="avatar-edit">
                            <i class="ri-camera-line"></i>
                        </div>
                    </div>
                    <div class="profile-info">
                        <h2><?php echo htmlspecialchars($user['username']); ?></h2>
                        <p>Membre depuis <?php echo date('d/m/Y', strtotime($user['created_at'])); ?></p>
                    </div>
                </div>

                <form method="POST" action="profile.php">
                    <div class="form-group">
                        <label class="form-label">Nom d'utilisateur</label>
                        <input type="text" 
                               name="username" 
                               class="form-control" 
                               value="<?php echo htmlspecialchars($user['username']); ?>" 
                               required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Mot de passe actuel</label>
                        <input type="password" 
                               name="current_password" 
                               class="form-control" 
                               required>
                        <i class="ri-eye-line password-toggle"></i>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Nouveau mot de passe (facultatif)</label>
                        <input type="password" 
                               name="new_password" 
                               class="form-control">
                        <i class="ri-eye-line password-toggle"></i>
                        <small class="text-muted d-block mt-2">
                            <i class="ri-information-line"></i>
                            Laissez vide pour conserver le mot de passe actuel
                        </small>
                    </div>

                    <button type="submit" name="update_profile" class="btn-save">
                        <i class="ri-save-line"></i>
                        Enregistrer les modifications
                    </button>
                </form>
            </div>
        </main>
    </div>

    <script>
    // Toggle password visibility
    document.querySelectorAll('.password-toggle').forEach(toggle => {
        toggle.addEventListener('click', function() {
            const input = this.previousElementSibling;
            const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
            input.setAttribute('type', type);
            this.classList.toggle('ri-eye-line');
            this.classList.toggle('ri-eye-off-line');
        });
    });
    </script>
</body>
</html> 