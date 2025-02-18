USE gestion_rdv;

-- Insertion des patients
INSERT INTO patients (nom, prenom, telephone, email) VALUES
('Dupont', 'Jean', '0601020304', 'jean.dupont@example.com'),
('Martin', 'Claire', '0605060708', 'claire.martin@example.com'),
('Lemoine', 'Pierre', '0612345678', 'pierre.lemoine@example.com'),
('Robert', 'Sophie', '0623456789', 'sophie.robert@example.com'),
('Durand', 'Marc', '0634567890', 'marc.durand@example.com'),
('Blanc', 'Lucie', '0645678901', 'lucie.blanc@example.com'),
('Girard', 'Paul', '0656789012', 'paul.girard@example.com'),
('Benoit', 'Isabelle', '0678901234', 'isabelle.benoit@example.com'),
('Pires', 'André', '0689012345', 'andre.pires@example.com'),
('Faure', 'Aline', '0690123456', 'aline.faure@example.com'),
('Lemoine', 'Anne', '0701234567', 'anne.lemoine@example.com'),
('Perrier', 'Jacques', '0712345678', 'jacques.perrier@example.com'),
('Lopez', 'Marc', '0723456789', 'marc.lopez@example.com'),
('Roche', 'Fanny', '0734567890', 'fanny.roche@example.com'),
('Vidal', 'Alice', '0745678901', 'alice.vidal@example.com'),
('Berger', 'Hélène', '0756789012', 'helene.berger@example.com'),
('Simon', 'Eric', '0767890123', 'eric.simon@example.com'),
('Leclerc', 'Chloé', '0778901234', 'chloe.leclerc@example.com'),
('Dufresne', 'Gabriel', '0789012345', 'gabriel.dufresne@example.com');

-- Insertion des rendez-vous
-- Patient 1 : Jean Dupont
INSERT INTO rendez_vous (patient_id, date_rdv, heure_rdv) VALUES
(1, '2025-02-20', '10:00:00'),
(1, '2025-02-21', '14:30:00'),
(1, '2025-02-22', '16:00:00');

-- Patient 2 : Claire Martin
INSERT INTO rendez_vous (patient_id, date_rdv, heure_rdv) VALUES
(2, '2025-02-20', '09:00:00'),
(2, '2025-02-21', '11:00:00'),
(2, '2025-02-22', '16:00:00'),
(2, '2025-02-23', '14:00:00');

-- Patient 3 : Pierre Lemoine
INSERT INTO rendez_vous (patient_id, date_rdv, heure_rdv) VALUES
(3, '2025-02-21', '11:00:00'),
(3, '2025-02-23', '10:30:00');

-- Patient 4 : Sophie Robert
INSERT INTO rendez_vous (patient_id, date_rdv, heure_rdv) VALUES
(4, '2025-02-22', '13:00:00'),
(4, '2025-02-24', '15:00:00');

-- Patient 5 : Marc Durand
INSERT INTO rendez_vous (patient_id, date_rdv, heure_rdv) VALUES
(5, '2025-02-20', '12:00:00'),
(5, '2025-02-22', '09:30:00'),
(5, '2025-02-23', '15:30:00');

-- Patient 6 : Lucie Blanc
INSERT INTO rendez_vous (patient_id, date_rdv, heure_rdv) VALUES
(6, '2025-02-21', '14:00:00'),
(6, '2025-02-23', '12:00:00'),
(6, '2025-02-24', '09:00:00');

-- Patient 7 : Paul Girard
INSERT INTO rendez_vous (patient_id, date_rdv, heure_rdv) VALUES
(7, '2025-02-22', '14:30:00'),
(7, '2025-02-23', '11:00:00'),
(7, '2025-02-24', '13:30:00');

-- Patient 8 : Isabelle Benoit
INSERT INTO rendez_vous (patient_id, date_rdv, heure_rdv) VALUES
(8, '2025-02-20', '10:30:00'),
(8, '2025-02-22', '11:00:00'),
(8, '2025-02-24', '17:00:00');

-- Patient 9 : André Pires
INSERT INTO rendez_vous (patient_id, date_rdv, heure_rdv) VALUES
(9, '2025-02-21', '09:30:00'),
(9, '2025-02-23', '16:30:00');

-- Patient 10 : Aline Faure
INSERT INTO rendez_vous (patient_id, date_rdv, heure_rdv) VALUES
(10, '2025-02-22', '08:00:00'),
(10, '2025-02-24', '10:30:00');

-- Patient 11 : Anne Lemoine
INSERT INTO rendez_vous (patient_id, date_rdv, heure_rdv) VALUES
(11, '2025-02-21', '09:00:00');

-- Patient 12 : Jacques Perrier
INSERT INTO rendez_vous (patient_id, date_rdv, heure_rdv) VALUES
(12, '2025-02-23', '13:30:00'),
(12, '2025-02-24', '14:00:00');

-- Patient 13 : Marc Lopez
INSERT INTO rendez_vous (patient_id, date_rdv, heure_rdv) VALUES
(13, '2025-02-21', '15:00:00');

-- Patient 14 : Fanny Roche
INSERT INTO rendez_vous (patient_id, date_rdv, heure_rdv) VALUES
(14, '2025-02-22', '10:00:00');

-- Patient 15 : Alice Vidal
INSERT INTO rendez_vous (patient_id, date_rdv, heure_rdv) VALUES
(15, '2025-02-23', '16:00:00');

-- Patient 16 : Hélène Berger
INSERT INTO rendez_vous (patient_id, date_rdv, heure_rdv) VALUES
(16, '2025-02-20', '08:00:00');

-- Patient 17 : Eric Simon
INSERT INTO rendez_vous (patient_id, date_rdv, heure_rdv) VALUES
(17, '2025-02-24', '11:00:00');

-- Patient 18 : Chloé Leclerc
INSERT INTO rendez_vous (patient_id, date_rdv, heure_rdv) VALUES
(18, '2025-02-20', '12:30:00');

-- Patient 19 : Gabriel Dufresne
INSERT INTO rendez_vous (patient_id, date_rdv, heure_rdv) VALUES
(19, '2025-02-21', '14:00:00');

-- Patient 20 : Isabelle Lemoine
INSERT INTO rendez_vous (patient_id, date_rdv, heure_rdv) VALUES
(20, '2025-02-22', '17:30:00');
