<?php

class Event {
    public $id;
    public $attendees;
    public $nome_evento;
    public $data_evento;
    
    public function __construct($id, $nome_evento, $attendees, $data_evento) {
        $this->id = $id;
        $this->nome_evento = $nome_evento;
        $this->attendees = $attendees;
        $this->data_evento = $data_evento;
    }

    // Eventuali altri metodi per lavorare con i dati (es. formattazione della data)
}