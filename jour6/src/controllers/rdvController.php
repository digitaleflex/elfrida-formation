<?php
require_once __DIR__ . '/../models/RendezVous.php';
require_once __DIR__ . '/../utils/flash.php';

// Gestion de la suppression
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    if (RendezVous::delete($id)) {
        Flash::setMessage('success', 'Rendez-vous supprimé avec succès !');
        header("Location: ../../index.Php");
        exit();
    } else {
        Flash::setMessage('error', 'Erreur lors de la suppression du rendez-vous.');
        header("Location: ../../index.Php");
        exit();
    }
}

// Gestion de l'ajout (code existant)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (RendezVous::add($_POST["patient_id"], $_POST["date_rdv"], $_POST["heure_rdv"])) {
        Flash::setMessage('success', 'Rendez-vous ajouté avec succès !');
        header("Location: ../../index.Php");
        exit();
    } else {
        Flash::setMessage('error', 'Erreur : Ce créneau est déjà réservé.');
        header("Location: ../views/add_rdv.php");
        exit();
    }
}
?>
