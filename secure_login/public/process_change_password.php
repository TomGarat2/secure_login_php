<?php
// Activer l'affichage de toutes les erreurs pour le débogage
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Inclure les fichiers nécessaires pour la gestion de la session et la configuration de la base de données
require_once '../src/init_session.php';
require_once 'C:\wamp64/config/config.php';

// Démarrer une nouvelle session ou reprendre une session existante
session_start();

// Vérifier si l'utilisateur est connecté en vérifiant la variable de session 'user_id'
if (!isset($_SESSION['user_id'])) {
    // Si l'utilisateur n'est pas connecté, définir un message de statut et rediriger vers la page de connexion
    $_SESSION['status'] = 'Veuillez vous connecter pour accéder à cette page.';
    header('Location: login.php');
    exit;
}

// Vérifier si la requête est de type POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Récupérer les mots de passe actuels et nouveaux depuis le formulaire
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];

    // Vérifier que le nouveau mot de passe a au moins 8 caractères
    if (strlen($new_password) < 8) {
        $_SESSION['status'] = 'Le nouveau mot de passe doit comporter au moins 8 caractères.';
        header('Location: change_password.php');
        exit;
    }

    // Préparer une requête SQL pour obtenir le mot de passe actuel de l'utilisateur depuis la base de données
    $stmt = $pdo->prepare('SELECT password FROM users WHERE id = ?');
    $stmt->execute([$_SESSION['user_id']]);
    $user = $stmt->fetch();

    // Vérifier si le mot de passe actuel est correct
    if ($user && password_verify($current_password, $user['password'])) {
        // Si le mot de passe actuel est correct, hacher le nouveau mot de passe
        $options = ['cost' => 12];
        $hashedPassword = password_hash($new_password, PASSWORD_BCRYPT, $options);

        // Mettre à jour le mot de passe dans la base de données
        $stmt = $pdo->prepare('UPDATE users SET password = ? WHERE id = ?');
        $stmt->execute([$hashedPassword, $_SESSION['user_id']]);

        // Définir un message de statut indiquant que le mot de passe a été changé avec succès et rediriger vers la page de profil
        $_SESSION['status'] = 'Mot de passe changé avec succès.';
        header('Location: profile.php');
        exit;
    } else {
        // Si le mot de passe actuel est incorrect, définir un message de statut et rediriger vers la page de changement de mot de passe
        $_SESSION['status'] = 'Le mot de passe actuel est incorrect.';
        header('Location: change_password.php');
        exit;
    }
} else {
    // Si la requête n'est pas de type POST, afficher un message d'erreur
    echo "Requête non POST";
}
?>
