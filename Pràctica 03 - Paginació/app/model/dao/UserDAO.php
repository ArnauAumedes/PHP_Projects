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

            // La connexió PDO s'ha de passar al constructor i estar en $this->db
            if (!isset($this->db) || !($this->db instanceof PDO)) {
                echo '<div class="alert alert-danger">Error de configuració: connexió a la BD no trobada.</div>';
                return;
            }

            try {
                $stmt = $this->db->prepare('SELECT user_id, username, email, password_hash, active FROM users WHERE email = :email LIMIT 1');
                $stmt->execute([':email' => $email]);
                $user = $stmt->fetch(PDO::FETCH_ASSOC);

                if (!$user) {
                    echo '<div class="alert alert-danger">Credencials incorrectes.</div>';
                    return;
                }

                // Determinar quina columna guarda la contrasenya (password_hash o password)
                $hashColumn = null;
                if (isset($user['password_hash'])) {
                    $hashColumn = 'password_hash';
                } elseif (isset($user['password'])) {
                    $hashColumn = 'password';
                }

                if ($hashColumn === null) {
                    // Mostrar keys per ajudar a depurar (temporal)
                    $cols = implode(', ', array_keys($user));
                    echo '<div class="alert alert-danger">Error al verificar la contrasenya: la fila d\'usuari no conté cap columna de contrasenya coneguda. Columnes: ' . htmlspecialchars($cols) . '</div>';
                    return;
                }

                // Verificar contrasenya
                if (!password_verify($password, $user[$hashColumn])) {
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
                    'user_id' => $user['user_id'],
                    'username' => $user['username'],
                    'email' => $user['email']
                ];

                // Preparar missatge flash de benvinguda (es mostrarà una sola vegada al header)
                $_SESSION['flash_welcome'] = $user['username'] ?? ($user['email'] ?? 'Usuari');

                // Redirigir al menú / pàgina principal
                header('Location: /practicas/Pràctica 03 - Paginació/public/index.php?action=menu');
                exit;
            } catch (Exception $e) {
                // Mostrar missatge genèric per a l'usuari i el missatge d'error real per a debug
                echo '<div class="alert alert-danger">Error del servidor. Torna a intentar-ho més tard.</div>';
                // Debug (temporal): mostrar excepció per ajudar a localitzar el problema
                echo '<div class="alert alert-warning"><small>Debug: ' . htmlspecialchars($e->getMessage()) . '</small></div>';
                error_log('Login error: ' . $e->getMessage());
                return;
            }
        }
    }
}
?>