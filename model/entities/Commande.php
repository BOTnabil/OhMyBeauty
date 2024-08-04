<?php
namespace Model\Entities;

class Commande {
    private $idCommande;
    private $dateCommande;
    private $prixTotal;
    private $idUtilisateur;

    public function __construct($idCommande, $dateCommande, $prixTotal, $idUtilisateur) {
        $this->idCommande = $idCommande;
        $this->dateCommande = $dateCommande;
        $this->prixTotal = $prixTotal;
        $this->idUtilisateur = $idUtilisateur;
    }

    public function getIdCommande() {
        return $this->idCommande;
    }

    public function getDateCommande() {
        return $this->dateCommande;
    }

    public function getPrixTotal() {
        return $this->prixTotal;
    }

    public function getIdUtilisteur() {
        return $this->idUtilisateur;
    }

    public function setDateCommande($dateCommande) {
        $this->dateCommande = $dateCommande;
        return $this;
    }

    public function setPrixTotal($prixTotal) {
        $this->prixTotal = $prixTotal;
        return $this;
    }

    public function setIdUtilisateur($idUtilisateur) {
        $this->idUtilisateur = $idUtilisateur;
        return $this;
    }
}
