# **📝 Série d’Exercices - Jour 7 : Projet de la Semaine - Mini Application Sécurisée**

---

## **📌 Instructions Générales**

- **But :** Concevoir, développer et sécuriser une application web complète en appliquant tous les concepts étudiés durant la semaine.
- **Organisation :** 
  - Créez un projet structuré (ex. dossier `src`, dossier `public`, etc.) et publiez-le sur GitHub avec un fichier `README.md` détaillant l’objectif du projet, la structure, les étapes d’installation et les instructions de test.
  - Commentez votre code pour expliquer votre démarche.
  - Testez toutes les fonctionnalités, notamment avec des outils comme Postman et votre navigateur.
- **Conseil :** Travaillez de manière incrémentale en validant chaque fonctionnalité avant de passer à la suivante.

---

## **🚀 Exercice 1 : Définition du Projet et Cahier des Charges**

### **🎯 Objectif :**
Définir précisément les exigences fonctionnelles et techniques de votre mini application sécurisée (ex. gestion d’un carnet de contacts).

### **📌 Consignes :**
1. **Rédigez un document de conception** (peut être un fichier Markdown ou un PDF) incluant :
   - La **définition du projet**.
   - La liste des **fonctionnalités** (ajout, modification, suppression, affichage des contacts, authentification utilisateur, etc.).
   - Les exigences **sécuritaires** (protection XSS, CSRF, injection SQL, utilisation de JWT).
2. **Identifiez les technologies** à utiliser : PHP (POO), MySQL, API REST, Postman pour les tests, etc.
3. **Présentez un schéma d’architecture** simplifié de votre application (par exemple, schéma de la structure du projet et des flux de données).

---

## **🚀 Exercice 2 : Conception de l’Architecture et Structure du Projet**

### **🎯 Objectif :**
Mettre en place la structure de votre projet et définir l’architecture de l’application.

### **📌 Consignes :**
1. **Créez la structure des dossiers** de votre projet, par exemple :
   ```
   mini-app-securisee/
    ┣ src/
    ┃ ┣ config/      # Fichiers de configuration (db.php, .env)
    ┃ ┣ controllers/ # Logique de traitement (AuthController.php, ContactController.php)
    ┃ ┣ models/      # Classes de données (User.php, Contact.php)
    ┃ ┗ views/       # Templates HTML/PHP (login.php, register.php, dashboard.php)
    ┣ public/        # Point d'entrée (index.php) et assets (CSS, JS, images)
    ┣ vendor/        # Dépendances via Composer (ex. firebase/php-jwt)
    ┣ README.md
    ┗ .env.example
   ```
2. **Documentez la structure** dans le fichier `README.md` en expliquant le rôle de chaque dossier et fichier.
3. **Mettez en place la connexion à la base de données** dans un fichier de configuration (ex. `db.php`) et testez-la avec un script simple.

---

## **🚀 Exercice 3 : Développement de l’API REST pour la Gestion des Contacts**

### **🎯 Objectif :**
Implémenter les opérations CRUD (Create, Read, Update, Delete) pour gérer les contacts via une API REST sécurisée.

### **📌 Consignes :**
1. **Créez un contrôleur pour les contacts** (ex. `ContactController.php`) dans lequel vous implémentez :
   - **GET :** Récupérer la liste des contacts pour l’utilisateur authentifié.
   - **POST :** Ajouter un nouveau contact.
   - **PUT :** Mettre à jour un contact existant.
   - **DELETE :** Supprimer un contact.
2. **Utilisez des requêtes préparées** (via PDO ou MySQLi) pour interagir avec la base de données.
3. **Retournez des réponses au format JSON** pour chaque opération et gérez les erreurs (par exemple, renvoyer un code HTTP 400 ou 500 en cas d’erreur).
4. **Testez chaque endpoint** avec Postman pour vérifier que vos opérations CRUD fonctionnent comme prévu.

---

## **🚀 Exercice 4 : Implémentation de l’Authentification Utilisateur et Sécurisation par JWT**

### **🎯 Objectif :**
Intégrer un système d’authentification pour sécuriser l’accès à l’API, en utilisant les sessions et les JSON Web Tokens (JWT).

### **📌 Consignes :**
1. **Créez un contrôleur d’authentification** (ex. `AuthController.php`) qui gère :
   - **Inscription :** Collecte et validation des informations utilisateur, hachage du mot de passe avec `password_hash()`, et stockage dans la base de données.
   - **Connexion :** Vérification des identifiants avec `password_verify()`, démarrage d’une session et génération d’un JWT via la bibliothèque `firebase/php-jwt`.
2. **Implémentez une page de connexion et une page d’inscription** dans le dossier `views`.
3. **Protégez les endpoints de l’API REST** en exigeant un JWT valide (en le passant dans l’en-tête HTTP `Authorization: Bearer <token>` ou dans un cookie sécurisé).
4. **Testez le processus complet** : inscription, connexion, récupération et validation du JWT, et accès aux endpoints sécurisés.

---

## **🚀 Exercice 5 : Intégration des Mécanismes de Sécurité (XSS, CSRF, Injection SQL)**

### **🎯 Objectif :**
Appliquer les bonnes pratiques de sécurité pour protéger votre application.

### **📌 Consignes :**
1. **Protection XSS :**
   - Dans vos vues, utilisez `htmlspecialchars()` pour afficher les données utilisateur.
2. **Protection CSRF :**
   - Pour chaque formulaire sensible (ex. formulaire d’inscription, modification des contacts), générez un token CSRF et validez-le lors de la soumission.
3. **Prévention de l’Injection SQL :**
   - Assurez-vous que toutes vos requêtes SQL utilisent des requêtes préparées et des paramètres liés.
4. **Testez vos protections** en tentant d’injecter du code malveillant ou en soumettant des formulaires avec un token CSRF invalide, et vérifiez que l’application résiste à ces attaques.

---

## **🚀 Exercice 6 : Test, Débogage et Amélioration**

### **🎯 Objectif :**
Valider et améliorer l’application en effectuant des tests fonctionnels et en corrigeant les erreurs éventuelles.

### **📌 Consignes :**
1. **Utilisez Postman** pour tester tous les endpoints de votre API (GET, POST, PUT, DELETE) et assurez-vous que les réponses JSON sont correctes.
2. **Testez l’interface utilisateur** dans le navigateur en simulant les opérations d’inscription, connexion et gestion des contacts.
3. **Créez un plan de tests** (peut être un simple document ou un tableau) récapitulant les scénarios testés et les résultats obtenus.
4. **Implémentez des améliorations** si nécessaire (ex. validation côté client, messages d’erreur plus explicites, pagination des contacts, etc.).
5. **Documentez vos tests** et les corrections apportées dans le `README.md`.

---

## **🚀 Exercice Bonus : Ajout de Fonctionnalités Supplémentaires**

### **🎯 Objectif :**
Aller au-delà des exigences de base en ajoutant des fonctionnalités supplémentaires à votre application.

### **📌 Consignes :**
1. **Ajoutez une fonctionnalité de recherche** permettant à l’utilisateur de filtrer les contacts par nom ou email.
2. **Implémentez la pagination** pour la liste des contacts afin de gérer efficacement un grand nombre d’entrées.
3. **Permettez l’exportation des contacts en CSV** ou en JSON.
4. **Documentez ces nouvelles fonctionnalités** dans le fichier `README.md` et testez-les minutieusement.

---

## **📌 Rendu du Devoir**

- **Organisation du Projet :**
  - Publiez l’ensemble du projet sur un dépôt GitHub (ex. `mini-app-securisee`).
  - Incluez un fichier `README.md` détaillant :
    - L’objectif du projet.
    - La structure du projet.
    - Les instructions d’installation et d’exécution.
    - Les étapes pour tester l’application.
- **Soumission :**
  - Partagez le lien de votre dépôt GitHub pour évaluation.

---

**Bonne pratique et happy coding !**  
En complétant ces exercices, vous consoliderez vos compétences en développement PHP avancé tout en créant une application web sécurisée et fonctionnelle.