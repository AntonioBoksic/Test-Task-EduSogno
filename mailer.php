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
        echo "Email sent successfully!";
    } else {
        echo "Email failed to send.";
    }
}
?>
