# **📝 Série d’Exercices - Jour 4 : Sécurité et Protection Contre les Attaques Web**

---

## **📌 Instructions Générales**
- **But :** Appliquer les bonnes pratiques de sécurité en PHP pour protéger vos applications contre les attaques XSS, CSRF, injection SQL et autres vulnérabilités.
- **Organisation :** Créez un projet structuré et publiez-le sur GitHub avec un fichier `README.md` qui détaille :
  - Les objectifs de chaque exercice.
  - Les étapes d’installation et d’exécution.
  - Les outils utilisés (ex. PHP, PDO, sessions, etc.).
- **Conseil :** Commentez votre code pour expliquer chaque étape et testez vos fonctionnalités pour vous assurer que les protections fonctionnent correctement.

---

## **🚀 Exercice 1 : Protection Contre les Attaques XSS**

### **🎯 Objectif :**
Empêcher l'exécution de code malveillant dans un formulaire de contact.

### **📌 Consignes :**
1. **Créez un formulaire de contact** comprenant les champs :
   - Nom
   - Email
   - Message
2. **Traitement du formulaire :**
   - Lors de la soumission, récupérez les données saisies.
   - Utilisez `htmlspecialchars()` pour échapper les entrées utilisateur avant de les afficher.
3. **Test :**
   - Essayez d'injecter du code JavaScript (ex. `<script>alert('XSS');</script>`) dans le champ message et vérifiez qu’il s’affiche en tant que texte, sans être exécuté.

---

## **🚀 Exercice 2 : Protection Contre les Attaques CSRF**

### **🎯 Objectif :**
Implémenter un token CSRF pour sécuriser un formulaire de modification des informations utilisateur.

### **📌 Consignes :**
1. **Création du formulaire :**
   - Créez un formulaire de modification (ex. mise à jour du profil avec nom et email).
2. **Mécanisme CSRF :**
   - À l’affichage du formulaire, générez un token unique (ex. `bin2hex(random_bytes(32))`) et stockez-le dans la session.
   - Incluez ce token dans un champ caché du formulaire.
3. **Validation du token :**
   - Dans le script de traitement, comparez le token envoyé avec celui stocké en session.
   - Si les tokens ne correspondent pas, refusez la modification et affichez un message d’erreur.
4. **Test :**
   - Simulez une soumission sans token ou avec un token invalide pour vérifier que la protection fonctionne.

---

## **🚀 Exercice 3 : Sécurisation des Mots de Passe par Hashage**

### **🎯 Objectif :**
Assurer la sécurité des mots de passe utilisateurs lors de l’inscription et la connexion.

### **📌 Consignes :**
1. **Inscription :**
   - Créez une page d’inscription où l’utilisateur saisit un nom, un email et un mot de passe.
   - Avant de stocker le mot de passe dans la base de données, utilisez `password_hash()` pour le chiffrer.
2. **Connexion :**
   - Créez une page de connexion demandant l’email et le mot de passe.
   - Récupérez le hash stocké en base et utilisez `password_verify()` pour comparer le mot de passe fourni.
3. **Test :**
   - Inscrivez-vous et assurez-vous que le mot de passe stocké est bien haché.
   - Testez la connexion avec le bon et le mauvais mot de passe pour vérifier la validité.

---

## **🚀 Exercice 4 : Prévention de l'Injection SQL avec PDO**

### **🎯 Objectif :**
Sécuriser les requêtes SQL en utilisant PDO et des requêtes préparées.

### **📌 Consignes :**
1. **Page de Connexion :**
   - Créez un formulaire de connexion avec des champs pour l’email et le mot de passe.
2. **Connexion à la base de données :**
   - Utilisez PDO pour établir une connexion sécurisée.
3. **Requête préparée :**
   - Préparez une requête SQL qui vérifie les informations de l’utilisateur en liant les paramètres (ex. `:email`).
   - Évitez d’insérer directement les données issues du formulaire dans la requête.
4. **Test :**
   - Essayez d’injecter du SQL dans les champs (ex. `' OR 1=1 --`) et vérifiez que l’attaque est bloquée.

---

## **🚀 Exercice 5 : Formulaire de Contact Ultra-Sécurisé**

### **🎯 Objectif :**
Intégrer plusieurs techniques de sécurité (XSS, CSRF, Injection SQL) dans un seul formulaire.

### **📌 Consignes :**
1. **Créez un formulaire de contact** avec les champs : nom, email, message.
2. **Sécurisation des données :**
   - Utilisez `htmlspecialchars()` pour échapper les données (protection XSS).
   - Ajoutez un token CSRF pour protéger le formulaire contre les attaques CSRF.
3. **Enregistrement des données :**
   - Stockez les informations dans une base de données en utilisant PDO et des requêtes préparées pour éviter les injections SQL.
4. **Test :**
   - Envoyez des données malveillantes pour simuler XSS, CSRF, et injection SQL et vérifiez que le système est résistant.

---

## **🚀 Exercice Bonus : Mise en Place d'une Politique CSP (Content Security Policy)**

### **🎯 Objectif :**
Renforcer la sécurité contre les attaques XSS en configurant une Content Security Policy.

### **📌 Consignes :**
1. **Configuration de l'en-tête CSP :**
   - Dans votre script PHP, ajoutez un en-tête HTTP `Content-Security-Policy` qui limite les sources autorisées pour les scripts, images et autres ressources.
   - Exemple :
     ```php
     header("Content-Security-Policy: default-src 'self'; script-src 'self' https://trusted.cdn.com; style-src 'self' 'unsafe-inline'");
     ```
2. **Test :**
   - Intégrez un script externe non autorisé dans votre page et vérifiez qu’il est bloqué par la politique CSP.

---

## **📌 Rendu du Devoir**

- **Organisation du Projet :**
  - Créez un dépôt GitHub (ex. `securite-web-php`) structuré en dossiers (ex. `src`, `assets`, etc.).
  - Ajoutez un fichier `README.md` décrivant :
    - Les objectifs de chaque exercice.
    - Les étapes d'installation et d'exécution.
    - Les choix techniques réalisés.
- **Soumission :**
  - Partagez le lien de votre repository GitHub pour évaluation.

---

**Bonne pratique et sécurité renforcée !**  
Mettez en application ces techniques pour développer des applications web robustes et protégées contre les attaques courantes.  
Happy coding !