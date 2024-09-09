<?php
namespace Model\Managers;

use App\Connect;

class CommandeManager {
    
    private $db;

    public function __construct() {
        $this->db = Connect::seConnecter(); // Initialisation de la connexion à la base de données
    }

    // Méthode pour créer une nouvelle commande
    public function creerCommande($prixTotal, $idUtilisateur) {
        $requete = "
            INSERT INTO commande (dateCommande, prixTotal, idUtilisateur) 
            VALUES (NOW(), :prixTotal, :idUtilisateur)
        ";
        $stmt = $this->db->prepare($requete);
        $stmt->bindParam(':prixTotal', $prixTotal, \PDO::PARAM_INT);
        $stmt->bindParam(':idUtilisateur', $idUtilisateur, \PDO::PARAM_INT);
        $stmt->execute();

        return $this->db->lastInsertId(); // Retourne l'ID de la nouvelle commande
    }

    // Méthode pour obtenir les commandes d'un utilisateur spécifique
    public function obtenirCommandesParUtilisateur($idUtilisateur) {
        $requete = "
            SELECT idCommande, dateCommande, prixTotal
            FROM commande
            WHERE idUtilisateur = :idUtilisateur
            ORDER BY dateCommande DESC
        ";
        $stmt = $this->db->prepare($requete);
        $stmt->bindParam(':idUtilisateur', $idUtilisateur, \PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    // Méthode pour obtenir les détails d'une commande spécifique
    public function obtenirDetailsCommande($idCommande) {
        $requete = "
            SELECT p.designation, c.quantite, p.prix, (c.quantite * p.prix) as total
            FROM contenir c
            INNER JOIN produit p ON c.idProduit = p.idProduit
            WHERE c.idCommande = :idCommande
        ";
        $stmt = $this->db->prepare($requete);
        $stmt->bindParam(':idCommande', $idCommande, \PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll();
    }
}
