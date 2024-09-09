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

                // Vérifier si l'utilisateur a déjà réservé cette prestation dans le futur
                if ($this->reservationManager->verifierReservationExistante($idUtilisateur, $idPrestation)) {
                    $_SESSION['erreur'] = "Vous avez déjà une réservation pour cette prestation dans le futur.";
                    header("Location:index.php?action=prestations");
                    die;
                }

                // Vérifier si l'utilisateur a déjà une réservation à ce créneau
                if ($this->reservationManager->verifierReservationPourCreneau($idUtilisateur, $datePrestation)) {
                    $_SESSION['erreur'] = "Vous avez déjà une réservation à ce créneau horaire.";
                    header("Location:index.php?action=prestations");
                    die;
                }

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

            // Utilisation de la méthode pour récupérer les créneaux horaires réservés
            $creneauxReserves = $this->reservationManager->obtenirCreneauxReservesParDate($idPrestation, $datePrestation);

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