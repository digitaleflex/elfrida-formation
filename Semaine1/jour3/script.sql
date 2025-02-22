CREATE DATABASE IF NOT EXISTS restaurant;
USE restaurant;

CREATE TABLE IF NOT EXISTS clients (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS commandes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    client_id INT NOT NULL,
    produit VARCHAR(100) NOT NULL,
    statut ENUM('en attente', 'validée', 'livrée', 'annulée') DEFAULT 'en attente',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (client_id) REFERENCES clients(id)
);

-- Données de test
INSERT INTO clients (nom, email) VALUES
('Jean Dupont', 'jean@example.com'),
('Marie Martin', 'marie@example.com'),
('Pierre Durant', 'pierre@example.com');

INSERT INTO commandes (client_id, produit, statut) VALUES
(1, 'Pizza', 'en attente'),
(2, 'Pâtes', 'validée'),
(1, 'Salade', 'livrée'),
(3, 'Pizza', 'en attente'),
(2, 'Pâtes', 'validée');