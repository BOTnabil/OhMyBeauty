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

    public function __toString() {
        return $this->designation;
    }

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
}
