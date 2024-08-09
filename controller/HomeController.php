<?php

namespace Controller;

class HomeController {

    public function defaultView() {
        // Charger et afficher la vue par défaut
        require 'view/defaultView.php';
    }

    public function aPropos() {
        // Charger et afficher la vue a propos
        require 'view/aPropos.php';
    }
}