<?php include '../includes/header.php'; ?>

<!-- appena utente entra sulla pagina controllo se è loggato e se è admin, altrimento lo reindirizzo su login.php -->
<?php

// Verifico se l'utente è loggato e se è un amministratore
if(!isset($_SESSION['user_id']) || !$_SESSION['is_admin']) {
    // L'utente non è autenticato come admin: reindirizzarlo
    header("Location: login.php");
    exit();
}
?>

<?php 
include("../controllers/EventController.php");
include('../database.php');
$eventController = new EventController($pdo);
$events = $eventController->index();
?>

<table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome Evento</th>
                <th>Data Evento</th>
                <th>Partecipanti</th>
                <th>Azioni</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($events as $event): ?>
                <tr>
                    <td><?= htmlspecialchars($event->id, ENT_QUOTES, 'UTF-8') ?></td>
                    <td><?= htmlspecialchars($event->nome_evento, ENT_QUOTES, 'UTF-8') ?></td>
                    <td><?= htmlspecialchars($event->data_evento, ENT_QUOTES, 'UTF-8') ?></td>
                    <td><?= htmlspecialchars($event->attendees, ENT_QUOTES, 'UTF-8') ?></td>
                    <td>
                        <a href="editEvent.php?id=<?= $event->id ?>">Modifica</a>
                        <a href="deleteEvent.php?id=<?= $event->id ?>">Elimina</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</main>


    

</body>

