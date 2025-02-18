# Blog PHP avec Bootstrap

Un blog moderne et élégant développé en PHP avec une interface utilisateur Bootstrap 5, enrichi d'animations et d'effets visuels modernes.

## 🚀 Fonctionnalités

- Interface utilisateur moderne et responsive avec animations
- Design élégant utilisant Bootstrap 5 et Font Awesome
- Système d'articles avec mise en avant
- Système de commentaires interactif
- Barre de recherche intégrée
- Protection contre les injections SQL (PDO)
- Effets visuels et animations modernes
- Police personnalisée (Poppins)
- Thème de couleur personnalisé avec variables CSS
- Interface responsive et mobile-first

## 🎨 Caractéristiques du Design

- **Typographie moderne**
  - Police Poppins pour une meilleure lisibilité
  - Hiérarchie visuelle claire
  - Dégradés de texte pour les titres

- **Composants élégants**
  - Cartes avec effets de survol
  - Boutons avec dégradés et animations
  - Navigation avec icônes
  - Badges et étiquettes stylisés

- **Effets visuels**
  - Animations de chargement
  - Effets de survol interactifs
  - Ombres et élévations
  - Transitions fluides

## 📋 Prérequis

- PHP 7.4 ou supérieur
- MySQL 5.7 ou supérieur
- Serveur web (Apache, Nginx, etc.)
- Extension PDO PHP activée

## 🛠️ Installation

1. Clonez ce dépôt dans votre répertoire web :
```bash
git clone [URL_DU_REPO]
```

2. Créez une base de données MySQL nommée `blog`

3. Importez la structure de la base de données :
```sql
CREATE TABLE articles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titre VARCHAR(255) NOT NULL,
    contenu TEXT NOT NULL,
    date_creation DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE commentaires (
    id INT AUTO_INCREMENT PRIMARY KEY,
    article_id INT NOT NULL,
    auteur VARCHAR(100) NOT NULL,
    commentaire TEXT NOT NULL,
    date_creation DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (article_id) REFERENCES articles(id)
);
```

4. Configurez la connexion à la base de données dans `includes/config.php` :
```php
define('DB_HOST', 'localhost');
define('DB_NAME', 'blog');
define('DB_USER', 'votre_utilisateur');
define('DB_PASS', 'votre_mot_de_passe');
```

## 🎨 Personnalisation

Le blog utilise un système de design moderne et personnalisable :

1. **Variables CSS**
   - Modifiez les couleurs dans `:root` dans `css/style.css`
   - Personnalisez les ombres et rayons de bordure
   - Ajustez les transitions et animations

2. **Classes Bootstrap**
   - Utilisez les classes Bootstrap pour la mise en page
   - Personnalisez les composants Bootstrap existants
   - Ajoutez de nouvelles sections avec la grille Bootstrap

3. **Icônes et médias**
   - Utilisez Font Awesome pour les icônes
   - Ajoutez des images d'arrière-plan
   - Personnalisez les icônes de navigation

4. **Animations**
   - Modifiez les animations existantes dans `css/style.css`
   - Ajoutez de nouvelles animations CSS
   - Personnalisez les effets de survol

## 📁 Structure du Projet

```
├── articles/
│   └── article.php
├── commentaires/
│   ├── afficher_commentaires.php
│   └── ajouter_commentaire.php
├── includes/
│   ├── config.php
│   ├── db.php
│   ├── header.php
│   └── footer.php
├── css/
│   └── style.css
├── index.php
└── README.md
```

## 🔒 Sécurité

- Utilisation de PDO pour les requêtes préparées
- Protection contre les injections XSS (htmlspecialchars)
- Validation des entrées utilisateur
- Sécurisation des formulaires

## 🔄 Fonctionnalités à venir

- Mode sombre
- Système de likes et partages
- Éditeur de texte riche pour les commentaires
- Galerie d'images pour les articles
- Système de catégories
- Authentification des utilisateurs

## 📝 Licence

Ce projet est sous licence MIT. Voir le fichier `LICENSE` pour plus de détails.

## 🤝 Contribution

Les contributions sont les bienvenues ! N'hésitez pas à :

1. Fork le projet
2. Créer une branche pour votre fonctionnalité
3. Commit vos changements
4. Push sur la branche
5. Créer une Pull Request

## 📧 Contact

Pour toute question ou suggestion, n'hésitez pas à ouvrir une issue sur le projet.
