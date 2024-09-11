<?php
namespace Model\Entities;

class Commande {
    private $idCommande;
    private $dateCommande;
    private $prixTotal;
    private $idUtilisateur;
    private $infosCommande;

    public function __construct($idCommande, $dateCommande, $prixTotal, $idUtilisateur) {
        $this->idCommande = $idCommande;
        $this->dateCommande = $dateCommande;
        $this->prixTotal = $prixTotal;
        $this->idUtilisateur = $idUtilisateur;
        $this->infosCommande = $infosCommande;
    }

    /**
     * Get the value of infosCommande
     */ 
    public function getInfosCommande()
    {
        return $this->infosCommande;
    }

    /**
     * Set the value of infosCommande
     *
     * @return  self
     */ 
    public function setInfosCommande($infosCommande)
    {
        $this->infosCommande = $infosCommande;

        return $this;
    }

    /**
     * Get the value of idUtilisateur
     */ 
    public function getIdUtilisateur()
    {
        return $this->idUtilisateur;
    }

    /**
     * Set the value of idUtilisateur
     *
     * @return  self
     */ 
    public function setIdUtilisateur($idUtilisateur)
    {
        $this->idUtilisateur = $idUtilisateur;

        return $this;
    }

    /**
     * Get the value of prixTotal
     */ 
    public function getPrixTotal()
    {
        return $this->prixTotal;
    }

    /**
     * Set the value of prixTotal
     *
     * @return  self
     */ 
    public function setPrixTotal($prixTotal)
    {
        $this->prixTotal = $prixTotal;

        return $this;
    }

    /**
     * Get the value of dateCommande
     */ 
    public function getDateCommande()
    {
        return $this->dateCommande;
    }

    /**
     * Set the value of dateCommande
     *
     * @return  self
     */ 
    public function setDateCommande($dateCommande)
    {
        $this->dateCommande = $dateCommande;

        return $this;
    }

    /**
     * Get the value of idCommande
     */ 
    public function getIdCommande()
    {
        return $this->idCommande;
    }

    /**
     * Set the value of idCommande
     *
     * @return  self
     */ 
    public function setIdCommande($idCommande)
    {
        $this->idCommande = $idCommande;

        return $this;
    }
}
