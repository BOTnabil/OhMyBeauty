<?php

namespace Controller;

class AccueilController {

    public function afficherParDefaut() {
        // Charger et afficher la vue par défaut
        require 'view/vueParDefaut.php';
    }

    public function afficherAPropos() {
        // Charger et afficher la vue à propos
        require 'view/vueAPropos.php';
    }
    
    public function afficherContact() {
        // Charger et afficher la vue contact
        require 'view/vueContact.php';
    }

    public function afficherPrestations() {
        // Charger et afficher la vue prestations
        require 'view/vuePrestations.php';
    }

    public function afficherBoutique() {
        // Charger et afficher la vue boutique
        require 'view/vueBoutique.php';
    }

    public function afficherRecap() {
        // Charger et afficher la vue récapitulatif
        require "view/vueRecapUtilisateur.php";
    }

    public function envoyerContact() {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $nom = filter_input(INPUT_POST, 'nom');
            $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
            $message = filter_input(INPUT_POST, 'message');
    
            if ($nom && $email && $message) {
                $destinataire = "assatour.nabil@gmail.com";
                $sujet = "Nouveau message de $nom";
                $contenu = "Nom: $nom\nEmail: $email\n\nMessage:\n$message";
                $entetes = "From: $email";
    
                if (mail($destinataire, $sujet, $contenu, $entetes)) {
                    echo ""; // message de confirmation ici
                } else {
                    echo ""; // message d'erreur ici
                }
            } else {
                echo ""; // d'erreur pour les champs vides
            }
            require 'view/vueContact.php';
        }
    }

    function genererRecuPDF($detailsCommande) {
        // Implémentation de la génération du PDF de reçu
    }
}
