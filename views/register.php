    <?php include '../includes/header.php'; ?>

    <div class="primary-flex">


        <h2>Crea il tuo account</h2>

        <div class="container-form">

        
            <form action="../controllers/registerController.php" method="POST">

                <div class="form-group">
                    <label for="nome">inserisci il nome</label>
                    <div>
                        <input type="text" id="nome" name="nome" placeholder="Mario"required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="cognome">inserisci il cognome</label>
                    <div>
                        <input type="text" id="cognome" name="cognome" placeholder="Rossi" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="email">inserisci l'email</label>
                    <div>
                        <input type="email" id="email" name="email" placeholder="name@example.com" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="password">inserisci la password</label>
                    <div>
                    <input type="password" id="password" name="password" placeholder="Scrivila qui" required>
                    </div>
                </div>

                <button type="submit">REGISTRATI</button>

            </form>

            <a class="alreadyRegistered" href="login.php"> Hai già un account? Accedi</a>
        </div>

    </div>
    

</body>

</html>


<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST["nome"];
    $last_name = $_POST["cognome"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Hash della password prima di salvarla
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Inserimento nel database (usa un prepared statement per la sicurezza)
    $stmt = $pdo->prepare("INSERT INTO utenti (nome, cognome, email, password) VALUES (?, ?, ?, ?)");
    $stmt->execute([$first_name, $last_name, $email, $hashed_password]);

    // Reindirizza l'utente o mostra un messaggio di successo
    header("Location: login.php");
}

?>
</body>
</html>