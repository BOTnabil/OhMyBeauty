<?php
namespace Model\Entities;

class Prestation {
    private $idPrestation;
    private $designation;
    private $prix;
    private $idCategorie;

    public function __construct($idPrestation, $designation, $prix, $idCategorie) {
        $this->idPrestation = $idPrestation;
        $this->designation = $designation;
        $this->prix = $prix;
        $this->idCategorie = $idCategorie;
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

    public function __toString() {
        return $this->designation;
    }
}
