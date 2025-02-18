<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['article_id'], $_POST['auteur'], $_POST['commentaire'])) {
    $article_id = $_POST['article_id'];
    $auteur = $_POST['auteur'];
    $commentaire = $_POST['commentaire'];

    // Insertion du commentaire dans la base de données
    $stmt = $pdo->prepare("INSERT INTO commentaires (article_id, auteur, commentaire) VALUES (?, ?, ?)");
    $stmt->execute([$article_id, $auteur, $commentaire]);

    echo '<div class="alert alert-success">Commentaire ajouté avec succès.</div>';
}
?>

<div class="card mt-4">
    <div class="card-header">
        <h4 class="mb-0">Ajouter un commentaire</h4>
    </div>
    <div class="card-body">
        <form method="post" action="article.php?id=<?php echo $_GET['id']; ?>" class="needs-validation" novalidate>
            <input type="hidden" name="article_id" value="<?php echo $_GET['id']; ?>">
            
            <div class="mb-3">
                <label for="auteur" class="form-label">Votre nom</label>
                <input type="text" class="form-control" id="auteur" name="auteur" required>
            </div>
            
            <div class="mb-3">
                <label for="commentaire" class="form-label">Votre commentaire</label>
                <textarea class="form-control" id="commentaire" name="commentaire" rows="4" required></textarea>
            </div>
            
            <button type="submit" class="btn btn-primary">Publier le commentaire</button>
        </form>
    </div>
</div>
