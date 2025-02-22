<?php
header('Content-Type: application/json');

class DatabaseConnection {
    private $host = 'localhost';
    private $db = 'gestion_projets';
    private $user = 'root';
    private $password = '';
    public $conn;

    public function __construct() {
        try {
            $this->conn = new PDO("mysql:host=$this->host;dbname=$this->db", $this->user, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Erreur de connexion : " . $e->getMessage();
        }
    }
}

class ProjectManager {
    private $db;
    
    public function __construct($db) {
        $this->db = $db;
    }

    public function getProjects() {
        $query = "
            SELECT p.*, c.nom as categorie_nom, c.couleur,
            COUNT(DISTINCT pm.membre_id) as nombre_membres
            FROM projets p
            LEFT JOIN categories c ON p.categorie_id = c.id
            LEFT JOIN projet_membres pm ON p.id = pm.projet_id
            GROUP BY p.id
        ";
        
        $stmt = $this->db->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getProjectStats() {
        $stats = [
            'total' => 0,
            'budget_total' => 0,
            'progression_moyenne' => 0,
            'par_statut' => [],
            'par_categorie' => [],
            'par_priorite' => []
        ];

        $query = "
            SELECT 
                COUNT(*) as total,
                SUM(budget) as budget_total,
                AVG(progression) as progression_moyenne,
                statut,
                categorie_id,
                priorite
            FROM projets
            GROUP BY statut, categorie_id, priorite
        ";

        $stmt = $this->db->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

$database = new DatabaseConnection();
$projectManager = new ProjectManager($database);

$action = $_GET['action'] ?? 'projects';

switch($action) {
    case 'stats':
        echo json_encode($projectManager->getProjectStats());
        break;
    default:
        echo json_encode($projectManager->getProjects());
}
?>
