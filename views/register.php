<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div class="container">
        <h2>Registrazione</h2>

        <form action="register_handler.php" method="POST">

            <div class="form-group">
                <label for="first_name">Nome:</label>
                <input type="text" id="first_name" name="first_name" required>
            </div>

            <div class="form-group">
                <label for="last_name">Cognome:</label>
                <input type="text" id="last_name" name="last_name" required>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>

            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>

            <button type="submit">Registrati</button>

        </form>

        <a href="login.php"> Hai già un account? Accedi</a>
    </div>

</body>

</html>


<?php

// Includi qui la tua connessione al database

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
</body>
</html>