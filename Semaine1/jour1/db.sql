CREATE DATABASE startup_db;

USE startup_db;

CREATE TABLE employes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    poste VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL
);