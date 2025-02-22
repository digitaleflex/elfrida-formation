<?php
// Désactiver l'affichage des erreurs et le buffer
error_reporting(0);
ini_set('display_errors', 0);
ob_start();

// Charger l'autoloader de Composer
require __DIR__ . '/vendor/autoload.php';
require_once('load.php');

// Import des classes nécessaires
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ExportManager {
    private $db;
    
    public function __construct($db) {
        $this->db = $db;
    }

    public function exportToPDF() {
        try {
            // Nettoyer le buffer
            ob_end_clean();
            
            // Créer le PDF
            $pdf = new \TCPDF('L', 'mm', 'A4', true, 'UTF-8');
            
            // Configuration
            $pdf->SetCreator('Gestion de Projets');
            $pdf->SetAuthor('DIGITALE FLEX');
            $pdf->SetTitle('Liste des Projets');
            $pdf->setPrintHeader(false);
            $pdf->setPrintFooter(false);
            $pdf->SetMargins(15, 15, 15);
            
            // Ajouter une page
            $pdf->AddPage();
            
            // Ajouter un titre
            $pdf->SetFont('helvetica', 'B', 16);
            $pdf->Cell(0, 10, 'Liste des Projets', 0, 1, 'C');
            $pdf->Ln(10);

            // Configuration du tableau
            $pdf->SetFont('helvetica', '', 10);
            
            // En-tête du tableau
            $header = array('Projet', 'Statut', 'Budget', 'Progression', 'Date Début', 'Date Fin');
            $w = array(50, 25, 30, 25, 30, 30); // Largeurs des colonnes
            
            // Couleurs d'en-tête
            $pdf->SetFillColor(52, 144, 220); // Bleu
            $pdf->SetTextColor(255); // Blanc
            $pdf->SetFont('', 'B');

            // En-tête du tableau
            for($i = 0; $i < count($header); $i++) {
                $pdf->Cell($w[$i], 7, $header[$i], 1, 0, 'C', true);
            }
            $pdf->Ln();

            // Couleur et style pour les données
            $pdf->SetFillColor(245, 245, 245);
            $pdf->SetTextColor(0);
            $pdf->SetFont('');

            // Données
            $query = "SELECT nom_projet, statut, budget, progression, date_creation, date_fin FROM projets";
            $stmt = $this->db->conn->prepare($query);
            $stmt->execute();
            $projects = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $fill = false;
            foreach($projects as $row) {
                $pdf->Cell($w[0], 6, $row['nom_projet'], 'LR', 0, 'L', $fill);
                $pdf->Cell($w[1], 6, $row['statut'], 'LR', 0, 'C', $fill);
                $pdf->Cell($w[2], 6, number_format($row['budget'], 0, ',', ' ') . ' F', 'LR', 0, 'R', $fill);
                $pdf->Cell($w[3], 6, $row['progression'] . '%', 'LR', 0, 'C', $fill);
                $pdf->Cell($w[4], 6, date('d/m/Y', strtotime($row['date_creation'])), 'LR', 0, 'C', $fill);
                $pdf->Cell($w[5], 6, date('d/m/Y', strtotime($row['date_fin'])), 'LR', 0, 'C', $fill);
                $pdf->Ln();
                $fill = !$fill;
            }
            
            // Ligne de fermeture
            $pdf->Cell(array_sum($w), 0, '', 'T');

            // Envoi du PDF
            $pdf->Output('projets.pdf', 'D');
            exit;
        } catch (\Exception $e) {
            header('Content-Type: application/json');
            http_response_code(500);
            die(json_encode(['error' => $e->getMessage()]));
        }
    }

    public function exportToExcel() {
        try {
            // Nettoyer tout output précédent
            if (ob_get_length()) ob_clean();
            
            if (headers_sent()) {
                throw new Exception("Impossible d'envoyer l'Excel - Les en-têtes ont déjà été envoyés");
            }

            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment; filename="projets.xlsx"');
            header('Cache-Control: max-age=0');

            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();

            // En-tête
            $sheet->setCellValue('A1', 'Projet');
            $sheet->setCellValue('B1', 'Description');
            $sheet->setCellValue('C1', 'Statut');
            $sheet->setCellValue('D1', 'Budget');
            $sheet->setCellValue('E1', 'Progression');
            $sheet->setCellValue('F1', 'Date Début');
            $sheet->setCellValue('G1', 'Date Fin');
            $sheet->setCellValue('H1', 'Priorité');

            // Style de l'en-tête
            $sheet->getStyle('A1:H1')->getFont()->setBold(true);
            $sheet->getStyle('A1:H1')->getFill()
                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                ->getStartColor()->setARGB('FFCCCCCC');

            // Données
            $query = "SELECT * FROM projets ORDER BY date_creation DESC";
            $stmt = $this->db->conn->prepare($query);
            $stmt->execute();
            $projects = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $row = 2;
            foreach($projects as $project) {
                $sheet->setCellValue('A'.$row, $project['nom_projet']);
                $sheet->setCellValue('B'.$row, $project['description']);
                $sheet->setCellValue('C'.$row, $project['statut']);
                $sheet->setCellValue('D'.$row, $project['budget']);
                $sheet->setCellValue('E'.$row, $project['progression'].'%');
                $sheet->setCellValue('F'.$row, $project['date_creation']);
                $sheet->setCellValue('G'.$row, $project['date_fin']);
                $sheet->setCellValue('H'.$row, $project['priorite']);
                $row++;
            }

            // Ajuster la largeur des colonnes
            foreach(range('A','H') as $col) {
                $sheet->getColumnDimension($col)->setAutoSize(true);
            }

            // Créer le fichier Excel
            $writer = new Xlsx($spreadsheet);
            
            ob_clean(); // Nettoyer une dernière fois
            $writer->save('php://output');
            die();
        } catch (Exception $e) {
            ob_clean();
            header('Content-Type: application/json');
            http_response_code(500);
            die(json_encode(['error' => $e->getMessage()]));
        }
    }
}

// Point d'entrée principal
try {
    require_once('load.php');
    
    if (!isset($_GET['type'])) {
        throw new Exception('Type d\'export non spécifié');
    }

    $database = new DatabaseConnection();
    $exportManager = new ExportManager($database);

    switch($_GET['type']) {
        case 'pdf':
            $exportManager->exportToPDF();
            break;
        case 'excel':
            $exportManager->exportToExcel();
            break;
        default:
            throw new Exception('Type d\'export non valide');
    }
} catch (Exception $e) {
    ob_clean();
    header('Content-Type: application/json');
    http_response_code(500);
    die(json_encode(['error' => $e->getMessage()]));
} 