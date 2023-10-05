<?php

function sendResetEmail($toEmail, $token) {
    // L'oggetto dell'email
    $subject = 'Reset Your Password';

    // Il corpo dell'email
    $message = "Hello,\n\nIt seems like you requested a password reset. Please click on the link below to reset your password:\n";
    $message .= "http://localhost:8888/Test-Task-EduSogno/views/resetPassword.php". "?token=" . $token . "\n\n";
    $message .= "If you did not request this password reset, please ignore this email.\n";
    
    // Gli headers dell'email
    $headers = 'From: webmaster@yourwebsite.com' . "\r\n" .
               'Reply-To: webmaster@yourwebsite.com' . "\r\n" .
               'X-Mailer: PHP/' . phpversion();



    // Usa la funzione mail() di PHP per inviare l'email
    if(mail($toEmail, $subject, $message, $headers)) {
        $_SESSION['message'] = "Email mandata con successo a $toEmail";
    } else {
        $_SESSION['message'] = "Invio email fallito a $toEmail.";
    }
    
    // Reindirizza l'utente a forgottenPassword.php
    header('Location: http://localhost:8888/Test-Task-EduSogno/views/forgottenPassword.php');
    exit;
}



//qua gestiamo le mail da mandare in caso di aggiunta o modifica evento a tutti i partecipanti coinvolti
function sendEventEmail($toEmails, $subject, $message) {
    // Gli headers dell'email
    $headers = 'From: webmaster@yourwebsite.com' . "\r\n" .
               'Reply-To: webmaster@yourwebsite.com' . "\r\n" .
               'X-Mailer: PHP/' . phpversion();

    // Inviare l'email a ciascun partecipante
    foreach($toEmails as $toEmail) {
        mail($toEmail, $subject, $message, $headers);
    }
}
?>
