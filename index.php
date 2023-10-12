<?php

$uri = parse_url($_SERVER['REQUEST_URI'])['path'];

echo "URI Richiesto: " . $uri;

$routes = [
    
    //da index vengo reindirizzato a home
    "/Test-Task-EduSogno/" => "views/home.php",

    //login e relative pagine a cui si viene reindirizzati 
    "/Test-Task-EduSogno/login"  => "views/login.php", 
    "/Test-Task-EduSogno/controllers/loginController.php" => "/Test-Task-EduSogno/controllers/loginController.php", //quando provo ad effettuare il login la gestisco con il controller
    "/Test-Task-EduSogno/personalPage" => "views/personalPage.php",
    "/Test-Task-EduSogno/adminDashboard" => "views/adminDashboard.php",

    //register
    "/Test-Task-EduSogno/register" => "views/register.php",

    //reset password
    "/Test-Task-EduSogno/forgottenPassword" => "views/forgottenPassword.php",


    //azioni admin
    "/Test-Task-EduSogno/editEvent" => "views/editEvent.php",
    "/Test-Task-EduSogno/controllers/handleUpdateEvent.php"
    
    //logout
    "/Test-Task-EduSogno/logout" => "views/logout.php",
];

// controlla se $uri esiste in $routes
if (array_key_exists($uri, $routes)) {
    require $routes["$uri"];
} else {
    http_response_code(404);
    require 'views/404.php';
}
?>