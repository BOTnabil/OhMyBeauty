<?php

namespace Controller; 
use App\Connect;

class HomeController {

    public function defaultView() {
        // Charger et afficher la vue par défaut
        include 'view/defaultView.php';
    }
}