<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <!-- import del font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100;0,9..40,200;0,9..40,300;0,9..40,400;0,9..40,500;0,9..40,600;0,9..40,700;0,9..40,800;0,9..40,900;0,9..40,1000;1,9..40,100;1,9..40,200;1,9..40,300;1,9..40,400;1,9..40,500;1,9..40,600;1,9..40,700;1,9..40,800;1,9..40,900;1,9..40,1000&display=swap" rel="stylesheet">

</head>

<body>
<?php include '../includes/header.php'; ?>

<div class="primary-flex">

    <h2>Hai già un account?</h2>

    <div class="container-form">

    
        
        <form action="../controllers/loginController.php" method="POST">
            <!-- campo per email -->
            <div class="form-group">
                <label for="email">inserisci l'email</label>
                <div>
                <input type="email" id="email" name="email" placeholder="name@example.com" required>
                </div>
            </div>

            
            <!-- campo per password -->
            <div class="form-group">
                <label for="password">inserisci la password</label>
                <div>
                    <input type="password" id="password" name="password" placeholder="Scrivila qui" required>
                </div>
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

        <div>
            <a href="register.php">Non hai un account? Registrati</a>
        </div>

        <div>
            <a href="forgottenPassword.php">Pasword Dimenticata?</a>
        </div>
    </div>

</div>
  
</body>
</html>