# SecureLogin Project

## Description

SecureLogin est un projet PHP sécurisée permettant aux utilisateurs de s'inscrire, de se connecter, de changer leur mot de passe et de gérer leur profil. Le projet intègre des mesures de sécurité telles que la protection CSRF, le hachage des mots de passe et un mécanisme anti-brute force pour limiter les tentatives de connexion échouées.

## Table des matières

- [Installation](#installation)
- [Configuration](#configuration)
- [Fonctionnalités](#fonctionnalités)
- [Sécurité](#sécurité)
- [Tâches CRON](#tâches-cron)

## Installation

1. **Clonez le dépôt sur votre machine locale.**
    ```sh
    git clone https://github.com/TomGarat2/secure_login_php.git
    ```

2. **Accédez au répertoire du projet.**
    ```sh
    cd secure_login
    ```

3. **Installez les dépendances avec Composer.**
    ```sh
    composer install
    ```

4. **Configurez votre serveur web (WAMP) pour pointer vers le répertoire `public` du projet.**
    - Ouvrez le gestionnaire WAMP.
    - Ajoutez un nouveau projet en pointant vers le répertoire `public`.

5. **Configurez votre base de données en créant les tables nécessaires.**
    - Ouvrez phpMyAdmin et créez une nouvelle base de données nommée `secure_login`.
    - Utilisez le fichier SQL fourni pour créer les tables nécessaires.

## Configuration

Les paramètres de session et de base de données sont configurés dans les fichiers `src/config.php` et `src/init_session.php`. (Pour des mesures de sécurité évidente il faut déplacer le fichier config.php en dehors du répertoire www de wamp et donc modifier les routes en conséquence. j'ai donc placer le fichier config.php dans le dossier config qui lui devra être déplacé.)

### Configuration de la base de données

- **Hôte** : localhost
- **Nom de la base de données** : secure_login
- **Utilisateur** : root
- **Mot de passe** : 

### Configuration des sessions

- **Cookies sécurisés** : false 
- **HTTPOnly** : true (interdit l'accès au cookie via JavaScript)
- **Régénération d'ID de session** : true (sécurité supplémentaire)

## Fonctionnalités

1. **Inscription (SignUp)**
   - Formulaire d'inscription avec vérification CSRF.
   - Stockage sécurisé des mots de passe avec `password_hash`.

2. **Connexion (SignIn)**
   - Formulaire de connexion avec vérification des identifiants.
   - Gestion des sessions pour les utilisateurs connectés.

3. **Changement de mot de passe (ChangePwd)**
   - Formulaire de changement de mot de passe.
   - Vérification du mot de passe actuel et mise à jour du mot de passe.

4. **Profil (SignedIn)**
   - Page de profil accessible uniquement aux utilisateurs connectés.

5. **Déconnexion**
   - Fonctionnalité de déconnexion qui détruit la session.

6. **Barre de navigation**
   - Navigation fluide entre les pages avec une barre de navigation cohérente.

7. **Anti-Brute Force**
   - Limitation des tentatives de connexion échouées.
   - Enregistrement des tentatives échouées et blocage après un certain nombre de tentatives.

## Sécurité

- **Protection CSRF** : Utilisation de tokens CSRF pour protéger les formulaires contre les attaques CSRF.
- **Hachage des mots de passe** : Utilisation de `password_hash` et `password_verify` pour sécuriser les mots de passe.
- **Gestion des sessions** : Configuration des cookies de session sécurisés et régénération de l'ID de session pour chaque nouvelle session.

## Tâches CRON

Pour nettoyer régulièrement les tentatives de connexion échouées, planifiez une tâche CRON pour exécuter le script de nettoyage.

1. **Ouvrez le crontab** en utilisant la commande suivante :
    ```sh
    crontab -e
    ```

2. **Ajoutez la ligne suivante pour exécuter le script chaque jour à minuit** :
    ```sh
    0 0 * * * /usr/bin/php /path/to/clean_login_attempts.php
    ```

Remplacez `/path/to/clean_login_attempts.php` par le chemin absolu vers votre script.

Garabedian Tom.
