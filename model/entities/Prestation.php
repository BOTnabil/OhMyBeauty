<?php
namespace Model\Entities;

class Prestation {
    private $idPrestation;
    private $designation;
    private $prix;
    private $idCategorie;
    private $duree;
    private $description;

    public function __construct($idPrestation, $designation, $prix, $idCategorie, $description, $duree) {
        $this->idPrestation = $idPrestation;
        $this->designation = $designation;
        $this->prix = $prix;
        $this->idCategorie = $idCategorie;
        $this->duree = $duree;
        $this->description = $description;
    }

    public function getIdPrestation() {
        return $this->idPrestation;
    }

    public function getDesignation() {
        return $this->designation;
    }

    public function getPrix() {
        return $this->prix;
    }

    public function getIdCategorie() {
        return $this->idCategorie;
    }

    public function getDuree() {
        return $this->duree;
    }

    public function getDescription() {
        return $this->description;
    }

    public function setDesignation($designation) {
        $this->designation = $designation;
        return $this;
    }

    public function setPrix($prix) {
        $this->prix = $prix;
        return $this;
    }

    public function setIdCategorie($idCategorie) {
        $this->idCategorie = $idCategorie;
        return $this;
    }

    public function setDuree($duree) {
        $this->duree = $duree;
        return $this;
    }
    
    public function setDescription($description) {
        $this->description = $description;
        return $this;
    }

    public function __toString() {
        return $this->designation;
    }
}
