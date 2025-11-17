<?php
// public/logout.php - termina la sessió i redirigeix a l'index públic
session_start();
// Eliminar dades de sessió
$_SESSION = [];
if (ini_get('session.use_cookies')) {
    setcookie(session_name(), '', time() - 42000, '/');
}
session_destroy();
header('Location: /practicas/Pràctica 03 - Paginació/public/index.php');
exit;

?>
