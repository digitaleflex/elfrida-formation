<?php
require_once __DIR__ . '/../config/database.php';

class RendezVous {
    public static function getAll() {
        global $pdo;
        $stmt = $pdo->query("SELECT r.*, p.nom, p.prenom FROM rendez_vous r 
                             JOIN patients p ON r.patient_id = p.id");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function add($patient_id, $date_rdv, $heure_rdv) {
        global $pdo;
        try {
            $stmt = $pdo->prepare("INSERT INTO rendez_vous (patient_id, date_rdv, heure_rdv) VALUES (?, ?, ?)");
            return $stmt->execute([$patient_id, $date_rdv, $heure_rdv]);
        } catch (PDOException $e) {
            return false;
        }
    }

    // Méthode pour supprimer un rendez-vous
    public static function delete($id) {
        global $pdo;
        try {
            $stmt = $pdo->prepare("DELETE FROM rendez_vous WHERE id = ?");
            return $stmt->execute([$id]);
        } catch (PDOException $e) {
            echo 'Erreur lors de la suppression du rendez-vous : ' . $e->getMessage();
            return false;
        }
    }
}
?>
