<?php include '../includes/header.php'; ?>
<?php
// Verifica se la password è stata effettivamente resettata
if (!isset($_SESSION['password_reset_success']) || !$_SESSION['password_reset_success']) {
    // Reindirizza l'utente alla pagina di login o alla pagina di reset della password
    header('Location: http://localhost:8888/Test-Task-EduSogno/views/forgottenPassword.php');
    exit;
}
?>

<div>
    Hai cambiato la tua password con successo.
</div>


</div>
</body>
</html>