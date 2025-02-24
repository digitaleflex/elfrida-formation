# **📝 Série d’Exercices - Jour 6 : Création d’une API REST avec PHP**

---

## **📌 Instructions Générales**

- **But :** Mettre en pratique la création d’une API RESTful en utilisant PHP et MySQL pour gérer des opérations CRUD (Create, Read, Update, Delete) sur une ressource (par exemple, une liste de contacts).
- **Organisation :** Organisez votre projet en plusieurs fichiers (par exemple, `db.php`, `api.php`, etc.) et publiez-le sur GitHub avec un fichier `README.md` expliquant :
  - Les objectifs de chaque exercice.
  - Les étapes d’installation et d’exécution.
  - Les outils utilisés (PHP, MySQL, Postman pour les tests, etc.).
- **Conseil :** Commentez votre code pour expliquer chaque étape et testez minutieusement chaque fonctionnalité à l’aide d’un outil comme Postman.

---

## **🚀 Exercice 1 : Mise en Place de la Base de Données et de la Table**

### **🎯 Objectif :**
Créer la base de données et la table qui serviront de support à votre API.

### **📌 Consignes :**
1. **Créez une base de données :**
   - Nommez-la par exemple `contacts_api`.
2. **Créez une table `contacts` :**
   - Les colonnes doivent inclure au minimum : `id` (clé primaire, auto-incrémentée), `name` (VARCHAR), `email` (VARCHAR) et `phone` (VARCHAR).
3. **Vérifiez la création :**
   - Utilisez un outil comme phpMyAdmin ou la ligne de commande MySQL pour vous assurer que la table a été correctement créée.

---

## **🚀 Exercice 2 : Connexion à la Base de Données avec PHP**

### **🎯 Objectif :**
Établir une connexion sécurisée à votre base de données MySQL depuis PHP.

### **📌 Consignes :**
1. **Créez un fichier `db.php` :**
   - Établissez la connexion avec MySQL en utilisant l’extension MySQLi ou PDO.
2. **Gérez les erreurs de connexion :**
   - Affichez un message d’erreur en cas d’échec de la connexion.
3. **Testez votre connexion :**
   - Affichez un message de succès si la connexion est établie correctement.

---

## **🚀 Exercice 3 : Implémentation de la Méthode GET pour Récupérer les Contacts**

### **🎯 Objectif :**
Créer un endpoint qui retourne la liste des contacts stockés dans la base de données au format JSON.

### **📌 Consignes :**
1. **Créez ou modifiez le fichier `api.php` :**
   - Vérifiez que la méthode HTTP utilisée est **GET**.
2. **Interrogez la table `contacts` :**
   - Récupérez toutes les entrées et stockez-les dans un tableau.
3. **Encodez les données en JSON :**
   - Utilisez `json_encode()` pour formater la réponse.
4. **Testez l’endpoint :**
   - Utilisez Postman pour envoyer une requête GET et vérifiez que les données retournées sont correctes.

---

## **🚀 Exercice 4 : Ajout d’un Contact via la Méthode POST**

### **🎯 Objectif :**
Permettre la création d’un nouveau contact dans la base de données via une requête POST.

### **📌 Consignes :**
1. **Dans `api.php` :**
   - Vérifiez si la méthode HTTP est **POST**.
2. **Récupérez les données envoyées en JSON :**
   - Utilisez `file_get_contents("php://input")` et `json_decode()` pour obtenir les données.
3. **Insérez les données dans la table `contacts` :**
   - Créez une requête SQL pour ajouter le nouveau contact.
4. **Retournez une réponse JSON :**
   - Indiquez si l’ajout a été réalisé avec succès ou s’il y a eu une erreur.
5. **Testez l’endpoint :**
   - Envoyez une requête POST via Postman avec un payload JSON contenant les informations du contact.

---

## **🚀 Exercice 5 : Mise à Jour d’un Contact via la Méthode PUT**

### **🎯 Objectif :**
Permettre la mise à jour des informations d’un contact existant à l’aide d’une requête PUT.

### **📌 Consignes :**
1. **Dans `api.php` :**
   - Vérifiez que la méthode HTTP est **PUT**.
2. **Récupérez le payload JSON :**
   - Utilisez `file_get_contents("php://input")` et `json_decode()` pour extraire l’ID du contact et les nouvelles informations.
3. **Exécutez une requête SQL pour mettre à jour le contact :**
   - Assurez-vous d’utiliser des requêtes préparées pour la sécurité.
4. **Retournez une réponse JSON indiquant le succès ou l’échec de l’opération.**
5. **Testez l’endpoint :**
   - Envoyez une requête PUT via Postman pour mettre à jour un contact existant.

---

## **🚀 Exercice 6 : Suppression d’un Contact via la Méthode DELETE**

### **🎯 Objectif :**
Permettre la suppression d’un contact de la base de données via une requête DELETE.

### **📌 Consignes :**
1. **Dans `api.php` :**
   - Vérifiez que la méthode HTTP est **DELETE**.
2. **Récupérez l’ID du contact à supprimer :**
   - L’extraction peut se faire via le payload JSON ou un paramètre dans l’URL.
3. **Exécutez une requête SQL pour supprimer le contact correspondant :**
   - Assurez-vous d’utiliser des requêtes préparées.
4. **Retournez une réponse JSON confirmant la suppression ou indiquant une erreur.**
5. **Testez l’endpoint :**
   - Envoyez une requête DELETE via Postman avec l’ID du contact à supprimer.

---

## **🚀 Exercice Bonus : Gestion Dynamique des Routes et Amélioration de l’API**

### **🎯 Objectif :**
Optimiser l’API en gérant dynamiquement les routes et en ajoutant des fonctionnalités supplémentaires.

### **📌 Consignes :**
1. **Refactorisation du fichier `api.php` :**
   - Implémentez une logique de routage pour gérer les différentes méthodes HTTP dans des fonctions séparées.
2. **Validation des entrées :**
   - Ajoutez une validation des données reçues avant de les utiliser dans vos requêtes SQL.
3. **Gestion des erreurs :**
   - Améliorez les réponses JSON pour retourner des codes HTTP appropriés et des messages détaillés.
4. **Documentation de l’API :**
   - Créez un fichier `API_DOC.md` dans votre dépôt GitHub détaillant les endpoints, méthodes HTTP, exemples de payloads et codes de réponse.
5. **Test Complet :**
   - Utilisez Postman pour tester toutes les routes et vérifiez que votre API répond correctement aux différentes opérations CRUD.

---

## **📌 Rendu du Devoir**

- **Organisation du Projet :**
  - Créez un dépôt GitHub (ex. `api-rest-php-contacts`) avec une structure claire (dossier `src`, fichier `db.php`, `api.php`, etc.).
  - Ajoutez un fichier `README.md` détaillant :
    - Les objectifs de chaque exercice.
    - Les étapes d’installation et d’exécution.
    - Comment tester l’API avec Postman.
- **Soumission :**
  - Partagez le lien de votre repository GitHub pour évaluation.

---

**Bonne pratique et happy coding !**  
En suivant ces exercices, vous consoliderez vos compétences en création d’API RESTful et serez capable de développer des services web performants et sécurisés.