
<!-- se questo header.php lo uso per tutte le view potrei anche eliminare session_start() da tutte le altre view (?) (l'ho fatto e funziona giustamente)-->
<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- import del font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100;0,9..40,200;0,9..40,300;0,9..40,400;0,9..40,500;0,9..40,600;0,9..40,700;0,9..40,800;0,9..40,900;0,9..40,1000;1,9..40,100;1,9..40,200;1,9..40,300;1,9..40,400;1,9..40,500;1,9..40,600;1,9..40,700;1,9..40,800;1,9..40,900;1,9..40,1000&display=swap" rel="stylesheet">
    <script src="assets/js/main.js"></script>
</head>

<body>
    
    <!-- header con logo e link/hamburger -->
    <header>
        <div class="logo">
            <a href="personalPage">
                <img src="assets/images/logo.png" alt="Your Website Logo">
            </a>
        </div>

        <div class="nav">
            <?php
            if(isset($_SESSION['user_id'])):
            ?>
                <!-- Menù quando l'utente è loggato -->
                <div class="hamburger-menu">
                    <div class="hamburger" onclick="toggleMenu()">☰</div>
                    <div class="menu-content" id="menu">

                        <!-- link per admin Dashboard visibile solo se utente è admin -->
                        <?php
                            if(isset($_SESSION['is_admin']) && $_SESSION['is_admin'] === true):
                            ?>

                                <a href="adminDashboard">Admin Dashboard</a>

                            <?php
                            endif;
                            ?>    
                        
                        
                        <a href="personalPage">Personal Page</a>
                        <a href="logout">Logout</a>
                        
                    </div>
                </div>
            <?php
            else:
            ?>
                <!-- Link quando l'utente NON è loggato -->
                <a href="register">Register</a>
                <a href="login">Login</a>
            <?php
            endif;
            ?>
        </div>

    </header>

    <!-- questo è lo sfondo che condividono tutte le view -->
    <div class="view-background">
        <!-- <img class="onda-seconda-dal-basso" src="../assets/images/Vector4.png" alt="">   -->
        <img class="immagine-cerchio-destra" src="assets/images/Ellipse12.png" alt="">  
        <img class="immagine-cerchio-sinistra" src="assets/images/Ellipse13.png" alt="">  
        
        
        <img class="immagine-razzo" src="assets/images/Group201.png" alt="">  
        
        <img class="onda-terza-dal-basso" src="assets/images/Vector5.png" alt="">  
        
        <img class="onda-seconda-dal-basso" src="assets/images/Vector4.png" alt="">  

        <img class="onda-bianca-footer" src="assets/images/Vector1.png" alt="">  
    </div>

    <!-- da qui inizia il contenuto di ogni singola view -->
    <div class="view-content">
    
    <!-- serve a far apparire la lista di link dal menù sul click -->
    <!-- ho provato a spostarlo in ../assets/js/main.js  ma per qualche motivo non funziona quindi lo lascio qua-->
    <script>
        function toggleMenu() {
            var menu = document.getElementById("menu");
            menu.style.display = menu.style.display === "block" ? "none" : "block";
        }
    </script>


<!-- il view-content si chiude nelle singole view -->
<!-- il body si chiude nelle singole view -->

