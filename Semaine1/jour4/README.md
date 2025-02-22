# 🔐 Système d'Authentification Moderne

Un système d'authentification moderne et sécurisé avec une interface utilisateur élégante, développé en PHP et MySQL.

![Version](https://img.shields.io/badge/version-1.0.0-blue.svg)
![PHP Version](https://img.shields.io/badge/PHP-7.4+-green.svg)
![MySQL Version](https://img.shields.io/badge/MySQL-5.7+-orange.svg)

## ✨ Fonctionnalités

- 👤 Inscription utilisateur avec validation
- 🔑 Connexion sécurisée
- 🎯 Tableau de bord personnalisé
- 👨‍💼 Gestion de profil utilisateur
- 🔒 Hachage sécurisé des mots de passe
- 📱 Interface responsive
- 🎨 Design moderne et intuitif

## 🚀 Installation

1. **Cloner le projet**
```bash
git clone https://github.com/votre-username/auth-system.git
cd auth-system
```

2. **Configuration de la base de données**

Créez une base de données MySQL et importez le schéma :
```sql
CREATE DATABASE auth_project;
USE auth_project;
```

Exécutez le script SQL fourni :
```bash
mysql -u root -p auth_project < sql/db_schema.sql
```

3. **Configuration**

Copiez le fichier de configuration et modifiez-le selon vos besoins :
```bash
cp config.example.php config.php
```

Modifiez les paramètres de connexion dans `config.php` :
```php
define('DB_HOST', 'localhost');
define('DB_NAME', 'auth_project');
define('DB_USER', 'votre_utilisateur');
define('DB_PASSWORD', 'votre_mot_de_passe');
```

## 🏗️ Structure du Projet

```
auth-system/
├── actions/    # supprimer le dossier actions
│   ├── login_action.php     # supprimer le fichier login_action.php
│   └── register_action.php # supprimer le fichier register_action.php
├── includes/
│   ├── db.php
│   ├── session.php
│   └── error_handler.php
├── views/
│   ├── dashboard.php
│   ├── login.php
│   ├── profile.php
│   └── register.php
├── css/
│   └── styles.css
├── sql/
│   └── db_schema.sql
├── config.php
└── index.php
```

## 🔧 Technologies Utilisées

- **Frontend**
  - HTML5
  - CSS3
  - JavaScript
  - Bootstrap 5
  - Remix Icons
  - Google Fonts (Poppins)

- **Backend**
  - PHP 7.4+
  - MySQL 5.7+
  - PDO

## 🔐 Sécurité

- Hachage des mots de passe avec `password_hash()`
- Protection contre les injections SQL avec PDO
- Validation des entrées utilisateur
- Sessions sécurisées
- Protection CSRF
- Échappement des données affichées

## 📱 Responsive Design

L'interface s'adapte automatiquement à différentes tailles d'écran :
- Ordinateurs de bureau
- Tablettes
- Smartphones

## 🎨 Personnalisation

Le système utilise des variables CSS pour une personnalisation facile :

```css
:root {
    --primary-color: #6366F1;
    --secondary-color: #1E293B;
    --background-color: #F8FAFC;
}
```

## 📝 Fonctionnalités à Venir

- [ ] Authentification à deux facteurs
- [ ] Réinitialisation de mot de passe
- [ ] Connexion avec réseaux sociaux
- [ ] Gestion des rôles utilisateurs
- [ ] Journal des connexions
- [ ] Mode sombre

## 🤝 Contribution

Les contributions sont les bienvenues ! Pour contribuer :

1. Forkez le projet
2. Créez une branche pour votre fonctionnalité
3. Committez vos changements
4. Poussez vers la branche
5. Ouvrez une Pull Request

## 📄 Licence

Ce projet est sous licence MIT. Voir le fichier `LICENSE` pour plus de détails.

## 👥 Auteur

- **Eurin HASH** - [GitHub](https://github.com/digitaleflex)

## 🙏 Remerciements

- Bootstrap pour le framework CSS
- Remix Icons pour les icônes
- Google Fonts pour la police Poppins

---

⭐️ Si vous trouvez ce projet utile, n'hésitez pas à lui donner une étoile sur GitHub !
