<?php

namespace Controller;

require_once './dompdf/autoload.inc.php';

use Dompdf\Dompdf;
use Model\Managers\CommandeManager;

class AccueilController {

    private $commandeManager;

    public function __construct() {
        $this->commandeManager = new CommandeManager();
    }

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
    
    public function telechargerFacture() {
        // Récupérer les informations de la commande
        $id_commande = filter_input(INPUT_POST, 'id_commande', FILTER_VALIDATE_INT);
        $commande = $this->commandeManager->obtenirCommandeParId($id_commande);
        
        if ($commande) {
            // Initialise Dompdf
            $dompdf = new Dompdf();
    
            // Crée le contenu HTML de la facture
            $html = "<h1>Facture de la commande n°" . $commande['numeroCommande'] . "</h1><br>
            <p>Date : " . $commande['dateCommande'] . "</p><br>
            <p>" . $commande['infosCommande'] . "</p><br>
            <p>Total : " . $commande['prixTotal'] . " €</p>";
    
            // Charge le HTML dans Dompdf
            $dompdf->loadHtml($html);
    
            // Option de taille du papier
            $dompdf->setPaper('A4', 'portrait');
    
            // Rend le PDF
            $dompdf->render();
    
            // Renomme le fichier avec le numéro de commande
            $nomFichier = "facture_" . $commande['numeroCommande'] . ".pdf";
    
            // Sortie du PDF avec nom personnalisé
            $dompdf->stream($nomFichier);
        }
    }    
}
