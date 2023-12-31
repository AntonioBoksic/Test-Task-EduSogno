<?php
// Inizio la sessione se non è già stata avviata
session_start();

// Distruggo tutte le variabili di sessione
$_SESSION = array();

// Se si desidera distruggere completamente la sessione, eliminare anche i cookie di sessione.
// Nota: Ciò distruggerà la sessione e non solo i dati di sessione
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Distruggo la sessione.
session_destroy();

// Reindirizzo l'utente alla pagina di login o alla homepage
header("Location: login.php");
exit();
?>
