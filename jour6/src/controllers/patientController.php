<?php
require_once __DIR__ . '/../models/Patient.php';
require_once __DIR__ . '/../utils/flash.php';

// Gestion de la suppression
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    try {
        if (Patient::delete($id)) {
            Flash::setMessage('success', 'Patient supprimé avec succès !');
        }
    } catch (Exception $e) {
        Flash::setMessage('error', 'Impossible de supprimer ce patient car il a des rendez-vous associés.');
    }
    header("Location: ../../index.Php");
    exit();
}

// Gestion de l'ajout
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        // Validation des données
        $errors = [];
        
        // Nettoyage et validation des données
        $nom = trim($_POST["nom"]);
        $prenom = trim($_POST["prenom"]);
        $telephone = trim($_POST["telephone"]);
        $email = trim($_POST["email"]);

        if (empty($nom) || empty($prenom) || empty($telephone) || empty($email)) {
            $errors[] = "Tous les champs sont obligatoires.";
        }

        if (empty($errors)) {
            if (Patient::add($nom, $prenom, $telephone, $email)) {
                Flash::setMessage('success', 'Patient ajouté avec succès !');
                header("Location: ../../index.Php");
                exit();
            }
        } else {
            Flash::setMessage('error', implode("<br>", $errors));
            header("Location: ../views/add_patient.php");
            exit();
        }
    } catch (Exception $e) {
        Flash::setMessage('error', $e->getMessage());
        header("Location: ../views/add_patient.php");
        exit();
    }
}
?>
