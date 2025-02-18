<?php
require_once __DIR__ . '/../config/database.php';

class Patient {
    // Méthode pour récupérer tous les patients
    public static function getAll() {
        global $pdo;
        try {
            $stmt = $pdo->query("SELECT * FROM patients");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo 'Erreur : ' . $e->getMessage();
            return [];
        }
    }

    // Méthode pour ajouter un patient
    public static function add($nom, $prenom, $telephone, $email) {
        global $pdo;
        try {
            // Préparer et exécuter la requête d'insertion
            $stmt = $pdo->prepare("INSERT INTO patients (nom, prenom, telephone, email) VALUES (?, ?, ?, ?)");
            $result = $stmt->execute([$nom, $prenom, $telephone, $email]);

            // Retourner true si l'insertion est réussie, sinon false
            return $result;
        } catch (PDOException $e) {
            echo 'Erreur lors de l\'ajout du patient : ' . $e->getMessage();
            return false;
        }
    }
}
?>
