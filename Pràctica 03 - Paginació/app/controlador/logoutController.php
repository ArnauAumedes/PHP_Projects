<?php
// Controlador per al logout: destruye la sessió i redirigeix a l'index públic
// Aquest fitxer s'ha d'invocar des de `public/index.php?action=logout`

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Netejar dades de sessió
$_SESSION = [];

// Eliminar cookie de sessió si s'usa cookies
if (ini_get('session.use_cookies')) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params['path'], $params['domain'], $params['secure'], $params['httponly']
    );
}

// Destruir la sessió
session_destroy();

// Redirigir a la pàgina pública principal
header('Location: /practicas/Pràctica 03 - Paginació/public/index.php');
exit;

?>
