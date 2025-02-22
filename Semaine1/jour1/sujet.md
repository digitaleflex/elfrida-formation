### **Sujet : Gestion des Employés d'une Startup**

Une startup en pleine croissance souhaite organiser la gestion de ses employés. Vous devez créer une application web permettant à l'administrateur de gérer les informations des employés via une base de données MySQL. L'application doit implémenter les fonctionnalités suivantes :

1. **Créer une base de données** :
   - Nom de la base de données : `startup_db`.
   - Table `employes` avec les champs suivants :
     ```sql
     CREATE TABLE employes (
         id INT AUTO_INCREMENT PRIMARY KEY,
         nom VARCHAR(100) NOT NULL,
         poste VARCHAR(100) NOT NULL,
         email VARCHAR(100) UNIQUE NOT NULL
     );
     ```

2. **Implémenter le CRUD en PHP/PDO** :
   - **Read** : Afficher la liste des employés sous forme de tableau HTML (`index.php`).
   - **Create** : Ajouter un nouvel employé via un formulaire (`ajouter_employe.php`).
   - **Update** : Modifier les informations d'un employé existant (`modifier_employe.php`).
   - **Delete** : Supprimer un employé de la base de données (`supprimer_employe.php`).

3. **Sécuriser les requêtes** :
   - Utiliser PDO avec des requêtes préparées (`prepare()` et liaisons de paramètres) pour éviter les injections SQL.
   - Échapper les sorties utilisateur avec `htmlspecialchars()` pour prévenir les attaques XSS.

4. **Styler l'interface utilisateur** :
   - Utiliser Bootstrap pour rendre l'interface moderne et responsive.
   - Assurer une expérience utilisateur fluide avec des messages clairs (par exemple, confirmation avant suppression).

5. **Documentation** :
   - Fournir un fichier `README.md` détaillant le projet, les instructions d'installation, les fonctionnalités implémentées et éventuellement des captures d'écran.

---

### **Fichiers attendus** :
- `db.php` : Fichier de connexion à la base de données.
- `index.php` : Liste des employés.
- `ajouter_employe.php` : Formulaire d'ajout.
- `modifier_employe.php` : Modification d'un employé.
- `supprimer_employe.php` : Suppression d'un employé.
- `README.md` : Documentation du projet.
