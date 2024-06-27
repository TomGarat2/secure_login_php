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

// Récupérer le message de statut de la session , puis le supprimer de la session
$status = isset($_SESSION['status']) ? $_SESSION['status'] : '';
unset($_SESSION['status']);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Changer le mot de passe</title>
</head>
<body>
    <!-- Inclure la barre de navigation -->
    <?php include '../templates/navbar.php'; ?>

    <!-- Afficher le message de statut-->
    <?php if ($status): ?>
        <p><?= htmlspecialchars($status) ?></p>
    <?php endif; ?>

    <h2>Changer le mot de passe</h2>
    <!-- Formulaire pour changer le mot de passe -->
    <form action="process_change_password.php" method="POST">
        <label for="current_password">Mot de passe actuel:</label>
        <input type="password" id="current_password" name="current_password" required><br><br>

        <label for="new_password">Nouveau mot de passe:</label>
        <input type="password" id="new_password" name="new_password" required><br><br>

        <button type="submit">Changer le mot de passe</button>
    </form>
</body>
</html>
