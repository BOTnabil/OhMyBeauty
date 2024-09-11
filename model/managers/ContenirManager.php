<?php
namespace Model\Managers;

use App\Connect;

class ContenirManager {
    
    private $db;

    public function __construct() {
        $this->db = Connect::seConnecter(); // Initialisation de la connexion à la base de données
    }

    // Méthodes
    public function ajouterProduitACommande($idCommande, $idProduit, $quantite) {
        $requete = "
            INSERT INTO contenir (idCommande, idProduit, quantite) 
            VALUES (:idCommande, :idProduit, :quantite)
        ";
        $stmt = $this->db->prepare($requete);
        $stmt->bindParam(':idCommande', $idCommande, \PDO::PARAM_INT);
        $stmt->bindParam(':idProduit', $idProduit, \PDO::PARAM_INT);
        $stmt->bindParam(':quantite', $quantite, \PDO::PARAM_INT);
        $stmt->execute();
    }

    public function supprimerProduitDeContenir($idProduit) {
        $requete = "
            UPDATE contenir
            SET idProduit = NULL
            WHERE idProduit = :idProduit
        ";
        $stmt = $this->db->prepare($requete);
        $stmt->bindParam(':idProduit', $idProduit, \PDO::PARAM_INT);
        $stmt->execute();
    }
    
}
