<?php
namespace Model\Entities;

class Produit {
    private $idProduit;
    private $designation;
    private $prix;
    private $image;
    private $idCategorie;

    public function __construct($idProduit, $designation, $prix, $image, $idCategorie) {
        $this->idProduit = $idProduit;
        $this->designation = $designation;
        $this->prix = $prix;
        $this->image = $image;
        $this->idCategorie = $idCategorie;
    }

    public function getIdProduit() {
        return $this->idProduit;
    }

    public function getDesignation() {
        return $this->designation;
    }

    public function getPrix() {
        return $this->prix;
    }

    public function getImage() {
        return $this->image;
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

    public function setImage($image) {
        $this->image = $image;
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
