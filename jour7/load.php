<?php
ob_start(); // Démarrer la mise en mémoire tampon
error_reporting(0);
ini_set('display_errors', 0);

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
            throw new Exception("Erreur de connexion : " . $e->getMessage());
        }
    }
}

class ProjectManager {
    private $db;
    
    public function __construct($db) {
        $this->db = $db;
    }

    public function getProjects() {
        try {
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
        } catch (PDOException $e) {
            return ['error' => $e->getMessage()];
        }
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

    public function generateReport($startDate, $endDate) {
        $query = "
            SELECT 
                COUNT(*) as total_projets,
                SUM(CASE WHEN statut = 'terminé' THEN 1 ELSE 0 END) as projets_termines,
                AVG(progression) as progression_moyenne,
                SUM(budget) as budget_total
            FROM projets
            WHERE date_creation BETWEEN ? AND ?
        ";
        // ... implementation ...
    }

    public function getCategories() {
        $stmt = $this->db->conn->prepare("SELECT id, nom FROM categories");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addProject($data) {
        try {
            $query = "INSERT INTO projets (
                nom_projet, description, date_creation, date_fin,
                categorie_id, priorite, budget, statut, progression
            ) VALUES (
                :nom_projet, :description, :date_creation, :date_fin,
                :categorie_id, :priorite, :budget, 'en cours', 0
            )";

            $stmt = $this->db->conn->prepare($query);
            $stmt->execute([
                'nom_projet' => $data['nom_projet'],
                'description' => $data['description'],
                'date_creation' => $data['date_creation'],
                'date_fin' => $data['date_fin'],
                'categorie_id' => $data['categorie_id'],
                'priorite' => $data['priorite'],
                'budget' => $data['budget']
            ]);

            return ['success' => true, 'id' => $this->db->conn->lastInsertId()];
        } catch (PDOException $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function updateProject($data) {
        try {
            // Validation des données
            if (!isset($data['project_id']) || !isset($data['nom_projet'])) {
                return ['success' => false, 'error' => 'Données manquantes'];
            }

            $progression = intval($data['progression']);
            if ($progression < 0 || $progression > 100) {
                return ['success' => false, 'error' => 'Progression invalide'];
            }

            $query = "UPDATE projets SET 
                nom_projet = :nom_projet,
                description = :description,
                date_creation = :date_creation,
                date_fin = :date_fin,
                categorie_id = :categorie_id,
                priorite = :priorite,
                statut = :statut,
                progression = :progression,
                budget = :budget
                WHERE id = :id";

            $stmt = $this->db->conn->prepare($query);
            $result = $stmt->execute([
                'id' => $data['project_id'],
                'nom_projet' => $data['nom_projet'],
                'description' => $data['description'],
                'date_creation' => $data['date_creation'],
                'date_fin' => $data['date_fin'],
                'categorie_id' => $data['categorie_id'],
                'priorite' => $data['priorite'],
                'statut' => $data['statut'],
                'progression' => $progression,
                'budget' => floatval($data['budget'])
            ]);

            return ['success' => $result];
        } catch (PDOException $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function deleteProject($id) {
        try {
            // Supprimer d'abord les références dans les tables liées
            $this->db->conn->prepare("DELETE FROM projet_membres WHERE projet_id = ?")->execute([$id]);
            $this->db->conn->prepare("DELETE FROM commentaires WHERE projet_id = ?")->execute([$id]);
            $this->db->conn->prepare("DELETE FROM taches WHERE projet_id = ?")->execute([$id]);
            $this->db->conn->prepare("DELETE FROM rappels WHERE projet_id = ?")->execute([$id]);
            
            // Supprimer le projet
            $stmt = $this->db->conn->prepare("DELETE FROM projets WHERE id = ?");
            $stmt->execute([$id]);

            return ['success' => true];
        } catch (PDOException $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }
}

// Ne rien afficher directement, tout passer par json_encode
$database = new DatabaseConnection();
$projectManager = new ProjectManager($database);

$action = $_GET['action'] ?? 'projects';
$result = [];

switch($action) {
    case 'stats':
        $result = $projectManager->getProjectStats();
        break;
    case 'categories':
        $result = $projectManager->getCategories();
        break;
    case 'add_project':
        $result = $projectManager->addProject($_POST);
        break;
    case 'update_project':
        $result = $projectManager->updateProject($_POST);
        break;
    case 'delete_project':
        $result = $projectManager->deleteProject($_GET['id']);
        break;
    default:
        $result = $projectManager->getProjects();
}

echo json_encode($result);
exit;
?>
