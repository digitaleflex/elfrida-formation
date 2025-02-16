<?php
require 'db.php';

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$id = $_GET['id'];

// Récupération des données de l'employé
$stmt = $pdo->prepare("SELECT * FROM employes WHERE id = :id");
$stmt->execute([':id' => $id]);
$employe = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$employe) {
    header("Location: index.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'];
    $poste = $_POST['poste'];
    $email = $_POST['email'];

    // Validation des données
    if (empty($nom) || empty($poste) || empty($email)) {
        $error = "Tous les champs sont obligatoires.";
    } else {
        try {
            $stmt = $pdo->prepare("UPDATE employes SET nom = :nom, poste = :poste, email = :email WHERE id = :id");
            $stmt->execute([':nom' => $nom, ':poste' => $poste, ':email' => $email, ':id' => $id]);
            header("Location: index.php");
            exit;
        } catch (PDOException $e) {
            $error = "Une erreur est survenue : " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier un Employé</title>
    <!-- Inclusion de Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Modifier un Employé</h1>
        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>
        <form method="POST" action="" class="row g-3">
            <div class="col-md-6">
                <label for="nom" class="form-label">Nom :</label>
                <input type="text" name="nom" id="nom" class="form-control" value="<?= htmlspecialchars($employe['nom']) ?>" required>
            </div>
            <div class="col-md-6">
                <label for="poste" class="form-label">Poste :</label>
                <input type="text" name="poste" id="poste" class="form-control" value="<?= htmlspecialchars($employe['poste']) ?>" required>
            </div>
            <div class="col-md-6">
                <label for="email" class="form-label">Email :</label>
                <input type="email" name="email" id="email" class="form-control" value="<?= htmlspecialchars($employe['email']) ?>" required>
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary">Modifier</button>
                <a href="index.php" class="btn btn-secondary ms-2">Annuler</a>
            </div>
        </form>
    </div>
</body>
</html>