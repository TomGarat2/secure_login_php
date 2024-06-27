<?php
// Configurer les paramètres de session avant de démarrer la session
$cookieParams = session_get_cookie_params();
$cookieLifetime = $cookieParams["lifetime"];
$cookiePath = $cookieParams["path"];
$cookieDomain = $cookieParams["domain"];
$secure = false; 
$httponly = true; // Interdire l'accès au cookie via JavaScript

if (session_status() === PHP_SESSION_NONE) {
    session_set_cookie_params($cookieLifetime, $cookiePath, $cookieDomain, $secure, $httponly);
    session_start();
    session_regenerate_id(true); // Sécurité supplémentaire: régénérer l'ID de session
}

function generate_csrf_token() {
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

function verify_csrf_token($token) {
    return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
}
?>
