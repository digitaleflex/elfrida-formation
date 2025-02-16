CREATE DATABASE supermarche_db;

USE supermarche_db;

CREATE TABLE produits (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    prix DECIMAL(10, 2) NOT NULL,
    stock INT NOT NULL
);