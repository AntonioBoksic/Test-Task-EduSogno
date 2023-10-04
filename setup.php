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
$createUtentiTable = "
        CREATE TABLE IF NOT EXISTS utenti (
        id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        nome VARCHAR(255) NOT NULL,
        cognome VARCHAR(255) NOT NULL,
        email VARCHAR(255) UNIQUE NOT NULL,
        password VARCHAR(255) NOT NULL,
        is_admin BOOLEAN DEFAULT FALSE,
        password_reset_token VARCHAR(255),
        password_reset_expires DATETIME
    )
";

//creo tabella users
$pdo->exec($createUtentiTable);

// specifico le caratteristiche della tabella events
$createEventiTable = "
        CREATE TABLE IF NOT EXISTS eventi (
        id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        attendees text,
        nome_evento VARCHAR(255) NOT NULL,
        data_evento DATETIME
    )
";

//creo tabella events
$pdo->exec($createEventiTable);

// Dati di esempio per eventi
$insertEventData = "
    INSERT INTO `eventi`(`attendees`, `nome_evento`, `data_evento`) 
    VALUES 
    ('ulysses200915@varen8.com,qmonkey14@falixiao.com,mavbafpcmq@hitbase.net','Test Edusogno 1', '2022-10-13 14:00'), 
    ('dgipolga@edume.me,qmonkey14@falixiao.com,mavbafpcmq@hitbase.net','Test Edusogno 2', '2022-10-15 19:00'), 
    ('dgipolga@edume.me,ulysses200915@varen8.com,mavbafpcmq@hitbase.net','Test Edusogno 3', '2022-10-15 19:00');
";

// Inserisco i dati di esempio nella tabella eventi
$pdo->exec($insertEventData);

//se tutto il codice gira senza problemi otterrò questo messaggio
echo "Tabelle create con successo!";
//n.b. se tento di ri-eseguire questo codice dopo aver ottenuto il messaggio sopra non ri-otterrò questo messaggio dato che il codice si imbatterà in un'errore prima di arrivare qui, in quanto le tabella sono state già create


    
