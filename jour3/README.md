# Système de Commande en Ligne pour Restaurant

Une application web permettant aux clients de passer des commandes en ligne et au restaurant de gérer ces commandes.

## Fonctionnalités

- 🍽️ Passage de commande par les clients
- 📋 Consultation de la liste des commandes
- 🔄 Modification du statut des commandes (en attente, validée, livrée, annulée)
- ❌ Suppression des commandes

## Prérequis

- PHP 7.4 ou supérieur
- MySQL 5.7 ou supérieur
- Serveur web (Apache, Nginx, etc.)

## Installation

1. **Cloner le projet**
   ```bash
   git clone https://github.com/digitaleflex/elfrida-formation 
   cd elfrid-formation/jour3
   ```

2. **Configuration de la base de données**
   - Créer une base de données MySQL
   - Importer le fichier `script.sql`
   - Modifier le fichier `config.php` avec vos informations de connexion :
     ```php
     $host = 'localhost';
     $dbname = 'restaurant';
     $username = 'root';
     $password = '';
     ```

3. **Configuration du serveur web**
   - Placer les fichiers dans votre répertoire web
   - S'assurer que PHP est configuré avec l'extension mysqli

## Structure du projet

```
├── index.html          # Page d'accueil
├── commande.html       # Formulaire de commande
├── commandes.html      # Gestion des commandes
├── api.php            # API REST
├── config.php         # Configuration BD
├── script.sql         # Structure de la BD
└── css/
    └── styles.css     # Styles CSS
```

## Utilisation

1. **Page d'accueil**
   - Accéder à `index.html`
   - Choisir entre passer une commande ou voir les commandes

2. **Passer une commande**
   - Remplir le formulaire avec nom, email et choix du plat
   - La commande est enregistrée avec le statut "en attente"

3. **Gérer les commandes**
   - Voir toutes les commandes
   - Modifier leur statut
   - Supprimer des commandes

## API REST

L'API utilise les méthodes HTTP standards :

- `GET /api.php` : Liste toutes les commandes
- `POST /api.php` : Crée une nouvelle commande
- `PUT /api.php` : Met à jour le statut d'une commande
- `DELETE /api.php` : Supprime une commande

## Sécurité

- Protection contre les injections SQL avec des requêtes préparées
- Validation des données côté serveur
- Gestion des erreurs

## Contribution

1. Fork le projet
2. Créer une branche (`git checkout -b feature/AjoutFonctionnalite`)
3. Commit les changements (`git commit -m 'Ajout d'une fonctionnalité'`)
4. Push vers la branche (`git push origin feature/AjoutFonctionnalite`)
5. Créer une Pull Request

## Licence

Ce projet est sous licence MIT. Voir le fichier `LICENSE` pour plus de détails.


### Demontration

https://www.awesomescreenshot.com/video/36666061key=f28e1ca78066f39f1bd3ed4886f8670b


