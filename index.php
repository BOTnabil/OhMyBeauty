<?php

use Controller\HomeController;

spl_autoload_register(function($class_name){
    include $class_name . '.php';
});

$ctrlHome = new HomeController();

$id = (isset($_GET["id"])) ? $_GET["id"] : null;

if(isset($_GET["action"])){
    switch ($_GET["action"]) {
        case "defaultView" : $ctrlHome->defaultView(); break;
        case "aPropos" : $ctrlHome->aPropos(); break;
    } 
} else {
    // Si aucun paramètre "action" n'est défini, afficher la vue par défaut
    $ctrlHome->defaultView();
}