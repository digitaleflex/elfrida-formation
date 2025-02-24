# **📌 Jour 3 : Envoi d’E-mails en PHP avec PHPMailer**  

## **🎯 Objectifs du jour :**  
- Comprendre pourquoi utiliser PHPMailer au lieu de la fonction `mail()` native de PHP.  
- Installer et configurer PHPMailer pour envoyer des e-mails via SMTP.  
- Envoyer un e-mail simple avec un sujet et un corps de message.  
- Implémenter un système de confirmation par e-mail.  
- Sécuriser l’envoi des e-mails et gérer les erreurs.  

---

## **1️⃣ Introduction à PHPMailer**  
### **📌 Pourquoi utiliser PHPMailer ?**  
PHP propose une fonction native appelée `mail()`, mais elle présente plusieurs limites :  
❌ **Pas de support SMTP sécurisé** (TLS/SSL).  
❌ **Difficile à configurer sur certains serveurs** (souvent bloqué par les hébergeurs).  
❌ **Manque de flexibilité** (pièces jointes, HTML, etc.).  
❌ **Faible gestion des erreurs**.  

💡 **PHPMailer** est une bibliothèque populaire qui permet d’envoyer des e-mails plus facilement et de manière sécurisée avec **SMTP**, support des **pièces jointes**, et format **HTML**.  

---

## **2️⃣ Installation et Configuration de PHPMailer**  
### **📌 Installation avec Composer (Recommandé)**
Composer est un gestionnaire de dépendances pour PHP. Pour installer PHPMailer, utilisez la commande suivante :  
```bash
composer require phpmailer/phpmailer
```
Si vous ne pouvez pas utiliser Composer, vous pouvez télécharger la bibliothèque ici : [PHPMailer GitHub](https://github.com/PHPMailer/PHPMailer) et inclure les fichiers manuellement.

### **📌 Inclusion de PHPMailer dans votre projet**
Ajoutez ces lignes dans votre script PHP :  
```php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Charge PHPMailer via Composer
```
Si vous avez téléchargé PHPMailer manuellement, vous devez inclure les fichiers nécessaires :  
```php
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/SMTP.php';
```

---

## **3️⃣ Envoi d’un E-mail Simple avec SMTP**
Voici un script **de base** pour envoyer un e-mail via **Gmail SMTP** :  
```php
$mail = new PHPMailer(true); // Active l'affichage des erreurs

try {
    // Configuration du serveur SMTP
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';  // Serveur SMTP (Gmail ici)
    $mail->SMTPAuth   = true;
    $mail->Username   = 'votre_email@gmail.com'; // Remplacez par votre adresse Gmail
    $mail->Password   = 'votre_mot_de_passe'; // Remplacez par votre mot de passe (ou utilisez un mot de passe d'application Gmail)
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // TLS recommandé
    $mail->Port       = 587;

    // Paramètres de l’e-mail
    $mail->setFrom('votre_email@gmail.com', 'Votre Nom');
    $mail->addAddress('destinataire@example.com'); // Adresse du destinataire
    $mail->Subject = 'Sujet de votre e-mail';
    $mail->Body    = 'Ceci est un e-mail envoyé avec PHPMailer !';
    
    // Envoi
    $mail->send();
    echo 'E-mail envoyé avec succès !';
} catch (Exception $e) {
    echo "Erreur lors de l'envoi : {$mail->ErrorInfo}";
}
```
✅ **Explication des paramètres SMTP :**  
- **Host :** Le serveur SMTP (ici, Gmail `smtp.gmail.com`).  
- **SMTPAuth :** Activation de l’authentification SMTP.  
- **Username & Password :** Identifiants de connexion.  
- **SMTPSecure :** `TLS` ou `SSL` pour chiffrer la connexion.  
- **Port :** `587` pour TLS, `465` pour SSL.  

⚠️ **Si vous utilisez Gmail, activez "Accès aux applications moins sécurisées" ou utilisez un mot de passe d’application.**  

---

## **4️⃣ Envoi d’un E-mail avec HTML et Pièces Jointes**  
PHPMailer permet d’envoyer des e-mails au format **HTML** et d’ajouter des **fichiers en pièce jointe** :  
```php
$mail->isHTML(true); // Activer le format HTML
$mail->Body = '<h1>Bienvenue !</h1><p>Ceci est un message en HTML.</p>';
$mail->AltBody = 'Ceci est une version texte du message HTML.';

// Ajouter une pièce jointe
$mail->addAttachment('chemin_du_fichier/fichier.pdf', 'nom_du_fichier.pdf');
```
✅ **Pourquoi `AltBody` ?**  
Certaines boîtes mail n’acceptent pas le HTML. L’`AltBody` permet d’envoyer une version texte en fallback.

---

## **5️⃣ Envoi d’un E-mail de Confirmation d’Inscription**  
Lorsqu’un utilisateur s’inscrit, on lui envoie un lien de confirmation :  
```php
$token = bin2hex(random_bytes(16)); // Générer un jeton sécurisé
$link = "https://votresite.com/confirmation.php?token=$token";

$mail->Subject = 'Confirmez votre inscription';
$mail->Body = "Cliquez sur ce lien pour activer votre compte : <a href='$link'>$link</a>";
```
### **📌 Vérification du lien de confirmation**  
Dans `confirmation.php`, vérifiez si le token est valide en le comparant avec celui stocké en base de données.

---

## **6️⃣ Sécurité et Gestion des Erreurs**
### **📌 Protéger ses identifiants SMTP**
Ne stockez **jamais** vos identifiants SMTP en dur dans votre code ! Utilisez un fichier `.env` :  
```env
SMTP_USER=votre_email@gmail.com
SMTP_PASS=votre_mot_de_passe
```
Puis chargez-le en PHP :  
```php
$mail->Username = getenv('SMTP_USER');
$mail->Password = getenv('SMTP_PASS');
```
### **📌 Gestion des erreurs d’envoi**
PHPMailer permet de capturer les erreurs SMTP :  
```php
try {
    $mail->send();
} catch (Exception $e) {
    echo "L’e-mail n’a pas pu être envoyé. Erreur : {$mail->ErrorInfo}";
}
```

---

# **💡 Mise en Pratique : Développement d’un Système d’Inscription avec Confirmation**
### **🎯 Objectif :**  
Créer un **formulaire d’inscription** qui envoie un e-mail avec un lien de confirmation.  

✅ **Étapes :**  
1. Un utilisateur remplit un **formulaire d’inscription** (`inscription.php`).  
2. Son email et un **token sécurisé** sont stockés en base de données.  
3. Un e-mail contenant un **lien de confirmation** est envoyé.  
4. L’utilisateur clique sur le lien (`confirmation.php`), et son compte est activé.  

---

## **🎯 Conclusion**
🔹 **PHPMailer** est une solution robuste pour l’envoi d’e-mails en PHP.  
🔹 L’utilisation de **SMTP sécurisé** est indispensable pour éviter le spam.  
🔹 Toujours **protéger ses identifiants** et **gérer les erreurs** correctement.  
🔹 L’**envoi d’e-mails transactionnels** (confirmation, récupération de mot de passe) est une pratique courante pour améliorer l’expérience utilisateur.  

---

🔥 **🚀 Prochaines étapes :**  
✅ Faire les exercices de la journée !  
✅ Publier le code sur **GitHub** avec un `README.md` clair !  
✅ Expérimenter avec **des modèles HTML/CSS d’e-mails** !  

Bonne pratique ! 🚀