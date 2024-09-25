<?php
namespace Model\Entities;

class Contenir {
    private $id_commande;
    private $id_produit;
    private $quantite;

    public function __construct($id_commande, $id_produit, $quantite) {
        $this->id_commande = $id_commande;
        $this->id_produit = $id_produit;
        $this->quantite = $quantite;
    }

//Getters et setters
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
     * Get the value of id_commande
     */ 
    public function getIdCommande()
    {
        return $this->id_commande;
    }

    /**
     * Set the value of idCommande
     *
     * @return  self
     */ 
    public function setIdCommande($id_commande)
    {
        $this->id_commande = $id_commande;

        return $this;
    }
}
