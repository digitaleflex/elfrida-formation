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
            // Démarrer une transaction
            $pdo->beginTransaction();

            // Vérifier si le rendez-vous existe
            $stmt = $pdo->prepare("SELECT * FROM rendez_vous WHERE id = ?");
            $stmt->execute([$id]);
            $rdv = $stmt->fetch();

            if (!$rdv) {
                throw new Exception("Ce rendez-vous n'existe pas.");
            }

            // Vérifier si la date est passée
            if (strtotime($rdv['date_rdv']) < strtotime(date('Y-m-d'))) {
                throw new Exception("Impossible de supprimer un rendez-vous passé.");
            }

            // Supprimer le rendez-vous
            $stmt = $pdo->prepare("DELETE FROM rendez_vous WHERE id = ?");
            $stmt->execute([$id]);

            // Réorganiser les IDs
            $pdo->query("SET @count = 0;");
            $pdo->query("UPDATE rendez_vous SET id = @count:= @count + 1 ORDER BY id;");
            $pdo->query("ALTER TABLE rendez_vous AUTO_INCREMENT = 1;");

            // Valider la transaction
            $pdo->commit();
            
            return true;
        } catch (PDOException $e) {
            // En cas d'erreur, annuler la transaction
            $pdo->rollBack();
            throw new Exception("Erreur lors de la suppression : " . $e->getMessage());
        }
    }
}
?>
