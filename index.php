<?php

use Controller\HomeController;
use Controller\SecurityController;

spl_autoload_register(function($class_name){
    include $class_name . '.php';
});

$ctrlHome = new HomeController();
$ctrlSecurity = new SecurityController();

$id = isset($_GET["id"]) ? $_GET["id"] : null;

if(isset($_GET["action"])){
    switch ($_GET["action"]) {
        // Changement de views
        case "defaultView" : $ctrlHome->defaultView(); break;
        case "aPropos" : $ctrlHome->aPropos(); break;
        case "contact" : $ctrlHome->contact(); break;
        // Envoie de mail
        case "contactSubmit": $ctrlHome->contactSubmit(); break;
        // Security
        case "logout": $ctrlSecurity->logout(); break;
        case "register": $ctrlSecurity->register(); break;
        case "login": $ctrlSecurity->login(); break;
    } 
} else {
    // Si aucun paramètre "action" n'est défini, afficher la vue par défaut
    $ctrlHome->defaultView();
}