<?php
include('../database.php');

// imposto la sessione qui, mi servirà sia per tenere traccia dei dati dell'utente loggato che degli errori in caso di login fallito.
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Recupero l'utente dal database tramite l'email
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);

    $user = $stmt->fetch();

    if ($user) {


        // Confronto la password inserita con quella hashata nel database
        if (password_verify($password, $user['password'])) {
            // Password corretta

            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['first_name'] . ' ' . $user['last_name'];
            // etc...

            header("Location: ../views/dashboard.php");  // Supponendo che tu abbia una pagina dashboard per gli utenti loggati
            exit();
        } else {
            // Password errata
            $_SESSION['error'] = "Password errata o email non trovata";
            header("Location: ../views/login.php");
            exit();
        }
    } else {
        // L'email non esiste nel database
        $_SESSION['error'] = "Password errata o email non trovata";
        header("Location: ../views/login.php");
        exit();
    }
}
?>
