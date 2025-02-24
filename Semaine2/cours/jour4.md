# **🔹 Jour 4 : Sécurité et Protection Contre les Attaques Web**

### **📝 Objectifs du jour :**
- Comprendre les principales attaques web : **XSS (Cross-Site Scripting)**, **CSRF (Cross-Site Request Forgery)**, et **Injection SQL**.
- Mettre en place des bonnes pratiques de sécurité en PHP pour protéger les applications web.
- Sécuriser les mots de passe et les entrées utilisateur.

### **📌 Contenu détaillé :**

---

### **1. Prévention des attaques XSS (Cross-Site Scripting)**

#### **Qu'est-ce que l'attaque XSS ?**
Le **Cross-Site Scripting (XSS)** est une attaque dans laquelle un attaquant injecte du code JavaScript malveillant dans une page web visitée par d'autres utilisateurs. Cela peut permettre à l'attaquant de voler des informations sensibles comme des cookies, des identifiants de session, ou même de manipuler l'affichage de la page.

#### **Comment prévenir l’attaque XSS ?**

- **Échapper les entrées utilisateur :**  
  Pour éviter qu’un utilisateur malveillant n'injecte du code JavaScript dans un champ de formulaire, il faut toujours **échapper** les données entrées par l’utilisateur. PHP fournit la fonction `htmlspecialchars()` qui permet de convertir les caractères spéciaux en entités HTML.

  **Exemple :**
  ```php
  $user_input = $_POST['user_input']; // Entrée de l'utilisateur
  echo htmlspecialchars($user_input, ENT_QUOTES, 'UTF-8');
  ```
  Cette fonction va convertir les caractères comme `<`, `>`, et `&` en entités HTML, empêchant ainsi l'exécution de code malveillant.

- **Utilisation de Content Security Policy (CSP) :**  
  Une **Content Security Policy (CSP)** est une norme qui permet de restreindre les sources de contenu qu’un site web peut charger, ce qui permet de réduire les risques d'attaques XSS. Il est recommandé de configurer CSP sur les serveurs pour limiter les sources externes.

  **Exemple de configuration CSP :**
  ```php
  header("Content-Security-Policy: default-src 'self'; script-src 'self' https://trusted.com;");
  ```

---

### **2. Prévention des attaques CSRF (Cross-Site Request Forgery)**

#### **Qu'est-ce que l'attaque CSRF ?**
Le **Cross-Site Request Forgery (CSRF)** est une attaque qui permet à un attaquant de forcer un utilisateur authentifié à exécuter une action non désirée sur une application web. Cela peut inclure des actions comme changer le mot de passe ou effectuer des paiements.

#### **Comment prévenir l’attaque CSRF ?**

- **Utilisation de tokens CSRF :**  
  Un **token CSRF** est un jeton unique généré pour chaque session ou formulaire et qui doit être envoyé avec chaque requête de modification de données. Le serveur peut vérifier si le token envoyé avec la requête correspond à celui qui est stocké dans la session de l'utilisateur, garantissant ainsi que la requête vient de l'utilisateur authentifié et non d'un site tiers.

  **Exemple :**
  ```php
  // Génération du token CSRF
  $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
  
  // Inclusion du token dans le formulaire HTML
  <form method="post" action="process_form.php">
    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token']; ?>">
    <!-- autres champs du formulaire -->
  </form>

  // Validation du token dans le script PHP de traitement
  if ($_POST['csrf_token'] !== $_SESSION['csrf_token']) {
    die("Token CSRF invalide !");
  }
  ```

- **Protection des formulaires sensibles :**  
  Utilisez toujours des tokens CSRF pour tous les formulaires qui impliquent des actions sensibles comme la modification de données ou la soumission de requêtes.

---

### **3. Sécurisation des mots de passe**

#### **Pourquoi sécuriser les mots de passe ?**
Les mots de passe sont souvent la première ligne de défense pour protéger les comptes utilisateurs. Si un attaquant parvient à récupérer un mot de passe, il peut accéder à des informations sensibles.

#### **Comment sécuriser les mots de passe ?**

- **Hashing des mots de passe avec `password_hash()` :**  
  Il est essentiel de ne jamais stocker un mot de passe en clair. PHP fournit la fonction `password_hash()` pour créer un **hash sécurisé** du mot de passe, utilisant l'algorithme de hachage **bcrypt** (par défaut).

  **Exemple :**
  ```php
  $password = $_POST['password'];
  $hashed_password = password_hash($password, PASSWORD_BCRYPT);
  // Enregistrez $hashed_password dans la base de données
  ```

- **Vérification avec `password_verify()` :**  
  Lors de la connexion, vous devez comparer le mot de passe entré par l'utilisateur avec le **hash** stocké dans la base de données. Utilisez `password_verify()` pour cette vérification.

  **Exemple :**
  ```php
  if (password_verify($_POST['password'], $hashed_password)) {
      // Connexion réussie
  } else {
      // Mot de passe incorrect
  }
  ```

---

### **4. Protection contre l’injection SQL**

#### **Qu'est-ce que l’injection SQL ?**
L’injection SQL est une technique où un attaquant insère des requêtes SQL malveillantes dans un champ de saisie pour manipuler la base de données. Cela peut permettre à l'attaquant de voler ou de modifier des données sensibles.

#### **Comment prévenir l’injection SQL ?**

- **Utilisation de PDO et des requêtes préparées :**  
  Pour éviter l’injection SQL, il est crucial d'utiliser des requêtes préparées avec des **paramètres liés** plutôt que d'inclure directement les entrées utilisateur dans les requêtes SQL.

  **Exemple avec PDO :**
  ```php
  $pdo = new PDO("mysql:host=localhost;dbname=test", "username", "password");
  $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
  $stmt->bindParam(':email', $_POST['email'], PDO::PARAM_STR);
  $stmt->execute();
  $result = $stmt->fetch();
  ```

- **Éviter l’utilisation directe des entrées utilisateur dans les requêtes SQL :**  
  Ne jamais insérer directement les entrées utilisateurs dans des requêtes SQL. Toujours passer par des requêtes préparées ou utiliser des fonctions d'échappement comme `mysqli_real_escape_string()`.

---

### **Mise en pratique : Développement d’un formulaire sécurisé avec protection contre XSS et CSRF**

Dans cet exercice, vous allez créer un formulaire sécurisé en suivant les bonnes pratiques pour prévenir les attaques XSS et CSRF.

**Étapes :**
1. Créez un formulaire de **contact** qui prend des informations comme le nom, l'email, et un message.
2. Assurez-vous de **protéger les entrées utilisateur** contre les attaques XSS en utilisant `htmlspecialchars()`.
3. Mettez en place un **token CSRF** pour protéger le formulaire contre les attaques CSRF.
4. Enregistrez les informations soumises par l'utilisateur dans la base de données après avoir validé et échappé les données.

---

### **📌 Conclusion :**
La sécurité des applications web est cruciale pour éviter que des utilisateurs malveillants exploitent des vulnérabilités pour compromettre des informations sensibles. Aujourd’hui, vous avez appris comment protéger vos applications PHP contre certaines des attaques les plus courantes telles que XSS, CSRF et l'injection SQL. Vous avez également vu comment sécuriser les mots de passe des utilisateurs pour empêcher leur compromission.

En mettant en œuvre ces bonnes pratiques de sécurité, vous pourrez développer des applications web plus sûres et fiables pour vos utilisateurs.