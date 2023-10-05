<?php

include_once("EventController.php");
include_once("../models/Event.php");
include_once("../database.php");

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    
    $event_id = $_GET['id'];
    
    // Validazione dell'ID se necessario (es. assicurarsi che sia un intero)
    
    $event = new Event($event_id, "", "", ""); // Creare un oggetto evento con solo l'ID settato
    
    $controller = new EventController($pdo);
    $controller->delete($event);
    
    // Reindirizzare l'utente sulla dashboard
    header("Location: ../views/adminDashboard.php");
    
} else {
    // Gestione di errore/redirect se l'ID non è fornito
    header("Location: errorPage.php");
}