<?php
namespace Model\Managers;

use App\Connect;

class ProduitManager {
    
    private $db;

    public function __construct() {
        $this->db = Connect::seConnecter(); // Initialisation de la connexion à la base de données
    }

    // Méthode pour obtenir tous les produit d'une catégorie spécifique
    public function getProduitsByCategorie($idCategorie) {
        $query = "
            SELECT p.designation, p.prix 
            FROM produit p
            INNER JOIN categorie c ON c.idCategorie = p.idCategorie
            WHERE c.idCategorie = $idCategorie
        ";
        $result = $this->db->query($query);

        return $result->fetchAll(); // Assuming fetchAll is a custom method in your database connection class
    }

    // Méthode pour obtenir toutes les catégories avec leurs produits
    public function getAllCategoriesWithProduits() {
        $query = "
            SELECT c.idCategorie, c.designation AS categorie_designation, p.designation, p.prix 
            FROM categorie c
            LEFT JOIN produit p ON c.idCategorie = p.idCategorie
            ORDER BY c.designation, p.designation
        ";
        $result = $this->db->query($query);

        $categories = [];
        while ($row = $result->fetch()) { // Assuming fetch is a custom method in your database connection class
            $categories[$row['categorie_designation']][] = [
                'designation' => $row['designation'],
                'prix' => $row['prix']
            ];
        }

        return $categories;
    }
}
