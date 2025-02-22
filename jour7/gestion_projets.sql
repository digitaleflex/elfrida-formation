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

CREATE TABLE commentaires (
    id INT AUTO_INCREMENT PRIMARY KEY,
    projet_id INT,
    membre_id INT,
    contenu TEXT,
    date_creation DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (projet_id) REFERENCES projets(id),
    FOREIGN KEY (membre_id) REFERENCES membres(id)
);

CREATE TABLE taches (
    id INT AUTO_INCREMENT PRIMARY KEY,
    projet_id INT,
    titre VARCHAR(255),
    description TEXT,
    statut ENUM('à faire', 'en cours', 'terminée') DEFAULT 'à faire',
    membre_id INT,
    date_echeance DATE,
    FOREIGN KEY (projet_id) REFERENCES projets(id),
    FOREIGN KEY (membre_id) REFERENCES membres(id)
);

CREATE TABLE rappels (
    id INT AUTO_INCREMENT PRIMARY KEY,
    projet_id INT,
    titre VARCHAR(255),
    description TEXT,
    date_rappel DATETIME,
    statut ENUM('actif', 'complété', 'annulé') DEFAULT 'actif',
    FOREIGN KEY (projet_id) REFERENCES projets(id)
);

-- Ajout de plus de catégories
INSERT INTO categories (nom, couleur) VALUES 
('Infrastructure', '#9b59b6'),
('Formation', '#34495e'),
('Communication', '#e67e22'),
('Innovation', '#16a085'),
('Support', '#95a5a6'),
('Qualité', '#d35400');

-- Ajout de plus de membres
INSERT INTO membres (nom, email, role) VALUES
('Sophie Martin', 'sophie@example.com', 'chef de projet'),
('Lucas Dubois', 'lucas@example.com', 'développeur senior'),
('Emma Petit', 'emma@example.com', 'designer UI/UX'),
('Thomas Richard', 'thomas@example.com', 'architecte solution'),
('Julie Lambert', 'julie@example.com', 'marketing'),
('Nicolas Moreau', 'nicolas@example.com', 'analyste'),
('Laura Bernard', 'laura@example.com', 'développeur mobile'),
('Antoine Leroy', 'antoine@example.com', 'chef de produit'),
('Camille Roux', 'camille@example.com', 'testeur QA'),
('Hugo Simon', 'hugo@example.com', 'développeur frontend');

-- Ajout de nombreux projets variés
INSERT INTO projets (nom_projet, description, date_creation, date_fin, statut, budget, categorie_id, priorite, progression) VALUES
-- Projets Développement
('Application CRM', 'Développement d''un CRM sur mesure', '2024-01-15', '2024-08-30', 'en cours', 75000.00, 1, 'haute', 45),
('Plateforme E-learning', 'Création d''une plateforme de formation en ligne', '2024-02-01', '2024-07-15', 'en cours', 60000.00, 1, 'haute', 30),
('API REST Services', 'Développement des API pour les services externes', '2024-01-10', '2024-04-30', 'terminé', 25000.00, 1, 'moyenne', 100),
('Module BI', 'Module de Business Intelligence', '2024-03-01', '2024-09-30', 'en cours', 90000.00, 1, 'haute', 15),
('App Mobile V2', 'Nouvelle version de l''application mobile', '2024-02-15', '2024-06-30', 'en cours', 55000.00, 1, 'haute', 40),

-- Projets Marketing
('Campagne SEO', 'Optimisation du référencement', '2024-01-20', '2024-04-20', 'terminé', 15000.00, 2, 'moyenne', 100),
('Marketing Digital Q2', 'Stratégie marketing digital', '2024-02-01', '2024-05-31', 'en cours', 35000.00, 2, 'haute', 60),
('Étude de Marché', 'Analyse des concurrents', '2024-03-01', '2024-05-15', 'en cours', 20000.00, 2, 'basse', 25),
('Réseaux Sociaux', 'Gestion des réseaux sociaux', '2024-01-01', '2024-12-31', 'en cours', 48000.00, 2, 'moyenne', 35),
('Event Tech 2024', 'Organisation salon technologique', '2024-04-01', '2024-06-30', 'en cours', 75000.00, 2, 'haute', 20),

-- Projets Design
('Refonte UX', 'Amélioration de l''expérience utilisateur', '2024-01-15', '2024-04-15', 'terminé', 30000.00, 3, 'haute', 100),
('Design System', 'Création d''un système de design unifié', '2024-02-01', '2024-05-31', 'en cours', 45000.00, 3, 'haute', 70),
('Motion Design', 'Animations et vidéos promotionnelles', '2024-03-01', '2024-06-30', 'en cours', 25000.00, 3, 'moyenne', 40),
('Charte Graphique', 'Mise à jour de la charte graphique', '2024-01-10', '2024-03-31', 'terminé', 18000.00, 3, 'basse', 100),
('Interface Mobile', 'Design de l''interface mobile', '2024-02-15', '2024-05-15', 'en cours', 35000.00, 3, 'haute', 55),

-- Projets R&D
('IA Prédictive', 'Développement algorithmes IA', '2024-01-01', '2024-12-31', 'en cours', 120000.00, 4, 'haute', 40),
('Blockchain POC', 'Proof of concept blockchain', '2024-02-01', '2024-07-31', 'en cours', 80000.00, 4, 'moyenne', 35),
('IoT Platform', 'Plateforme Internet des objets', '2024-03-01', '2024-09-30', 'en cours', 95000.00, 4, 'haute', 25),
('5G Research', 'Recherche sur applications 5G', '2024-01-15', '2024-06-30', 'annulé', 70000.00, 4, 'basse', 20),
('AR/VR Dev', 'Développement réalité augmentée', '2024-02-15', '2024-08-31', 'en cours', 85000.00, 4, 'haute', 30),

-- Projets Infrastructure
('Cloud Migration', 'Migration vers le cloud', '2024-01-01', '2024-06-30', 'en cours', 110000.00, 5, 'haute', 50),
('Sécurité Réseau', 'Renforcement sécurité', '2024-02-01', '2024-05-31', 'en cours', 65000.00, 5, 'haute', 45),
('Backup System', 'Système de sauvegarde', '2024-01-15', '2024-04-15', 'terminé', 40000.00, 5, 'moyenne', 100),
('DevOps Pipeline', 'Automatisation pipeline', '2024-03-01', '2024-08-31', 'en cours', 75000.00, 5, 'haute', 30),
('Monitoring', 'Système de monitoring', '2024-02-15', '2024-05-15', 'en cours', 45000.00, 5, 'moyenne', 60),

-- Projets Formation
('Formation Dev', 'Formation développeurs', '2024-01-15', '2024-04-15', 'terminé', 25000.00, 6, 'moyenne', 100),
('Onboarding', 'Programme d''intégration', '2024-02-01', '2024-05-31', 'en cours', 35000.00, 6, 'basse', 70),
('Certifications', 'Préparation certifications', '2024-03-01', '2024-08-31', 'en cours', 50000.00, 6, 'moyenne', 40),
('Workshop Agile', 'Formation méthodes agiles', '2024-01-10', '2024-03-31', 'terminé', 15000.00, 6, 'basse', 100),
('Tech Training', 'Formation nouvelles technologies', '2024-02-15', '2024-06-30', 'en cours', 45000.00, 6, 'haute', 35);

-- Liaison projets-membres (quelques exemples)
INSERT INTO projet_membres (projet_id, membre_id) 
SELECT p.id, m.id 
FROM projets p 
CROSS JOIN membres m 
WHERE RAND() < 0.3;

-- Ajout de quelques tâches
INSERT INTO taches (projet_id, titre, description, statut, membre_id, date_echeance) 
SELECT 
    p.id,
    CONCAT('Tâche ', FLOOR(RAND() * 100)),
    'Description de la tâche',
    ELT(FLOOR(RAND() * 3) + 1, 'à faire', 'en cours', 'terminée'),
    m.id,
    DATE_ADD(CURRENT_DATE, INTERVAL FLOOR(RAND() * 30) DAY)
FROM projets p 
CROSS JOIN membres m 
WHERE RAND() < 0.2;

-- Ajout de quelques commentaires
INSERT INTO commentaires (projet_id, membre_id, contenu) 
SELECT 
    p.id,
    m.id,
    CONCAT('Commentaire sur l''avancement du projet - ', FLOOR(RAND() * 100))
FROM projets p 
CROSS JOIN membres m 
WHERE RAND() < 0.2;
