<?php include '../includes/header.php'; ?>

<!-- appena utente entra sulla pagina controllo se è loggato e se è admin, altrimento lo reindirizzo su login.php -->
<?php
session_start();

// Verifico se l'utente è loggato e se è un amministratore
if(!isset($_SESSION['user_id']) || !$_SESSION['is_admin']) {
    // L'utente non è autenticato come admin: reindirizzarlo
    header("Location: login.php");
    exit();
}
?>



    
ciao sei un admin e puoi entrare
</body>

