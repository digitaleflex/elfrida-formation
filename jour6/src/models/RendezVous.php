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
            // Vérifier si le rendez-vous existe
            $stmt = $pdo->prepare("SELECT * FROM rendez_vous WHERE id = ?");
            $stmt->execute([$id]);
            $rdv = $stmt->fetch();

            if (!$rdv) {
                throw new Exception("Ce rendez-vous n'existe pas dans la base de données.");
            }

            // Vérifier si le rendez-vous est pour aujourd'hui et déjà passé
            if (strtotime($rdv['date_rdv']) == strtotime(date('Y-m-d'))) {
                $heure_actuelle = date('H:i:s');
                if (strtotime($rdv['heure_rdv']) < strtotime($heure_actuelle)) {
                    throw new Exception("Désolé, vous ne pouvez pas supprimer un rendez-vous déjà passé.");
                }
            }

            // Supprimer le rendez-vous
            $stmt = $pdo->prepare("DELETE FROM rendez_vous WHERE id = ?");
            $stmt->execute([$id]);

            // Réorganiser les IDs
            $pdo->exec("SET @count = 0");
            $pdo->exec("UPDATE rendez_vous SET id = @count:= @count + 1 ORDER BY id");
            $pdo->exec("ALTER TABLE rendez_vous AUTO_INCREMENT = 1");
            
            return true;

        } catch (PDOException $e) {
            throw new Exception("Une erreur est survenue lors de la suppression du rendez-vous. Veuillez réessayer.");
        }
    }
}
?>
