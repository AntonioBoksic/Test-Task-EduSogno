<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>

<?php include '../includes/header.php'; ?>






<?php
session_start();
include('../database.php');

// Verifica se l'utente è loggato
if(!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Recupero informazioni utente
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$_SESSION['user_id']]);
$user = $stmt->fetch();

// Recupero eventi dell'utente
$stmt = $pdo
->prepare("SELECT e.title FROM events e
JOIN event_user eu ON eu.event_id = e.id
WHERE eu.user_id = ?
");
$stmt->execute([$_SESSION['user_id']]);
$events = $stmt->fetchAll();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Metatags, link CSS, etc... -->
    <title>Dashboard</title>
</head>
<body>

<h1>Welcome <?php echo htmlspecialchars($user['first_name'] . ' ' . $user['last_name']); ?></h1>

<h2>Your Events:</h2>
<ul>
    <?php 
    if($events) {
        foreach($events as $event) {
            echo '<li>' . htmlspecialchars($event['name']) . '</li>';
        }
    } else {
        echo "No events found.";
    }
    ?>
</ul>

<!-- ... altre sezioni del dashboard ... -->

</body>
</html>
