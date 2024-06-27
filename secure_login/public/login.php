<?php
// Inclut le fichier qui initialise la session et configure les paramètres de session
require_once '../src/init_session.php';

// Vérifie si un message de statut est défini dans la session et le stocke dans une variable
$status = isset($_SESSION['status']) ? $_SESSION['status'] : '';
// Supprime le message de statut de la session pour éviter qu'il ne soit affiché plusieurs fois
unset($_SESSION['status']);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
</head>
<body>
    <!-- Inclut la barre de navigation -->
    <?php include '../templates/navbar.php'; ?>

    <!-- Affiche le message de statut s'il existe -->
    <?php if ($status): ?>
        <p><?= htmlspecialchars($status) ?></p>
    <?php endif; ?>

    <h2>Connexion</h2>
    <!-- Formulaire de connexion -->
    <form action="process_login.php" method="POST">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>
        
        <label for="password">Mot de passe:</label>
        <input type="password" id="password" name="password" required><br><br>
        
        <button type="submit">Connexion</button>
    </form>
</body>
</html>
