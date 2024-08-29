<?php
namespace Model\Managers;

use App\Connect;

class CommandeManager {
    
    private $db;

    public function __construct() {
        $this->db = Connect::seConnecter(); // Initialisation de la connexion à la base de données
    }

    // Méthode
    public function createCommande($prixTotal, $idUtilisateur) {
        $query = "
            INSERT INTO commande (dateCommande, prixTotal, idUtilisateur) 
            VALUES (NOW(), :prixTotal, :idUtilisateur)
        ";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':prixTotal', $prixTotal);
        $stmt->bindParam(':idUtilisateur', $idUtilisateur);
        $stmt->execute();

        return $this->db->lastInsertId(); // Return le nouvel ID
    }

    public function getCommandesByUtilisateur($idUtilisateur) {
        $query = "
            SELECT idCommande, dateCommande, prixTotal
            FROM commande
            WHERE idUtilisateur = :idUtilisateur
            ORDER BY dateCommande DESC
        ";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':idUtilisateur', $idUtilisateur, \PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    public function getCommandeDetails($idCommande) {
        $query = "
            SELECT p.designation, c.quantite, p.prix, (c.quantite * p.prix) as total
            FROM contenir c
            INNER JOIN produit p ON c.idProduit = p.idProduit
            WHERE c.idCommande = :idCommande
        ";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':idCommande', $idCommande, \PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll();
    }
}
