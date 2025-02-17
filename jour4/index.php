<?php
// Inclure la connexion à la base de données et démarrer la session
include 'includes/db.php';
session_start();

// Vérification si l'utilisateur est déjà connecté
if (isset($_SESSION['user_id'])) {
    header('Location: views/dashboard.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenue | Système d'Authentification</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #6366F1;
            --secondary-color: #1E293B;
            --accent-color: #4F46E5;
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

        .welcome-container {
            max-width: 1200px;
            width: 100%;
            background: white;
            border-radius: 24px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
            overflow: hidden;
            display: flex;
        }

        .welcome-image {
            flex: 1;
            background: linear-gradient(45deg, var(--primary-color), var(--accent-color));
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            color: white;
            position: relative;
            overflow: hidden;
        }

        .welcome-image::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('https://images.unsplash.com/photo-1432821596592-e2c18b78144f?ixlib=rb-4.0.3') center/cover;
            opacity: 0.1;
        }

        .welcome-content {
            flex: 1;
            padding: 60px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .welcome-title {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--secondary-color);
            margin-bottom: 20px;
        }

        .welcome-text {
            color: #64748B;
            font-size: 1.1rem;
            margin-bottom: 40px;
            line-height: 1.6;
        }

        .auth-buttons {
            display: flex;
            gap: 20px;
        }

        .btn {
            padding: 15px 30px;
            border-radius: 12px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 10px;
            transition: all 0.3s ease;
        }

        .btn-primary {
            background: var(--primary-color);
            border: none;
        }

        .btn-primary:hover {
            background: var(--accent-color);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(99, 102, 241, 0.3);
        }

        .btn-outline {
            border: 2px solid var(--primary-color);
            color: var(--primary-color);
            background: transparent;
        }

        .btn-outline:hover {
            background: var(--primary-color);
            color: white;
            transform: translateY(-2px);
        }

        .features {
            margin-top: 60px;
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 30px;
        }

        .feature-item {
            display: flex;
            align-items: flex-start;
            gap: 15px;
        }

        .feature-icon {
            width: 40px;
            height: 40px;
            background: rgba(99, 102, 241, 0.1);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary-color);
            font-size: 1.2rem;
        }

        @media (max-width: 992px) {
            .welcome-container {
                flex-direction: column;
            }

            .welcome-image {
                padding: 60px 40px;
            }

            .features {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="welcome-container">
        <div class="welcome-image">
            <h2 style="font-size: 2rem; font-weight: 700; margin-bottom: 20px; position: relative;">
                Système d'Authentification
            </h2>
            <p style="font-size: 1.1rem; opacity: 0.9; position: relative;">
                Une solution sécurisée et moderne pour gérer vos utilisateurs
            </p>
        </div>

        <div class="welcome-content">
            <h1 class="welcome-title">Bienvenue sur notre plateforme</h1>
            <p class="welcome-text">
                Découvrez une expérience d'authentification simple et sécurisée. 
                Créez votre compte en quelques clics ou connectez-vous pour accéder à votre espace personnel.
            </p>

            <div class="auth-buttons">
                <a href="views/register.php" class="btn btn-primary">
                    <i class="ri-user-add-line"></i>
                    Créer un compte
                </a>
                <a href="views/login.php" class="btn btn-outline">
                    <i class="ri-login-circle-line"></i>
                    Se connecter
                </a>
            </div>

            <div class="features">
                <div class="feature-item">
                    <div class="feature-icon">
                        <i class="ri-shield-check-line"></i>
                    </div>
                    <div>
                        <h3 style="font-size: 1.1rem; font-weight: 600; color: var(--secondary-color);">
                            Sécurité Renforcée
                        </h3>
                        <p style="color: #64748B; font-size: 0.95rem;">
                            Protection avancée de vos données personnelles
                        </p>
                    </div>
                </div>

                <div class="feature-item">
                    <div class="feature-icon">
                        <i class="ri-speed-line"></i>
                    </div>
                    <div>
                        <h3 style="font-size: 1.1rem; font-weight: 600; color: var(--secondary-color);">
                            Interface Rapide
                        </h3>
                        <p style="color: #64748B; font-size: 0.95rem;">
                            Expérience utilisateur fluide et intuitive
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
