<?php

// Includo il file di connessione al database e/o le funzioni di mail
include '../database.php'; 
include '../mailer.php'; 

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
        sendResetEmail($email, $token); // Funzione che devi definire
        
        // Qui potresti anche memorizzare il token nel database associato all'email dell'utente,
        // per poi verificarlo quando l'utente clicca sul link nel suo email
    } else {
        // Gestisci il caso in cui l'email non esiste nel database (mostra un errore, reindirizza, ecc.)
    }
}
