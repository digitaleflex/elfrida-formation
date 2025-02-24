### **🔹 Jour 6 : Création d’une API REST avec PHP**

---

## **📝 Objectifs du Jour :**
- **Comprendre** le fonctionnement des API REST.
- **Créer** une API RESTful avec PHP et MySQL.
- **Gérer** les requêtes **GET**, **POST**, **PUT**, et **DELETE** pour manipuler des données.

---

## **📌 Contenu Détailé**

### **1. Introduction aux API RESTful**

Une API RESTful (Representational State Transfer) est un style d'architecture pour les services web qui utilise les verbes HTTP pour manipuler des ressources. Ces ressources peuvent être des données dans une base de données, des fichiers ou tout autre objet pouvant être modifié.

#### **Principes fondamentaux des API REST :**
- **Stateless (Sans état) :** Chaque requête doit être indépendante et doit contenir toutes les informations nécessaires pour être traitée.
- **Utilisation des méthodes HTTP standards :**
  - **GET** : Récupérer des données.
  - **POST** : Créer des données.
  - **PUT** : Mettre à jour des données.
  - **DELETE** : Supprimer des données.
- **Les URLs sont des ressources :** Chaque ressource a une URL unique qui permet d'accéder à ses données.
  
### **2. Concepts Clés et Bonnes Pratiques**

- **Méthode HTTP appropriée :** Assurez-vous de toujours utiliser la méthode HTTP appropriée pour l’action que vous souhaitez effectuer (par exemple, **GET** pour récupérer, **POST** pour créer).
- **Réponses cohérentes :** Utilisez des codes de statut HTTP pour indiquer si une requête a été réussie ou non (ex. **200 OK**, **201 Created**, **404 Not Found**).
- **Utilisation de JSON :** Les données échangées dans une API REST sont généralement formatées en JSON, car c'est un format léger, facile à comprendre et à manipuler.

### **3. Utilisation de Postman pour Tester une API**

[Postman](https://www.postman.com/) est un outil populaire qui permet de tester des API en envoyant des requêtes HTTP et en visualisant les réponses. Il peut être utilisé pour tester les différentes méthodes HTTP, valider les codes de statut et examiner le contenu de la réponse.

### **4. Création d’une API Simple avec PHP et MySQL**

#### **Étape 1 : Préparer la Base de Données MySQL**

Avant de créer l'API, vous devez préparer une base de données. Nous allons créer une base de données `contacts_api` avec une table `contacts` pour stocker les informations des contacts.

Exemple de table `contacts` :
```sql
CREATE DATABASE contacts_api;

USE contacts_api;

CREATE TABLE contacts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    phone VARCHAR(15)
);
```

#### **Étape 2 : Connexion à la Base de Données avec PHP**

Créez un fichier `db.php` pour gérer la connexion à la base de données.

```php
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "contacts_api";

// Créer la connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
```

#### **Étape 3 : Gérer les Routes pour les Actions**

Les routes correspondent aux points d'accès de notre API. Chaque action (GET, POST, PUT, DELETE) sera associée à une route spécifique. Vous pouvez créer un fichier `api.php` pour gérer les différentes requêtes.

---

### **5. Implémentation des Requêtes CRUD**

Les requêtes CRUD (Create, Read, Update, Delete) permettent de manipuler les ressources de l’API. Nous allons implémenter ces requêtes en PHP pour manipuler la table `contacts`.

#### **5.1 GET : Récupérer des Données**

La méthode **GET** permet de récupérer des contacts dans la base de données.

```php
// api.php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $sql = "SELECT * FROM contacts";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $contacts = [];
        while($row = $result->fetch_assoc()) {
            $contacts[] = $row;
        }
        echo json_encode($contacts);
    } else {
        echo json_encode(["message" => "No contacts found"]);
    }
}
```

#### **5.2 POST : Ajouter des Données**

La méthode **POST** permet d’ajouter de nouveaux contacts à la base de données. 

```php
// api.php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"));
    
    $name = $data->name;
    $email = $data->email;
    $phone = $data->phone;

    $sql = "INSERT INTO contacts (name, email, phone) VALUES ('$name', '$email', '$phone')";
    
    if ($conn->query($sql) === TRUE) {
        echo json_encode(["message" => "New contact created successfully"]);
    } else {
        echo json_encode(["message" => "Error: " . $conn->error]);
    }
}
```

#### **5.3 PUT : Modifier des Données**

La méthode **PUT** permet de mettre à jour les informations d'un contact existant.

```php
// api.php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    $data = json_decode(file_get_contents("php://input"));
    
    $id = $data->id;
    $name = $data->name;
    $email = $data->email;
    $phone = $data->phone;

    $sql = "UPDATE contacts SET name='$name', email='$email', phone='$phone' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(["message" => "Contact updated successfully"]);
    } else {
        echo json_encode(["message" => "Error: " . $conn->error]);
    }
}
```

#### **5.4 DELETE : Supprimer des Données**

La méthode **DELETE** permet de supprimer un contact de la base de données.

```php
// api.php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    $data = json_decode(file_get_contents("php://input"));
    
    $id = $data->id;

    $sql = "DELETE FROM contacts WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(["message" => "Contact deleted successfully"]);
    } else {
        echo json_encode(["message" => "Error: " . $conn->error]);
    }
}
```

---

### **6. Tester l’API avec Postman**

Une fois que l'API est mise en place, vous pouvez tester les différentes méthodes avec **Postman** :

1. **GET Request** : Utilisez la méthode GET pour récupérer la liste des contacts.
2. **POST Request** : Utilisez la méthode POST pour créer un nouveau contact.
3. **PUT Request** : Utilisez la méthode PUT pour modifier un contact existant.
4. **DELETE Request** : Utilisez la méthode DELETE pour supprimer un contact.

---

## **💡 Conclusion :**

Ce jour vous a permis de comprendre comment créer une API RESTful avec PHP et MySQL en utilisant les principales méthodes HTTP. Vous avez appris à gérer les opérations CRUD (Create, Read, Update, Delete) pour manipuler des données dans une base de données. Ce genre de compétence est essentiel pour créer des applications web modernes qui nécessitent des interactions avec un serveur.

---

**Bon courage pour le développement de votre API !**