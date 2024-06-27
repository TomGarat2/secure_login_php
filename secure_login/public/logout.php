<?php
// Inclut le fichier qui initialise la session et configure les paramètres de session
require_once '../src/init_session.php';

// Démarre une nouvelle session ou reprend une session existante
session_start();

// Détruit toutes les données de session pour déconnecter l'utilisateur
session_destroy();

// Définit un message de statut indiquant que l'utilisateur a été déconnecté
$_SESSION['status'] = 'Vous avez été déconnecté.';

// Redirige l'utilisateur vers la page de connexion
header('Location: login.php');
exit;
?>
