
### **Sujet : Gestion des Stocks d'un Supermarché**

Un supermarché souhaite informatiser son stock de produits. Vous devez créer une application web permettant à l'administrateur de gérer les informations des produits via une base de données MySQL. L'application doit implémenter les fonctionnalités suivantes :

1. **Créer une base de données** :
   - Nom de la base de données : `supermarche_db`.
   - Table `produits` avec les champs suivants :
     ```sql
     CREATE TABLE produits (
         id INT AUTO_INCREMENT PRIMARY KEY,
         nom VARCHAR(100) NOT NULL,
         prix DECIMAL(10, 2) NOT NULL,
         stock INT NOT NULL
     );
     ```

2. **Implémenter le CRUD en PHP/PDO** :
   - **Read** : Afficher la liste des produits sous forme de tableau HTML (`index.php`).
   - **Create** : Ajouter un nouveau produit via un formulaire (`ajouter_produit.php`).
   - **Update** : Modifier les informations d'un produit existant (`modifier_produit.php`).
   - **Delete** : Supprimer un produit de la base de données (`supprimer_produit.php`).

3. **Ajouter un système de recherche** :
   - Permettre aux utilisateurs de rechercher un produit par son nom.
   - Bonus : Implémenter une recherche en temps réel (Live Search) sans recharger la page.

4. **Sécuriser les requêtes** :
   - Utiliser PDO avec des requêtes préparées (`prepare()` et liaisons de paramètres) pour éviter les injections SQL.
   - Échapper les sorties utilisateur avec `htmlspecialchars()` pour prévenir les attaques XSS.

5. **Styler l'interface utilisateur** :
   - Utiliser Bootstrap pour rendre l'interface moderne et responsive.
   - Assurer une expérience utilisateur fluide avec des messages clairs (par exemple, confirmation avant suppression).

6. **Documentation** :
   - Fournir un fichier `README.md` détaillant le projet, les instructions d'installation, les fonctionnalités implémentées et éventuellement des captures d'écran.

---

### **Fichiers attendus** :
- `db.php` : Fichier de connexion à la base de données.
- `index.php` : Liste des produits.
- `ajouter_produit.php` : Formulaire d'ajout.
- `modifier_produit.php` : Modification d'un produit.
- `supprimer_produit.php` : Suppression d'un produit.
- `recherche.php` ou `recherche_ajax.php` : Système de recherche (optionnel si intégré directement dans `index.php`).
- `README.md` : Documentation du projet.

---

Ce sujet évalue les compétences techniques des étudiants en développement web, notamment leur maîtrise de PHP, MySQL, PDO, et leur capacité à produire une application fonctionnelle, sécurisée et bien documentée.