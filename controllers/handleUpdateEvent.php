<?php
include_once("EventController.php");
include_once("../models/Event.php");
include_once("../database.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $id = $_POST['id'];
    $nome_evento = $_POST['nome_evento'];
    $data_evento = $_POST['data_evento'];
    $attendees = $_POST['attendees'];
    
    // Validare i dati se necessario
    
    $event = new Event($id, $nome_evento, $attendees, $data_evento);
    
    $controller = new EventController($pdo);
    $controller->update($event);
    
    header("Location: ../views/adminDashboard.php");
} else {
    header("Location: editEvent.php");
}