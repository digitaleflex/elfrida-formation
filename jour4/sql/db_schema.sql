-- Création de la base de données (si nécessaire)
CREATE DATABASE IF NOT EXISTS auth_project;

-- Sélection de la base de données
USE auth_project;

-- Création de la table utilisateurs
CREATE TABLE IF NOT EXISTS utilisateurs (
    id INT AUTO_INCREMENT PRIMARY KEY,      -- Identifiant unique de l'utilisateur
    username VARCHAR(255) NOT NULL UNIQUE,  -- Nom d'utilisateur unique
    password VARCHAR(255) NOT NULL,         -- Mot de passe haché
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP -- Date de création de l'utilisateur
);

-- Exemple d'insertion d'un utilisateur (à ne pas faire en production)
-- INSERT INTO utilisateurs (username, password) VALUES ('exemple', 'motdepassehache');
