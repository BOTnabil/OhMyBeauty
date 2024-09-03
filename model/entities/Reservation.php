<?php
namespace Model\Entities;

class Reservation {
    private $idUtilisateur;
    private $idPrestation;
    private $datePrestation;

    public function __construct($idUtilisateur, $idPrestation, $datePrestation) {
        $this->idUtilisateur = $idUtilisateur;
        $this->idPrestation = $idPrestation;
        $this->datePrestation = $datePrestation;
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
}
