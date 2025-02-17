<?php
include '../includes/db.php';
session_start();

$errors = [];
$success = false;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $password_confirm = trim($_POST['password_confirm']);
    
    // Validation du nom d'utilisateur
    if (empty($username)) {
        $errors['username'] = "Le nom d'utilisateur est requis";
    } elseif (strlen($username) < 3) {
        $errors['username'] = "Le nom d'utilisateur doit contenir au moins 3 caractères";
    }

    // Vérification si l'utilisateur existe déjà
    $stmt = $pdo->prepare("SELECT id FROM utilisateurs WHERE username = ?");
    $stmt->execute([$username]);
    if ($stmt->rowCount() > 0) {
        $errors['username'] = "Ce nom d'utilisateur est déjà pris";
    }

    // Validation du mot de passe
    if (empty($password)) {
        $errors['password'] = "Le mot de passe est requis";
    } elseif (strlen($password) < 6) {
        $errors['password'] = "Le mot de passe doit contenir au moins 6 caractères";
    } elseif (!preg_match("/[A-Z]/", $password)) {
        $errors['password'] = "Le mot de passe doit contenir au moins une majuscule";
    } elseif (!preg_match("/[0-9]/", $password)) {
        $errors['password'] = "Le mot de passe doit contenir au moins un chiffre";
    }

    // Validation de la confirmation du mot de passe
    if ($password !== $password_confirm) {
        $errors['password_confirm'] = "Les mots de passe ne correspondent pas";
    }

    // Si aucune erreur, procéder à l'inscription
    if (empty($errors)) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        
        try {
            $stmt = $pdo->prepare("INSERT INTO utilisateurs (username, password) VALUES (?, ?)");
            if ($stmt->execute([$username, $hashed_password])) {
                $success = true;
                $_SESSION['registration_success'] = true;
                header("refresh:2;url=login.php");
            }
        } catch (PDOException $e) {
            $errors['system'] = "Une erreur est survenue lors de l'inscription";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription | Créer un compte</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #6366F1;
            --secondary-color: #1E293B;
            --success-color: #22C55E;
            --error-color: #EF4444;
            --background-color: #F8FAFC;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #F8FAFC 0%, #E2E8F0 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .register-container {
            max-width: 500px;
            width: 100%;
            background: white;
            border-radius: 24px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
            padding: 40px;
        }

        .register-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .register-header h1 {
            color: var(--secondary-color);
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .register-header p {
            color: #64748B;
            font-size: 1.1rem;
        }

        .form-group {
            position: relative;
            margin-bottom: 25px;
        }

        .form-control {
            width: 100%;
            padding: 16px 20px 16px 50px;
            border-radius: 12px;
            border: 2px solid #E2E8F0;
            font-size: 1rem;
            transition: all 0.3s ease;
            background-color: #F8FAFC;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
            background-color: white;
        }

        .form-icon {
            position: absolute;
            left: 20px;
            top: 50%;
            transform: translateY(-50%);
            color: #64748B;
            font-size: 1.2rem;
        }

        .error-feedback {
            color: var(--error-color);
            font-size: 0.9rem;
            margin-top: 8px;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .success-message {
            background-color: #F0FDF4;
            border: 1px solid #DCFCE7;
            color: var(--success-color);
            padding: 16px;
            border-radius: 12px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .password-strength {
            height: 4px;
            background: #E2E8F0;
            margin-top: 8px;
            border-radius: 2px;
            overflow: hidden;
        }

        .password-strength-bar {
            height: 100%;
            width: 0;
            transition: all 0.3s ease;
        }

        .btn-register {
            width: 100%;
            padding: 16px;
            border-radius: 12px;
            background: var(--primary-color);
            color: white;
            border: none;
            font-weight: 600;
            font-size: 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .btn-register:hover {
            background: #4F46E5;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(99, 102, 241, 0.3);
        }

        .login-link {
            text-align: center;
            margin-top: 20px;
            color: #64748B;
        }

        .login-link a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 500;
        }

        .login-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="register-container">
        <div class="register-header">
            <h1>Créer un compte</h1>
            <p>Rejoignez-nous en quelques clics</p>
        </div>

        <?php if ($success): ?>
        <div class="success-message">
            <i class="ri-checkbox-circle-line"></i>
            Inscription réussie ! Vous allez être redirigé vers la page de connexion...
        </div>
        <?php endif; ?>

        <form method="POST" action="register.php" id="registerForm">
            <div class="form-group">
                <i class="ri-user-line form-icon"></i>
                <input type="text" 
                       name="username" 
                       class="form-control <?php echo isset($errors['username']) ? 'is-invalid' : ''; ?>" 
                       placeholder="Votre nom d'utilisateur"
                       value="<?php echo htmlspecialchars($username ?? ''); ?>"
                       required>
                <?php if (isset($errors['username'])): ?>
                <div class="error-feedback">
                    <i class="ri-error-warning-line"></i>
                    <?php echo $errors['username']; ?>
                </div>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <i class="ri-lock-line form-icon"></i>
                <input type="password" 
                       name="password" 
                       class="form-control <?php echo isset($errors['password']) ? 'is-invalid' : ''; ?>" 
                       placeholder="Votre mot de passe"
                       id="password"
                       required>
                <div class="password-strength">
                    <div class="password-strength-bar"></div>
                </div>
                <?php if (isset($errors['password'])): ?>
                <div class="error-feedback">
                    <i class="ri-error-warning-line"></i>
                    <?php echo $errors['password']; ?>
                </div>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <i class="ri-lock-line form-icon"></i>
                <input type="password" 
                       name="password_confirm" 
                       class="form-control <?php echo isset($errors['password_confirm']) ? 'is-invalid' : ''; ?>" 
                       placeholder="Confirmez votre mot de passe"
                       required>
                <?php if (isset($errors['password_confirm'])): ?>
                <div class="error-feedback">
                    <i class="ri-error-warning-line"></i>
                    <?php echo $errors['password_confirm']; ?>
                </div>
                <?php endif; ?>
            </div>

            <button type="submit" class="btn-register">
                <i class="ri-user-add-line"></i>
                Créer mon compte
            </button>
        </form>

        <div class="login-link">
            Déjà inscrit ? <a href="login.php">Connectez-vous ici</a>
        </div>
    </div>

    <script>
    document.getElementById('password').addEventListener('input', function(e) {
        const password = e.target.value;
        const strengthBar = document.querySelector('.password-strength-bar');
        
        // Calcul de la force du mot de passe
        let strength = 0;
        if(password.length > 6) strength += 25;
        if(password.match(/[A-Z]/)) strength += 25;
        if(password.match(/[0-9]/)) strength += 25;
        if(password.match(/[^A-Za-z0-9]/)) strength += 25;

        strengthBar.style.width = strength + '%';
        
        // Couleur basée sur la force
        if(strength < 25) {
            strengthBar.style.backgroundColor = '#EF4444';
        } else if(strength < 50) {
            strengthBar.style.backgroundColor = '#F59E0B';
        } else if(strength < 75) {
            strengthBar.style.backgroundColor = '#10B981';
        } else {
            strengthBar.style.backgroundColor = '#059669';
        }
    });
    </script>
</body>
</html>
