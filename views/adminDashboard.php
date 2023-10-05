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

//recupero tutti gli eventi dal database
$eventController = new EventController($pdo);
$events = $eventController->index();

// Recupero informazioni utente per poter stampare il nome
$stmt = $pdo->prepare("SELECT * FROM utenti WHERE id = ?");
$stmt->execute([$_SESSION['user_id']]);
$user = $stmt->fetch();
?>

<h2>Ciao <?php echo htmlspecialchars($user['nome']) ?>, controlla gli eventi dalla admin dashboard</h2>
    <div class="table-container">
        <table>
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
                        <td class="tabella-partecipanti">
                            <div class="scroll-container">
                                <?= htmlspecialchars($event->attendees, ENT_QUOTES, 'UTF-8') ?>
                            </div>
                        </td>
                        <td>
                            <a href="editEvent.php?id=<?= $event->id ?>">Modifica</a>
                            <a href="#" onclick="confirmDelete(<?= $event->id ?>,'<?= addslashes($event->nome_evento) ?>');">Elimina</a>

                        </td>
                    </tr>
                <?php endforeach; ?>
                <tr>
                    <td colspan="4"></td> <!-- Colonne vuote -->
                    <td>
                        <a href="createEvent.php">Crea nuovo evento</a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</main>


<script>

    // funzione per alert/popup prima di eliminare un evento
    function confirmDelete(eventId, eventName) {

        let userConfirmation = confirm("Sei sicuro di voler eliminare l'evento" + eventName + "?");
    
        if (userConfirmation) {
            window.location.href = "../controllers/handleDeleteEvent.php?id=" + eventId;
        }
    }
    </script>

</div>
</body>

