# ClubPhoto

Application PHP simple pour la gestion d'un club photo : inscription/connexion des membres, publication d'articles et de photos, pages de présentation des photographes.

Description
-----------
Ce projet contient une petite application web en PHP (sans framework) destinée à gérer les contenus d'un club photo : articles, photos, profils de photographes et authentification.

Prérequis
---------
- Environnement WAMP (Apache + PHP + MySQL/MariaDB) ou équivalent.
- PHP 7.x ou 8.x (selon votre environnement local).
- Une base de données MySQL/MariaDB si l'application nécessite une persistance (vérifier la présence d'un script SQL dans votre workspace si nécessaire).

Installation rapide
-------------------
1. Copier le dossier `ClubPhoto` dans le répertoire web de votre WAMP (ex : `c:\wamp64\www\clubphoto\ClubPhoto`).
2. Vérifier/ajuster la configuration de connexion à la base de données si des fichiers `config/` contiennent des paramètres (modifier selon votre setup).
3. Si un script SQL d'initialisation existe, l'importer via phpMyAdmin ou `mysql`.
4. Ouvrir le navigateur : `http://localhost/ClubPhoto` (ou `http://localhost/clubphoto/ClubPhoto/` selon votre configuration).

Structure du projet
-------------------
- `index.php` / `accueil.php` : pages d'accueil et point d'entrée du site.
- `connexion.php`, `inscription.php`, `login.php`, `logout.php` : gestion de l'authentification.
- `article.php`, `photo.php`, `photographe.php` : pages de contenu (articles, galerie, profils).
- `bloc_entete.php`, `bloc_menu.php`, `bloc_pied.php` : fragments de layout (en-tête, menu, pied de page).
- `config/` : fichiers de configuration (vérifier les paramètres DB ou chemins ici).
- `image/` : images et ressources utilisées par l'application.
- `global.css` : styles globaux (dans `config/` ou selon l'emplacement réel).

Points d'attention
------------------
- Si l'application gère des uploads de photos, vérifiez que le dossier d'uploads ait les droits en écriture pour l'utilisateur du serveur web.
- Ne commitez pas les identifiants de base de données : préférez un fichier local ignoré par Git ou des variables d'environnement.
- Testez les pages d'authentification localement avant d'ajouter des utilisateurs en production.

Usage
-----
- Visiter la page d'accueil (`index.php` ou `accueil.php`) pour voir la liste des articles/photos.
- S'inscrire via `inscription.php` puis se connecter via `connexion.php` / `login.php`.
- Consulter les photos et articles, et afficher les profils des photographes via `photographe.php`.

Contribuer
---------
- Pour améliorer le projet, créez une branche par fonctionnalité et ouvrez une Pull Request.
- Ajouter un script d'initialisation SQL (`database/schema.sql`) et des instructions plus détaillées d'installation est recommandé.

Contact
-------
Si vous avez des questions, ouvrez un issue dans le dépôt ou contactez l'auteur du projet.

---
README mis à jour automatiquement par l'assistant.
