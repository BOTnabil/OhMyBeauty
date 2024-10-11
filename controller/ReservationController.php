<?php

namespace Controller;

use Model\Managers\PrestationManager;
use Model\Managers\ReservationManager;
use App\Session;
use DateTime;

class ReservationController {
    private $prestationManager;
    private $reservationManager;
    

    public function __construct() {
        $this->prestationManager = new PrestationManager();
        $this->reservationManager = new ReservationManager();
    }

//Méthodes
    public function reserver() {
        // Réservation seulement si l'utilisateur est connecté
        if (isset($_SESSION['user_id'])) {
            if (isset($_POST['id_prestation']) && isset($_POST['datePrestation']) && isset($_POST['creneauHoraire'])) {
                $id_utilisateur = $_SESSION['user_id'];  // ID de l'utilisateur connecté
                $nom = filter_input(INPUT_POST, 'nom', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $prenom = filter_input(INPUT_POST, 'prenom', FILTER_SANITIZE_FULL_SPECIAL_CHARS);    
                $id_prestation = $_POST['id_prestation'];
                $datePrestation = $_POST['datePrestation'] . ' ' . $_POST['creneauHoraire'] . ':00';  // Combine la date et l'heure
    
                // Récupérer les informations sur la prestation
                $prestation = $this->prestationManager->obtenirPrestationParId($id_prestation);
    
                // Générer les informations de la réservation
                $infosReservation = $this->genererInfosReservationTexte($prestation, $_POST['datePrestation'], $_POST['creneauHoraire'], $nom, $prenom);
    
                // Créer la nouvelle réservation avec les infos générées
                $this->reservationManager->creerReservation($id_utilisateur, $id_prestation, $datePrestation, $infosReservation);
    
                // Message de confirmation
                $_SESSION['MAJrdv'] = "Réservation effectuée avec succès!";
                header("Location: index.php?action=recap");
                exit;
            }
        } else {
            header("Location: index.php?action=connexion");
        }
    }
    
    
    public function choisirCreneau() {
        //On récupère l'id de l'utilisateur, l'id de la presta et la date que l'on a choisi au préalable
        if (isset($_POST['id_prestation']) && isset($_POST['datePrestation']) && isset($_SESSION['user_id'])) {
            $id_prestation = $_POST['id_prestation'];
            $datePrestation = $_POST['datePrestation'];
            $id_utilisateur = $_SESSION['user_id'];
    
            // Récupérer les créneaux réservés par tous les utilisateurs
            $creneauxReserves = $this->reservationManager->obtenirCreneauxReservesParDate($id_prestation, $datePrestation);
    
            require "view/vueChoisirCreneau.php"; // Page pour afficher les créneaux horaires disponibles
        } else {
            header("Location: index.php?action=connexion");
        }
    }

    public function annulerReservationProcess() {
        if (isset($_POST['id_reservation'])) {
            $id_reservation = $_POST['id_reservation'];
            
            // Supprimer la réservation spécifique
            $this->reservationManager->annulerReservation($id_reservation);
            $_SESSION['MAJrdv'] = "Réservation annulée avec succès!";
            
            // Vérifier la provenance de la requête
            if (isset($_POST['source']) && $_POST['source'] === 'recapUtilisateur') {
                // Si la requête provient de recapUtilisateur
                header("Location:index.php?action=recap");
            } else if (Session::estAdmin() && isset($_POST['source']) && $_POST['source'] === 'vueCalendrier') {
                // Si la requête provient de vueCalendrier
                if (isset($_POST['prestations'])) {
                    $prestationsSelectionnees = implode('&prestations%5B%5D=', $_POST['prestations']);
                    $prestationsSelectionnees .= "&action=voirRendezVous";
                    header("Location: index.php?action=voirRendezVous&prestations%5B%5D=$prestationsSelectionnees");
                }
            }
        }
    }
     


    public function estAnnulable($datePrestation) {
        $dateActuelle = new DateTime();
        $datePrestation = new DateTime($datePrestation);

        // Calcul de la différence en jours
        $differenceJours = $dateActuelle->diff($datePrestation)->days;

        // Vérifier si la réservation est annulable (plus de 3 j)
        return ($dateActuelle < $datePrestation && $differenceJours >= 3);
    }

    public function supprimerReservationsPassees() {
        // Appeler la méthode dans le manager
        $this->reservationManager->supprimerReservationsPassees();
    }

    private function genererInfosReservationTexte($prestation, $datePrestation, $creneauHoraire, $nom, $prenom) {
        // Générer le texte pour infosReservation
        $infos = "Nom : " . $nom . " " . $prenom . " | ";
        $infos .= "Prestation : " . $prestation['designation'] . " | ";
        $infos .= "Créneau horaire : " . $creneauHoraire . " | ";
        $infos .= "Durée : " . $prestation['duree'] . " | ";
        $infos .= "Prix : " . $prestation['prix'] . " €";
        
        return $infos;
    }
}