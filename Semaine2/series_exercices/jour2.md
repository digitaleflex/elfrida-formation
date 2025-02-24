# **📌 Série d’exercices - Jour 2 : Manipulation des Fichiers en PHP**  
🚀 **Objectif :** Mettre en pratique les concepts vus dans le cours en développant des fonctionnalités liées à la manipulation et à la gestion des fichiers en PHP.  

✅ **Consignes générales :**  
1. **Chaque étudiant doit créer un projet PHP sur GitHub** avec un fichier **README.md** expliquant son projet et comment l’exécuter.  
2. **Le code doit être bien structuré** avec des commentaires expliquant chaque étape.  
3. **Les fichiers doivent être nommés correctement** et respecter les bonnes pratiques PHP.  
4. **Respectez la sécurité** en validant les entrées et en protégeant les fichiers.  

---

## **📝 Exercice 1 : Lecture et Écriture dans un Fichier**
### **🎯 Objectif :** Lire et écrire dans un fichier texte en PHP.  

✅ **Instructions :**  
1. Créez un fichier `journal.txt`.  
2. Écrivez un script PHP (`ecrire.php`) qui **ajoute** une nouvelle ligne avec la date et un message personnalisé.  
3. Créez un script (`lire.php`) qui affiche le contenu du fichier `journal.txt` sur une page web.  
4. Vérifiez que le fichier est **fermé après lecture et écriture**.  
5. Affichez le contenu du fichier en respectant les sauts de ligne (`<br>`).  

🔹 **Résultat attendu :**  
- Chaque exécution de `ecrire.php` ajoute une ligne dans `journal.txt`.  
- `lire.php` affiche tout le contenu du fichier correctement.  

---

## **📝 Exercice 2 : Manipulation des Fichiers CSV**
### **🎯 Objectif :** Lire et écrire dans un fichier CSV en PHP.  

✅ **Instructions :**  
1. Créez un fichier `users.csv` contenant 3 colonnes : **Nom, Email, Téléphone**.  
2. Développez un script PHP (`ajouter_utilisateur.php`) qui permet **d’ajouter un nouvel utilisateur** au fichier CSV via un formulaire HTML.  
3. Développez un script PHP (`afficher_utilisateurs.php`) qui **lit et affiche les utilisateurs** sous forme de tableau HTML.  
4. Ajoutez un bouton permettant d’exporter les utilisateurs en JSON (`export_json.php`).  

🔹 **Résultat attendu :**  
- Un formulaire pour ajouter des utilisateurs.  
- Une liste d’utilisateurs affichée sous forme de tableau.  
- Un fichier JSON généré contenant la liste des utilisateurs.  

---

## **📝 Exercice 3 : Upload de Fichiers Sécurisé**
### **🎯 Objectif :** Gérer l’upload de fichiers avec validation de sécurité.  

✅ **Instructions :**  
1. Créez un formulaire HTML (`upload.html`) permettant d’uploader une image.  
2. Développez un script PHP (`upload.php`) pour gérer l’upload :  
   - **Limiter les fichiers aux formats JPG, PNG et GIF.**  
   - **Limiter la taille des fichiers à 2 Mo.**  
   - **Renommer les fichiers pour éviter les conflits.**  
   - **Stocker les fichiers dans un dossier sécurisé (`uploads/`).**  
3. Créez un script (`galerie.php`) qui affiche toutes les images uploadées sous forme de galerie.  
4. Ajoutez un bouton pour **supprimer une image** (`supprimer.php`).  

🔹 **Résultat attendu :**  
- L’upload fonctionne et affiche un message en cas de succès/échec.  
- Les images sont affichées sous forme de galerie.  
- Un bouton permet de supprimer une image.  

---

## **📝 Exercice 4 (Avancé) : Système de Gestion de Fichiers**
### **🎯 Objectif :** Créer une interface complète de gestion de fichiers.  

✅ **Instructions :**  
1. Créez une interface web permettant :  
   - D’**uploader plusieurs fichiers** en une seule fois.  
   - De **voir la liste des fichiers** avec leur date d’upload.  
   - De **télécharger un fichier** en cliquant dessus.  
   - De **supprimer un fichier** avec confirmation.  
2. Sécurisez l’upload avec :  
   - Un contrôle des **types MIME et extensions**.  
   - Une **limitation de taille à 5 Mo par fichier**.  
   - Un **hashage du nom de fichier** pour éviter les conflits.  

🔹 **Résultat attendu :**  
- Une interface propre affichant les fichiers.  
- La possibilité d’interagir avec les fichiers (upload, affichage, suppression).  
- Une gestion sécurisée des fichiers.  

---

## **🎯 Bonus (Optionnel) : Stockage Avancé avec Base de Données**
✅ **Instructions :**  
1. Modifiez l’exercice 3 pour **enregistrer les fichiers uploadés dans une base de données** (nom, taille, date d’upload).  
2. Affichez la liste des fichiers avec leurs détails depuis la base de données.  

---

# **📌 Rendu du Devoir**  
📢 **Chaque étudiant doit publier son projet sur GitHub** avec :  
✅ Un dossier bien organisé (`upload/`, `csv/`, `json/` etc.).  
✅ Un fichier `README.md` expliquant le projet et les fichiers.  
✅ Un lien GitHub à soumettre pour évaluation.  

---

🚀 **Bon courage ! N’oubliez pas de sécuriser votre code et de bien commenter vos scripts !** 🎯🔥