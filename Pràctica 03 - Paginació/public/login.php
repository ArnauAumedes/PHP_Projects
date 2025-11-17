<?php
// public/login.php - procesa el login y muestra la vista de login
session_start();

$error = '';

// Intentar obtener PDO desde app/model/database/database.php si proporciona db_connect()
$pdo = null;
if (file_exists(__DIR__ . '/../app/model/database/database.php')) {
    require_once __DIR__ . '/../app/model/database/database.php';
    if (function_exists('db_connect')) {
        try {
            $pdo = db_connect();
        } catch (Exception $e) {
            $pdo = null;
        }
    }
}

// Fallback: intentar conexión por defecto (ajusta credentials si tu BD tiene otro nom/usuari)
if (!$pdo) {
    try {
        $pdo = new PDO('mysql:host=127.0.0.1;dbname=practicas;charset=utf8mb4', 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (Exception $e) {
        // No es posible conectar
        $error = 'No se pudo conectar a la base de datos. Contacta al administrador.';
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && empty($error)) {
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($email === '' || $password === '') {
        $error = 'Rellena todos los campos.';
    } else {
        try {
            // Preparar y buscar usuario
            $stmt = $pdo->prepare('SELECT id, username, email, password_hash, active, dni FROM users WHERE email = :email LIMIT 1');
            $stmt->execute([':email' => $email]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user && isset($user['password_hash']) && password_verify($password, $user['password_hash'])) {
                if ((int)($user['active'] ?? 1) !== 1) {
                    $error = 'Cuenta desactivada.';
                } else {
                    // Login OK
                    session_regenerate_id(true);
                    $_SESSION['user_id'] = (int)$user['id'];
                    $_SESSION['username'] = $user['username'] ?? $user['email'];
                    $_SESSION['email'] = $user['email'];
                    if (isset($user['dni'])) $_SESSION['dni'] = $user['dni'];
                    header('Location: /practicas/Pràctica 03 - Paginació/public/index.php');
                    exit;
                }
            } else {
                $error = 'Credenciales incorrectas.';
            }
        } catch (Exception $e) {
            $error = 'Error al procesar la solicitud.';
        }
    }
}

// Incluir vista (usa $error si está presente)
include __DIR__ . '/../app/vista/login.php';

?>
