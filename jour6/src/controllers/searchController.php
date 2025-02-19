<?php
require_once __DIR__ . '/../config/database.php';

if (isset($_GET['search'])) {
    $search = $_GET['search'];
    
    try {
        $query = "SELECT * FROM patients 
                  WHERE nom LIKE :search 
                  OR prenom LIKE :search 
                  OR email LIKE :search 
                  OR telephone LIKE :search
                  LIMIT 5";
                  
        $stmt = $pdo->prepare($query);
        $stmt->execute(['search' => "%$search%"]);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        header('Content-Type: application/json');
        echo json_encode($results);
        
    } catch (PDOException $e) {
        header('HTTP/1.1 500 Internal Server Error');
        echo json_encode(['error' => $e->getMessage()]);
    }
}
?> 