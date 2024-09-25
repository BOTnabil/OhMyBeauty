<?php
namespace Model\Entities;

class Reservation {
    private $id_reservation;
    private $id_utilisateur;
    private $id_prestation;
    private $datePrestation;
    private $infosReservation;

// Permet de construire un objet avec les arguments cités
    public function __construct($id_reservation, $id_utilisateur, $id_prestation, $datePrestation, $infosReservation) {
        $this->id_reservation = $id_reservation;
        $this->id_utilisateur = $id_utilisateur;
        $this->id_prestation = $id_prestation;
        $this->datePrestation = $datePrestation;
        $this->infosReservation = $infosReservation;
    }


//Getters et setters
    /**
     * Get the value of infosReservation
     */ 
    public function getInfosReservation()
    {
        return $this->infosReservation;
    }

    /**
     * Set the value of infosReservation
     *
     * @return  self
     */ 
    public function setInfosReservation($infosReservation)
    {
        $this->infosReservation = $infosReservation;

        return $this;
    }

    /**
     * Get the value of datePrestation
     */ 
    public function getDatePrestation()
    {
        return $this->datePrestation;
    }

    /**
     * Set the value of datePrestation
     *
     * @return  self
     */ 
    public function setDatePrestation($datePrestation)
    {
        $this->datePrestation = $datePrestation;

        return $this;
    }

    /**
     * Get the value of id_prestation
     */ 
    public function getIdPrestation()
    {
        return $this->id_prestation;
    }

    /**
     * Set the value of idPrestation
     *
     * @return  self
     */ 
    public function setIdPrestation($id_prestation)
    {
        $this->id_prestation = $id_prestation;

        return $this;
    }

    /**
     * Get the value of id_utilisateur
     */ 
    public function getIdUtilisateur()
    {
        return $this->id_utilisateur;
    }

    /**
     * Set the value of id_utilisateur
     *
     * @return  self
     */ 
    public function setIdUtilisateur($id_utilisateur)
    {
        $this->id_utilisateur = $id_utilisateur;

        return $this;
    }

    /**
     * Get the value of id_reservation
     */ 
    public function getIdReservation()
    {
        return $this->id_reservation;
    }

    /**
     * Set the value of id_reservation
     *
     * @return  self
     */ 
    public function setIdReservation($id_reservation)
    {
        $this->id_reservation = $id_reservation;

        return $this;
    }
}
