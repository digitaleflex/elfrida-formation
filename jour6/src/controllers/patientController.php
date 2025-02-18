<?php
require_once __DIR__ . '/../models/Patient.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (Patient::add($_POST["nom"], $_POST["prenom"], $_POST["telephone"], $_POST["email"])) {
        header("Location: ../../index.Php");
        exit();
    } else {
        echo "Erreur lors de l'ajout du patient.";
    }
}
?>
