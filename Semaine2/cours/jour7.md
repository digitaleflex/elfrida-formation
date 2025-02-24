# **🚀 Jour 7 : Projet de la Semaine - Mini Application Sécurisée**

---

## **1. Introduction et Objectifs**

**Objectif principal :**  
Mettre en pratique tous les concepts abordés durant la semaine pour développer une application web sécurisée, fonctionnelle et bien structurée en PHP.

**Exemple de projet :**  
La création d’un **carnet de contacts sécurisé**. L’application devra permettre :
- L’**ajout** d’un nouveau contact.
- La **modification** des informations d’un contact existant.
- La **suppression** d’un contact.
- L’**authentification** des utilisateurs pour accéder aux fonctionnalités de gestion du carnet.

**Pourquoi ce projet ?**  
Ce projet vous permet de combiner plusieurs notions clés :
- **Programmation Orientée Objet (POO)**
- **Manipulation des fichiers et des données** (CRUD via API REST)
- **Sécurisation des applications web** (protection contre XSS, CSRF, injection SQL)
- **Authentification** via sessions et JWT  
  
Ce mini-projet vous aidera à consolider vos compétences en développement PHP avancé tout en créant une application réelle.

---

## **2. Définition du Projet et Analyse des Besoins**

### **2.1 Définition du Projet**
**Projet : Gestion d’un carnet de contacts sécurisé**  
**Fonctionnalités attendues :**
- **Gestion des contacts :**  
  - **Ajout** d’un contact (nom, email, téléphone, etc.).
  - **Modification** d’un contact existant.
  - **Suppression** d’un contact.
  - **Affichage** de la liste des contacts.
- **Authentification utilisateur :**  
  - Inscription (avec hachage des mots de passe).
  - Connexion avec gestion de session.
  - Utilisation de **JWT** pour sécuriser l’API.
- **Sécurité renforcée :**  
  - Protection contre les attaques **XSS** (en échappant les entrées).
  - Protection contre les attaques **CSRF** (avec des tokens).
  - Prévention des **injections SQL** (via des requêtes préparées en PDO).

### **2.2 Analyse des Besoins Techniques**
- **Langage :** PHP (version 7+ recommandée)
- **Base de données :** MySQL (pour stocker les contacts et les utilisateurs)
- **API REST :** Pour effectuer des opérations CRUD sur les contacts
- **Outils de sécurité :**  
  - `htmlspecialchars()` pour échapper les entrées utilisateur.
  - Tokens CSRF pour protéger les formulaires.
  - `password_hash()` et `password_verify()` pour la gestion des mots de passe.
  - Bibliothèque `firebase/php-jwt` pour la gestion des JSON Web Tokens.

---

## **3. Conception et Architecture du Projet**

### **3.1 Structure du Projet**
Organisez votre projet dans une structure claire. Par exemple :

```
mini-app-securisee/
 ┣ src/
 ┃ ┣ config/
 ┃ ┃ ┗ db.php           # Connexion à la base de données
 ┃ ┣ controllers/
 ┃ ┃ ┣ AuthController.php    # Gestion de l'inscription, connexion et JWT
 ┃ ┃ ┗ ContactController.php # Gestion des contacts (CRUD)
 ┃ ┣ models/
 ┃ ┃ ┣ User.php         # Classe Utilisateur
 ┃ ┃ ┗ Contact.php      # Classe Contact
 ┃ ┣ views/
 ┃ ┃ ┣ login.php
 ┃ ┃ ┣ register.php
 ┃ ┃ ┗ dashboard.php
 ┣ public/
 ┃ ┣ index.php          # Point d'entrée de l'application
 ┃ ┗ assets/            # CSS, JS, images
 ┣ vendor/              # Dépendances via Composer (ex. firebase/php-jwt)
 ┣ README.md
 ┗ .env.example         # Exemple de configuration sensible
```

### **3.2 Architecture de l’Application**
- **Back-end :**  
  Utilisez la **POO** pour structurer votre code. Créez des classes pour représenter les **utilisateurs** et les **contacts**.
- **API REST :**  
  Implémentez une API dans le contrôleur `ContactController.php` qui gère les requêtes HTTP (GET, POST, PUT, DELETE).
- **Sécurité :**  
  Intégrez les mécanismes de sécurité étudiés :  
  - Protection XSS dans la couche de vue.
  - Vérification CSRF dans les formulaires.
  - Requêtes préparées en PDO pour les interactions avec la base de données.
  - Utilisation de JWT pour sécuriser l’API et authentifier les utilisateurs.

---

## **4. Mise en Œuvre et Développement**

### **4.1 Mise en place de la Base de Données**
- Créez une base de données (ex. `secure_contacts`) et deux tables :  
  - **users** : pour stocker les informations d’authentification.
  - **contacts** : pour stocker les données du carnet de contacts.

**Exemple de création de table `contacts` :**
```sql
CREATE TABLE contacts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    phone VARCHAR(20),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
);
```

### **4.2 Implémentation des Fonctionnalités CRUD via une API REST**
- **GET :** Retourner la liste des contacts pour un utilisateur authentifié.
- **POST :** Ajouter un nouveau contact.
- **PUT :** Mettre à jour un contact existant.
- **DELETE :** Supprimer un contact.

**Exemple de traitement d’une requête GET dans `ContactController.php` :**
```php
<?php
class ContactController {
    private $conn;

    public function __construct($dbConnection) {
        $this->conn = $dbConnection;
    }

    public function getContacts($userId) {
        $stmt = $this->conn->prepare("SELECT * FROM contacts WHERE user_id = ?");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        $contacts = $result->fetch_all(MYSQLI_ASSOC);
        header('Content-Type: application/json');
        echo json_encode($contacts);
    }
}
```

### **4.3 Sécurisation des Accès avec JWT**
- **Génération d’un JWT** lors de la connexion de l’utilisateur dans `AuthController.php`.
- **Validation du JWT** pour chaque requête protégée sur l’API.
  
**Exemple de génération d’un JWT :**
```php
<?php
use Firebase\JWT\JWT;

class AuthController {
    private $secretKey = "votre_cle_secrete";

    public function generateJWT($userData) {
        $payload = [
            "iss" => "http://votresite.com",
            "aud" => "http://votresite.com",
            "iat" => time(),
            "exp" => time() + 3600,
            "data" => $userData
        ];
        return JWT::encode($payload, $this->secretKey);
    }
}
```

### **4.4 Mise en Place des Mécanismes de Sécurité**
- **Protection XSS :**  
  Dans vos vues, utilisez `htmlspecialchars()` pour afficher les données.
  
- **Protection CSRF :**  
  Générez un token CSRF à inclure dans chaque formulaire et validez-le lors du traitement.

- **Requêtes préparées :**  
  Utilisez PDO ou MySQLi avec des requêtes préparées pour éviter les injections SQL.

### **4.5 Test et Débogage**
- **Tests unitaires :**  
  Vérifiez chaque fonctionnalité individuellement.
- **Utilisation de Postman :**  
  Testez votre API en envoyant des requêtes GET, POST, PUT et DELETE.
- **Debuggage :**  
  Ajoutez des logs et des messages d’erreur pour faciliter le débogage.

---

## **5. Présentation et Évaluation du Projet**

### **5.1 Documentation et Présentation**
- **README.md :**  
  Expliquez en détail :
  - L’objectif du projet.
  - La structure du projet.
  - Les étapes d’installation.
  - Comment tester l’application (avec Postman, navigateur, etc.).
- **Démonstration :**  
  Préparez une courte présentation ou une vidéo montrant le fonctionnement de l’application (authentification, gestion des contacts, etc.).

### **5.2 Évaluation**
- **Fonctionnalités :**  
  Assurez-vous que toutes les fonctionnalités (CRUD, authentification, sécurisation) sont bien implémentées et fonctionnent.
- **Sécurité :**  
  Vérifiez que votre application protège contre les attaques XSS, CSRF et les injections SQL.
- **Qualité du Code :**  
  Le code doit être clair, bien commenté et structuré de manière cohérente.
- **Documentation :**  
  La documentation doit être complète et permettre à un utilisateur ou évaluateur de comprendre et de tester votre projet.

---

## **6. Conclusion**

Ce projet final est une occasion unique de mettre en pratique tout ce que vous avez appris :
- La **programmation orientée objet** pour structurer votre code.
- La création d’**API RESTful** pour gérer les données via des requêtes HTTP.
- L’**implémentation de mesures de sécurité** essentielles (XSS, CSRF, injection SQL, JWT).

En réalisant ce mini-projet, vous consoliderez vos compétences en développement PHP avancé et serez mieux préparé à développer des applications web robustes et sécurisées.

---

**Bonne pratique, soyez créatifs et surtout, happy coding !**