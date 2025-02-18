-- 1. Création de la base de données (si elle n'existe pas)
CREATE DATABASE IF NOT EXISTS blog;
USE blog;

-- 2. Création de la table `articles`
CREATE TABLE IF NOT EXISTS articles (
    id INT AUTO_INCREMENT PRIMARY KEY,          -- Identifiant unique de l'article
    titre VARCHAR(255) NOT NULL,                -- Titre de l'article
    contenu TEXT NOT NULL,                     -- Contenu de l'article
    date_creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP,  -- Date de création de l'article
    INDEX(titre)                              -- Index sur le titre pour améliorer la recherche
);

-- 3. Création de la table `commentaires`
CREATE TABLE IF NOT EXISTS commentaires (
    id INT AUTO_INCREMENT PRIMARY KEY,          -- Identifiant unique du commentaire
    article_id INT NOT NULL,                    -- Référence à l'article
    auteur VARCHAR(255) NOT NULL,               -- Nom de l'auteur du commentaire
    commentaire TEXT NOT NULL,                 -- Contenu du commentaire
    date_creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP,  -- Date de création du commentaire
    FOREIGN KEY (article_id) REFERENCES articles(id) ON DELETE CASCADE,  -- Clé étrangère liée à l'article
    INDEX(article_id)                          -- Index sur l'article_id pour accélérer les recherches par article
);

-- 4. Insertion d'exemples de données dans la table `articles`
INSERT INTO articles (titre, contenu) VALUES
('Introduction à la cybersécurité', 'La cybersécurité est un domaine de plus en plus crucial dans le monde moderne. Cette discipline englobe les pratiques, processus et technologies utilisés pour protéger les systèmes informatiques contre les cybermenaces.'),
('L\'importance du cloud computing', 'Le cloud computing permet aux entreprises de stocker et d\'accéder à des données via Internet. Cette technologie offre une flexibilité, une scalabilité et une rentabilité accrues.'),
('Les bases du développement web', 'Le développement web est un secteur dynamique et en constante évolution. Ce domaine englobe la création de sites et d\'applications web à l\'aide de diverses technologies.'),

-- Ajout de 10 nouveaux articles
('L\'Intelligence Artificielle en 2024', 'L\'IA continue de révolutionner notre quotidien. Des assistants virtuels aux voitures autonomes, découvrez les dernières avancées et leurs impacts sur notre société. L\'apprentissage automatique et le deep learning ouvrent de nouvelles perspectives fascinantes.'),

('Les tendances du Design Web', 'Le design web moderne privilégie l\'expérience utilisateur et la simplicité. Le minimalisme, les dark modes, et les animations subtiles dominent les tendances actuelles. Découvrez comment créer des interfaces élégantes et fonctionnelles.'),

('Sécurité des applications mobiles', 'La sécurité des applications mobiles est devenue cruciale avec l\'augmentation des transactions mobiles. Apprenez les meilleures pratiques pour protéger les données des utilisateurs et prévenir les failles de sécurité courantes.'),

('Le DevOps expliqué simplement', 'Le DevOps révolutionne la façon dont les équipes développent et déploient les applications. Cette approche combine développement et opérations pour des livraisons plus rapides et plus fiables. Découvrez les principes clés et les outils essentiels.'),

('Développement durable et technologie', 'Comment la technologie peut-elle contribuer à un avenir plus durable ? Des centres de données verts aux applications éco-responsables, explorez les initiatives qui façonnent une industrie tech plus respectueuse de l\'environnement.'),

('Les frameworks JavaScript modernes', 'React, Vue, Angular : comment choisir le bon framework pour votre projet ? Comparaison détaillée des performances, de la facilité d\'utilisation et des cas d\'usage de chaque framework JavaScript populaire.'),

('Blockchain et Web 3.0', 'Le Web 3.0 et la blockchain transforment l\'internet tel que nous le connaissons. Des cryptomonnaies aux NFTs, découvrez les technologies qui construisent l\'internet décentralisé de demain.'),

('UX Writing : l\'art des mots dans le design', 'L\'UX Writing est essentiel pour créer des interfaces utilisateur intuitives. Apprenez à rédiger des textes clairs, concis et engageants qui guident naturellement les utilisateurs dans leur expérience.'),

('Les bases de données NoSQL', 'Les bases de données NoSQL offrent une alternative flexible aux bases relationnelles traditionnelles. MongoDB, Redis, Cassandra : découvrez quand et pourquoi utiliser ces solutions modernes.'),

('L\'accessibilité web : un impératif', 'Créer des sites web accessibles n\'est pas une option, c\'est une nécessité. Découvrez les normes WCAG, les outils et les bonnes pratiques pour rendre le web accessible à tous.');

-- 5. Insertion d'exemples de données dans la table `commentaires`
INSERT INTO commentaires (article_id, auteur, commentaire) VALUES
(1, 'Alice Dupont', 'Cet article est très informatif. Merci pour ces conseils en cybersécurité !'),
(1, 'Bob Martin', 'La cybersécurité est un sujet complexe, mais cet article le rend accessible.'),
(2, 'Charlie Rousseau', 'L\'article sur le cloud est excellent. Je pense que le cloud computing est l\'avenir des entreprises.'),
(3, 'David Tremblay', 'J\'adore le développement web. Un sujet passionnant et toujours en évolution.'),
(4, 'Emma Laurent', 'L\'IA est fascinante ! J\'aimerais en apprendre plus sur le machine learning.'),
(5, 'François Dubois', 'Super article sur les tendances du design. Les dark modes sont vraiment à la mode !'),
(6, 'Julie Martin', 'La sécurité mobile est cruciale de nos jours. Article très pertinent.'),
(7, 'Thomas Bernard', 'Enfin un article qui explique clairement le DevOps !'),
(8, 'Sophie Leroux', 'Important de parler de l\'impact environnemental de la tech.'),
(10, 'Pierre Dupuis', 'La blockchain va révolutionner beaucoup de secteurs.');

-- 6. Affichage des données d'exemple
SELECT * FROM articles;
SELECT * FROM commentaires;
