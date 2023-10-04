<?php
include("../models/Event.php");
include("../database.php");

class EventController {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function index() {
        $stmt = $this->pdo->prepare("SELECT * FROM eventi");
        $stmt->execute();
        $eventsData = $stmt->fetchAll();
        $events = [];
        
        foreach ($eventsData as $data) {
            $events[] = new Event($data['id'], $data['nome_evento'], $data['attendees'], $data['data_evento']);
        }
        
        return $events;
    }

    public function show($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM eventi WHERE id = ?");
        $stmt->execute([$id]);
        $data = $stmt->fetch();

        return new Event($data['id'], $data['nome_evento'], $data['attendees'], $data['data_evento']);
    }

    public function create(Event $event) {
        $stmt = $this->pdo->prepare("INSERT INTO eventi (nome_evento, attendees, data_evento) VALUES (?, ?, ?)");
        $stmt->execute([$event->nome_evento, $event->attendees, $event->data_evento]);
        return $this->pdo->lastInsertId(); 
    }

    public function update(Event $event) {
        $stmt = $this->pdo->prepare("UPDATE eventi SET nome_evento = ?, attendees = ?, data_evento = ? WHERE id = ?");
        return $stmt->execute([$event->nome_evento, $event->attendees, $event->data_evento, $event->id]);
    }

    public function delete(Event $event) {
        $stmt = $this->pdo->prepare("DELETE FROM eventi WHERE id = ?");
        return $stmt->execute([$event->id]);
    }

 
}
