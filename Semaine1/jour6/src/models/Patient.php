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
            // Vérification de l'email unique
            $stmt = $pdo->prepare("SELECT COUNT(*) FROM patients WHERE email = ?");
            $stmt->execute([$email]);
            if ($stmt->fetchColumn() > 0) {
                throw new Exception("Un patient avec cet email existe déjà.");
            }

            // Validation du numéro de téléphone (seulement des chiffres)
            if (!preg_match("/^[0-9]+$/", $telephone)) {
                throw new Exception("Le numéro de téléphone ne doit contenir que des chiffres.");
            }

            // Validation de l'email
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                throw new Exception("L'adresse email n'est pas valide.");
            }

            // Validation du nom et prénom
            if (strlen($nom) < 2 || strlen($prenom) < 2) {
                throw new Exception("Le nom et le prénom doivent contenir au moins 2 caractères.");
            }

            // Préparer et exécuter la requête d'insertion
            $stmt = $pdo->prepare("INSERT INTO patients (nom, prenom, telephone, email) VALUES (?, ?, ?, ?)");
            $stmt->execute([$nom, $prenom, $telephone, $email]);
            return true;

        } catch (PDOException $e) {
            if ($e->getCode() == 23000) { // Code d'erreur pour duplicate entry
                throw new Exception("Un patient avec cet email existe déjà.");
            }
            throw new Exception("Erreur lors de l'ajout du patient : " . $e->getMessage());
        }
    }

    // Méthode pour supprimer un patient
    public static function delete($id) {
        global $pdo;
        try {
            // Vérifier si le patient a des rendez-vous
            $stmt = $pdo->prepare("SELECT COUNT(*) FROM rendez_vous WHERE patient_id = ?");
            $stmt->execute([$id]);
            $hasAppointments = $stmt->fetchColumn() > 0;

            if ($hasAppointments) {
                // Récupérer le nombre de rendez-vous
                $stmt = $pdo->prepare("SELECT COUNT(*) as nb_rdv, MIN(date_rdv) as prochain FROM rendez_vous WHERE patient_id = ?");
                $stmt->execute([$id]);
                $info = $stmt->fetch();
                
                $message = "Ce patient a " . $info['nb_rdv'] . " rendez-vous planifié" . 
                          ($info['nb_rdv'] > 1 ? 's' : '') . ". " .
                          "Veuillez d'abord supprimer " . 
                          ($info['nb_rdv'] > 1 ? 'ces rendez-vous' : 'ce rendez-vous') . 
                          " avant de pouvoir supprimer le patient.";
                
                throw new Exception($message);
            }

            // Supprimer le patient
            $stmt = $pdo->prepare("DELETE FROM patients WHERE id = ?");
            $stmt->execute([$id]);
            
            if ($stmt->rowCount() === 0) {
                throw new Exception("Ce patient n'existe pas dans la base de données.");
            }

            // Réorganiser les IDs
            $pdo->exec("SET @count = 0");
            $pdo->exec("UPDATE patients SET id = @count:= @count + 1 ORDER BY id");
            $pdo->exec("ALTER TABLE patients AUTO_INCREMENT = 1");
            
            return true;
        } catch (PDOException $e) {
            throw new Exception("Une erreur est survenue lors de la suppression du patient. Veuillez réessayer.");
        }
    }
}
?>
