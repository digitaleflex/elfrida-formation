CREATE DATABASE restaurant;
USE restaurant;

CREATE TABLE clients (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL
);

CREATE TABLE commandes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    client_id INT,
    produit VARCHAR(100) NOT NULL,
    statut ENUM('en attente', 'validée', 'livrée') DEFAULT 'en attente',
    FOREIGN KEY (client_id) REFERENCES clients(id) ON DELETE CASCADE
);

-- Insérer des données de test
INSERT INTO clients (nom, email) VALUES ('Alice', 'alice@example.com'), ('Bob', 'bob@example.com');
INSERT INTO commandes (client_id, produit, statut) VALUES 
(1, 'Pizza', 'en attente'), 
(2, 'Pâtes', 'validée');