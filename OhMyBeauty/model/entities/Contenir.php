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

    public function getIdCommande() {
        return $this->idCommande;
    }

    public function getIdProduit() {
        return $this->idProduit;
    }

    public function getQuantite() {
        return $this->quantite;
    }

    public function setIdCommande($idCommande) {
        $this->idCommande = $idCommande;
        return $this;
    }

    public function setIdProduit($idProduit) {
        $this->idProduit = $idProduit;
        return $this;
    }

    public function setQuantite($quantite) {
        $this->quantite = $quantite;
        return $this;
    }
}
