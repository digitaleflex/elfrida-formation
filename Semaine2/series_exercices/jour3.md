# **📝 Série d’Exercices - Jour 3 : Envoi d’E-mails en PHP avec PHPMailer**  

## **📌 Instructions Générales :**  
📌 Chaque exercice doit être réalisé dans un **projet structuré** avec des fichiers bien organisés.  
📌 Vous devez publier votre code sur **GitHub** avec un fichier `README.md` expliquant :  
   - 📌 L’objectif de l’exercice  
   - 📌 Les prérequis (installation de PHPMailer, configuration SMTP, etc.)  
   - 📌 Comment exécuter le script  
📌 Pensez à gérer les **erreurs** et à sécuriser vos identifiants **SMTP** en utilisant un fichier `.env`.  
📌 Chaque étudiant devra envoyer le lien vers son **repository GitHub** après validation.  

---

## **🔹 Exercice 1 : Envoi d’un E-mail Simple avec PHPMailer**  
**🎯 Objectif :** Configurer et envoyer un e-mail simple en utilisant PHPMailer et SMTP.  

### **📌 Consignes :**  
1. Installer PHPMailer via **Composer**.  
2. Configurer l’envoi d’un e-mail en utilisant **SMTP (Gmail, Mailtrap, etc.)**.  
3. L’e-mail doit contenir :  
   - Un **expéditeur personnalisé** (nom + adresse e-mail).  
   - Un **destinataire** (mettez votre propre e-mail pour tester).  
   - Un **sujet** et un **message** en texte brut.  
4. Gérer et afficher les **erreurs** en cas d’échec d’envoi.  

**📌 Bonus :** Ajouter un **corps de message en HTML** et un **texte alternatif** (`AltBody`).  

---

## **🔹 Exercice 2 : Formulaire de Contact avec Envoi d’E-mail**  
**🎯 Objectif :** Créer un formulaire qui envoie un e-mail aux administrateurs d’un site.  

### **📌 Consignes :**  
1. Créer une page `contact.php` avec un formulaire contenant :  
   - **Nom** (champ texte).  
   - **E-mail** (champ e-mail).  
   - **Message** (champ textarea).  
   - **Bouton d’envoi**.  
2. Lors de la soumission du formulaire :  
   - Vérifier que tous les champs sont remplis.  
   - Valider l’adresse e-mail.  
   - Afficher un **message de confirmation** ou une **erreur**.  
3. Envoyer le contenu du formulaire à l’**administrateur** par e-mail avec PHPMailer.  

**📌 Bonus :**  
✔️ Ajouter un **captcha** (Google reCAPTCHA ou simple question mathématique).  
✔️ Enregistrer les messages en base de données.  

---

## **🔹 Exercice 3 : Envoi d’un E-mail avec Pièce Jointe**  
**🎯 Objectif :** Apprendre à envoyer des fichiers en pièce jointe par e-mail.  

### **📌 Consignes :**  
1. Modifier le formulaire de l’exercice précédent pour permettre **l’envoi d’un fichier** (`.pdf`, `.jpg`, `.png`).  
2. Vérifier la **taille et le type de fichier** avant l’envoi.  
3. Ajouter la pièce jointe à l’e-mail.  
4. Afficher un **message de confirmation** en cas de succès.  

**📌 Bonus :**  
✔️ Stocker les fichiers uploadés dans un **dossier sécurisé** avant envoi.  
✔️ Permettre l’envoi de **plusieurs pièces jointes**.  

---

## **🔹 Exercice 4 : Confirmation d’Inscription par E-mail**  
**🎯 Objectif :** Mettre en place un système d’inscription avec validation par e-mail.  

### **📌 Consignes :**  
1. Créer une page `inscription.php` avec un formulaire demandant :  
   - **Nom**  
   - **E-mail**  
   - **Mot de passe** (haché en base de données avec `password_hash()`).  
2. Après l’inscription :  
   - Générer un **token unique** pour chaque utilisateur.  
   - Stocker l’utilisateur en base de données avec un champ `status = 0` (non validé).  
   - Envoyer un e-mail contenant un **lien de confirmation** (`confirmation.php?token=...`).  
3. Dans `confirmation.php` :  
   - Vérifier si le **token existe** en base de données.  
   - Si oui, activer le compte (`status = 1`).  

**📌 Bonus :**  
✔️ Ajouter un **système de gestion des sessions** après validation.  
✔️ Afficher un **message d’erreur** si le lien est invalide ou expiré.  

---

## **🔹 Exercice 5 : Réinitialisation de Mot de Passe par E-mail**  
**🎯 Objectif :** Permettre à un utilisateur de réinitialiser son mot de passe via un e-mail.  

### **📌 Consignes :**  
1. Créer une page `forgot_password.php` où l’utilisateur entre son **adresse e-mail**.  
2. Après soumission :  
   - Vérifier si l’e-mail existe en base de données.  
   - Générer un **lien sécurisé** de réinitialisation avec un **token unique**.  
   - Envoyer ce lien par e-mail (`reset_password.php?token=...`).  
3. Dans `reset_password.php` :  
   - Vérifier si le **token est valide**.  
   - Si oui, afficher un **formulaire pour saisir un nouveau mot de passe**.  
   - Mettre à jour le mot de passe en base de données.  

**📌 Bonus :**  
✔️ Ajouter une **expiration du token** (ex : 30 minutes).  
✔️ Ne pas révéler si un e-mail existe pour éviter le phishing.  

---

## **🔹 Exercice 6 (Avancé) : Envoi d’E-mails Automatisés (CRON Job)**  
**🎯 Objectif :** Automatiser l’envoi d’un e-mail tous les jours à une liste d’utilisateurs.  

### **📌 Consignes :**  
1. Créer un script PHP (`email_cron.php`) qui envoie un **e-mail quotidien**.  
2. Ajouter une base de données contenant une **liste d’e-mails** à contacter.  
3. Planifier l’exécution automatique avec un **CRON job** (Linux) :  
   ```bash
   crontab -e
   ```
   Ajouter cette ligne pour exécuter le script toutes les 24h :  
   ```bash
   0 9 * * * /usr/bin/php /var/www/html/email_cron.php
   ```
4. Afficher **un message de confirmation** après l’envoi.  

**📌 Bonus :**  
✔️ Ajouter une **option pour se désinscrire** des e-mails automatiques.  
✔️ Envoyer des **rapports par e-mail** aux administrateurs.  

---

# **📌 Rendu des Exercices**
✅ Publiez votre code sur **GitHub** en respectant cette structure :  
```
📂 projet-envoi-email
 ┣ 📂 src
 ┃ ┣ 📜 inscription.php
 ┃ ┣ 📜 confirmation.php
 ┃ ┣ 📜 forgot_password.php
 ┃ ┣ 📜 reset_password.php
 ┃ ┣ 📜 contact.php
 ┃ ┣ 📜 email_cron.php
 ┃ ┗ 📜 config.php
 ┣ 📂 assets
 ┃ ┣ 📜 styles.css
 ┃ ┗ 📂 uploads
 ┣ 📜 README.md
 ┗ 📜 .env.example
```
📌 **README.md** doit expliquer :  
✔️ Les prérequis (PHP, PHPMailer, SMTP).  
✔️ L’installation et l’exécution des scripts.  
✔️ Les fonctionnalités et les cas d’utilisation.  

📌 **🔗 Envoyez le lien de votre repository GitHub pour validation.**  

---

# **🚀 Conclusion**
Ces exercices couvrent **toutes les compétences clés** pour gérer l’envoi d’e-mails en PHP. Après les avoir réalisés, vous serez capable de :  
✅ **Envoyer des e-mails simples et avancés.**  
✅ **Gérer l’authentification SMTP de manière sécurisée.**  
✅ **Mettre en place des confirmations d’inscription et de récupération de mot de passe.**  
✅ **Automatiser l’envoi d’e-mails avec des CRON jobs.**  

Bonne pratique et bon code ! 💻🔥