<?php
require 'vendor/autoload.php';

// Test TCPDF
try {
    $pdf = new TCPDF();
    echo "TCPDF fonctionne correctement<br>";
} catch (Exception $e) {
    echo "Erreur TCPDF : " . $e->getMessage() . "<br>";
}

// Test PhpSpreadsheet
try {
    $spreadsheet = new PhpOffice\PhpSpreadsheet\Spreadsheet();
    echo "PhpSpreadsheet fonctionne correctement<br>";
} catch (Exception $e) {
    echo "Erreur PhpSpreadsheet : " . $e->getMessage() . "<br>";
} 