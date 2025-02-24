Voici un cours détaillé et pédagogique sur la **Programmation Orientée Objet (POO) en PHP**, conçu pour être captivant et facile à comprendre.  

---

# **🚀 Jour 1 : Programmation Orientée Objet (POO) en PHP**  
## **🎯 Objectifs du jour :**  
- Comprendre les concepts de base de la **POO** et pourquoi elle est utile.  
- Apprendre à structurer son code en utilisant **classes et objets**.  
- Découvrir des concepts avancés comme **l’héritage, les interfaces et l’abstraction**.  
- Appliquer ces notions dans un mini-projet : un **gestionnaire de tâches**.

---

## **📌 Introduction : Pourquoi utiliser la POO ?**  

Imagine que tu développes une application de gestion de tâches en PHP procédural. Tu aurais probablement des fonctions séparées pour ajouter, modifier et supprimer des tâches. Mais au fil du temps, ton code devient difficile à maintenir et à modifier.  

👉 **La Programmation Orientée Objet (POO)** permet de **structurer** et **modulariser** le code en regroupant les données et les comportements dans des objets.  

### **✅ Avantages de la POO :**  
✅ Code plus **organisé** et **réutilisable**.  
✅ Facilite la **maintenance** et l’**évolution** d’un projet.  
✅ Permet une **meilleure collaboration** entre développeurs.  
✅ Protège les données en utilisant des notions comme **l’encapsulation**.  

---

## **📌 1. Les Bases de la POO en PHP**  

### **1.1 Déclaration d’une classe et création d’un objet**  

Une **classe** est un modèle qui définit un objet. Un **objet** est une instance de cette classe.  

```php
<?php
// Définition d'une classe
class Tache {
    public $nom; // Propriété de la classe

    // Constructeur : s’exécute automatiquement à l’instanciation
    public function __construct($nom) {
        $this->nom = $nom;
    }

    // Méthode : une fonction à l’intérieur d’une classe
    public function afficherNom() {
        return "La tâche est : " . $this->nom;
    }
}

// Instanciation d'un objet
$tache1 = new Tache("Apprendre PHP");
echo $tache1->afficherNom();
?>
```
### **Explication :**
1. On crée une **classe** `Tache` avec une **propriété** `$nom` et une **méthode** `afficherNom()`.
2. Le **constructeur `__construct()`** permet d'initialiser la propriété `$nom` lors de l'instanciation.
3. On crée un **objet** `tache1` et on affiche son nom avec `afficherNom()`.

---

## **📌 2. Concepts avancés de la POO**  

### **2.1 Encapsulation : Protéger les données**  

L’encapsulation permet de **restreindre l’accès** aux propriétés et méthodes avec les **modificateurs de visibilité**.  

- **public** : accessible partout.  
- **private** : accessible uniquement dans la classe.  
- **protected** : accessible dans la classe et les classes enfants.  

**Exemple :**  

```php
<?php
class Tache {
    private $nom;

    public function __construct($nom) {
        $this->nom = $nom;
    }

    // Getter pour accéder à $nom
    public function getNom() {
        return $this->nom;
    }

    // Setter pour modifier $nom
    public function setNom($nouveauNom) {
        $this->nom = $nouveauNom;
    }
}

$tache1 = new Tache("Apprendre PHP");
echo $tache1->getNom(); // Affiche : Apprendre PHP
$tache1->setNom("Maîtriser PHP");
echo $tache1->getNom(); // Affiche : Maîtriser PHP
?>
```
👉 Ici, la **propriété `$nom` est privée**, donc elle ne peut être modifiée qu’avec des **getters et setters**.

---

### **2.2 Héritage : Réutiliser le code**  

L’héritage permet à une classe **d'hériter** des propriétés et méthodes d’une autre classe.  

```php
<?php
class Tache {
    protected $nom;

    public function __construct($nom) {
        $this->nom = $nom;
    }

    public function getNom() {
        return $this->nom;
    }
}

// La classe TacheUrgente hérite de Tache
class TacheUrgente extends Tache {
    private $priorite;

    public function __construct($nom, $priorite) {
        parent::__construct($nom);
        $this->priorite = $priorite;
    }

    public function afficherDetails() {
        return "Tâche : " . $this->nom . " | Priorité : " . $this->priorite;
    }
}

$tacheUrgente = new TacheUrgente("Corriger un bug", "Haute");
echo $tacheUrgente->afficherDetails();
?>
```
👉 **`TacheUrgente` hérite de `Tache`** et ajoute une nouvelle propriété `$priorite`.

---

### **2.3 Interface et Classe Abstraite : Définir des règles**  

- **Une interface** définit des méthodes qu'une classe doit implémenter.  
- **Une classe abstraite** peut contenir des méthodes définies et non définies.  

```php
<?php
interface ActionTache {
    public function effectuer();
}

class TacheSimple implements ActionTache {
    public function effectuer() {
        return "La tâche est effectuée.";
    }
}

$tache = new TacheSimple();
echo $tache->effectuer();
?>
```
👉 **`TacheSimple` doit obligatoirement implémenter la méthode `effectuer()`** définie dans l’interface.

---

## **📌 3. Mini-Projet : Gestionnaire de Tâches en POO**  

### **Objectif :**  
Créer une classe `GestionnaireTaches` qui permettra d’ajouter, lister et supprimer des tâches.  

```php
<?php
class GestionnaireTaches {
    private $taches = [];

    public function ajouterTache($tache) {
        $this->taches[] = $tache;
    }

    public function afficherTaches() {
        foreach ($this->taches as $index => $tache) {
            echo ($index + 1) . ". " . $tache->getNom() . "\n";
        }
    }
}

// Création d'un gestionnaire de tâches
$gestionnaire = new GestionnaireTaches();
$tache1 = new Tache("Apprendre PHP");
$tache2 = new Tache("Créer un projet en POO");

$gestionnaire->ajouterTache($tache1);
$gestionnaire->ajouterTache($tache2);
$gestionnaire->afficherTaches();
?>
```
👉 Ce mini-projet permet **d’ajouter et lister les tâches** en utilisant la POO.

---

## **📌 Exercices pratiques 🏆**  

1️⃣ **Créer une classe `Utilisateur`** avec les propriétés `nom` et `email`. Ajouter un constructeur et une méthode `afficherInfos()`.  
2️⃣ **Créer une classe `Admin` qui hérite de `Utilisateur`**, en ajoutant une propriété `role`.  
3️⃣ **Créer une interface `Authentifiable`** avec une méthode `seConnecter()`. Implémenter cette interface dans `Utilisateur`.  

---

## **📌 Conclusion**  

🎯 **Aujourd’hui, tu as appris :**  
✅ Les bases de la POO en PHP (classes, objets, méthodes).  
✅ L’encapsulation, l’héritage, les interfaces et classes abstraites.  
✅ Comment structurer un projet avec la POO.  

🚀 **Prochain cours : Manipulation des fichiers en PHP !**