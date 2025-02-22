<?php
require 'db.php';

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$id = $_GET['id'];

try {
    $stmt = $pdo->prepare("DELETE FROM employes WHERE id = :id");
    $stmt->execute([':id' => $id]);
    header("Location: index.php");
    exit;
} catch (PDOException $e) {
    echo "Une erreur est survenue : " . $e->getMessage();
}