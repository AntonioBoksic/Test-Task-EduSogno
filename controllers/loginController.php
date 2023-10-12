<?php
include('../database.php');

// imposto la sessione qui, mi servirà sia per tenere traccia dei dati dell'utente loggato che degli errori in caso di login fallito.
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Recupero l'utente dal database tramite l'email
    $stmt = $pdo->prepare("SELECT * FROM utenti WHERE email = ?");
    $stmt->execute([$email]);

    $user = $stmt->fetch();

    if ($user) {


        // Confronto la password inserita con quella hashata nel database
        if (password_verify($password, $user['password'])) {
            // Password corretta

            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['nome'] . ' ' . $user['cognome'];
            
            //qui verifico se l'utente loggato è admin o meno e lo salvo nella sessione.
            $_SESSION['is_admin'] = $user['is_admin'] == 1 ? true : false;
            
            if($_SESSION['is_admin'] == true) {
                header("Location: ../adminDashboard");
            exit();
            } else {
                header("Location: ../personalPage");
                exit(); 
            }


        } else {
            // Password errata
            $_SESSION['error'] = "Password errata o email non trovata";
            header("Location: ../login");
            exit();
        }
    } else {
        // L'email non esiste nel database
        $_SESSION['error'] = "Password errata o email non trovata";
        header("Location: ../login");
        exit();
    }
}
?>
