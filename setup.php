<?php

//questo file viene eseguito solo per inizializzare il progetto
//mi server per connettermi al database e creare tabelle

//dati per configurazione DB in locale (MAMP)
$host = 'localhost';
$port = '8889';
$db   = 'Edu';
$user = 'root';
$pass = 'root';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;port=$port;dbname=$db;charset=$charset";


$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

//mi connetto al database
try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}

// specifico le caratteristiche della tabella users
$createUsersTable = "
    CREATE TABLE users (
        id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        first_name VARCHAR(255) NOT NULL,
        last_name VARCHAR(255) NOT NULL,
        email VARCHAR(255) UNIQUE NOT NULL,
        password VARCHAR(255) NOT NULL,
        is_admin BOOLEAN DEFAULT FALSE
    )
";

//creo tabella users
$pdo->exec($createUsersTable);

// specifico le caratteristiche della tabella events
$createEventsTable = "
    CREATE TABLE events (
        id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        title VARCHAR(255) NOT NULL,
        description TEXT,
        date DATETIME
    )
";

//creo tabella events
$pdo->exec($createEventsTable);

$createEventUserTable = "
    CREATE TABLE event_user (
        id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        user_id BIGINT UNSIGNED,
        event_id BIGINT UNSIGNED,
        UNIQUE(user_id, event_id),
        FOREIGN KEY(user_id) REFERENCES users(id),
        FOREIGN KEY(event_id) REFERENCES events(id)
    )
";

//creo tabella events
$pdo->exec($createEventUserTable);

//se tutto il codice gira senza problemi otterrò questo messaggio
echo "Tabelle create con successo!";
//n.b. se tento di ri-eseguire questo codice dopo aver ottenuto il messaggio sopra non ri-otterrò questo messaggio dato che il codice si imbatterà in un'errore prima di arrivare qui, in quanto le tabella sono state già create
