<?php 
    include_once '../includes/header.php'; 
    include_once("../controllers/EventController.php");
    include_once("../models/Event.php");
    include_once("../database.php");

    $eventController = new EventController($pdo);

    //Valida che l'ID sia presente e sia un numero intero
    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        $event = $eventController->find($_GET['id']);
    } else {
        // Gestisci il caso in cui non esiste l'ID o non è valido
        die("ID dell'evento non valido.");
    }

    // Controlla che l'evento esista
    if (!$event) {
        die("Evento non trovato.");
    }
?>

<h2>modifica l'evento <?php echo htmlspecialchars($event->nome_evento)?> </h2>

<form action="../controllers/handleUpdateEvent.php" method="POST">
    <label for="nome_evento">Nome Evento:</label>
    <input type="text" id="nome_evento" name="nome_evento" value="<?= htmlspecialchars($event->nome_evento, ENT_QUOTES, 'UTF-8') ?>" required><br><br>
    
    <label for="data_evento">Data Evento:</label>
    <input type="datetime-local" id="data_evento" name="data_evento" value="<?= htmlspecialchars($event->data_evento, ENT_QUOTES, 'UTF-8') ?>" required><br><br>
    
    <label for="attendees">Partecipanti:</label>
    <input type="text" id="attendees" name="attendees" value="<?= htmlspecialchars($event->attendees, ENT_QUOTES, 'UTF-8') ?>" required><br><br>
    
    <!-- Aggiungi un campo nascosto per l'ID dell'evento, per poter identificare quale evento aggiornare -->
    <input type="hidden" name="id" value="<?= htmlspecialchars($event->id, ENT_QUOTES, 'UTF-8') ?>">
    
    <input type="submit" value="Aggiorna Evento">
</form>


<!-- Includi eventuali JavaScript -->

</body>
</html>