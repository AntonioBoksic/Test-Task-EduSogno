<?php include 'includes/header.php';

// Connessione al database
include 'database.php';

//imposto il fuso orario di
date_default_timezone_set('Europe/Rome');

$isValidToken = false; // Imposta una variabile booleana per controllare la validità del token
$errorMessage = ''; // Un posto per memorizzare eventuali messaggi di errore


// Controlla se il token è presente nella query string
if(isset($_GET['token'])) {
    $token = $_GET['token'];

    try {
        // Preparare la query SQL
        $stmt = $pdo->prepare("SELECT * FROM utenti WHERE password_reset_token = :token");
        
        // Esegui la query con il token fornito
        $stmt->execute([':token' => $token]);
        
        // Ottieni il risultato della query
        $resetRequest = $stmt->fetch();

    
        
        // Se il token esiste nel DB
        if($resetRequest) {
            // Verificare che il token non sia scaduto
            $expiryDate = new DateTime($resetRequest['password_reset_expires']);
            $now = new DateTime();
            
            if($expiryDate > $now) {
                $isValidToken = true;
            } else {
                $errorMessage = 'Il token è scaduto.';
            }
        } else {
            $errorMessage = 'Il token non è valido.';
        }
    } catch (PDOException $e) {
        // Gestione dell'errore (ad esempio, scrivere l'errore in un log, mostrare un messaggio generico all'utente, etc.)
        echo "Errore: " . $e->getMessage();
    }
} else {
    $errorMessage = 'Token non fornito.';
}
?>


<?php if($isValidToken): ?>
    <!-- Mostra il modulo di reimpostazione della password -->
    <form action="../controllers/resetPasswordController.php" method="POST">
    Nuova password: <input type="password" name="new_password" required>
    Conferma password: <input type="password" name="confirm_password" required>
    <input type="hidden" name="token" value="<?php echo htmlspecialchars($token); ?>">
    <input type="submit" value="Reimposta password">
    </form>
<?php else: ?>
    <!-- Mostra il messaggio di errore -->
    <p><?php echo $errorMessage; ?></p>
<?php endif; ?>


<!-- script per checkare che password e conferma password corrispondano -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const button = document.querySelector('input[type="submit"]');
        
        button.addEventListener('click', function(e) {

            // Ottieni i valori dalle caselle di input
            const newPassword = document.querySelector('input[name="new_password"]').value;
            const confirmPassword = document.querySelector('input[name="confirm_password"]').value;
            
            // Controllo sulla lunghezza della password e sulla corrispondenza
            if(newPassword.length < 5 || newPassword !== confirmPassword) {
                alert('Le password non corrispondono o sono troppo corte!');
                e.preventDefault(); // Dovrebbe prevenire il submit del form
            } else {
                console.log('Password is valid, attempting to submit form...');
            }
        });
    });
</script>


</div>
</body>
</html>