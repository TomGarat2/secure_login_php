<?php
// Démarre une nouvelle session ou reprend une session existante
session_start();

// Inclut le fichier de la barre de navigation
include '../templates/navbar.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Accueil SecureLogin</title>
</head>
<body>
    <!-- Titre principal de la page -->
    <h1>Bienvenue sur SecureLogin</h1>

    <?php
    // Vérifie si un message de statut est défini dans la session
    if (isset($_SESSION['status'])) {
        // Affiche le message de statut
        echo "<p>" . $_SESSION['status'] . "</p>";

        // Efface le message de statut de la session après l'affichage pour éviter qu'il ne soit affiché plusieurs fois
        unset($_SESSION['status']);
    }
    ?>
</body>
</html>
