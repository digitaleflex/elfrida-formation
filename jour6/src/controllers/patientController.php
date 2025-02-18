<?php
require_once __DIR__ . '/../models/Patient.php';

// Gestion de la suppression
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    if (Patient::delete($id)) {
        header("Location: ../../index.Php");
        exit();
    } else {
        echo "Erreur lors de la suppression du patient.";
    }
}

// Gestion de l'ajout (code existant)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (Patient::add($_POST["nom"], $_POST["prenom"], $_POST["telephone"], $_POST["email"])) {
        header("Location: ../../index.Php");
        exit();
    } else {
        echo "Erreur lors de l'ajout du patient.";
    }
}
?>
