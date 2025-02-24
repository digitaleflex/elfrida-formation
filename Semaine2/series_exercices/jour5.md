# **📝 Série d’Exercices - Jour 5 : Gestion des Sessions et JWT (JSON Web Tokens)**

---

## **📌 Instructions Générales**
- **But :** Mettre en pratique la gestion des sessions, l'utilisation sécurisée des cookies et l'implémentation d'un système d'authentification basé sur JWT.
- **Organisation :** Créez un projet structuré et publiez-le sur GitHub avec un fichier `README.md` qui détaille :
  - Les objectifs de chaque exercice.
  - Les étapes d'installation et d'exécution.
  - Les choix techniques et les bibliothèques utilisées (par exemple, `firebase/php-jwt` pour JWT).
- **Conseil :** Commentez votre code pour expliquer chaque étape et testez minutieusement chaque fonctionnalité.

---

## **🚀 Exercice 1 : Initiation aux Sessions PHP**

### **🎯 Objectif :**
Comprendre et manipuler les sessions en PHP.

### **📌 Consignes :**
1. **Démarrage de la session :**
   - Créez un script `session_demo.php`.
   - Utilisez `session_start()` au début du fichier.
2. **Stockage et récupération :**
   - Stockez quelques informations (par exemple, nom d'utilisateur et rôle) dans `$_SESSION`.
   - Affichez ces informations sur la page.
3. **Sécurisation et destruction :**
   - Utilisez `session_regenerate_id(true)` après une action (par exemple, après une "connexion").
   - Créez un script pour détruire la session (déconnexion).

---

## **🚀 Exercice 2 : Création et Sécurisation des Cookies**

### **🎯 Objectif :**
Créer et récupérer des cookies de manière sécurisée.

### **📌 Consignes :**
1. **Définition d’un cookie sécurisé :**
   - Créez un script `cookie_set.php` qui définit un cookie (ex. nom d'utilisateur) avec les options `HttpOnly` et `Secure` (si en HTTPS).
2. **Lecture du cookie :**
   - Dans un autre script `cookie_get.php`, affichez la valeur du cookie.
3. **Test :**
   - Vérifiez en inspectant votre navigateur que le cookie est marqué comme HttpOnly.

---

## **🚀 Exercice 3 : Authentification Basée sur les Sessions**

### **🎯 Objectif :**
Mettre en place un système d'authentification simple utilisant les sessions.

### **📌 Consignes :**
1. **Formulaire de connexion :**
   - Créez une page `login.php` avec un formulaire demandant un identifiant et un mot de passe.
2. **Vérification des identifiants :**
   - Simulez la validation (par exemple, identifiant : "admin", mot de passe : "secret").
3. **Gestion de la session :**
   - Si les identifiants sont corrects, démarrez une session, regénérez l'ID de session et stockez le nom d'utilisateur.
   - Redirigez l'utilisateur vers une page `dashboard.php` qui affiche un message de bienvenue.
4. **Déconnexion :**
   - Créez un script `logout.php` qui détruit la session et redirige l'utilisateur vers la page de connexion.

---

## **🚀 Exercice 4 : Génération d'un JWT**

### **🎯 Objectif :**
Apprendre à générer un JSON Web Token en utilisant la bibliothèque `firebase/php-jwt`.

### **📌 Consignes :**
1. **Installation :**
   - Installez la bibliothèque via Composer :  
     ```bash
     composer require firebase/php-jwt
     ```
2. **Création du JWT :**
   - Créez un script `generate_jwt.php`.
   - Définissez une clé secrète.
   - Créez un payload contenant des informations utilisateur (ex. userId, username, date d'émission et expiration).
   - Utilisez `JWT::encode()` pour générer le token et affichez-le.
3. **Test :**
   - Vérifiez que le token généré est conforme (trois parties séparées par des points).

---

## **🚀 Exercice 5 : Validation d'un JWT et Accès Protégé**

### **🎯 Objectif :**
Décoder et valider un JWT pour sécuriser l'accès à une ressource protégée.

### **📌 Consignes :**
1. **Récupération du JWT :**
   - Créez un script `validate_jwt.php` qui récupère un token (par exemple, via un paramètre GET ou dans l'en-tête HTTP `Authorization`).
2. **Validation du JWT :**
   - Utilisez `JWT::decode()` avec la même clé secrète pour décoder le token.
   - Si le token est valide et non expiré, affichez les informations contenues dans le payload.
   - En cas d'erreur, affichez un message d'erreur indiquant que le token est invalide.
3. **Test :**
   - Testez avec un token valide et modifiez manuellement le token pour vérifier que l'erreur est bien détectée.

---

## **🚀 Exercice 6 : Système d'Authentification Complet avec Sessions et JWT**

### **🎯 Objectif :**
Combiner sessions et JWT pour créer un système d'authentification robuste.

### **📌 Consignes :**
1. **Formulaire de connexion :**
   - Créez une page `login.php` avec un formulaire de connexion.
2. **Validation des identifiants :**
   - Si la connexion est réussie (simulez la vérification ou utilisez une base de données), démarrez une session et générez un JWT pour l'utilisateur.
3. **Stockage et affichage :**
   - Affichez le JWT à l'utilisateur ou stockez-le côté client (par exemple dans un cookie sécurisé ou dans le stockage local).
   - Redirigez l'utilisateur vers une page `protected.php` qui nécessite soit une session active, soit un JWT valide pour accéder aux contenus.
4. **Sécurisation des accès :**
   - Dans `protected.php`, vérifiez la présence d'une session ou la validité du JWT (via l'en-tête HTTP ou un paramètre).
   - Si l'utilisateur est authentifié, affichez le contenu protégé ; sinon, redirigez-le vers la page de connexion.
5. **Déconnexion :**
   - Ajoutez une fonctionnalité de déconnexion qui détruit la session et invalide le JWT si nécessaire.

---

## **🚀 Exercice Bonus : Création d'une API Sécurisée avec JWT**

### **🎯 Objectif :**
Mettre en place une API REST sécurisée nécessitant un JWT pour accéder aux ressources.

### **📌 Consignes :**
1. **Endpoint API :**
   - Créez un script `api_endpoint.php` qui retourne des données en JSON (ex. liste d'articles, informations utilisateur, etc.).
2. **Sécurisation de l'API :**
   - Exigez que chaque requête contienne un en-tête `Authorization: Bearer <token>`.
   - Validez le JWT présent dans l'en-tête avant de fournir l'accès aux données.
3. **Réponse de l'API :**
   - Si le token est valide, retournez les données au format JSON.
   - Sinon, retournez un message d'erreur avec le code HTTP approprié (par exemple, 401 Unauthorized).
4. **Test :**
   - Utilisez un outil comme Postman pour tester l'API en fournissant ou non le JWT dans l'en-tête.

---

## **📌 Rendu du Devoir**

- **Organisation du Projet :**
  - Créez un dépôt GitHub (ex. `auth-sessions-jwt-php`) structuré en dossiers (ex. `src`, `vendor`, etc.).
  - Ajoutez un fichier `README.md` décrivant :
    - Les objectifs de chaque exercice.
    - Les étapes d'installation et d'exécution.
    - Les choix techniques réalisés.
- **Soumission :**
  - Partagez le lien de votre repository GitHub pour évaluation.

---

**Bonne pratique et happy coding !**  
En suivant ces exercices, vous consoliderez vos compétences en gestion des sessions, sécurisation via cookies et authentification par JWT, des compétences essentielles pour développer des applications web sécurisées et modernes.