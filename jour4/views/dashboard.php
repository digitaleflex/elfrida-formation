<?php
session_start();
include '../includes/db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$stmt = $pdo->prepare("SELECT username, created_at FROM utilisateurs WHERE id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de bord | Mon espace</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <style>
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

        .sidebar {
            width: var(--sidebar-width);
            background: white;
            padding: 2rem;
            position: fixed;
            height: 100vh;
            border-right: 1px solid #E2E8F0;
        }

        .main-content {
            margin-left: var(--sidebar-width);
            flex: 1;
            padding: 2rem;
        }

        .user-profile {
            text-align: center;
            margin-bottom: 2rem;
            padding-bottom: 2rem;
            border-bottom: 1px solid #E2E8F0;
        }

        .avatar {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background: var(--primary-color);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.5rem;
            margin: 0 auto 1rem;
        }

        .nav-menu {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .nav-item {
            margin-bottom: 0.5rem;
        }

        .nav-link {
            display: flex;
            align-items: center;
            padding: 0.75rem 1rem;
            color: var(--secondary-color);
            text-decoration: none;
            border-radius: 0.5rem;
            transition: all 0.3s ease;
            gap: 10px;
        }

        .nav-link:hover, .nav-link.active {
            background: #F1F5F9;
            color: var(--primary-color);
        }

        .nav-link i {
            font-size: 1.25rem;
        }

        .dashboard-header {
            background: white;
            padding: 1.5rem;
            border-radius: 1rem;
            margin-bottom: 2rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: white;
            padding: 1.5rem;
            border-radius: 1rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        .stat-card h3 {
            color: #64748B;
            font-size: 0.875rem;
            margin-bottom: 0.5rem;
        }

        .stat-card .value {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--secondary-color);
        }

        .recent-activity {
            background: white;
            padding: 1.5rem;
            border-radius: 1rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        .activity-item {
            display: flex;
            align-items: center;
            padding: 1rem 0;
            border-bottom: 1px solid #E2E8F0;
        }

        .activity-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #F1F5F9;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 1rem;
            color: var(--primary-color);
        }

        .btn-logout {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: #EF4444;
            text-decoration: none;
            padding: 0.75rem 1rem;
            border-radius: 0.5rem;
            margin-top: auto;
            transition: all 0.3s ease;
        }

        .btn-logout:hover {
            background: #FEE2E2;
        }

        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
                z-index: 1000;
            }

            .main-content {
                margin-left: 0;
            }
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <aside class="sidebar">
            <div class="user-profile">
                <div class="avatar">
                    <?php echo strtoupper(substr($user['username'], 0, 1)); ?>
                </div>
                <h4><?php echo htmlspecialchars($user['username']); ?></h4>
                <p class="text-muted">Membre depuis <?php echo date('d/m/Y', strtotime($user['created_at'])); ?></p>
            </div>

            <nav>
                <ul class="nav-menu">
                    <li class="nav-item">
                        <a href="dashboard.php" class="nav-link active">
                            <i class="ri-dashboard-line"></i>
                            Tableau de bord
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="profile.php" class="nav-link">
                            <i class="ri-user-settings-line"></i>
                            Mon profil
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="ri-settings-4-line"></i>
                            Paramètres
                        </a>
                    </li>
                </ul>
            </nav>

            <a href="logout.php" class="btn-logout">
                <i class="ri-logout-box-line"></i>
                Se déconnecter
            </a>
        </aside>

        <main class="main-content">
            <div class="dashboard-header">
                <h1>Tableau de bord</h1>
                <p>Bienvenue sur votre espace personnel</p>
            </div>

            <div class="stats-grid">
                <div class="stat-card">
                    <h3>Connexions</h3>
                    <div class="value">12</div>
                </div>
                <div class="stat-card">
                    <h3>Dernière connexion</h3>
                    <div class="value">Aujourd'hui</div>
                </div>
                <div class="stat-card">
                    <h3>Statut du compte</h3>
                    <div class="value">Actif</div>
                </div>
            </div>

            <div class="recent-activity">
                <h2>Activité récente</h2>
                <div class="activity-item">
                    <div class="activity-icon">
                        <i class="ri-login-circle-line"></i>
                    </div>
                    <div>
                        <h4>Connexion réussie</h4>
                        <p class="text-muted">Il y a quelques minutes</p>
                    </div>
                </div>
                <!-- Autres activités... -->
            </div>
        </main>
    </div>
</body>
</html>
