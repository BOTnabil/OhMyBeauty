<?php
namespace Model\Entities;

class Categorie {
    private $idCategorie;
    private $designation;

    public function __construct($idCategorie, $designation) {
        $this->idCategorie = $idCategorie;
        $this->designation = $designation;
    }

    public function getIdCategorie() {
        return $this->idCategorie;
    }

    public function getDesignation() {
        return $this->designation;
    }

    public function setDesignation($designation) {
        $this->designation = $designation;
        return $this;
    }

    public function __toString() {
        return $this->designation;
    }
}