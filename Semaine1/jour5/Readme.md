# Blog PHP avec Bootstrap

Un blog moderne et élégant développé en PHP avec une interface utilisateur Bootstrap 5, enrichi d'animations et d'effets visuels modernes.

## 🚀 Fonctionnalités

### Système d'Articles
- Interface utilisateur moderne et responsive
- Mise en page élégante avec Bootstrap 5
- Système de pagination avancé
- Extraits d'articles avec aperçu

### Recherche Avancée
- Recherche en temps réel (AJAX)
- Mise à jour dynamique des résultats
- Debouncing pour optimiser les performances
- Navigation dans l'historique intégrée
- Indicateur de chargement
- URLs partageables pour les résultats de recherche

### Système de Commentaires
- Commentaires en temps réel
- Validation côté client et serveur
- Notifications de succès/erreur
- Interface utilisateur intuitive

### Gestion des Erreurs
- Pages d'erreur 404 et 500 personnalisées
- Suggestions d'articles sur la page 404
- Animations et effets visuels
- Section support utilisateur

### Design et UX
- Design responsive et mobile-first
- Animations fluides et transitions
- Thème de couleur personnalisé
- Police Poppins pour une meilleure lisibilité
- Icônes Font Awesome intégrées

## 🎨 Caractéristiques Techniques

### Frontend
- **Bootstrap 5** pour la mise en page
- **Font Awesome** pour les icônes
- **JavaScript** moderne avec Fetch API
- Animations CSS personnalisées
- Design responsive

### Backend
- **PHP 7.4+** avec PDO
- Architecture MVC simplifiée
- Gestion sécurisée des requêtes
- Protection contre les injections SQL
- Validation des données

### Performance
- Mise en cache des ressources
- Compression GZIP
- Optimisation des images
- Debouncing des requêtes AJAX
- Chargement différé (lazy loading)

## 📋 Prérequis

- PHP 7.4 ou supérieur
- MySQL 5.7 ou supérieur
- Serveur web (Apache recommandé)
- Extension PDO PHP activée
- mod_rewrite Apache activé

## 🛠️ Installation

1. Clonez le dépôt :
```bash
git clone [URL_DU_REPO]
```

2. Importez la base de données :
```sql
-- Création de la base de données
CREATE DATABASE IF NOT EXISTS blog;
USE blog;

-- Structure des tables
CREATE TABLE articles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titre VARCHAR(255) NOT NULL,
    contenu TEXT NOT NULL,
    date_creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE commentaires (
    id INT AUTO_INCREMENT PRIMARY KEY,
    article_id INT NOT NULL,
    auteur VARCHAR(100) NOT NULL,
    commentaire TEXT NOT NULL,
    date_creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (article_id) REFERENCES articles(id)
);
```

3. Configurez votre fichier `includes/config.php` :
```php
define('DB_HOST', 'localhost');
define('DB_NAME', 'blog');
define('DB_USER', 'votre_utilisateur');
define('DB_PASS', 'votre_mot_de_passe');
define('SITE_TITLE', 'Mon Blog Tech');
define('SITE_DESCRIPTION', 'Un blog sur la technologie et le développement web');
```

4. Configurez votre serveur web :
   - Assurez-vous que mod_rewrite est activé
   - Le fichier .htaccess est configuré pour la gestion des erreurs et les redirections

## 📁 Structure du Projet

```
/
├── articles/
│   └── article.php
├── includes/
│   ├── config.php
│   ├── db.php
│   ├── header.php
│   └── footer.php
├── css/
│   └── style.css
├── .htaccess
├── index.php
├── articles.php
├── about.php
├── 404.php
├── 500.php
└── README.md
```

## 🔒 Sécurité

- Protection contre les injections SQL (PDO)
- Échappement des données HTML (htmlspecialchars)
- Protection des fichiers sensibles (.htaccess)
- Validation des entrées utilisateur
- Headers de sécurité configurés

## 🎯 Fonctionnalités à Venir

- [ ] Système d'authentification
- [ ] Panel d'administration
- [ ] Éditeur WYSIWYG pour les articles
- [ ] Système de tags et catégories
- [ ] Mode sombre
- [ ] API REST
- [ ] Système de newsletter
- [ ] Cache avancé

## 🤝 Contribution

Les contributions sont les bienvenues ! Pour contribuer :

1. Forkez le projet
2. Créez une branche pour votre fonctionnalité
3. Committez vos changements
4. Poussez vers la branche
5. Ouvrez une Pull Request

## 📝 Licence

Ce projet est sous licence MIT. Voir le fichier `LICENSE` pour plus de détails.

## 📧 Support

Pour toute question ou suggestion :
- Ouvrez une issue
- Contactez-nous via le formulaire sur la page À propos
- Email : support@example.com
