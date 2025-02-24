# **📚 Jour 2 : Manipulation des Fichiers en PHP**  

## 🎯 **Objectifs du cours**  
Aujourd’hui, nous allons apprendre à :  
✅ Lire, écrire et manipuler des fichiers en PHP.  
✅ Gérer l’upload de fichiers en toute sécurité.  
✅ Mettre en place des validations et des protections contre les attaques.  

---

# **1️⃣ Lecture et Écriture dans un Fichier en PHP**  

### 📌 **Pourquoi manipuler des fichiers en PHP ?**  
PHP permet de lire et d'écrire dans des fichiers pour stocker des données, configurer des paramètres, ou générer des logs d’activité.

## **1.1 Ouvrir et Lire un fichier**  

PHP propose la fonction `fopen()` pour ouvrir un fichier et `fread()` pour en lire le contenu.

🔹 **Syntaxe de base :**
```php
$nom_fichier = "mon_fichier.txt";
$fichier = fopen($nom_fichier, "r"); // Ouvrir en lecture seule

if ($fichier) {
    $contenu = fread($fichier, filesize($nom_fichier)); // Lire tout le fichier
    fclose($fichier); // Toujours fermer le fichier après utilisation
    echo nl2br($contenu); // Afficher le contenu avec sa mise en forme
} else {
    echo "Impossible d'ouvrir le fichier.";
}
```
👉 **Explication** :  
- `"r"` signifie **lecture seule**.  
- `filesize($nom_fichier)` récupère la taille du fichier.  
- `fclose($fichier)` ferme le fichier après lecture.  

## **1.2 Écrire dans un fichier**  

🔹 **Créer ou modifier un fichier :**
```php
$nom_fichier = "mon_fichier.txt";
$fichier = fopen($nom_fichier, "a"); // "a" pour ajouter du contenu sans écraser

if ($fichier) {
    fwrite($fichier, "Ajout d'une nouvelle ligne\n");
    fclose($fichier);
    echo "Écriture réussie !";
} else {
    echo "Impossible d'écrire dans le fichier.";
}
```
👉 **Modes d’ouverture :**
| Mode  | Description |
|-------|------------|
| `"r"` | Lecture seule |
| `"w"` | Écriture seule (efface le contenu existant) |
| `"a"` | Ajout à la fin du fichier (sans écraser le contenu) |

---

# **2️⃣ Manipulation des Fichiers CSV et JSON**  

## **2.1 Lire et écrire dans un fichier CSV**  
Un fichier CSV (**Comma-Separated Values**) stocke des données sous forme de tableau.

🔹 **Écriture d'un fichier CSV** :
```php
$fichier = fopen("data.csv", "w");
$data = [
    ["Nom", "Email", "Téléphone"],
    ["Alice", "alice@mail.com", "123456789"],
    ["Bob", "bob@mail.com", "987654321"]
];

foreach ($data as $ligne) {
    fputcsv($fichier, $ligne);
}
fclose($fichier);
echo "Fichier CSV créé !";
```

🔹 **Lecture d'un fichier CSV** :
```php
$fichier = fopen("data.csv", "r");
while ($ligne = fgetcsv($fichier)) {
    echo implode(" | ", $ligne) . "<br>";
}
fclose($fichier);
```

---

## **2.2 Manipulation de fichiers JSON**  
Les fichiers JSON permettent d’enregistrer des données sous forme d’objets.

🔹 **Écriture d’un fichier JSON** :
```php
$data = [
    "nom" => "Alice",
    "email" => "alice@mail.com",
    "age" => 25
];

$fichier = "data.json";
file_put_contents($fichier, json_encode($data, JSON_PRETTY_PRINT));
echo "Fichier JSON créé !";
```

🔹 **Lecture d’un fichier JSON** :
```php
$fichier = "data.json";
$contenu = file_get_contents($fichier);
$data = json_decode($contenu, true);

echo "Nom : " . $data["nom"] . "<br>";
echo "Email : " . $data["email"] . "<br>";
```

---

# **3️⃣ Upload de Fichiers en PHP**  

## **3.1 Utilisation de `$_FILES`**  

🔹 **Formulaire HTML pour uploader un fichier :**
```html
<form action="upload.php" method="post" enctype="multipart/form-data">
    <input type="file" name="fichier">
    <button type="submit">Uploader</button>
</form>
```

🔹 **Traitement en PHP (`upload.php`) :**
```php
if (isset($_FILES["fichier"])) {
    $dossier_destination = "uploads/";
    $nom_fichier = basename($_FILES["fichier"]["name"]);
    $chemin_fichier = $dossier_destination . $nom_fichier;

    if (move_uploaded_file($_FILES["fichier"]["tmp_name"], $chemin_fichier)) {
        echo "Fichier uploadé avec succès !";
    } else {
        echo "Erreur lors de l'upload.";
    }
}
```

---

## **3.2 Sécurisation de l’upload de fichiers**  

### 🔹 **Limiter le type de fichier**
Avant d’accepter un fichier, vérifions son **extension et son type MIME** :
```php
$extensions_autorisees = ["jpg", "jpeg", "png", "pdf"];
$extension = strtolower(pathinfo($nom_fichier, PATHINFO_EXTENSION));

if (!in_array($extension, $extensions_autorisees)) {
    die("Format non autorisé !");
}

$type_mime = mime_content_type($_FILES["fichier"]["tmp_name"]);
if (!in_array($type_mime, ["image/jpeg", "image/png", "application/pdf"])) {
    die("Type de fichier non valide !");
}
```

### 🔹 **Limiter la taille du fichier**
On empêche l’upload de fichiers trop volumineux :
```php
$taille_max = 2 * 1024 * 1024; // 2 Mo

if ($_FILES["fichier"]["size"] > $taille_max) {
    die("Fichier trop volumineux !");
}
```

### 🔹 **Stocker les fichiers dans un dossier sécurisé**
Il est recommandé de stocker les fichiers **hors du dossier public (`public_html`, `www`)** et d’utiliser un script PHP pour les récupérer.

---

# **4️⃣ Affichage et Suppression des fichiers uploadés**  

## **4.1 Afficher les fichiers uploadés**  
Lister les fichiers du dossier `uploads/` :
```php
$files = scandir("uploads/");

foreach ($files as $file) {
    if ($file !== "." && $file !== "..") {
        echo "<a href='uploads/$file'>$file</a> | <a href='supprimer.php?file=$file'>Supprimer</a><br>";
    }
}
```

---

## **4.2 Supprimer un fichier**  
Créer un script `supprimer.php` :
```php
if (isset($_GET["file"])) {
    $fichier = "uploads/" . basename($_GET["file"]);

    if (file_exists($fichier)) {
        unlink($fichier);
        echo "Fichier supprimé !";
    } else {
        echo "Fichier introuvable.";
    }
}
```

---

# **🎯 Récapitulatif**  
✅ Lire et écrire dans un fichier avec `fopen()`, `fwrite()`, `fread()`.  
✅ Manipuler des fichiers CSV et JSON.  
✅ Gérer l'upload de fichiers avec `$_FILES`.  
✅ Sécuriser l’upload avec des validations.  
✅ Afficher et supprimer les fichiers uploadés.  

---

# **🔥 Mini Exercice**  
🔹 **Créer un système d'upload sécurisé d’images avec affichage et suppression.**  
✅ **Consignes** :  
1️⃣ Créez une page `upload.html` avec un formulaire.  
2️⃣ Traitez l’upload en PHP (`upload.php`).  
3️⃣ Sécurisez les fichiers (taille, type, extension).  
4️⃣ Affichez la liste des images uploadées (`index.php`).  
5️⃣ Ajoutez une option pour supprimer un fichier (`supprimer.php`).  

---

🚀 **Bravo ! Vous avez maintenant toutes les bases pour manipuler les fichiers en PHP !** 💪🔥