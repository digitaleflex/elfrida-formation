CREATE DATABASE gestion_rdv;
USE gestion_rdv;

-- Table des patients
CREATE TABLE patients (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    prenom VARCHAR(100) NOT NULL,
    telephone VARCHAR(15) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL
);

-- Table des rendez-vous
CREATE TABLE rendez_vous (
    id INT AUTO_INCREMENT PRIMARY KEY,
    patient_id INT NOT NULL,
    date_rdv DATE NOT NULL,
    heure_rdv TIME NOT NULL,
    FOREIGN KEY (patient_id) REFERENCES patients(id),
    CONSTRAINT unique_rdv UNIQUE (patient_id, date_rdv, heure_rdv)
);
