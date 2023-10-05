<?php include '../includes/header.php'; ?>

<h2>Crea un nuovo evento!</h2>

<form action="../controllers/handleCreateEvent.php" method="POST">
    <label for="nome_evento">Nome Evento:</label>
    <input type="text" id="nome_evento" name="nome_evento" required><br><br>
    
    <label for="data_evento">Data Evento:</label>
    <input type="datetime-local" id="data_evento" name="data_evento" required><br><br>
    
    <label for="attendees">Partecipanti:</label>
    <input type="text" id="attendees" name="attendees" required><br><br>
    
    <input type="submit" value="Crea Evento">
</form>

<!-- Includi eventuali JavaScript -->

</body>
</html>
