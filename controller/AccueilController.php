<?php

namespace Controller;

class AccueilController {

//Méthodes
    public function afficherHome() {
        // Charger et afficher la vue par défaut
        require 'view/home.php';
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
    
    public function afficherConnexion() {
        // Charger et afficher la vue connexion
        require "view/vueConnexion.php";
    }

    public function afficherInscription() {
        // Charger et afficher la vue inscription
        require "view/vueInscription.php";
    }

    public function afficherPanier() {
        // Charger et afficher la vue panier
        require "view/vuePanier.php";
    }
    

    public function envoyerMail() {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            // Récupérer et filtrer les données du formulaire
            $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
            $sujet = filter_input(INPUT_POST, 'sujet', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $message = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            
            if ($email && $sujet && $message) {
                $destinataire = "assatour.nabil@gmail.com";  // Adresse de destination
                $headers = "From: $email\r\n";  // L'adresse de l'expéditeur
                $contenu = "Email de l'expéditeur: $email\n\nSujet: $sujet\n\nMessage:\n$message";
    
                // Envoyer l'email
                if (mail($destinataire, $sujet, $contenu, $headers)) {
                    $_SESSION['MAJcontact'] = "Votre message a bien été envoyé.";
                    header("Location: index.php?action=contact");
                } else {
                    $_SESSION['MAJcontact'] = "Une erreur est survenue lors de l'envoi du message.";
                    header("Location: index.php?action=contact");
                }
            } else {
                $_SESSION['MAJcontact'] = "Veuillez remplir tous les champs correctement.";
            }
            // Redirection après traitement
            header("Location: index.php?action=contact");
            exit;
        }
    }
    

    function genererRecuPDF($detailsCommande) {
        // Implémentation de la génération du PDF de reçu
    }
}
