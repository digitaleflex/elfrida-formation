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
            // Démarrer une transaction
            $pdo->beginTransaction();

            // Vérifier si le patient a des rendez-vous
            $stmt = $pdo->prepare("SELECT COUNT(*) FROM rendez_vous WHERE patient_id = ?");
            $stmt->execute([$id]);
            $hasAppointments = $stmt->fetchColumn() > 0;

            if ($hasAppointments) {
                throw new Exception("Ce patient a des rendez-vous programmés. Veuillez d'abord supprimer ses rendez-vous.");
            }

            // Supprimer le patient
            $stmt = $pdo->prepare("DELETE FROM patients WHERE id = ?");
            $stmt->execute([$id]);
            
            if ($stmt->rowCount() === 0) {
                throw new Exception("Patient non trouvé.");
            }

            // Réorganiser les IDs
            $pdo->query("SET @count = 0;");
            $pdo->query("UPDATE patients SET id = @count:= @count + 1 ORDER BY id;");
            $pdo->query("ALTER TABLE patients AUTO_INCREMENT = 1;");

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
