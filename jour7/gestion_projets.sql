-- Création de la base de données
CREATE DATABASE gestion_projets;

USE gestion_projets;

-- Création de la table des projets
CREATE TABLE projets (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nom_projet VARCHAR(255) NOT NULL,
  date_creation DATE,
  statut ENUM('en cours', 'terminé', 'annulé') DEFAULT 'en cours',
  budget DECIMAL(10, 2) NULL
);

-- Ajout de nouvelles tables pour plus de fonctionnalités
CREATE TABLE categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    couleur VARCHAR(7) DEFAULT '#3498db'
);

CREATE TABLE membres (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    email VARCHAR(255) NOT NULL,
    role VARCHAR(50) DEFAULT 'membre'
);

-- Amélioration de la table projets
ALTER TABLE projets 
ADD COLUMN description TEXT,
ADD COLUMN categorie_id INT,
ADD COLUMN priorite ENUM('basse', 'moyenne', 'haute') DEFAULT 'moyenne',
ADD COLUMN date_fin DATE,
ADD COLUMN progression INT DEFAULT 0,
ADD FOREIGN KEY (categorie_id) REFERENCES categories(id);

-- Table de liaison projets-membres
CREATE TABLE projet_membres (
    projet_id INT,
    membre_id INT,
    FOREIGN KEY (projet_id) REFERENCES projets(id),
    FOREIGN KEY (membre_id) REFERENCES membres(id),
    PRIMARY KEY (projet_id, membre_id)
);

-- Insertion de données de test
INSERT INTO categories (nom, couleur) VALUES 
('Développement', '#3498db'),
('Marketing', '#2ecc71'),
('Design', '#e74c3c'),
('R&D', '#f1c40f');

INSERT INTO membres (nom, email, role) VALUES
('Jean Dupont', 'jean@example.com', 'chef de projet'),
('Marie Martin', 'marie@example.com', 'développeur'),
('Paul Bernard', 'paul@example.com', 'designer');

INSERT INTO projets (nom_projet, description, date_creation, date_fin, statut, budget, categorie_id, priorite, progression) VALUES
('Refonte Site Web', 'Modernisation du site corporate', '2024-01-01', '2024-06-30', 'en cours', 15000.00, 1, 'haute', 65),
('Campagne Marketing Q2', 'Campagne réseaux sociaux', '2024-02-15', '2024-05-15', 'en cours', 8000.00, 2, 'moyenne', 30),
('Application Mobile', 'Développement app iOS/Android', '2024-03-01', '2024-12-31', 'en cours', 45000.00, 1, 'haute', 15);
