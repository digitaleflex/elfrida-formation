-- Création de la base de données
CREATE DATABASE IF NOT EXISTS blog;
USE blog;

-- Création de la table articles
CREATE TABLE IF NOT EXISTS articles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titre VARCHAR(255) NOT NULL,
    contenu TEXT NOT NULL,
    date_creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Création de la table commentaires
CREATE TABLE IF NOT EXISTS commentaires (
    id INT AUTO_INCREMENT PRIMARY KEY,
    article_id INT NOT NULL,
    auteur VARCHAR(50) NOT NULL,
    commentaire TEXT NOT NULL,
    date_creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (article_id) REFERENCES articles(id) ON DELETE CASCADE
);

-- Insertion des articles
INSERT INTO articles (titre, contenu, date_creation) VALUES
('Les tendances du développement web en 2024', 
'Le développement web continue d\'évoluer rapidement. Cette année, nous observons l\'émergence de nouvelles technologies et pratiques qui transforment la façon dont nous créons des sites web. Parmi les tendances majeures, on trouve :

1. L\'adoption croissante des architectures Jamstack
2. L\'utilisation généralisée de l\'IA dans le développement
3. La montée en puissance des Progressive Web Apps
4. L\'importance grandissante de la performance web
5. Les nouvelles approches du CSS avec Container Queries

Ces évolutions reflètent une industrie en constante mutation, où l\'innovation et l\'expérience utilisateur sont au cœur des préoccupations.',
'2024-01-15 10:00:00'),

('Intelligence Artificielle : Impact sur le développement logiciel',
'L\'IA révolutionne la façon dont nous développons des logiciels. Des assistants de code aux tests automatisés, l\'impact est considérable :

- Génération automatique de code
- Détection précoce des bugs
- Optimisation des performances
- Personnalisation des expériences utilisateur
- Automatisation des tâches répétitives

Ces avancées permettent aux développeurs de se concentrer sur des tâches plus créatives et stratégiques.',
'2024-01-14 14:30:00'),

('Guide complet de la cybersécurité pour les développeurs',
'La sécurité est devenue une préoccupation majeure dans le développement web. Voici les points essentiels à connaître :

1. Sécurisation des API
2. Protection contre les injections SQL
3. Gestion sécurisée des authentifications
4. Encryption des données sensibles
5. Bonnes pratiques OWASP

Il est crucial de maintenir ses connaissances à jour dans ce domaine en constante évolution.',
'2024-01-13 09:15:00'),

('Les frameworks JavaScript à surveiller en 2024',
'Le paysage des frameworks JavaScript continue d\'évoluer. Découvrez les plus prometteurs :

1. Next.js 14 et ses nouvelles fonctionnalités
2. Remix et son approche innovante
3. Svelte et son compilateur révolutionnaire
4. Qwik et sa performance exceptionnelle
5. Solid.js et sa réactivité fine

Chaque framework apporte ses innovations et répond à des besoins spécifiques.',
'2024-01-12 16:45:00'),

('DevOps : Meilleures pratiques et outils',
'Le DevOps est devenu incontournable. Voici les pratiques essentielles :

- Intégration continue avec GitHub Actions
- Déploiement continu avec Jenkins
- Containerisation avec Docker
- Orchestration avec Kubernetes
- Monitoring avec Prometheus

Ces outils et pratiques permettent d\'optimiser le cycle de développement.',
'2024-01-11 11:20:00'),

('L\'art du Clean Code',
'Écrire du code propre est un art qui s\'apprend. Principes fondamentaux :

1. DRY (Don\'t Repeat Yourself)
2. SOLID principles
3. Clean Architecture
4. Code Documentation
5. Tests unitaires

Un code propre est plus facile à maintenir et à faire évoluer.',
'2024-01-10 13:40:00'),

('Performance Web : Optimisation et bonnes pratiques',
'La performance est cruciale pour l\'expérience utilisateur. Points clés :

- Optimisation des images
- Minification des ressources
- Lazy loading
- Caching intelligent
- Core Web Vitals

Ces optimisations améliorent significativement l\'expérience utilisateur.',
'2024-01-09 15:30:00'),

('Accessibilité Web : Guide complet',
'L\'accessibilité web est un droit fondamental. Aspects essentiels :

1. Structure HTML sémantique
2. Contraste et lisibilité
3. Navigation au clavier
4. Compatibilité lecteur d\'écran
5. ARIA landmarks

Rendre le web accessible à tous est une responsabilité collective.',
'2024-01-08 10:25:00'),

('Mobile First : Stratégies de développement',
'Le mobile first est devenu la norme. Stratégies clés :

- Design responsive
- Performance mobile
- Touch-friendly interfaces
- Progressive enhancement
- Mobile-specific features

Une approche mobile first garantit une expérience optimale sur tous les appareils.',
'2024-01-07 14:15:00'),

('API REST vs GraphQL',
'Comparaison détaillée des deux approches :

REST :
- Simple à comprendre
- Caching efficace
- Standards établis

GraphQL :
- Requêtes flexibles
- Pas de sur-fetching
- Type system intégré

Chaque approche a ses avantages selon le contexte.',
'2024-01-06 09:50:00'),

('Tests automatisés : Guide pratique',
'Les tests sont essentiels pour la qualité du code :

1. Tests unitaires avec Jest
2. Tests d\'intégration
3. Tests end-to-end avec Cypress
4. TDD et BDD
5. Couverture de code

Une bonne stratégie de test garantit la fiabilité du code.',
'2024-01-05 16:20:00'),

('Architecture Microservices',
'Les microservices transforment le développement :

- Scalabilité indépendante
- Déploiement flexible
- Isolation des pannes
- Choix technologiques adaptés
- Communication inter-services

Cette architecture offre flexibilité et robustesse.',
'2024-01-04 11:45:00'),

('CSS moderne avec Tailwind',
'Tailwind révolutionne le CSS :

1. Utility-first approach
2. Configuration flexible
3. Performance optimisée
4. Responsive design
5. Dark mode support

Un outil qui change la façon d\'écrire du CSS.',
'2024-01-03 13:30:00'),

('Base de données NoSQL vs SQL',
'Choisir la bonne base de données :

SQL :
- ACID compliance
- Relations structurées
- Requêtes complexes

NoSQL :
- Scalabilité horizontale
- Schéma flexible
- Performance élevée

Le choix dépend des besoins spécifiques du projet.',
'2024-01-02 15:10:00'),

('Sécurité des API Web',
'Protéger ses API est crucial :

1. Authentication JWT
2. Rate limiting
3. Validation des entrées
4. CORS configuration
5. API Gateway

La sécurité doit être une priorité dès la conception.',
'2024-01-01 10:00:00');

-- Insertion de quelques commentaires d'exemple
INSERT INTO commentaires (article_id, auteur, commentaire) VALUES
(1, 'Sophie Martin', 'Article très instructif sur les nouvelles tendances !'),
(1, 'Thomas Dubois', 'J\'utilise déjà Jamstack, c\'est vraiment efficace.'),
(2, 'Julie Bernard', 'L\'IA va vraiment révolutionner notre façon de coder.'),
(3, 'Pierre Durand', 'La sécurité est souvent négligée, merci pour ces rappels.'),
(4, 'Marie Lambert', 'J\'ai hâte d\'essayer Qwik, ça a l\'air prometteur.'); 