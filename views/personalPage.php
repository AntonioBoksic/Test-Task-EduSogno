
<?php
    include '../includes/header.php';

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

    <h2>Ciao <?php echo htmlspecialchars($user['nome']) ?> ecco i tuoi eventi</h2>
<div class="events-grid">
    <?php 
    if($events) {
        foreach($events as $event) {
            ?>
            <div class="event-card">
                <h2 class="event-name"><?= htmlspecialchars($event['nome_evento']) ?></h2>
                <p class="event-date"><?= htmlspecialchars($event['data_evento']) ?></p>
                <button class="join-btn">Join</button>
            </div>
            <?php
        }
    } else {
        echo "No events found.";
    }
    ?>
</div>

</div>
</body>
</html>
