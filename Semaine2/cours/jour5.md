# **📚 Jour 5 : Gestion des Sessions et JWT (JSON Web Tokens)**

## **🎯 Objectifs du jour :**
- Comprendre le fonctionnement des sessions en PHP.
- Utiliser les cookies en toute sécurité pour stocker des informations côté client.
- Implémenter une authentification basée sur les JSON Web Tokens (JWT) pour sécuriser les API.

---

## **1. Gestion des Sessions en PHP**

### **1.1 Qu'est-ce qu'une session ?**
Une **session** permet de stocker des informations sur l'utilisateur côté serveur durant toute la durée de sa visite (ou **session**) sur le site web. Ces informations (comme l'identifiant utilisateur) sont stockées dans la variable superglobale `$_SESSION`.

### **1.2 Démarrer une session**
Pour utiliser les sessions, il faut appeler `session_start()` au tout début de votre script, avant d'envoyer le moindre contenu.
  
**Exemple :**
```php
<?php
// Démarrer la session
session_start();

// Stocker une variable de session
$_SESSION['username'] = 'Eurin';

// Afficher la variable
echo "Bonjour, " . $_SESSION['username'];
?>
```

### **1.3 Stocker et récupérer des variables de session**
Vous pouvez stocker différentes données dans `$_SESSION` et y accéder sur toutes les pages où `session_start()` est appelé.

**Exemple de stockage et récupération :**
```php
<?php
session_start();

// Stockage d'une donnée
$_SESSION['user_role'] = 'admin';

// Récupération de la donnée
if(isset($_SESSION['user_role'])) {
    echo "Votre rôle est : " . $_SESSION['user_role'];
} else {
    echo "Rôle non défini.";
}
?>
```

### **1.4 Sécuriser les sessions**
Pour renforcer la sécurité des sessions, vous pouvez :
- **Regénérer l'ID de session** après une connexion réussie avec `session_regenerate_id(true)`, afin de prévenir les attaques de fixation de session.
- Configurer des options dans `php.ini` ou au démarrage du script pour limiter l'accès aux sessions.

**Exemple :**
```php
<?php
session_start();
session_regenerate_id(true); // Regénère l'ID de session
?>
```

---

## **2. Gestion des Cookies en PHP**

### **2.1 Qu'est-ce qu'un cookie ?**
Un **cookie** est un petit fichier stocké sur le navigateur de l'utilisateur. Il permet de retenir des informations comme les préférences ou une partie de l'identification.

### **2.2 Définir un cookie sécurisé**
Utilisez la fonction `setcookie()` pour créer un cookie. Pour améliorer la sécurité, il est recommandé d'utiliser les options `HttpOnly` (empêche l'accès via JavaScript) et `Secure` (n'envoie le cookie qu'en HTTPS).

**Exemple :**
```php
<?php
// Définir un cookie nommé "user" qui expire dans 1 heure
setcookie("user", "Eurin", time() + 3600, "/", "", isset($_SERVER["HTTPS"]), true);
?>
```

### **2.3 Utiliser les cookies pour stocker des informations**
Les cookies sont accessibles via la variable superglobale `$_COOKIE`.

**Exemple :**
```php
<?php
if(isset($_COOKIE["user"])) {
    echo "Bonjour, " . $_COOKIE["user"];
} else {
    echo "Cookie non défini.";
}
?>
```

---

## **3. Implémentation d’un Système JWT (JSON Web Tokens)**

### **3.1 Qu'est-ce qu'un JWT ?**
Un **JWT** est un token sécurisé utilisé pour authentifier des utilisateurs, notamment dans les API. Il se compose de trois parties :
- **Header :** Indique le type de token et l'algorithme de signature (ex. HS256).
- **Payload :** Contient les données (claims) telles que l'identifiant utilisateur et d'autres informations.
- **Signature :** Assure que le token n'a pas été modifié en signant le header et le payload avec une clé secrète.

### **3.2 Génération d'un JWT**
Il est recommandé d'utiliser la bibliothèque [firebase/php-jwt](https://github.com/firebase/php-jwt) pour générer et valider des JWT.

**Installation via Composer :**
```bash
composer require firebase/php-jwt
```

**Exemple de génération :**
```php
<?php
require 'vendor/autoload.php';
use Firebase\JWT\JWT;

$key = "votre_cle_secrete"; // Clé secrète de signature
$payload = [
    "iss" => "http://votresite.com",     // Émetteur
    "aud" => "http://votresite.com",     // Audience
    "iat" => time(),                     // Date d'émission
    "nbf" => time(),                     // Date à partir de laquelle le token est valide
    "exp" => time() + 3600,              // Expiration (1 heure)
    "data" => [
        "userId" => 123,
        "username" => "Eurin"
    ]
];

$jwt = JWT::encode($payload, $key);
echo "Votre JWT : " . $jwt;
?>
```

### **3.3 Validation d'un JWT**
Pour vérifier l'authenticité d'un JWT, utilisez la même clé secrète pour le décoder.

**Exemple de validation :**
```php
<?php
require 'vendor/autoload.php';
use Firebase\JWT\JWT;

$key = "votre_cle_secrete";
$jwt = $_GET['token']; // Récupéré via l'URL ou l'en-tête Authorization

try {
    $decoded = JWT::decode($jwt, $key, ['HS256']);
    // $decoded est un objet contenant les informations du token
    echo "Authentification réussie pour l'utilisateur : " . $decoded->data->username;
} catch (Exception $e) {
    echo "Token invalide : " . $e->getMessage();
}
?>
```

### **3.4 Utilisation des JWT dans une API**
Les JWT sont souvent envoyés dans l’en-tête HTTP `Authorization: Bearer <token>` et sont utilisés pour sécuriser l'accès aux ressources d'une API. Le serveur valide le token avant d'autoriser l'accès.

---

## **4. Mise en Pratique : Création d’un Système de Connexion avec Sessions et JWT**

### **Étapes à suivre :**

1. **Page d'Inscription/Connexion :**
   - Créez un formulaire où l'utilisateur peut s'inscrire ou se connecter.
   - Validez les identifiants de l'utilisateur et démarrez une session avec `session_start()`.
   - Après une connexion réussie, utilisez `session_regenerate_id()` pour renforcer la sécurité.

2. **Génération d'un JWT :**
   - Après validation des identifiants, générez un JWT contenant les informations de l'utilisateur (ex. userId, username).
   - Affichez ou stockez le JWT pour une utilisation ultérieure dans vos appels API.

3. **Accès aux Pages Protégées :**
   - Pour accéder à des pages nécessitant une authentification, vérifiez la session et/ou demandez que le JWT soit présent dans l'en-tête de la requête.
   - Décodage et validation du JWT pour autoriser l'accès.

4. **Déconnexion :**
   - Implémentez une fonctionnalité de déconnexion qui détruit la session avec `session_destroy()` et, si nécessaire, invalide le JWT.

**Exemple de script de connexion (login.php) :**
```php
<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Simuler la validation des identifiants (à remplacer par une vérification réelle en base de données)
    if ($_POST['username'] == 'Eurin' && $_POST['password'] == 'secret') {
        // Démarrer la session et sécuriser
        session_regenerate_id(true);
        $_SESSION['user'] = $_POST['username'];
        
        // Générer un JWT pour l'utilisateur
        require 'vendor/autoload.php';
        use Firebase\JWT\JWT;
        $key = "votre_cle_secrete";
        $payload = [
            "iss" => "http://votresite.com",
            "aud" => "http://votresite.com",
            "iat" => time(),
            "exp" => time() + 3600,
            "data" => ["username" => $_SESSION['user']]
        ];
        $jwt = JWT::encode($payload, $key);
        
        echo "Connexion réussie. Votre JWT : " . $jwt;
    } else {
        echo "Identifiants incorrects.";
    }
}
?>
```

---

## **Conclusion**
- **Sessions et Cookies :** Ces mécanismes permettent de stocker temporairement des informations utilisateur. Les sessions sont gérées côté serveur tandis que les cookies sont stockés sur le navigateur.
- **Sécurisation :** Utilisez `session_start()` et `session_regenerate_id()` pour protéger les sessions. Définissez des cookies sécurisés avec les attributs `HttpOnly` et `Secure`.
- **JWT :** Ils offrent une solution moderne et décentralisée pour l'authentification, particulièrement utile pour sécuriser des API. Leur génération et validation reposent sur une clé secrète commune.
- **Application pratique :** En combinant sessions et JWT, vous pouvez créer des systèmes d'authentification robustes qui permettent aux utilisateurs de se connecter, d'accéder aux ressources protégées et de maintenir leur session de manière sécurisée.

Prenez le temps de tester chaque fonctionnalité et d'explorer comment ces technologies interagissent pour garantir la sécurité et l'efficacité de vos applications PHP.  
Bonne pratique et happy coding !