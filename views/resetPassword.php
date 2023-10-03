<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>
    
<!-- includo connessione al database -->
<?php include '../includes/header.php';

// Connessione al database
include '../database.php';

// Verifica se il token è presente nella query string della URL
if (isset($_GET['token'])) {
    // Recupera il token
    $token = $_GET['token'];
    
    // TODO: Esegui verifica del token...
}
else {
    // Mostra un messaggio di errore o reindirizza se il token non è presente
    die("Token non presente");
}
?>

<!-- Mostra il form di reimpostazione della password solo se il token è valido -->
<!-- TODO: Aggiungi la logica per mostrare/nascondere il form in base alla validità del token -->
<form method="POST" action="resetPasswordHandler.php">
    Nuova password: <input type="password" name="new_password" required>
    Conferma password: <input type="password" name="confirm_password" required>
    <input type="hidden" name="token" value="<?php echo htmlspecialchars($token); ?>">
    <input type="submit" value="Reimposta password">
</form>

</body>
</html>