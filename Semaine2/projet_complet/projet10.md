Voici la présentation du **Projet 10**, avec un contexte réaliste, des entreprises fictives et des exigences supplémentaires pour une immersion optimale.

---

# **Projet 10 : Système de Gestion de Commandes pour un Restaurant**

## 1. Contexte Réel du Projet

### 1.1 Entreprise Fictive : **GustoFresh**

**GustoFresh** est un restaurant haut de gamme qui propose des repas frais, créatifs et de saison. Il se distingue par son concept de cuisine "du champ à l'assiette", en offrant des produits locaux et bio dans des menus qui changent selon les saisons. Le restaurant attire une clientèle fidèle, mais avec un volume de commandes croissant chaque mois, l'équipe de **GustoFresh** a de plus en plus de mal à gérer efficacement les commandes, les réservations et l’inventaire des ingrédients.

L’entreprise souhaite améliorer ses processus en développant un **système de gestion de commandes** en ligne et intégré. Ce système doit non seulement gérer les commandes des clients, mais aussi optimiser la gestion des réservations, l’inventaire des ingrédients, et permettre une coordination fluide entre les serveurs et la cuisine.

### 1.2 Objectifs du Projet

L’objectif de ce projet est de créer une application permettant aux employés de **GustoFresh** de gérer les commandes, les réservations, l’inventaire, et d’assurer une meilleure communication entre la salle et la cuisine.

Les fonctionnalités à développer incluent :

- **Gestion des commandes** : Prise en charge des commandes clients en temps réel.
- **Gestion des réservations** : Permettre aux clients de réserver une table et à l’équipe du restaurant de suivre ces réservations.
- **Gestion de l'inventaire** : Suivi des ingrédients disponibles et notification de réapprovisionnement.
- **Communication entre la salle et la cuisine** : Permettre aux serveurs de communiquer efficacement avec les chefs en temps réel pour suivre l'avancement des plats.

### 1.3 Contexte de Travail

Le projet sera réalisé par une équipe composée de chefs de projet, de développeurs backend et frontend, ainsi que des testeurs qualité. Vous devrez travailler en étroite collaboration avec les responsables de chaque département du restaurant pour comprendre les spécifications exactes et mettre en œuvre les fonctionnalités nécessaires. Une méthodologie agile avec des itérations courtes sera adoptée pour faciliter les ajustements en fonction des retours des utilisateurs.

---

## 2. Objectifs Pédagogiques

Ce projet permettra aux étudiants de :

- **Apprendre à développer un système complet de gestion des commandes** pour un restaurant, en intégrant la gestion des commandes, des réservations et de l'inventaire.
- **Comprendre la gestion d’une base de données relationnelle** pour suivre les commandes, les produits, les réservations et l’inventaire.
- **Créer une interface utilisateur intuitive** adaptée à l’environnement dynamique du service en restaurant.
- **Mettre en place des notifications en temps réel** pour garantir une gestion fluide entre la salle et la cuisine.
- **Gérer les stocks d’ingrédients** et prévoir des alertes de réapprovisionnement pour éviter les ruptures de stock.

---

## 3. Conception et Fonctionnalités

### 3.1 Fonctionnalités Principales

#### 1. **Gestion des Commandes** :
- **Prise de commandes en temps réel** : Les serveurs doivent pouvoir entrer les commandes des clients (plats, boissons, spécifications comme la cuisson ou les allergies) et les envoyer directement à la cuisine.
- **Suivi des commandes** : Chaque commande doit avoir un statut (par exemple, "En préparation", "Prête", "Servie").
- **Affichage des commandes en cours** : Un écran dans la cuisine doit afficher les commandes en cours et leur statut.
  
#### 2. **Gestion des Réservations** :
- **Réservation en ligne** : Les clients doivent pouvoir réserver une table via un site web ou une application mobile, en spécifiant l'heure et le nombre de personnes.
- **Calendrier des réservations** : Le système doit afficher un calendrier des réservations pour que le personnel puisse facilement gérer la disponibilité des tables.
- **Modification et annulation** : Permettre aux clients de modifier ou annuler leurs réservations en ligne.
  
#### 3. **Gestion de l'Inventaire** :
- **Suivi des stocks d'ingrédients** : Chaque ingrédient utilisé dans les plats doit être suivi pour savoir en temps réel quelles quantités sont disponibles.
- **Alertes de réapprovisionnement** : Lorsque les stocks d’un ingrédient arrivent à un seuil critique, le système envoie une alerte pour que l’inventaire soit réapprovisionné.
- **Historique des entrées et sorties** : Chaque mouvement de stock doit être enregistré (achat, consommation, etc.).
  
#### 4. **Communication en Temps Réel** :
- **Salle et cuisine** : Les serveurs doivent pouvoir envoyer des notifications aux chefs lorsque des commandes arrivent, et les chefs peuvent mettre à jour le statut de la commande (par exemple, "En préparation", "Prêt à servir").
- **Tableau de bord des commandes** : Les serveurs et les chefs doivent avoir un tableau de bord interactif qui montre l’état des commandes en temps réel.
  
#### 5. **Tableau de Bord pour le Manager** :
- **Suivi des ventes** : Le manager doit pouvoir consulter les ventes quotidiennes, hebdomadaires et mensuelles pour analyser la performance du restaurant.
- **Analyse des réservations** : Le manager doit voir les tendances des réservations et l'occupation des tables.
- **Alertes de stock faible** : Recevoir des notifications lorsqu’un ingrédient est sur le point d’être épuisé.

---

## 4. Architecture de la Base de Données

### 4.1 Tables principales

- **Table `orders`** : Contient les informations des commandes des clients.
  - `id`, `table_number`, `status`, `order_time`, `total_price`, `created_at`, `updated_at`

- **Table `order_items`** : Contient les détails des plats commandés.
  - `id`, `order_id` (référence à la table `orders`), `menu_item_id` (référence à la table `menu_items`), `quantity`, `special_request`, `price`

- **Table `menu_items`** : Contient les informations des plats du menu.
  - `id`, `name`, `description`, `price`, `ingredients`, `created_at`

- **Table `reservations`** : Contient les informations des réservations.
  - `id`, `customer_name`, `reservation_time`, `num_people`, `status`, `created_at`, `updated_at`

- **Table `inventory`** : Contient les informations sur les ingrédients.
  - `id`, `name`, `quantity`, `unit`, `critical_level`, `created_at`, `updated_at`

- **Table `employees`** : Contient les informations des employés (serveurs, chefs).
  - `id`, `name`, `role`, `email`, `created_at`, `updated_at`

- **Table `notifications`** : Contient les notifications envoyées entre la salle et la cuisine.
  - `id`, `message`, `sender_id`, `receiver_id`, `status`, `created_at`

---

## 5. Cahier des Charges et Méthodologie

### 5.1 Structure de l'Application

- **Back-end** : Node.js avec Express.js pour gérer les API RESTful et les requêtes à la base de données.
- **Front-end** : React.js pour la construction de l'interface utilisateur. Un tableau de bord interactif sera construit en utilisant des technologies comme Redux pour la gestion de l’état et WebSockets pour la communication en temps réel.
- **Base de données** : PostgreSQL pour la gestion des informations relatives aux commandes, réservations, inventaire, et employés.
- **Notifications** : Utilisation de WebSockets ou Firebase pour implémenter des notifications en temps réel entre la salle et la cuisine.

### 5.2 Planning du Projet

1. **Semaine 1 :**
   - Analyse des besoins et création des wireframes pour l’interface utilisateur.
   - Mise en place du projet avec Node.js et React.js.
   - Initialisation de la base de données.

2. **Semaine 2 :**
   - Développement des fonctionnalités de gestion des commandes.
   - Mise en place de la gestion des réservations et de l’inventaire.

3. **Semaine 3 :**
   - Implémentation des fonctionnalités de communication entre la salle et la cuisine.
   - Développement des alertes de réapprovisionnement.

4. **Semaine 4 :**
   - Tests et corrections des bugs.
   - Mise en place du tableau de bord pour le manager.

5. **Semaine 5 :**
   - Finalisation du projet et tests utilisateurs.
   - Documentation complète du code et de l’application.

---

## 6. Livrables

1. **Code source complet** : Hébergé sur GitHub avec un suivi des versions et des bonnes pratiques de commit.
2. **Documentation technique** : Détails sur l’architecture de l’application, la gestion des commandes, des réservations, et de l’inventaire.
3. **Prototype d’application web** : Application fonctionnelle pour la gestion des commandes et des réservations dans un restaurant.
4. **Rapport final** : Documentation détaillant les fonctionnalités développées et le processus de mise en œuvre du projet.

---

Ce projet est conçu pour aider les étudiants à comprendre les défis et les spécificités liées à la gestion d'un restaurant, tout en développant une application complète et fonctionnelle pour optimiser l'expérience des employés et des clients.