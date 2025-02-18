<?php
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ajouter un Patient</title>
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
        
        .form-control {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: white;
            backdrop-filter: blur(4px);
        }
        
        .form-control:focus {
            background: rgba(255, 255, 255, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.3);
            color: white;
            box-shadow: 0 0 0 0.25rem rgba(255, 255, 255, 0.1);
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
    </style>
</head>
<body>
    <div class="container">
        <div class="glass-container">
            <h2 class="mb-4">
                <i class="fas fa-user-plus me-3"></i>Ajouter un Patient
            </h2>
            <form action="../controllers/patientController.php" method="POST">
                <div class="mb-3">
                    <label for="nom" class="form-label">
                        <i class="fas fa-user me-2"></i>Nom
                    </label>
                    <input type="text" class="form-control" id="nom" name="nom" required>
                </div>
                <div class="mb-3">
                    <label for="prenom" class="form-label">
                        <i class="fas fa-user me-2"></i>Prénom
                    </label>
                    <input type="text" class="form-control" id="prenom" name="prenom" required>
                </div>
                <div class="mb-3">
                    <label for="telephone" class="form-label">
                        <i class="fas fa-phone me-2"></i>Téléphone
                    </label>
                    <input type="text" class="form-control" id="telephone" name="telephone" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">
                        <i class="fas fa-envelope me-2"></i>Email
                    </label>
                    <input type="email" class="form-control" id="email" name="email" required>
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
