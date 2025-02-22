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
            // Vérifier si l'ID est présent
            if (!isset($data['id']) && !isset($data['project_id'])) {
                return ['success' => false, 'error' => 'ID du projet manquant'];
            }

            // Utiliser project_id si id n'est pas défini
            $projectId = $data['id'] ?? $data['project_id'];

            // Construire la requête SQL dynamiquement
            $updateFields = [];
            $params = [];
            
            // Mettre à jour uniquement les champs fournis
            if (isset($data['statut'])) {
                $updateFields[] = 'statut = ?';
                $params[] = $data['statut'];
            }
            if (isset($data['nom_projet'])) {
                $updateFields[] = 'nom_projet = ?';
                $params[] = $data['nom_projet'];
            }
            if (isset($data['description'])) {
                $updateFields[] = 'description = ?';
                $params[] = $data['description'];
            }
            if (isset($data['budget'])) {
                $updateFields[] = 'budget = ?';
                $params[] = floatval($data['budget']);
            }
            if (isset($data['progression'])) {
                $updateFields[] = 'progression = ?';
                $params[] = intval($data['progression']);
            }
            if (isset($data['date_creation'])) {
                $updateFields[] = 'date_creation = ?';
                $params[] = $data['date_creation'];
            }
            if (isset($data['date_fin'])) {
                $updateFields[] = 'date_fin = ?';
                $params[] = $data['date_fin'];
            }
            if (isset($data['priorite'])) {
                $updateFields[] = 'priorite = ?';
                $params[] = $data['priorite'];
            }
            if (isset($data['categorie_id'])) {
                $updateFields[] = 'categorie_id = ?';
                $params[] = $data['categorie_id'];
            }

            // Si aucun champ à mettre à jour
            if (empty($updateFields)) {
                return ['success' => false, 'error' => 'Aucune donnée à mettre à jour'];
            }

            // Ajouter l'ID à la fin des paramètres
            $params[] = $projectId;

            // Construire et exécuter la requête
            $sql = "UPDATE projets SET " . implode(', ', $updateFields) . " WHERE id = ?";
            $stmt = $this->db->conn->prepare($sql);
            $stmt->execute($params);

            if ($stmt->rowCount() > 0) {
                return ['success' => true];
            } else {
                return ['success' => false, 'error' => 'Aucune modification effectuée'];
            }
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

    public function exportData() {
        try {
            // Récupérer les projets avec leurs détails
            $query = "
                SELECT 
                    p.*,
                    c.nom as categorie_nom,
                    c.couleur,
                    GROUP_CONCAT(DISTINCT m.nom) as membres,
                    COUNT(DISTINCT t.id) as nombre_taches,
                    COUNT(DISTINCT com.id) as nombre_commentaires
                FROM projets p
                LEFT JOIN categories c ON p.categorie_id = c.id
                LEFT JOIN projet_membres pm ON p.id = pm.projet_id
                LEFT JOIN membres m ON pm.membre_id = m.id
                LEFT JOIN taches t ON p.id = t.projet_id
                LEFT JOIN commentaires com ON p.id = com.projet_id
                GROUP BY p.id
            ";
            
            $stmt = $this->db->conn->prepare($query);
            $stmt->execute();
            $projets = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Ajouter des métadonnées
            $export = [
                'date_export' => date('Y-m-d H:i:s'),
                'nombre_projets' => count($projets),
                'projets' => $projets
            ];

            return $export;
        } catch (PDOException $e) {
            return ['error' => $e->getMessage()];
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
        $data = $_POST;
        // Vérifier si l'ID est présent dans l'URL
        if (isset($_GET['id'])) {
            $data['id'] = $_GET['id'];
        }
        $result = $projectManager->updateProject($data);
        break;
    case 'delete_project':
        $result = $projectManager->deleteProject($_GET['id']);
        break;
    case 'export':
        $result = $projectManager->exportData();
        break;
    default:
        $result = $projectManager->getProjects();
}

echo json_encode($result);
exit;
?>
