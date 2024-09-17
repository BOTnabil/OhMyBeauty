<?php

namespace Controller;

use Model\Managers\PrestationManager;
use Model\Managers\ReservationManager;
use DateTime;

class ReservationController {
    private $prestationManager;
    private $reservationManager;
    

    public function __construct() {
        $this->prestationManager = new PrestationManager();
        $this->reservationManager = new ReservationManager();
    }

    public function reserver() {
        // Réservation seulement si l'utilisateur est connecté
        if (isset($_SESSION['user_id'])) {
            if (isset($_POST['id_prestation']) && isset($_POST['datePrestation']) && isset($_POST['creneauHoraire'])) {
                $id_utilisateur = $_SESSION['user_id'];  // ID de l'utilisateur connecté
                $id_prestation = $_POST['id_prestation'];
                $datePrestation = $_POST['datePrestation'] . ' ' . $_POST['creneauHoraire'] . ':00';  // Combine la date et l'heure
    
                // Récupérer les informations sur la prestation
                $prestation = $this->prestationManager->obtenirPrestationParId($id_prestation);
    
                // Générer les informations de la réservation
                $infosReservation = $this->genererInfosReservationTexte($prestation, $_POST['datePrestation'], $_POST['creneauHoraire']);
    
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
        if (isset($_SESSION['user_id'])) {
            if (isset($_POST['id_prestation']) && isset($_POST['datePrestation'])) {
                $id_prestation = $_POST['id_prestation'];
                $datePrestation = $_POST['datePrestation'];
                $id_utilisateur = $_SESSION['user_id'];
        
                // Récupérer les créneaux réservés par tous les utilisateurs
                $creneauxReserves = $this->reservationManager->obtenirCreneauxReservesParDate($id_prestation, $datePrestation);
        
                // Récupérer les créneaux réservés par l'utilisateur lui-même à cette date
                $creneauxReservesUtilisateur = $this->reservationManager->obtenirCreneauxReservesUtilisateurParDate($id_utilisateur, $datePrestation);
        
                require "view/vueChoisirCreneau.php"; // Page pour afficher les créneaux horaires disponibles
            } 
        } else {
            header("Location: index.php?action=connexion");
        }
    }

    public function annulerReservation() {
        if (isset($_POST['id_prestation'])) {
            $id_prestation = $_POST['id_prestation'];

            $this->reservationManager->annulerReservation($id_prestation);
            $_SESSION['MAJrdv'] = "Réservation annulée avec succès!";
            
            header("Location:index.php?action=recap");
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

    private function genererInfosReservationTexte($prestation, $datePrestation, $creneauHoraire) {
        // Générer le texte pour infosReservation
        $infos = "Prestation: " . $prestation['designation'] . "\n";
        $infos .= "Date: " . date('d/m/Y', strtotime($datePrestation)) . "\n";
        $infos .= "Créneau horaire: " . $creneauHoraire . "\n";
        $infos .= "Durée: " . $prestation['duree'] . "\n";
        $infos .= "Prix: " . $prestation['prix'] . " €";
        
        return $infos;
    }
}