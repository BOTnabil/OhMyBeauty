<?php

namespace Controller;

use Model\Managers\PrestationManager;
use Model\Managers\ReservationManager;

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
                var_dump("ok");
                $idUtilisateur = $_SESSION['user_id'];  // ID de l'utilisateur connecté, récupéré depuis la session
                $idPrestation = $_POST['idPrestation'];
                $datePrestation = $_POST['datePrestation'] . ' ' . $_POST['creneauHoraire'] . ':00';  // Combine la date et l'heure

                $this->reservationManager->creerReservation($idUtilisateur, $idPrestation, $datePrestation);
                $_SESSION['MAJindex'] = "Réservation effectuée avec succès!";
                var_dump('ok');
                header("Location:index.php?action=recap");
            }
        }
    }

    public function choisirCreneau() {
        if (isset($_POST['idPrestation']) && isset($_POST['datePrestation'])) {
            $idPrestation = $_POST['idPrestation'];
            $datePrestation = $_POST['datePrestation'];

            // Utilisation de la méthode pour récupérer les créneaux horaires réservés
            $creneauxReserves = $this->reservationManager->obtenirCreneauxReservesParDate($idPrestation, $datePrestation);

            require "view/vueChoisirCreneau.php"; // Page pour afficher les créneaux horaires disponibles
        }
    }

    public function annulerReservation() {
        if (isset($_POST['idPrestation'])) {
            $idPrestation = $_POST['idPrestation'];

            $this->reservationManager->annulerReservation($idPrestation);
            $_SESSION['MAJindex'] = "Réservation annulée avec succès!";
            
            header("Location:index.php?action=recap");
        }
    }
}
