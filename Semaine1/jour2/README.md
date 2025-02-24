
# Gestion des Stocks - Supermarché

![HTML](https://img.shields.io/badge/HTML-239120?style=for-the-badge&logo=html5&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-005C84?style=for-the-badge&logo=mysql&logoColor=white)
![Bootstrap](https://img.shields.io/badge/Bootstrap-7952B3?style=for-the-badge&logo=bootstrap&logoColor=white)

Ce projet permet de gérer les stocks d'un supermarché en utilisant une base de données MySQL. Il implémente les opérations CRUD (Create, Read, Update, Delete) pour ajouter, afficher, modifier et supprimer des produits. Un système de recherche est également disponible.

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

Cette application web permet aux administrateurs d'un supermarché de gérer leurs stocks efficacement. Les données sont stockées dans une base de données MySQL, et toutes les requêtes sont sécurisées grâce à l'utilisation de PDO avec des requêtes préparées (`prepare()`).

---

## Fonctionnalités

- **CRUD complet** : Ajout, lecture, modification et suppression des produits.
- **Système de recherche** : Recherche rapide par nom de produit.
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
cd projet-supermarche/jour2
```

### 2. Créer la base de données

Créez une base de données MySQL nommée `supermarche_db` et exécutez le script SQL suivant pour créer la table `produits` :

```sql
CREATE DATABASE supermarche_db;

USE supermarche_db;

CREATE TABLE produits (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    prix DECIMAL(10, 2) NOT NULL,
    stock INT NOT NULL
);
```

### 3. Configurer la connexion à la base de données

Ouvrez le fichier `db.php` et modifiez les paramètres de connexion selon votre configuration MySQL :

```php
$host = 'localhost'; // Hôte MySQL
$dbname = 'supermarche_db'; // Nom de la base de données
$username = 'root'; // Utilisateur MySQL
$password = ''; // Mot de passe MySQL
```

### 4. Démarrer un serveur local

Placez les fichiers du projet dans le répertoire de votre serveur web local (par exemple, `htdocs` pour XAMPP). Accédez ensuite à l'application via votre navigateur :

```
http://localhost/projet-supermarche/jours2/index.php
```

---

## Utilisation

1. **Afficher les produits** : Accédez à `index.php` pour voir la liste des produits.
2. **Ajouter un produit** : Cliquez sur "Ajouter un Produit" pour accéder au formulaire d'ajout.
3. **Modifier un produit** : Cliquez sur "Modifier" à côté du produit souhaité pour mettre à jour ses informations.
4. **Supprimer un produit** : Cliquez sur "Supprimer" à côté du produit souhaité (une confirmation sera demandée).
5. **Rechercher un produit** : Utilisez la barre de recherche pour trouver un produit par son nom.

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

- **Votre Nom** - [@digitaleflex](https://github.com/digitaleflex)

Si vous avez des questions ou besoin d'aide, n'hésitez pas à ouvrir une issue sur ce dépôt !
```

