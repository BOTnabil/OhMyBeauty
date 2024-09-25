<?php
namespace Model\Entities;

class Prestation {
    private $id_prestation;
    private $designation;
    private $prix;
    private $id_categorie;
    private $duree;
    private $description;

// Permet de construire un objet avec les arguments cités
    public function __construct($id_prestation, $designation, $prix, $id_categorie, $description, $duree) {
        $this->id_prestation = $id_prestation;
        $this->designation = $designation;
        $this->prix = $prix;
        $this->id_categorie = $id_categorie;
        $this->duree = $duree;
        $this->description = $description;
    }

//Getters et setters
    /**
     * Get the value of description
     */ 
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the value of description
     *
     * @return  self
     */ 
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get the value of duree
     */ 
    public function getDuree()
    {
        return $this->duree;
    }

    /**
     * Set the value of duree
     *
     * @return  self
     */ 
    public function setDuree($duree)
    {
        $this->duree = $duree;

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
     * Set the value of id_categorie
     *
     * @return  self
     */ 
    public function setIdCategorie($id_categorie)
    {
        $this->id_categorie = $id_categorie;

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
     * Get the value of id_prestation
     */ 
    public function getIdPrestation()
    {
        return $this->id_prestation;
    }

    /**
     * Set the value of idPrestation
     *
     * @return  self
     */ 
    public function setIdPrestation($id_prestation)
    {
        $this->id_prestation = $id_prestation;

        return $this;
    }

//Méthodes
    public function __toString() {
        return $this->designation;
    }
}
