## **📌 Série d'exercices - Jour 1 : Programmation Orientée Objet (POO) en PHP**  

🎯 **Objectif** : Mettre en pratique les notions de **classes, objets, héritage, interfaces et encapsulation** vues en cours. Chaque étudiant doit publier son code sur **GitHub** avec un fichier `README.md` expliquant son projet.  

📌 **Instructions générales** :  
- Chaque exercice doit être réalisé dans un **fichier PHP séparé**.  
- Créez un **dépôt GitHub** nommé `POO-PHP-Exercices` et organisez vos fichiers.  
- Ajoutez un **README.md** décrivant chaque exercice et comment exécuter le code.  
- Envoyez le lien de votre dépôt une fois terminé.  

---

## **🚀 Exercice 1 : Création d'une classe `Utilisateur`**  
📌 **Objectif** : Comprendre la création d'une classe et l'instanciation d'objets.  

### 🔹 Consignes :  
1. Créer une classe `Utilisateur` avec les propriétés suivantes :  
   - `nom` (public)  
   - `email` (privé)  
2. Ajouter un **constructeur** pour initialiser ces propriétés.  
3. Ajouter une méthode `afficherInfos()` qui affiche les informations de l’utilisateur.  
4. Créer **deux objets** `Utilisateur` et afficher leurs informations.  

---

## **🚀 Exercice 2 : Encapsulation et Getters/Setters**  
📌 **Objectif** : Appliquer l'encapsulation pour protéger les données.  

### 🔹 Consignes :  
1. Modifier la classe `Utilisateur` :  
   - Rendre la propriété `email` **privée**.  
   - Ajouter des **méthodes `getEmail()` et `setEmail()`** pour accéder/modifier l’email.  
2. Tester l'encapsulation en tentant d'accéder directement à `email` depuis un objet (ce qui doit générer une erreur).  

---

## **🚀 Exercice 3 : Héritage - Création d’un `Admin`**  
📌 **Objectif** : Comprendre et utiliser l’héritage.  

### 🔹 Consignes :  
1. Créer une classe `Admin` qui **hérite de `Utilisateur`**.  
2. Ajouter une propriété **`role` (privée)** avec un getter et un setter.  
3. Ajouter une méthode `afficherRole()` qui affiche le rôle de l'admin.  
4. Instancier un `Admin` avec un rôle `"Super Admin"` et afficher ses infos.  

---

## **🚀 Exercice 4 : Interface `Authentifiable`**  
📌 **Objectif** : Comprendre l’utilité des interfaces en PHP.  

### 🔹 Consignes :  
1. Créer une **interface `Authentifiable`** avec la méthode `seConnecter()`.  
2. Implémenter cette interface dans `Utilisateur` et `Admin`.  
3. Chaque classe doit avoir sa propre version de `seConnecter()` :  
   - `Utilisateur` affiche `"Connexion en tant qu'utilisateur"`  
   - `Admin` affiche `"Connexion en tant qu'admin"`  
4. Tester en instanciant `Utilisateur` et `Admin` et en appelant `seConnecter()`.  

---

## **🚀 Exercice 5 : Gestionnaire de Tâches en POO**  
📌 **Objectif** : Appliquer la POO dans un projet plus structuré.  

### 🔹 Consignes :  
1. Créer une classe `Tache` avec :  
   - Une propriété `titre` (privée).  
   - Un constructeur pour initialiser le titre.  
   - Un getter `getTitre()` pour récupérer le titre.  
2. Créer une classe `GestionnaireTaches` avec :  
   - Une **propriété privée `$taches`** (tableau).  
   - Une **méthode `ajouterTache(Tache $tache)`**.  
   - Une **méthode `afficherTaches()`** listant toutes les tâches.  
3. Tester l'ajout et l'affichage de plusieurs tâches.  

---

## **🚀 Exercice 6 : Utilisation des Traits**  
📌 **Objectif** : Découvrir un concept avancé de la POO en PHP.  

### 🔹 Consignes :  
1. Créer un **trait `Horodatage`** avec une méthode `afficherHorodatage()` qui affiche la date et l’heure actuelles.  
2. Utiliser ce trait dans `Tache` pour afficher la date de création de chaque tâche.  
3. Tester le fonctionnement en affichant l’horodatage d’une tâche créée.  

---

## **🚀 Exercice 7 : Création d’une Classe Abstraite `Personne`**  
📌 **Objectif** : Apprendre à structurer son code avec des classes abstraites.  

### 🔹 Consignes :  
1. Créer une **classe abstraite `Personne`** avec :  
   - Une **propriété `$nom`** protégée.  
   - Un **constructeur** qui initialise `$nom`.  
   - Une **méthode abstraite `afficherInfos()`**.  
2. Modifier `Utilisateur` et `Admin` pour **hériter de `Personne`** et implémenter `afficherInfos()`.  
3. Instancier des objets `Utilisateur` et `Admin`, puis appeler `afficherInfos()`.  

---

## **📌 🔥 Exercice Bonus : Gestion des utilisateurs avec JSON**  
📌 **Objectif** : Ajouter de la persistance en stockant des données en JSON.  

### 🔹 Consignes :  
1. Modifier la classe `Utilisateur` pour qu’elle puisse **sauvegarder ses données dans un fichier JSON** (`utilisateurs.json`).  
2. Ajouter une méthode `sauvegarderUtilisateur()` qui écrit les informations dans un fichier JSON.  
3. Ajouter une méthode `chargerUtilisateurs()` qui lit et affiche les utilisateurs depuis le fichier JSON.  
4. Tester en créant plusieurs utilisateurs et en vérifiant que les données sont bien enregistrées.  

---

## **📌 Rendu du devoir 📤**  
✅ **Créez un dépôt GitHub** appelé `POO-PHP-Exercices`.  
✅ Ajoutez chaque exercice dans un fichier séparé (`exercice1.php`, `exercice2.php`, etc.).  
✅ Ajoutez un fichier **`README.md`** expliquant le but de chaque exercice et comment l’exécuter.  
✅ Partagez le lien de votre dépôt GitHub une fois terminé.  

🚀 **Bon courage et happy coding !** 💻🔥