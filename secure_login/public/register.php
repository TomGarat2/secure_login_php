<?php
// Inclure le fichier qui initialise la session et configure les paramètres de session
require_once '../src/init_session.php';

// Générer un token CSRF pour protéger contre les attaques CSRF
$csrf_token = generate_csrf_token();

// Vérifier s'il y a un message de statut dans la session et le stocker dans une variable
$status = isset($_SESSION['status']) ? $_SESSION['status'] : '';
// Supprimer le message de statut de la session pour éviter qu'il ne soit affiché plusieurs fois
unset($_SESSION['status']);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription</title>
</head>
<body>
    <!-- Inclure la barre de navigation -->
    <?php include '../templates/navbar.php'; ?>

    <!-- Afficher le message de statut s'il existe -->
    <?php if ($status): ?>
        <p><?= htmlspecialchars($status) ?></p>
    <?php endif; ?>

    <h2>Inscription</h2>
    <!-- Formulaire d'inscription -->
    <form action="process_register.php" method="POST">
        <!-- Champ caché pour le token CSRF -->
        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrf_token) ?>">
        
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>
        
        <label for="password">Mot de passe:</label>
        <input type="password" id="password" name="password" required><br><br>
        
        <button type="submit">S'inscrire</button>
    </form>
</body>
</html>
