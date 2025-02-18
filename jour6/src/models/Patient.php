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

    // Méthode pour supprimer un patient
    public static function delete($id) {
        global $pdo;
        try {
            // Démarrer une transaction
            $pdo->beginTransaction();
            
            // D'abord supprimer tous les rendez-vous du patient
            $stmt = $pdo->prepare("DELETE FROM rendez_vous WHERE patient_id = ?");
            $stmt->execute([$id]);
            
            // Ensuite supprimer le patient
            $stmt = $pdo->prepare("DELETE FROM patients WHERE id = ?");
            $stmt->execute([$id]);
            
            // Valider la transaction
            $pdo->commit();
            return true;
            
        } catch (PDOException $e) {
            // En cas d'erreur, annuler la transaction
            $pdo->rollBack();
            echo 'Erreur lors de la suppression du patient : ' . $e->getMessage();
            return false;
        }
    }
}
?>
