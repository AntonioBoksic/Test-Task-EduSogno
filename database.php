
<?php

// questo file mi server per la connessione al database in una qualsiasi fase successiva all'inizializzazione(ovvero dopo aver eseguito setup.php)
// i passaggi in questione sono presi dal file setup.php e sono commentati lì


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

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}
?>