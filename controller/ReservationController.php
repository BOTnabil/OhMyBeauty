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

    public function Reservation() {
        if (isset($_POST['idPrestation']) && isset($_POST['datePrestation']) && isset($_POST['timeSlot'])) {
            $idUtilisateur = $_SESSION['user_id'];  // ID de l'utilisateur connecté, récupéré depuis la session
            $idPrestation = $_POST['idPrestation'];
            $datePrestation = $_POST['datePrestation'] . ' ' . $_POST['timeSlot'] . ':00';  // Combine la date et l'heure

            try {
                $this->reservationManager->createReservation($idUtilisateur, $idPrestation, $datePrestation);
                $_SESSION['MAJindex'] = "Réservation effectuée avec succès!";
            } catch (Exception $e) {
                $_SESSION['MAJindex'] = $e->getMessage();
            }
            
            header("Location:index.php?action=recap");
        }
    }

    public function ChooseTimeSlot() {
        if (isset($_POST['idPrestation']) && isset($_POST['datePrestation'])) {
            $idPrestation = $_POST['idPrestation'];
            $datePrestation = $_POST['datePrestation'];

            // Récupérer les créneaux horaires déjà réservés pour cette prestation et cette date
            $reservedSlots = $this->reservationManager->getReservedSlotsByDate($idPrestation, $datePrestation);

            require "view/chooseTimeSlotView.php"; // Page pour afficher les créneaux horaires
        }
    }

    public function CancelReservation() {
        if (isset($_POST['idPrestation'])) {
            $idPrestation = $_POST['idPrestation'];

            try {
                $this->reservationManager->cancelReservation($idPrestation);
                $_SESSION['MAJindex'] = "Réservation annulée avec succès!";
            } catch (Exception $e) {
                $_SESSION['MAJindex'] = $e->getMessage();
            }
            
            header("Location:index.php?action=recap");
        }
    }
}