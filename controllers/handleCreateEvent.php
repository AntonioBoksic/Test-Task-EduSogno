<?php

include_once("EventController.php");
include_once("../models/Event.php");
include_once("../database.php");

// Controlla che il modulo sia stato inviato
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $nome_evento = $_POST['nome_evento'];
    $data_evento = $_POST['data_evento'];
    $attendees = $_POST['attendees'];
    
    // qua si potrebbe aggiungere validazione dei dati
    
    $event = new Event(null, $nome_evento, $attendees, $data_evento);
    
    $controller = new EventController($pdo);
    $controller->create($event);
    
    // Ridirigi verso una pagina di conferma o l'elenco eventi
    header("Location: ../views/adminDashboard.php");
} else {
    // Gestisci il caso in cui il modulo non sia stato inviato
    header("Location: createEvent.php");
}