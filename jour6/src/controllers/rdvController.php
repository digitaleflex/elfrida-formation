<?php
require_once __DIR__ . '/../models/RendezVous.php';

// Gestion de la suppression
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    if (RendezVous::delete($id)) {
        header("Location: ../../index.Php");
        exit();
    } else {
        echo "Erreur lors de la suppression du rendez-vous.";
    }
}

// Gestion de l'ajout (code existant)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (RendezVous::add($_POST["patient_id"], $_POST["date_rdv"], $_POST["heure_rdv"])) {
        header("Location: ../../index.Php");
        exit();
    } else {
        echo "Erreur : Ce créneau est déjà réservé.";
    }
}
?>
