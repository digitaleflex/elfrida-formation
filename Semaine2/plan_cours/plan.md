### 📅 Semaine 2 : Approfondissement du PHP et Sécurité Web  
**🎯 Objectif :** Améliorer la robustesse des applications PHP en explorant des concepts avancés et en renforçant la sécurité des applications web.  

---

## 🔹 **Jour 1 : Programmation Orientée Objet (POO) en PHP**  
**📝 Objectifs du jour :**  
- Comprendre et appliquer les concepts fondamentaux de la POO.  
- Structurer son code avec des classes et objets.  
- Implémenter l’héritage, les interfaces et l’abstraction.  
- Créer un petit projet en POO.  

**📌 Contenu détaillé :**  
1. **Introduction à la POO en PHP**  
   - Définition et importance de la POO.  
   - Différences entre programmation procédurale et orientée objet.  
2. **Les éléments de base :**  
   - Déclaration de classes et instanciation d’objets.  
   - Propriétés et méthodes.  
   - Visibilité : public, private, protected.  
3. **Les concepts avancés :**  
   - Héritage et surcharge des méthodes.  
   - Interfaces et classes abstraites.  
   - Utilisation des traits.  
4. **Mise en pratique :**  
   - Création d’un **gestionnaire de tâches** en POO :  
     - Ajouter, modifier et supprimer des tâches.  
     - Stockage des tâches en base de données.  
     - Interface simple pour afficher la liste des tâches.  

---

## 🔹 **Jour 2 : Manipulation des Fichiers en PHP**  
**📝 Objectifs du jour :**  
- Savoir lire, écrire et supprimer des fichiers en PHP.  
- Apprendre à gérer l’upload de fichiers en toute sécurité.  
- Mettre en place des validations et gérer les erreurs liées aux fichiers.  

**📌 Contenu détaillé :**  
1. **Lecture et écriture dans un fichier**  
   - fopen(), fread(), fwrite(), fclose().  
   - Manipulation des fichiers CSV et JSON.  
2. **Upload de fichiers (images, PDF, etc.)**  
   - Utilisation de `$_FILES`.  
   - Déplacement sécurisé des fichiers uploadés (`move_uploaded_file`).  
   - Définition de limites sur le type et la taille des fichiers acceptés.  
3. **Gestion des erreurs et validation**  
   - Vérifier l’extension et le type MIME.  
   - Sécuriser l’upload contre l’exécution de scripts malveillants.  
   - Stocker et récupérer les fichiers uploadés dans un dossier sécurisé.  
4. **Mise en pratique :**  
   - Développer un système simple d’upload d’images avec affichage et suppression.  

---

## 🔹 **Jour 3 : Envoi d’E-mails en PHP**  
**📝 Objectifs du jour :**  
- Configurer et utiliser **PHPMailer** pour envoyer des e-mails.  
- Envoyer des e-mails transactionnels (confirmation d’inscription, récupération de mot de passe, etc.).  
- Gérer les erreurs et assurer la sécurité des e-mails envoyés.  

**📌 Contenu détaillé :**  
1. **Présentation de PHPMailer**  
   - Pourquoi utiliser PHPMailer au lieu de `mail()` natif en PHP ?  
   - Installation et configuration avec Composer.  
2. **Envoi d’un e-mail simple**  
   - Paramétrage SMTP avec un service de messagerie (Gmail, Mailtrap, etc.).  
   - Envoi d’un e-mail avec un sujet et un corps de message.  
3. **E-mails avec confirmation**  
   - Génération et envoi d’un lien de confirmation.  
   - Vérification du lien et validation de l’inscription.  
4. **Mise en pratique :**  
   - Développement d’un système d’inscription avec confirmation par e-mail.  

---

## 🔹 **Jour 4 : Sécurité et Protection Contre les Attaques Web**  
**📝 Objectifs du jour :**  
- Comprendre les principales attaques web (XSS, CSRF, Injection SQL).  
- Mettre en place des bonnes pratiques de sécurité en PHP.  
- Sécuriser les mots de passe et les entrées utilisateur.  

**📌 Contenu détaillé :**  
1. **Prévention des attaques XSS (Cross-Site Scripting)**  
   - Échapper les entrées utilisateur avec `htmlspecialchars()`.  
   - Utilisation des Content Security Policies (CSP).  
2. **Prévention des attaques CSRF (Cross-Site Request Forgery)**  
   - Utilisation de tokens CSRF.  
   - Protection des formulaires sensibles.  
3. **Sécurisation des mots de passe**  
   - Hashing des mots de passe avec `password_hash()`.  
   - Vérification avec `password_verify()`.  
4. **Protection contre l’injection SQL**  
   - Utilisation de PDO et des requêtes préparées.  
   - Éviter l’utilisation directe des entrées utilisateur dans les requêtes SQL.  
5. **Mise en pratique :**  
   - Développement d’un formulaire sécurisé avec protection contre XSS et CSRF.  

---

## 🔹 **Jour 5 : Gestion des Sessions et JWT (JSON Web Tokens)**  
**📝 Objectifs du jour :**  
- Comprendre le fonctionnement des sessions en PHP.  
- Utiliser les cookies en toute sécurité.  
- Implémenter une authentification basée sur JWT.  

**📌 Contenu détaillé :**  
1. **Gestion des sessions en PHP**  
   - Démarrer une session (`session_start()`).  
   - Stocker et récupérer des variables de session.  
   - Sécuriser les sessions.  
2. **Gestion des cookies**  
   - Définir des cookies sécurisés (`HttpOnly`, `Secure`).  
   - Stocker des informations utilisateur temporairement.  
3. **Implémentation d’un système JWT**  
   - Génération et validation d’un JWT.  
   - Utilisation dans une API pour l’authentification.  
4. **Mise en pratique :**  
   - Création d’un système de connexion avec sessions et JWT.  

---

## 🔹 **Jour 6 : Création d’une API REST avec PHP**  
**📝 Objectifs du jour :**  
- Comprendre le fonctionnement des API REST.  
- Créer une API RESTful avec PHP et MySQL.  
- Gérer les requêtes GET, POST, PUT, DELETE.  

**📌 Contenu détaillé :**  
1. **Introduction aux API RESTful**  
   - Concepts clés et bonnes pratiques.  
   - Utilisation de Postman pour tester une API.  
2. **Création d’une API simple avec PHP**  
   - Connexion à une base de données.  
   - Gestion des routes pour les différentes actions.  
3. **Implémentation des requêtes CRUD**  
   - GET : Récupérer des données.  
   - POST : Ajouter des données.  
   - PUT : Modifier des données.  
   - DELETE : Supprimer des données.  
4. **Mise en pratique :**  
   - Développement d’une API pour gérer une liste de contacts.  

---

## 🔹 **Jour 7 : Projet de la Semaine - Mini Application Sécurisée**  
**📝 Objectifs du jour :**  
- Mettre en pratique tous les concepts appris durant la semaine.  
- Créer une **application sécurisée** et fonctionnelle.  

**📌 Déroulement du projet :**  
1. **Définition du projet**  
   - Ex : **Gestion d’un carnet de contacts sécurisé**.  
   - Fonctionnalités : Ajout, modification, suppression, authentification utilisateur.  
2. **Mise en œuvre**  
   - Utilisation de la POO et des bonnes pratiques de sécurité.  
   - Implémentation des fonctionnalités CRUD via une API REST.  
   - Sécurisation des accès avec JWT et protection contre XSS/CSRF.  
3. **Test et amélioration**  
   - Débogage et tests de sécurité.  
   - Présentation et évaluation du projet.  

---
