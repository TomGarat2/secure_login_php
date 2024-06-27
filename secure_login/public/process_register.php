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
    // Vérifier le token CSRF pour protéger contre les attaques CSRF
    if (!isset($_POST['csrf_token']) || !verify_csrf_token($_POST['csrf_token'])) {
        $_SESSION['status'] = 'Échec de la vérification CSRF.';
        header('Location: register.php');
        exit;
    }

    // Récupérer l'email et le mot de passe depuis le formulaire
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $password = $_POST['password'];

    // Vérifier que l'email est valide et que le mot de passe a au moins 8 caractères
    if (!$email || strlen($password) < 8) {
        $_SESSION['status'] = 'Email non valide ou mot de passe trop court.';
        header('Location: register.php');
        exit;
    }

    // Options pour le hachage du mot de passe
    $options = ['cost' => 12];
    // Hacher le mot de passe avec l'algorithme BCRYPT
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT, $options);

    // insérer le nouvel utilisateur dans la base de données
    try {
        $stmt = $pdo->prepare('INSERT INTO users (email, password) VALUES (?, ?)');
        $stmt->execute([$email, $hashedPassword]);
        $_SESSION['status'] = "Inscription réussie. Vous pouvez maintenant vous connecter.";
        header('Location: login.php');
        exit;
    } catch (PDOException $e) {
        // En cas d'erreur lors de l'insertion, définir un message de statut avec l'erreur et rediriger vers la page d'inscription
        $_SESSION['status'] = "Erreur lors de l'inscription: " . $e->getMessage();
        header('Location: register.php');
        exit;
    }
} else {
    // Si la requête n'est pas de type POST, afficher un message d'erreur
    echo "Requête non POST";
}
?>
