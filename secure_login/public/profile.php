<?php
// Inclure les fichiers nécessaires pour la gestion de la session et la configuration de la base de données
require_once '../src/init_session.php';
require_once 'C:\wamp64/config/config.php';

// Vérifier si l'utilisateur est connecté en vérifiant la variable de session 'user_id'
if (!isset($_SESSION['user_id'])) {
    // Si l'utilisateur n'est pas connecté, définir un message de statut et rediriger vers la page de connexion
    $_SESSION['status'] = 'Veuillez vous connecter pour accéder à cette page.';
    header('Location: login.php');
    exit;
}

// Préparer une requête SQL pour obtenir l'email de l'utilisateur connecté depuis la base de données
$stmt = $pdo->prepare('SELECT email FROM users WHERE id = ?');
$stmt->execute([$_SESSION['user_id']]);
$user = $stmt->fetch();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Profil</title>
</head>
<body>
    <!-- Inclure la barre de navigation -->
    <?php include '../templates/navbar.php'; ?>

    <!-- Afficher les informations de profil de l'utilisateur -->
    <h1>Profil</h1>
    <p>Email : <?= htmlspecialchars($user['email']) ?></p>
</body>
</html>
