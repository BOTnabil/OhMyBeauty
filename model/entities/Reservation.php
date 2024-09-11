<?php
namespace Model\Entities;

class Reservation {
    private $idReservation;
    private $idUtilisateur;
    private $idPrestation;
    private $datePrestation;
    private $infosReservation;

    public function __construct($idReservation, $idUtilisateur, $idPrestation, $datePrestation, $infosReservation) {
        $this->idReservation = $idReservation;
        $this->idUtilisateur = $idUtilisateur;
        $this->idPrestation = $idPrestation;
        $this->datePrestation = $datePrestation;
        $this->infosReservation = $infosReservation;
    }

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
     * Get the value of idPrestation
     */ 
    public function getIdPrestation()
    {
        return $this->idPrestation;
    }

    /**
     * Set the value of idPrestation
     *
     * @return  self
     */ 
    public function setIdPrestation($idPrestation)
    {
        $this->idPrestation = $idPrestation;

        return $this;
    }

    /**
     * Get the value of idUtilisateur
     */ 
    public function getIdUtilisateur()
    {
        return $this->idUtilisateur;
    }

    /**
     * Set the value of idUtilisateur
     *
     * @return  self
     */ 
    public function setIdUtilisateur($idUtilisateur)
    {
        $this->idUtilisateur = $idUtilisateur;

        return $this;
    }

    /**
     * Get the value of idReservation
     */ 
    public function getIdReservation()
    {
        return $this->idReservation;
    }

    /**
     * Set the value of idReservation
     *
     * @return  self
     */ 
    public function setIdReservation($idReservation)
    {
        $this->idReservation = $idReservation;

        return $this;
    }
}
