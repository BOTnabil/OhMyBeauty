<?php
namespace Model\Managers;

use App\Connect;

class ContenirManager {
    
    private $db;

    public function __construct() {
        $this->db = Connect::seConnecter(); // Initialisation de la connexion à la base de données
    }

    // Méthodes
    public function addProductToCommande($idCommande, $idProduit, $quantite) {
        $query = "
            INSERT INTO contenir (idCommande, idProduit, quantite) 
            VALUES (:idCommande, :idProduit, :quantite)
        ";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':idCommande', $idCommande);
        $stmt->bindParam(':idProduit', $idProduit);
        $stmt->bindParam(':quantite', $quantite);
        $stmt->execute();
    }
}
