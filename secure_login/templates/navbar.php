<nav>
    <ul>
        <?php if (isset($_SESSION['user_id'])): ?>
            <li><a href="profile.php">Profil</a></li>
            <li><a href="change_password.php">Changer le mot de passe</a></li>
            <li><a href="logout.php">Déconnexion</a></li>
        <?php else: ?>
            <li><a href="register.php">Inscription</a></li>
            <li><a href="login.php">Connexion</a></li>
        <?php endif; ?>
    </ul>
</nav>
