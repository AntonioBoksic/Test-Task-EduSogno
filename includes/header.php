
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
    
    <header>
        <div class="logo">
            <a href="personalPage.php">
                <img src="../assets/images/logo.png" alt="Your Website Logo">
            </a>
        </div>

        <div class="nav">
            <?php
            session_start();
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

                                <a href="adminDashboard.php">Admin Dashboard</a>

                            <?php
                            endif;
                            ?>    
                        
                        
                        <a href="personalPage.php">Personal Page</a>
                        <a href="logout.php">Logout</a>
                        
                    </div>
                </div>
            <?php
            else:
            ?>
                <!-- Link quando l'utente NON è loggato -->
                <a href="register.php">Register</a>
                <a href="login.php">Login</a>
            <?php
            endif;
            ?>
        </div>

    </header>

    <script>
    function toggleMenu() {
        var menu = document.getElementById("menu");
        menu.style.display = menu.style.display === "block" ? "none" : "block";
    }
    </script>

