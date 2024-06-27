<?php
// Activer l'affichage de toutes les erreurs pour le débogage
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Inclure les fichiers nécessaires pour la gestion de la session et la configuration de la base de données
require_once '../src/init_session.php';
require_once 'C:\wamp64/config/config.php';

// Démarrer une nouvelle session ou reprendre une session existante
session_start();

// Vérifier si la requête est de type POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Récupérer l'email et le mot de passe depuis le formulaire
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $password = $_POST['password'];

    // Vérifier que l'email et le mot de passe sont valides
    if (!$email || !$password) {
        $_SESSION['status'] = 'Veuillez fournir un email et un mot de passe valides.';
        header('Location: login.php');
        exit;
    }

    // Préparer une requête SQL pour obtenir l'utilisateur correspondant à l'email fourni
    $stmt = $pdo->prepare('SELECT id, password FROM users WHERE email = ?');
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    // Vérifier si l'utilisateur existe et si le mot de passe est correct
    if ($user && password_verify($password, $user['password'])) {
        // Si les informations de connexion sont correctes, définir l'ID de l'utilisateur dans la session
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['status'] = 'Connexion réussie !';
        header('Location: profile.php');
        exit;
    } else {
        // Si les informations de connexion sont incorrectes, définir un message de statut et rediriger vers la page de connexion
        $_SESSION['status'] = 'Email ou mot de passe incorrect.';
        header('Location: login.php');
        exit;
    }
} else {
    // Si la requête n'est pas de type POST, afficher un message d'erreur
    echo "Requête non POST";
}
?>
