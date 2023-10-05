<?php

// Imposto fuso orario di Roma
date_default_timezone_set('Europe/Rome');

start_session();

// Includo il file di connessione al database
include '../database.php'; 

// Verifica se il form è stato inviato
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $newPassword = $_POST['new_password'];
    $confirmPassword = $_POST['confirm_password'];
    $token = $_POST['token'];

    // Validazione dei dati (es. lunghezza password, corrispondenza, ecc.)
    
    // 1. Conferma che le password corrispondano
    if ($newPassword !== $confirmPassword) {
        // Reindirizza all'utente con un messaggio di errore
        header("Location: resetPassword.php?error=mismatch");
        exit;
    }

    // 2. Verifica la lunghezza della password
    $minLength = 5; // ad es. minimo 5 caratteri
    if (strlen($newPassword) < $minLength) {
        // Reindirizza all'utente con un messaggio di errore
        header("Location: resetPassword.php?error=short");
        exit;
    }

    try {
        // Verifica il token (validità e scadenza)
        
        // Seleziona l'utente corrispondente al token dal database
        $stmt = $pdo->prepare("SELECT * FROM utenti WHERE password_reset_token = :token");
        $stmt->execute([':token' => $token]);
        $user = $stmt->fetch();

        // Controlla se un utente con il token fornito esiste nel database
        if ($user) {
            // Controlla se il token è scaduto
            $expiryDate = new DateTime($user['password_reset_expires']);
            $now = new DateTime();
            
            if ($expiryDate > $now) {
                // Il token è valido e non scaduto, procedi con la reimpostazione della password
                
                // Hashing della nuova password
                $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
                
                // Aggiornamento della password nel database
                $stmt = $pdo->prepare("UPDATE utenti SET password = :password, password_reset_token = NULL, password_reset_expires = NULL WHERE id = :id");
                $stmt->execute([':password' => $hashedPassword, ':id' => $user['id']]);
                
                // mi salvo questo messaggio nella sessione in modo che io possa proteggere la view passwordResetSuccess in caso questo messaggio non sia presente nella sessione.
                $_SESSION['password_reset_success'] = true;
                // Reindirizza o informa l'utente del successo
                header("Location: http://localhost:8888/Test-Task-EduSogno/views/passwordResetSuccess.php");
                exit;
            } else {
                // Il token è scaduto, reindirizza verso una pagina di errore o mostra un messaggio
                header("Location: http://localhost:8888/Test-Task-EduSogno/views/passwordResetSuccess.php?error=expired");
                exit;
            }
        } else {
            // Nessun utente con il token fornito, reindirizza verso una pagina di errore o mostra un messaggio
            header("Location: http://localhost:8888/Test-Task-EduSogno/views/passwordResetSuccess.php?error=invalidtoken");
            exit;
        }
    } catch (PDOException $e) {
        // Gestione dell'errore
        echo "Errore: " . $e->getMessage();
    }
} else {
    // Reindirizza verso la pagina di reset se il metodo non è POST
    header("Location: http://localhost:8888/Test-Task-EduSogno/views/passwordResetSuccess.php");
    exit;
}
?>
