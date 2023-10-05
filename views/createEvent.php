<?php include '../includes/header.php'; ?>

<?php
// controlla se utente è loggato come admin
if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== true) {
    // Reindirizza l'utente alla pagina di login
    header("Location: http://localhost:8888/Test-Task-EduSogno/views/login.php");
    exit;
}
?>

<h2>Crea un nuovo evento!</h2>

<div class="primary-flex">
    <div class="container-form">


        <form action="../controllers/handleCreateEvent.php" method="POST">
            <label for="nome_evento">Nome Evento:</label>
            <input type="text" id="nome_evento" name="nome_evento" required><br><br>
            
            <label for="data_evento">Data Evento:</label>
            <input type="datetime-local" id="data_evento" name="data_evento" required><br><br>
            
            <label for="attendees">Partecipanti:</label>
            <input type="text" id="attendees" name="attendees" required><br><br>
            
            <button type="submit">Crea Evento</button>
        </form>
    </div>
</div>



</div>
</body>
</html>
