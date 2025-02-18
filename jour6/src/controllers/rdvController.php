<?php
require_once __DIR__ . '/../models/RendezVous.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (RendezVous::add($_POST["patient_id"], $_POST["date_rdv"], $_POST["heure_rdv"])) {
        header("Location: ../../index.Php");
        exit();
    } else {
        echo "Erreur : Ce créneau est déjà réservé.";
    }
}
?>
