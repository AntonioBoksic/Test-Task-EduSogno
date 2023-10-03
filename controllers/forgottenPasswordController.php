<?php

// Includo il file di connessione al database e/o le funzioni di mail
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

    // Pulisci l'email per evitare injection
    //$email = cleanInput($_POST['email']);
    $email = $_POST['email'];
    
    // Verifica se l'email esiste nel database
    $exists = checkEmailExists($email, $pdo); // Funzione che devi definire
    
    if ($exists) {
        // Crea un token unico per la reimpostazione della password
        $token = bin2hex(random_bytes(32)); // Funzione che devi definire

        // Invia l'email per la reimpostazione della password
        sendResetEmail($email, $token); // Funzione definita in mailer.php
        
        // Qui potresti anche memorizzare il token nel database associato all'email dell'utente,
        // per poi verificarlo quando l'utente clicca sul link nel suo email
    } else {
        $_SESSION['message'] = "Email does not exist in our database.";
        header('Location: http://localhost:8888/Test-Task-EduSogno/views/forgottenPassword.php');
        exit;    }
}

