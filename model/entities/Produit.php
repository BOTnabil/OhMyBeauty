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

    public function __toString() {
        return $this->designation;
    }

    /**
     * Get the value of idProduit
     */ 
    public function getIdProduit()
    {
        return $this->idProduit;
    }

    /**
     * Set the value of idProduit
     *
     * @return  self
     */ 
    public function setIdProduit($idProduit)
    {
        $this->idProduit = $idProduit;

        return $this;
    }

    /**
     * Get the value of designation
     */ 
    public function getDesignation()
    {
        return $this->designation;
    }

    /**
     * Set the value of designation
     *
     * @return  self
     */ 
    public function setDesignation($designation)
    {
        $this->designation = $designation;

        return $this;
    }

    /**
     * Get the value of prix
     */ 
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * Set the value of prix
     *
     * @return  self
     */ 
    public function setPrix($prix)
    {
        $this->prix = $prix;

        return $this;
    }

    /**
     * Get the value of image
     */ 
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set the value of image
     *
     * @return  self
     */ 
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get the value of idCategorie
     */ 
    public function getIdCategorie()
    {
        return $this->idCategorie;
    }

    /**
     * Set the value of idCategorie
     *
     * @return  self
     */ 
    public function setIdCategorie($idCategorie)
    {
        $this->idCategorie = $idCategorie;

        return $this;
    }
}
