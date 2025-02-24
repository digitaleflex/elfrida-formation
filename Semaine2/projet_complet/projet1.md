D'accord, voici le projet réajusté pour qu'il soit encore plus réaliste et immersif, avec un contexte d’entreprise fictive détaillé et des exigences supplémentaires pour donner aux étudiants une meilleure immersion dans une situation de développement en entreprise.

---

# **Projet : Système de Gestion de Commandes pour E-commerce**

## 1. Contexte Réel du Projet

### 1.1 Entreprise Fictive : **TechShop**

**TechShop** est une entreprise d'e-commerce spécialisée dans la vente en ligne de produits électroniques (smartphones, ordinateurs, accessoires, etc.). Depuis sa création il y a 3 ans, elle connaît une croissance rapide, avec un nombre croissant de commandes et une expansion dans plusieurs pays. L'entreprise a des partenaires logistiques externes et un service client interne pour gérer les retours et les demandes des clients.

Cependant, le système actuel de gestion des commandes est dépassé, difficile à maintenir et manque de certaines fonctionnalités de sécurité, notamment pour le suivi des paiements et la gestion des retours. TechShop a besoin d'un nouveau système moderne, sécurisé et évolutif qui permettrait de gérer efficacement toutes les commandes, de la création à la livraison.

### 1.2 Objectifs du Projet

Le projet consiste à développer une plateforme web permettant à **TechShop** de gérer efficacement ses commandes, du moment où un client passe une commande jusqu'à la livraison. Les fonctionnalités doivent être sécurisées, faciles à utiliser et capables de s'intégrer aux partenaires logistiques et aux services de paiement. Ce projet permettra aux étudiants de se confronter aux défis réels auxquels font face les entreprises en termes de développement de logiciels.

### 1.3 Contexte Spécifique pour les Étudiants

Le projet est conçu pour simuler une situation où les étudiants travaillent pour **TechShop** en tant que développeurs. Leur mission consiste à concevoir et implémenter une solution fonctionnelle pour la gestion des commandes, tout en respectant les meilleures pratiques en termes de sécurité et de performance. L'application doit aussi pouvoir s'intégrer avec des systèmes externes (API logistique et services de paiement).

---

## 2. Objectifs Pédagogiques

Ce projet permettra aux étudiants de :

- **Développer des fonctionnalités back-end** pour la gestion des commandes (CRUD), l'authentification des utilisateurs, et la sécurisation de l'application.
- **Créer des API RESTful sécurisées** pour l'intégration avec des partenaires externes (services logistiques et de paiement).
- **Implémenter un front-end basique** pour l’administration des commandes (interface simple, responsive).
- **Appliquer des concepts de sécurité** (injections SQL, XSS, CSRF) pour protéger les données sensibles (informations de paiement, informations client).
- **Travailler avec des bases de données relationnelles** pour le stockage et la gestion des données de commandes et des utilisateurs.

---

## 3. Conception et Fonctionnalités

### 3.1 Fonctionnalités Principales

#### 1. **Gestion des Commandes :**
- **Création de commandes :** Lorsqu'un client passe une commande, elle doit être automatiquement ajoutée au système, avec toutes les informations pertinentes (produits, quantités, prix, statut, etc.).
- **Suivi des commandes :** Chaque commande doit être suivie à travers différents statuts (en attente, en traitement, expédiée, livrée, annulée).
- **Modification des commandes :** Permettre de modifier ou annuler une commande avant l’expédition.
- **Gestion des retours :** Permettre aux utilisateurs et à l’administration de gérer les retours de produits.

#### 2. **Interface Administrateur :**
- **Tableau de bord des commandes :** Un tableau de bord permettant de visualiser et filtrer les commandes par date, statut, client, etc.
- **Authentification sécurisée :** Mise en place d’un système de login avec rôle pour accéder à l’administration (différents niveaux : gestionnaire, service client, logistique).
  
#### 3. **API REST :**
- **Gestion des commandes :** API permettant de créer, lire, mettre à jour et supprimer des commandes (CRUD).
- **Sécurité de l'API :** Authentification via JWT et utilisation des bonnes pratiques pour éviter les injections SQL et autres failles de sécurité.
- **Documentation de l'API :** Documentation à destination des partenaires externes pour intégrer facilement les services logistiques et de paiement.

#### 4. **Notifications et Suivi :**
- **Notifications par e-mail :** Lors de la création d’une commande, de l’expédition ou de la livraison, des e-mails automatiques doivent être envoyés au client.
- **Intégration SMS :** Suivi des commandes en temps réel avec des notifications par SMS pour informer les clients de l’état de leur commande.

### 3.2 Exigences de Sécurité

- **Protection des données sensibles :** Chiffrement des informations de paiement et des données personnelles des utilisateurs.
- **Prévention des attaques XSS et CSRF** dans toutes les interfaces utilisateur.
- **Gestion sécurisée des sessions utilisateurs** avec expiration automatique et régénération de l’ID de session.

---

## 4. Modélisation de la Base de Données

### 4.1 Tables principales

- **Table `users`** : Stocke les informations des utilisateurs (clients et administrateurs).
  - `id`, `name`, `email`, `password`, `role` (admin, customer, logistics), `created_at`, `updated_at`
  
- **Table `orders`** : Stocke les informations de chaque commande passée.
  - `id`, `user_id` (lié à `users`), `status` (pending, processing, shipped, delivered, canceled), `total_amount`, `created_at`, `updated_at`
  
- **Table `order_items`** : Détaille les produits de chaque commande.
  - `id`, `order_id` (lié à `orders`), `product_name`, `quantity`, `price`, `created_at`, `updated_at`

- **Table `products`** : Stocke les informations des produits disponibles sur le site.
  - `id`, `name`, `description`, `price`, `stock`, `created_at`, `updated_at`
  
- **Table `payments`** : Stocke les informations des paiements pour chaque commande.
  - `id`, `order_id` (lié à `orders`), `payment_status` (pending, completed), `payment_method`, `payment_date`, `amount`

---

## 5. Cahier des Charges et Méthodologie

### 5.1 Structure de l'Application

- **Back-end :** PHP (MVC ou micro-framework) pour gérer les commandes, l'API et les interactions avec la base de données.
- **Front-end :** Interface d'administration en HTML, CSS, JavaScript (optionnellement Vue.js ou React pour les étudiants avancés).
- **Sécurité :** Utilisation de JWT pour l'authentification, avec des routes sécurisées pour l'accès aux données sensibles.

### 5.2 Planning du Projet

1. **Semaine 1 :** Conception du système
   - Rédaction du cahier des charges fonctionnel.
   - Modélisation de la base de données.
   - Conception des maquettes de l'interface.
   - Préparation de l'environnement de développement.

2. **Semaine 2 :** Développement du back-end
   - Développement des API REST pour les commandes.
   - Implémentation de l'authentification JWT.
   - Connexion avec la base de données et gestion des commandes.

3. **Semaine 3 :** Développement du front-end
   - Création du tableau de bord pour l'administration des commandes.
   - Mise en place des notifications par e-mail et SMS.
   - Tests de sécurité et de performance.

4. **Semaine 4 :** Tests et Validation
   - Tests fonctionnels avec Postman.
   - Débogage et optimisation.
   - Rédaction de la documentation technique et utilisateur.

---

## 6. Livrables

1. **Code source complet :** Le code devra être hébergé sur GitHub avec des branches bien structurées.
2. **Documentation technique :** Comprenant les diagrammes UML et les instructions pour déployer le projet.
3. **API Documentation :** Swagger ou autre outil pour documenter les API REST développées.
4. **Interface d'administration :** Maquettes de l’interface et la version fonctionnelle du tableau de bord.
5. **Tests unitaires :** Tous les tests unitaires écrits avec PHPUnit pour tester les fonctionnalités du back-end.

---

Ce projet est conçu pour simuler une expérience en entreprise tout en permettant aux étudiants de se confronter à des problématiques réelles de développement, de sécurité et de gestion des bases de données.