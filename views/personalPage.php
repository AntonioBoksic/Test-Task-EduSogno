
<?php
    include '../includes/header.php';
    session_start();

    include('../database.php');
    include('../controllers/EventController.php');

    // Verifica se l'utente è loggato
    if(!isset($_SESSION['user_id'])) {
        header("Location: login.php");
        exit();
    }

    // Recupero informazioni utente
    $stmt = $pdo->prepare("SELECT * FROM utenti WHERE id = ?");
    $stmt->execute([$_SESSION['user_id']]);
    $user = $stmt->fetch();

    // Recupero eventi dove l'utente è un partecipante
    $email = $user['email'];
    $stmt = $pdo->prepare("SELECT * FROM eventi WHERE FIND_IN_SET(?, attendees)");
    $stmt->execute([$email]);
    $events = $stmt->fetchAll();
?>


    <h1>Welcome <?php echo htmlspecialchars($user['nome'] . ' ' . $user['cognome']); ?></h1>

    <h2>Your Events:</h2>
    <ul>
        <?php 
        if($events) {
            foreach($events as $event) {
                echo '<li>' . htmlspecialchars($event['nome_evento']) . ' at ' . htmlspecialchars($event['data_evento']) . '</li>';
            }
        } else {
            echo "No events found.";
        }
        ?>
    </ul>

</body>
</html>
