<?php
require_once __DIR__ . '/../models/RendezVous.php';
require_once __DIR__ . '/../utils/flash.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $errors = [];
        
        // Validation de la date
        $date_rdv = $_POST["date_rdv"];
        $heure_rdv = $_POST["heure_rdv"];
        $patient_id = $_POST["patient_id"];

        // Vérification si la date n'est pas dans le passé
        if (strtotime($date_rdv) < strtotime(date('Y-m-d'))) {
            $errors[] = "La date du rendez-vous ne peut pas être dans le passé.";
        }

        // Vérification des horaires de travail (8h-18h)
        $heure = (int)substr($heure_rdv, 0, 2);
        if ($heure < 8 || $heure >= 18) {
            $errors[] = "Les rendez-vous doivent être pris entre 8h et 18h.";
        }

        if (empty($patient_id)) {
            $errors[] = "Veuillez sélectionner un patient.";
        }

        if (empty($errors)) {
            if (RendezVous::add($patient_id, $date_rdv, $heure_rdv)) {
                Flash::setMessage('success', 'Rendez-vous ajouté avec succès !');
                header("Location: ../../index.Php");
                exit();
            }
        } else {
            Flash::setMessage('error', implode("<br>", $errors));
            header("Location: ../views/add_rdv.php");
            exit();
        }
    } catch (Exception $e) {
        Flash::setMessage('error', "Erreur : " . $e->getMessage());
        header("Location: ../views/add_rdv.php");
        exit();
    }
}

// Gestion de la suppression
if (isset($_GET['delete'])) {
    try {
        $id = $_GET['delete'];
        if (!is_numeric($id) || $id <= 0) {
            throw new Exception("Numéro de rendez-vous invalide.");
        }

        if (RendezVous::delete($id)) {
            Flash::setMessage('success', 'Le rendez-vous a été supprimé avec succès !');
        }
    } catch (Exception $e) {
        Flash::setMessage('error', $e->getMessage());
    }
    header("Location: ../../index.Php");
    exit();
}
?>
