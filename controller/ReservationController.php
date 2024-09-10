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
            if (isset($_POST['idPrestation']) && isset($_POST['datePrestation']) && isset($_POST['creneauHoraire'])) {
                $idUtilisateur = $_SESSION['user_id'];  // ID de l'utilisateur connecté
                $idPrestation = $_POST['idPrestation'];
                $datePrestation = $_POST['datePrestation'] . ' ' . $_POST['creneauHoraire'] . ':00';  // Combine la date et l'heure

                // Créer la nouvelle réservation si aucune réservation similaire n'existe
                $this->reservationManager->creerReservation($idUtilisateur, $idPrestation, $datePrestation);
                $_SESSION['MAJrdv'] = "Réservation effectuée avec succès!";
                header("Location:index.php?action=recap");
            }
        }
    }
    
    public function choisirCreneau() {
        if (isset($_POST['idPrestation']) && isset($_POST['datePrestation'])) {
            $idPrestation = $_POST['idPrestation'];
            $datePrestation = $_POST['datePrestation'];
            $idUtilisateur = $_SESSION['user_id'];
    
            // Récupérer les créneaux réservés par tous les utilisateurs
            $creneauxReserves = $this->reservationManager->obtenirCreneauxReservesParDate($idPrestation, $datePrestation);
    
            // Récupérer les créneaux réservés par l'utilisateur lui-même à cette date
            $creneauxReservesUtilisateur = $this->reservationManager->obtenirCreneauxReservesUtilisateurParDate($idUtilisateur, $datePrestation);
    
            require "view/vueChoisirCreneau.php"; // Page pour afficher les créneaux horaires disponibles
        }
    }

    public function annulerReservation() {
        if (isset($_POST['idPrestation'])) {
            $idPrestation = $_POST['idPrestation'];

            $this->reservationManager->annulerReservation($idPrestation);
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
}