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
        if (isset($_POST['idPrestation']) && isset($_POST['datePrestation'])) {
            $idUtilisateur = $_SESSION['user_id'];  // ID de l'utilisateur connecté, récupéré depuis la session
            $idPrestation = $_POST['idPrestation'];
            $datePrestation = $_POST['datePrestation'];

            try {
                $this->reservationManager->createReservation($idUtilisateur, $idPrestation, $datePrestation);
                $_SESSION['MAJindex'] = "Réservation effectuée avec succès!";
            } catch (Exception $e) {
                $_SESSION['MAJindex'] = $e->getMessage();
            }
            
            header("Location: index.php?action=recap");
        }
    }
}