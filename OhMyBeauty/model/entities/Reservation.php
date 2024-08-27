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

    public function getIdUtilisateur() {
        return $this->idUtilisateur;
    }

    public function getIdPrestation() {
        return $this->idPrestation;
    }

    public function getDatePrestation() {
        return $this->datePrestation;
    }

    public function setIdUtilisateur($idUtilisateur) {
        $this->idUtilisateur = $idUtilisateur;
        return $this;
    }

    public function setIdPrestation($idPrestation) {
        $this->idPrestation = $idPrestation;
        return $this;
    }

    public function setDatePrestation($datePrestation) {
        $this->datePrestation = $datePrestation;
        return $this;
    }
}
