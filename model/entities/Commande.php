<?php
namespace Model\Entities;

class Commande {
    private $id_commande;
    private $numeroCommande;
    private $dateCommande;
    private $prixTotal;
    private $id_utilisateur;
    private $infosCommande;

// Permet de construire un objet avec les arguments cités
    public function __construct($id_commande, $dateCommande, $prixTotal, $id_utilisateur) {
        $this->id_commande = $id_commande;
        $this->numeroCommande = $numeroCommande;
        $this->dateCommande = $dateCommande;
        $this->prixTotal = $prixTotal;
        $this->id_utilisateur = $id_utilisateur;
        $this->infosCommande = $infosCommande;
    }

//Getters et setters
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
     * Get the value of id_utilisateur
     */ 
    public function getIdUtilisateur()
    {
        return $this->id_utilisateur;
    }

    /**
     * Set the value of idUtilisateur
     *
     * @return  self
     */ 
    public function setIdUtilisateur($id_utilisateur)
    {
        $this->id_utilisateur = $id_utilisateur;

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
     * Get the value of numeroCommande
     */ 
    public function getNumeroCommande()
    {
        return $this->numeroCommande;
    }

    /**
     * Set the value of numeroCommande
     *
     * @return  self
     */ 
    public function setNumeroCommande($numeroCommande)
    {
        $this->numeroCommande = $numeroCommande;

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
     * Set the value of id_commande
     *
     * @return  self
     */ 
    public function setIdCommande($id_commande)
    {
        $this->id_commande = $id_commande;

        return $this;
    }
}
