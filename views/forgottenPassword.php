<?php include '../includes/header.php'; ?>

<div>
    Inserisci l'email per la quale hai dimenticato la password e ti verrà inviata una mail con un link per reimpostare la tua password.
</div>

<form action="../controllers/forgottenPasswordController.php" method="POST">


    <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
    </div>

    <input type="submit" value="Reset Password">


</form>

<?php

if(isset($_SESSION['message'])) {
    echo htmlspecialchars($_SESSION['message']);
    // Dimentica il messaggio per evitare che venga mostrato nuovamente in futuro
    unset($_SESSION['message']);
}
?>

</div>
</body>
</html>