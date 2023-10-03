<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div class="login-container">
    <h2>Accedi</h2>
    <form action="../controllers/loginController.php" method="POST">
        <!-- campo per email -->
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" required>
        </div>

        
        <!-- campo per password -->
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required>
        </div>
        
        <!-- messaggio di errore generico (per ragioni di sicurezza) in caso (1) email non esista o (2) email e password non corrispondono -->
        <?php
        // riprendo la sessione creata in loginController.php
        session_start();

        if(isset($_SESSION['error'])) {
            echo '<p style="color: red;">' . $_SESSION['error'] . '</p>';
            // rimuovo la proprietà error dalla sessione per non visualizzarla se ricarico login.php
            unset($_SESSION['error']);  
        }
        ?>
        
        <button type="submit">Accedi</button>
    </form>

   <a href="register.php">Non hai un account? Registrati</a>

  
</div>

</body>
</html>