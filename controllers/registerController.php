<?php

include '../database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Hash della password prima di salvarla
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Inserimento nel database (usa un prepared statement per la sicurezza)
    $stmt = $pdo->prepare("INSERT INTO users (first_name, last_name, email, password) VALUES (?, ?, ?, ?)");
    $stmt->execute([$first_name, $last_name, $email, $hashed_password]);

    // Reindirizza l'utente o mostra un messaggio di successo
    header("Location: login.php");
}

?>
