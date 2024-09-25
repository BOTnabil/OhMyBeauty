<?php
namespace Model\Entities;

class Produit {
    private $id_produit;
    private $designation;
    private $prix;
    private $image;
    private $id_categorie;

    public function __construct($id_produit, $designation, $prix, $image, $id_categorie) {
        $this->id_produit = $id_produit;
        $this->designation = $designation;
        $this->prix = $prix;
        $this->image = $image;
        $this->id_categorie = $id_categorie;
    }

    public function __toString() {
        return $this->designation;
    }


//Getters et setters
    /**
     * Get the value of id_produit
     */ 
    public function getIdProduit()
    {
        return $this->id_produit;
    }

    /**
     * Set the value of id_produit
     *
     * @return  self
     */ 
    public function setIdProduit($id_produit)
    {
        $this->id_produit = $id_produit;

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
     * Get the value of id_categorie
     */ 
    public function getIdCategorie()
    {
        return $this->id_categorie;
    }

    /**
     * Set the value of idCategorie
     *
     * @return  self
     */ 
    public function setIdCategorie($id_categorie)
    {
        $this->id_categorie = $id_categorie;

        return $this;
    }
}
