<?php
namespace Model\Entities;

class Contenir {
    private $idCommande;
    private $idProduit;
    private $quantite;

    public function __construct($idCommande, $idProduit, $quantite) {
        $this->idCommande = $idCommande;
        $this->idProduit = $idProduit;
        $this->quantite = $quantite;
    }

    /**
     * Get the value of quantite
     */ 
    public function getQuantite()
    {
        return $this->quantite;
    }

    /**
     * Set the value of quantite
     *
     * @return  self
     */ 
    public function setQuantite($quantite)
    {
        $this->quantite = $quantite;

        return $this;
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
