<?php

//imposto fuso orario di Roma,
date_default_timezone_set('Europe/Rome');

// Includo il file di connessione al database e le funzioni di mail
include '../database.php'; 
include '../mailer.php'; 

// avvio la sessione per potermi salvare il messaggio da far vedere nella view forgottenPassword.php da cui viene mandata la richiesta di reset
session_start();

//definizione funzione per vedere se email esiste nel database
function checkEmailExists($email, $pdo) {
    // Prepariamo la query SQL
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE email = :email");
    $stmt->bindParam(':email', $email);

    // Eseguiamo la query
    $stmt->execute();

    // Otteniamo il conteggio delle righe corrispondenti
    $count = $stmt->fetchColumn();

    // Se $count è maggiore di 0, allora l'e-mail esiste nel database
    return $count > 0;
}

// Controlla se la richiesta POST ha l'email e non è vuota
if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['email'])) {

    //qui probabilmente si può fare meglio a livello di sicurezza, per garantire che non ci siano possibilità di injection, ma per questo progetto può andare bene così
    $email = $_POST['email'];
    
    // Verifica se l'email esiste nel database
    $exists = checkEmailExists($email, $pdo); // Funzione definita sopra
    
    if ($exists) {
        // Crea un token unico per la reimpostazione della password
        $token = bin2hex(random_bytes(32));
        //$expires ci servirà per il timestamp al quale vogliamo far scadere il token
        $expires = new DateTime('NOW');
        $expires->add(new DateInterval('PT1H')); // Fai scadere il token dopo 1 ora

        // Aggiorna l'utente nel database con il token e il timestamp di scadenza
        $stmt = $pdo->prepare("UPDATE users SET password_reset_token = :token, password_reset_expires = :expires WHERE email = :email");
        $stmt->bindParam(':token', $token);
        $expiresFormatted = $expires->format('Y-m-d H:i:s');
        $stmt->bindParam(':expires', $expiresFormatted);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        // Invia l'email per la reimpostazione della password
        sendResetEmail($email, $token); // Funzione definita in mailer.php
        
        // Qui potresti anche memorizzare il token nel database associato all'email dell'utente,
        // per poi verificarlo quando l'utente clicca sul link nel suo email
    } else {
        $_SESSION['message'] = "Email does not exist in our database.";
        header('Location: http://localhost:8888/Test-Task-EduSogno/views/forgottenPassword.php');
        exit;    }
}

