<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <!-- import del font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100;0,9..40,200;0,9..40,300;0,9..40,400;0,9..40,500;0,9..40,600;0,9..40,700;0,9..40,800;0,9..40,900;0,9..40,1000;1,9..40,100;1,9..40,200;1,9..40,300;1,9..40,400;1,9..40,500;1,9..40,600;1,9..40,700;1,9..40,800;1,9..40,900;1,9..40,1000&display=swap" rel="stylesheet">
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
