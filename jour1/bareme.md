Voici un **barème et des critères de correction** pour évaluer le travail des étudiants sur le projet de gestion des employés d'une startup en PHP/MySQL/PDO. Ce barème est structuré pour couvrir les aspects techniques, fonctionnels et organisationnels du projet.

---

## **Barème et Critères de Correction**

### **1. Fonctionnalités Implémentées (50%)**
Évaluation des fonctionnalités principales demandées dans l'énoncé.

#### a. **CRUD Complet (40%)**
- **Ajout d'employés** (`ajouter_employe.php`) : 10%
  - Formulaire fonctionnel avec validation des champs.
  - Données insérées correctement dans la base de données.

- **Liste des employés** (`index.php`) : 10%
  - Affichage sous forme de tableau HTML bien formaté.
  - Lien vers les actions "Modifier" et "Supprimer".

- **Modification d'employés** (`modifier_employe.php`) : 10%
  - Récupération correcte des données depuis la base de données.
  - Formulaire pré-rempli avec les données existantes.
  - Mise à jour réussie dans la base de données.

- **Suppression d'employés** (`supprimer_employe.php`) : 10%
  - Suppression confirmée via une boîte de dialogue JavaScript.
  - Employé supprimé correctement de la base de données.

#### b. **Gestion des erreurs (10%)**
- Gestion des erreurs lors des opérations CRUD (par exemple, message d'erreur si un champ obligatoire est manquant ou si une requête échoue).
- Messages clairs affichés à l'utilisateur.

---

### **2. Qualité Technique (30%)**
Évaluation de la qualité technique du code et de la sécurité.

#### a. **Utilisation de PDO (10%)**
- Utilisation correcte de PDO pour interagir avec la base de données.
- Requêtes sécurisées avec `prepare()` et liaisons de paramètres (`:nom`, `:poste`, etc.).

#### b. **Structure du Code (10%)**
- Organisation claire des fichiers (ex. : `db.php`, `index.php`, etc.).
- Respect des bonnes pratiques de codage (indentation, noms de variables explicites, commentaires).

#### c. **Sécurité (10%)**
- Protection contre les injections SQL grâce à PDO.
- Échappement des sorties utilisateur avec `htmlspecialchars()` pour éviter les attaques XSS.

---

### **3. Interface Utilisateur (10%)**
Évaluation de la qualité de l'interface utilisateur.

#### a. **Design et Responsive (5%)**
- Utilisation de Bootstrap pour un design moderne et responsive.
- Adaptation aux petits écrans (mobiles, tablettes).

#### b. **Expérience Utilisateur (5%)**
- Navigation intuitive entre les pages.
- Messages clairs pour guider l'utilisateur (par exemple, confirmation de suppression).

---

### **4. Documentation et Présentation (10%)**
Évaluation de la documentation et de la présentation du projet.

#### a. **README.md (5%)**
- Fichier `README.md` complet avec :
  - Description du projet.
  - Instructions d'installation détaillées.
  - Liste des fonctionnalités implémentées.
  - Capture d'écran (optionnel mais apprécié).

#### b. **Présentation du Projet (5%)**
- Clarté et professionnalisme lors de la présentation orale (si applicable).
- Explications des choix techniques et des difficultés rencontrées.

---

## **Grille de Notation**

| Critère                          | Pourcentage | Points (sur 20) |
|----------------------------------|-------------|-----------------|
| **Fonctionnalités Implémentées** | 50%         | 10              |
| - Ajout d'employés               | 10%         | 2               |
| - Liste des employés             | 10%         | 2               |
| - Modification d'employés        | 10%         | 2               |
| - Suppression d'employés         | 10%         | 2               |
| - Gestion des erreurs            | 10%         | 2               |
| **Qualité Technique**            | 30%         | 6               |
| - Utilisation de PDO             | 10%         | 2               |
| - Structure du Code              | 10%         | 2               |
| - Sécurité                       | 10%         | 2               |
| **Interface Utilisateur**        | 10%         | 2               |
| - Design et Responsive           | 5%          | 1               |
| - Expérience Utilisateur         | 5%          | 1               |
| **Documentation et Présentation**| 10%         | 2               |
| - README.md                      | 5%          | 1               |
| - Présentation du Projet         | 5%          | 1               |
