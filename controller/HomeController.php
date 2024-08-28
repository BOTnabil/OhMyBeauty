<?php

namespace Controller;

class HomeController {

    public function defaultView() {
        // Charger et afficher la vue par défaut
        require 'view/defaultView.php';
    }

    public function aPropos() {
        // Charger et afficher la vue a propos
        require 'view/aProposView.php';
    }
    public function contact() {
        // Charger et afficher la vue contact
        require 'view/contactView.php';
    }

    public function services() {
        // Charger et afficher la vue service
        require 'view/servicesView.php';
    }

    public function shop() {
        // Charger et afficher la vue service
        require 'view/shopView.php';
    }

    public function contactSubmit() {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $nom = filter_input(INPUT_POST, 'nom');
            $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
            $message = filter_input(INPUT_POST, 'message');
    
            if ($nom && $email && $message) {
                $to = "assatour.nabil@gmail.com";
                $subject = "Nouveau message de $nom";
                $body = "Nom: $nom\nEmail: $email\n\nMessage:\n$message";
                $headers = "From: $email";
    
                if (mail($to, $subject, $body, $headers)) {
                    echo "";
                } else {
                    echo "";
                }
            } else {
                echo "";
            }
            require 'view/contactView.php';
        }
    }
}