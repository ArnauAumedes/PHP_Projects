<?php
require_once('../model/model.php');

// Definir variables i establir-les com a buides
$nameErr = $emailErr = $messageErr = "";
$name = $email = $message = "";
$formSubmitted = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $formSubmitted = true;
    
    // Validar dades (delegat al Model)
    $result = ContactModel::validateData($_POST);
    
    if (!$result['hasErrors']) {
        // Enviar email (delegat al Model)
        $emailResult = ContactModel::sendEmail(
            $result['data']['name'],
            $result['data']['email'], 
            $result['data']['message']
        );
        
        if ($emailResult['success']) {
            echo "<script>alert('Formulari enviat correctament amb " . $emailResult['method'] . "!');</script>";
            // Netejar camps
            $name = $email = $message = "";
        } else {
            echo "<script>alert('Error: " . $emailResult['error'] . "');</script>";
        }
    } else {
        // Mostrar errors i mantenir dades
        extract($result['errors']);
        if (isset($result['data'])) {
            extract($result['data']);
        }
    }
}

// Incloure la vista
require_once('../vista/vista.php');
?>