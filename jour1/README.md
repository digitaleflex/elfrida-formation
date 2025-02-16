# Gestion des Employés - Startup Management

![HTML](https://img.shields.io/badge/HTML-239120?style=for-the-badge&logo=html5&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-005C84?style=for-the-badge&logo=mysql&logoColor=white)
![Bootstrap](https://img.shields.io/badge/Bootstrap-7952B3?style=for-the-badge&logo=bootstrap&logoColor=white)

Ce projet est une application web PHP qui permet de gérer les employés d'une startup en utilisant une base de données MySQL. Il implémente les opérations CRUD (Create, Read, Update, Delete) pour ajouter, afficher, modifier et supprimer des employés. L'interface utilisateur est stylisée avec Bootstrap pour un design moderne et responsive.

---

## Table des matières

- [Présentation](#présentation)
- [Fonctionnalités](#fonctionnalités)
- [Technologies utilisées](#technologies-utilisées)
- [Installation](#installation)
- [Utilisation](#utilisation)
- [Contribuer](#contribuer)
- [Licence](#licence)

---

## Présentation

Cette application a été développée pour aider les administrateurs à organiser efficacement les informations sur les employés d'une startup. Les données sont stockées dans une base de données MySQL, et toutes les requêtes sont sécurisées grâce à l'utilisation de PDO avec des requêtes préparées (`prepare()`).

L'application inclut les pages suivantes :
- **Liste des employés** (`index.php`) : Affiche tous les employés sous forme de tableau.
- **Ajout d'un employé** (`ajouter_employe.php`) : Permet d'ajouter un nouvel employé via un formulaire.
- **Modification d'un employé** (`modifier_employe.php`) : Mettre à jour les informations d'un employé existant.
- **Suppression d'un employé** (`supprimer_employe.php`) : Supprimer un employé de la base de données.

---

## Fonctionnalités

- **CRUD complet** : Ajout, lecture, modification et suppression des employés.
- **Validation des données** : Vérifie que tous les champs obligatoires sont remplis avant d'exécuter les opérations.
- **Sécurité** : Utilise PDO pour protéger contre les injections SQL.
- **Design responsive** : Interface utilisateur stylisée avec Bootstrap pour une expérience utilisateur agréable sur tous les appareils.

---

## Technologies utilisées

- **Backend** : PHP 7.x ou supérieur
- **Base de données** : MySQL
- **Frontend** : HTML, CSS (avec Bootstrap), JavaScript
- **ORM/Liaison BDD** : PDO (PHP Data Objects)

---

## Installation

Suivez ces étapes pour installer et configurer le projet localement :

### 1. Cloner le dépôt

```bash
git clone https://github.com/digitaleflex/elfrida-formation.git
cd elfrida-formation
```

### 2. Créer la base de données

Créez une base de données MySQL nommée `startup_db` et exécutez le script SQL suivant pour créer la table `employes` :

```sql
CREATE DATABASE startup_db;

USE startup_db;

CREATE TABLE employes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    poste VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL
);
```

### 3. Configurer la connexion à la base de données

Ouvrez le fichier `db.php` et modifiez les paramètres de connexion selon votre configuration MySQL :

```php
$host = 'localhost'; // Hôte MySQL
$dbname = 'startup_db'; // Nom de la base de données
$username = 'root'; // Utilisateur MySQL
$password = ''; // Mot de passe MySQL
```

### 4. Démarrer un serveur local

Placez les fichiers du projet dans le répertoire de votre serveur web local (par exemple, `htdocs` pour XAMPP). Accédez ensuite à l'application via votre navigateur :

```
http://localhost/elfrida-formation/index.php
```

---

## Utilisation

1. **Afficher les employés** : Accédez à `index.php` pour voir la liste des employés.
2. **Ajouter un employé** : Cliquez sur "Ajouter un Employé" pour accéder au formulaire d'ajout.
3. **Modifier un employé** : Cliquez sur "Modifier" à côté de l'employé souhaité pour mettre à jour ses informations.
4. **Supprimer un employé** : Cliquez sur "Supprimer" à côté de l'employé souhaité (une confirmation sera demandée).

---

## Contribuer

Les contributions sont les bienvenues ! Voici comment contribuer à ce projet :

1. Fork le dépôt.
2. Créez une branche pour votre fonctionnalité (`git checkout -b feature/nouvelle-fonctionnalité`).
3. Commitez vos changements (`git commit -m "Ajoute nouvelle fonctionnalité"`).
4. Poussez votre branche (`git push origin feature/nouvelle-fonctionnalité`).
5. Ouvrez une Pull Request.

---

## Licence

Ce projet est sous licence **MIT**. Consultez le fichier [LICENSE](LICENSE) pour plus de détails.

---

## Auteur

- **Eurin HASH** - [@digitaleflex](https://github.com/digitaleflex)

---

Si vous avez des questions ou besoin d'aide, n'hésitez pas à ouvrir une issue sur ce dépôt !

---

### Remarque
