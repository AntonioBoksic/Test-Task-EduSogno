<?php include 'includes/header.php'; ?>

<h2>
    Inserisci l'email per la quale hai dimenticato la password e ti verrà inviata una mail con un link per reimpostare la tua password.
</h2>


<div class="primary-flex">
    <div class="container-form">

        <form action="controllers/forgottenPasswordController.php" method="POST">

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>

            <button type="submit">Reset Password</button>

        </form>
    </div>
</div>

<?php
if(isset($_SESSION['message'])) {
    echo "<div class='message-for-pw-reset'>" . htmlspecialchars($_SESSION['message']) . "</div>";
    // Dimentica il messaggio per evitare che venga mostrato nuovamente in futuro
    unset($_SESSION['message']);
}
?>

</div>
</body>
</html>