<?php
namespace Model\Entities;

class Categorie {
    private $id_categorie;
    private $designation;

// Permet de construire un objet avec les arguments cités
    public function __construct($id_categorie, $designation) {
        $this->id_categorie = $id_categorie;
        $this->designation = $designation;
    }

//Getters et setters
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
     * Get the value of id_categorie
     */ 
    public function getIdCategorie()
    {
        return $this->idCategorie;
    }

    /**
     * Set the value of id_categorie
     *
     * @return  self
     */ 
    public function setIdCategorie($id_categorie)
    {
        $this->id_categorie = $id_categorie;

        return $this;
    }

// Méthodes
    public function __toString() {
        return $this->designation;
    }
}