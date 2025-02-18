<?php
require_once __DIR__ . '/../models/Patient.php';
require_once __DIR__ . '/../utils/flash.php';

// Gestion de la suppression
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    if (Patient::delete($id)) {
        Flash::setMessage('success', 'Patient supprimé avec succès !');
        header("Location: ../../index.Php");
        exit();
    } else {
        Flash::setMessage('error', 'Erreur lors de la suppression du patient.');
        header("Location: ../../index.Php");
        exit();
    }
}

// Gestion de l'ajout
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (Patient::add($_POST["nom"], $_POST["prenom"], $_POST["telephone"], $_POST["email"])) {
        Flash::setMessage('success', 'Patient ajouté avec succès !');
        header("Location: ../../index.Php");
        exit();
    } else {
        Flash::setMessage('error', 'Erreur lors de l\'ajout du patient.');
        header("Location: ../views/add_patient.php");
        exit();
    }
}
?>
