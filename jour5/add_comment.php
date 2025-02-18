<?php
require_once('includes/db.php');

// Vérification si la requête est en POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $response = ['success' => false, 'message' => ''];

    // Récupération et nettoyage des données
    $article_id = filter_input(INPUT_POST, 'article_id', FILTER_VALIDATE_INT);
    $auteur = trim(filter_input(INPUT_POST, 'auteur', FILTER_SANITIZE_STRING));
    $commentaire = trim(filter_input(INPUT_POST, 'commentaire', FILTER_SANITIZE_STRING));

    // Validation des données
    if (!$article_id) {
        $response['message'] = 'Article invalide.';
    } elseif (empty($auteur)) {
        $response['message'] = 'Le nom est requis.';
    } elseif (strlen($auteur) > 50) {
        $response['message'] = 'Le nom est trop long (50 caractères maximum).';
    } elseif (empty($commentaire)) {
        $response['message'] = 'Le commentaire est requis.';
    } elseif (strlen($commentaire) > 1000) {
        $response['message'] = 'Le commentaire est trop long (1000 caractères maximum).';
    } else {
        try {
            // Vérification que l'article existe
            $stmt = $pdo->prepare("SELECT id FROM articles WHERE id = ?");
            $stmt->execute([$article_id]);
            
            if ($stmt->fetch()) {
                // Insertion du commentaire
                $stmt = $pdo->prepare("INSERT INTO commentaires (article_id, auteur, commentaire) VALUES (?, ?, ?)");
                $stmt->execute([$article_id, $auteur, $commentaire]);

                // Récupération du commentaire inséré avec sa date
                $stmt = $pdo->prepare("SELECT * FROM commentaires WHERE id = ?");
                $stmt->execute([$pdo->lastInsertId()]);
                $nouveau_commentaire = $stmt->fetch();

                $response['success'] = true;
                $response['message'] = 'Commentaire ajouté avec succès !';
                $response['commentaire'] = [
                    'id' => $nouveau_commentaire['id'],
                    'auteur' => htmlspecialchars($nouveau_commentaire['auteur']),
                    'commentaire' => nl2br(htmlspecialchars($nouveau_commentaire['commentaire'])),
                    'date' => date('d/m/Y à H:i', strtotime($nouveau_commentaire['date_creation']))
                ];
            } else {
                $response['message'] = 'Article introuvable.';
            }
        } catch (PDOException $e) {
            $response['message'] = 'Erreur lors de l\'ajout du commentaire.';
        }
    }

    // Envoi de la réponse en JSON
    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
}

// Si ce n'est pas une requête POST, redirection vers la page d'accueil
header('Location: index.php');
exit;
?> 