<?php
require_once __DIR__ . '/../entities/User.php';

class UserDAO extends User
{   
    private $db;
    public function __construct($db)
    {
        $this->db = $db;
    }

    /**
     * Processa el formulari de login
     * 
     * Valida les credencials i inicia la sessió si són correctes.
     * Utilitza prepared statements per prevenir SQL Injection.
     * 
     * @return void
     */
    public function processLogin()
    {
        // Procesamiento del formulario de login
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['btnSubmit'])) {
            // Validar campos
            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';

            if ($email === '' || $password === '') {
                echo '<div class="alert alert-danger">ELS CAMPS NO PODEN ESTAR BUITS</div>';
                return;
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                echo '<div class="alert alert-danger">Email invàlid</div>';
                return;
            }

            // $db debe venir de ../model/database/database.php (PDO). Ajusta si usas otra variable.
            if (!isset($db) || !($db instanceof PDO)) {
                echo '<div class="alert alert-danger">Error de configuració: connexió a la BD no trobada.</div>';
                return;
            }

            try {
                $stmt = $db->prepare('SELECT id, username, email, password_hash, active FROM users WHERE email = :email LIMIT 1');
                $stmt->execute([':email' => $email]);
                $user = $stmt->fetch(PDO::FETCH_ASSOC);

                if (!$user) {
                    echo '<div class="alert alert-danger">Credencials incorrectes.</div>';
                    return;
                }

                // Verificar contrasenya (assumeix password_hash() a l'registre)
                if (!password_verify($password, $user['password_hash'])) {
                    echo '<div class="alert alert-danger">Credencials incorrectes.</div>';
                    return;
                }

                // Comprovar si el compte està actiu (opcional)
                if (isset($user['active']) && !$user['active']) {
                    echo '<div class="alert alert-danger">El compte no està actiu.</div>';
                    return;
                }

                // Login correcte: guardar dades en sessió
                $_SESSION['user'] = [
                    'id' => $user['id'],
                    'username' => $user['username'],
                    'email' => $user['email']
                ];

                // Redirigir al menú / pàgina principal
                header('Location: /practicas/Pràctica 03 - Paginació/public/index.php?action=menu');
                exit;
            } catch (Exception $e) {
                // No exposar l'error real en producció
                echo '<div class="alert alert-danger">Error del servidor. Torna a intentar-ho més tard.</div>';
                error_log('Login error: ' . $e->getMessage());
                return;
            }
        }
    }
}
?>