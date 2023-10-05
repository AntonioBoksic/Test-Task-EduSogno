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
  
</div>
</body>
</html>