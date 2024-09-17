<?php
namespace Model\Managers;

use App\Connect;

class ContenirManager {
    
    private $db;

    public function __construct() {
        $this->db = Connect::seConnecter(); // Initialisation de la connexion à la base de données
    }

    // Méthodes
    public function ajouterProduitACommande($id_commande, $id_produit, $quantite) {
        $requete = "
            INSERT INTO contenir (id_commande, id_produit, quantite) 
            VALUES (:id_commande, :id_produit, :quantite)
        ";
        $stmt = $this->db->prepare($requete);
        $stmt->bindParam(':id_commande', $id_commande, \PDO::PARAM_INT);
        $stmt->bindParam(':id_produit', $id_produit, \PDO::PARAM_INT);
        $stmt->bindParam(':quantite', $quantite, \PDO::PARAM_INT);
        $stmt->execute();
    }

    public function supprimerProduitDeContenir($id_produit) {
        $requete = "
            UPDATE contenir
            SET id_produit = NULL
            WHERE id_produit = :id_produit
        ";
        $stmt = $this->db->prepare($requete);
        $stmt->bindParam(':id_produit', $id_produit, \PDO::PARAM_INT);
        $stmt->execute();
    }
    
}
