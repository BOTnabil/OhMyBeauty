<?php
namespace Model\Managers;

use App\Connect;

class ProduitManager {
    
    private $db;

    public function __construct() {
        $this->db = Connect::seConnecter(); // Initialisation de la connexion à la base de données
    }

    public function getProduitById($idProduit) {
        $query = "
            SELECT idProduit, designation, prix 
            FROM produit 
            WHERE idProduit = :idProduit
        ";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':idProduit', $idProduit, \PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch();
    }

    // Méthode pour obtenir tous les produits d'une catégorie spécifique
    public function getProduitsByCategorie($idCategorie) {
        $query = "
            SELECT p.designation, p.prix 
            FROM produit p
            INNER JOIN categorie c ON c.idCategorie = p.idCategorie
            WHERE c.idCategorie = $idCategorie
        ";
        $result = $this->db->query($query);

        return $result->fetchAll();
    }

    // Méthode pour obtenir toutes les catégories avec leurs produits
    public function getAllCategoriesWithProduits() {
        $query = "
            SELECT c.idCategorie, c.designation AS categorie_designation, p.idProduit, p.designation, p.prix 
            FROM categorie c
            LEFT JOIN produit p ON c.idCategorie = p.idCategorie
            ORDER BY c.designation, p.designation
        ";
        $result = $this->db->query($query);
    
        $categories = [];
        while ($row = $result->fetch()) {
            $categories[$row['categorie_designation']][] = [
                'idProduit' => $row['idProduit'],
                'designation' => $row['designation'],
                'prix' => $row['prix']
            ];
        }
    
        return $categories;
    }
    
}
