<?php
include '../includes/db.php';
session_start();

$errors = [];
$success = false;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    
    if (!empty($username) && !empty($password)) {
        // Vérifier l'utilisateur dans la base de données
        $stmt = $pdo->prepare("SELECT id, password FROM utilisateurs WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $username;
            header("Location: dashboard.php");
            exit();
        } else {
            $errors['login'] = "Nom d'utilisateur ou mot de passe incorrect";
        }
    } else {
        $errors['login'] = "Veuillez remplir tous les champs";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion | Accéder à votre compte</title>
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

        .login-container {
            max-width: 500px;
            width: 100%;
            background: white;
            border-radius: 24px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
            padding: 40px;
        }

        .login-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .login-header h1 {
            color: var(--secondary-color);
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .login-header p {
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
            padding: 10px;
            background-color: #FEF2F2;
            border-radius: 8px;
        }

        .btn-login {
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
            margin-top: 20px;
        }

        .btn-login:hover {
            background: #4F46E5;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(99, 102, 241, 0.3);
        }

        .register-link {
            text-align: center;
            margin-top: 25px;
            padding-top: 20px;
            border-top: 1px solid #E2E8F0;
            color: #64748B;
        }

        .register-link a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 500;
        }

        .register-link a:hover {
            text-decoration: underline;
        }

        .remember-me {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 20px;
        }

        .remember-me input[type="checkbox"] {
            width: 16px;
            height: 16px;
            border-radius: 4px;
            border: 2px solid #E2E8F0;
            cursor: pointer;
        }

        .forgot-password {
            text-align: right;
            margin-bottom: 20px;
        }

        .forgot-password a {
            color: #64748B;
            text-decoration: none;
            font-size: 0.9rem;
        }

        .forgot-password a:hover {
            color: var(--primary-color);
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-header">
            <h1>Connexion</h1>
            <p>Heureux de vous revoir !</p>
        </div>

        <?php if (isset($_SESSION['registration_success'])): ?>
        <div class="success-message">
            <i class="ri-checkbox-circle-line"></i>
            Inscription réussie ! Vous pouvez maintenant vous connecter.
        </div>
        <?php unset($_SESSION['registration_success']); endif; ?>

        <form method="POST" action="login.php">
            <?php if (isset($errors['login'])): ?>
            <div class="error-feedback">
                <i class="ri-error-warning-line"></i>
                <?php echo $errors['login']; ?>
            </div>
            <?php endif; ?>

            <div class="form-group">
                <i class="ri-user-line form-icon"></i>
                <input type="text" 
                       name="username" 
                       class="form-control" 
                       placeholder="Votre nom d'utilisateur"
                       value="<?php echo htmlspecialchars($username ?? ''); ?>"
                       required>
            </div>

            <div class="form-group">
                <i class="ri-lock-line form-icon"></i>
                <input type="password" 
                       name="password" 
                       class="form-control" 
                       placeholder="Votre mot de passe"
                       required>
            </div>

            <div class="remember-me">
                <input type="checkbox" id="remember" name="remember">
                <label for="remember">Se souvenir de moi</label>
            </div>

            <div class="forgot-password">
                <a href="#">Mot de passe oublié ?</a>
            </div>

            <button type="submit" class="btn-login">
                <i class="ri-login-circle-line"></i>
                Se connecter
            </button>
        </form>

        <div class="register-link">
            Pas encore de compte ? <a href="register.php">Inscrivez-vous ici</a>
        </div>
    </div>
</body>
</html>
