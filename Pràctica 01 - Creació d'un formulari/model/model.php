<?php
require_once('../PHPMailer/src/PHPMailer.php');
require_once('../PHPMailer/src/SMTP.php');
require_once('../PHPMailer/src/Exception.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class ContactModel {
    
    /**
     * Funció per netejar les dades d'entrada
     */
    public static function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    
    /**
     * Validar dades del formulari
     */
    public static function validateData($data) {
        $errors = [];
        $cleanData = [];
        
        // Validar nom
        if (empty($data["name"])) {
            $errors["nameErr"] = "El nom és obligatori";
        } else {
            $cleanData["name"] = self::test_input($data["name"]);
            if (strlen($cleanData["name"]) < 2) {
                $errors["nameErr"] = "El nom ha de tenir almenys 2 caràcters";
            }
        }
        
        // Validar email
        if (empty($data["email"])) {
            $errors["emailErr"] = "L'email és obligatori";
        } else {
            $cleanData["email"] = self::test_input($data["email"]);
            if (!filter_var($cleanData["email"], FILTER_VALIDATE_EMAIL)) {
                $errors["emailErr"] = "Format d'email invàlid";
            }
        }
        
        // Validar missatge
        if (empty($data["message"])) {
            $errors["messageErr"] = "El missatge és obligatori";
        } else {
            $cleanData["message"] = self::test_input($data["message"]);
            if (strlen($cleanData["message"]) < 10) {
                $errors["messageErr"] = "El missatge ha de tenir almenys 10 caràcters";
            }
        }
        
        return [
            'errors' => $errors,
            'data' => $cleanData,
            'hasErrors' => !empty($errors)
        ];
    }
    
    /**
     * Enviar email amb PHPMailer i fallback a mail()
     */
    public static function sendEmail($name, $email, $message) {
        try {
            // Intentar enviar amb PHPMailer primer
            $mail = new PHPMailer(true);
            
            // Configuració del servidor SMTP
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'a.aumedes@sapalomera.cat';
            $mail->Password = 'hcvgrnpkywafqtke';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;
            $mail->CharSet = 'UTF-8';
            
            // Configuració de l'email
            $mail->setFrom($email, $name);
            $mail->addAddress('a.aumedes@sapalomera.cat', 'Destinatari');
            $mail->addReplyTo($email, $name);
            
            // Contingut de l'email
            $mail->isHTML(false);
            $mail->Subject = 'Nou missatge de contacte de ' . $name;
            $mail->Body = "Has rebut un nou missatge de contacte:\n\n";
            $mail->Body .= "Nom: " . $name . "\n";
            $mail->Body .= "Email: " . $email . "\n\n";
            $mail->Body .= "Missatge:\n" . $message . "\n";
            
            // Opcions SMTP
            $mail->SMTPDebug = 0;
            $mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );
            $mail->Timeout = 30;
            
            $mail->send();
            return ['success' => true, 'method' => 'PHPMailer'];
            
        } catch (Exception $e) {
            // Fallback: usar mail() de php.ini
            $to = "a.aumedes@sapalomera.cat";
            $subject = "Nou missatge de contacte de " . $name;
            $body = "Has rebut un nou missatge de contacte:\n\n";
            $body .= "Nom: " . $name . "\n";
            $body .= "Email: " . $email . "\n\n";
            $body .= "Missatge:\n" . $message . "\n";
            
            $headers = "From: " . $email . "\r\n";
            $headers .= "Reply-To: " . $email . "\r\n";
            $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
            
            if (mail($to, $subject, $body, $headers)) {
                return ['success' => true, 'method' => 'mail()'];
            } else {
                return ['success' => false, 'error' => 'Ambdós mètodes han fallat'];
            }
        }
    }
}
?>