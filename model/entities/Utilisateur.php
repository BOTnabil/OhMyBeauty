<?php
namespace Model\Entities;

class Utilisateur {
    private $idUtilisateur;
    private $nom;
    private $prenom;
    private $email;
    private $motDePasse;
    private $role;

    public function __construct($idUtilisateur, $nom, $prenom, $email, $motDePasse, $role) {
        $this->idUtilisateur = $idUtilisateur;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->email = $email;
        $this->motDePasse = $motDePasse;
        $this->role = $role;
    }

    public function getIdUtilisateur() {
        return $this->idUtilisateur;
    }

    public function getNom() {
        return $this->nom;
    }

    public function getPrenom() {
        return $this->prenom;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getMotDePasse() {
        return $this->motDePasse;
    }

    public function getRole() {
        return $this->role;
    }

    public function setNom($nom) {
        $this->nom = $nom;
        return $this;
    }

    public function setPrenom($prenom) {
        $this->prenom = $prenom;
        return $this;
    }

    public function setEmail($email) {
        $this->email = $email;
        return $this;
    }

    public function setMotDePasse($motDePasse) {
        $this->motDePasse = $motDePasse;
        return $this;
    }

    public function setRole($role) {
        $this->role = $role;
        return $this;
    }
}
