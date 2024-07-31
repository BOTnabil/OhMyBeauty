<?php

namespace Controller; 
use Model\Connect;

class HomeController {

    public function defaultView() {
        // Charger et afficher la vue par défaut
        include 'view/defaultView.php';
    }
}