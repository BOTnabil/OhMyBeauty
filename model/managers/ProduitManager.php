<?php
namespace Model\Managers;

use App\Connect;

class ProduitManager {
    
    private $db;

    public function __construct() {
        $this->db = Connect::seConnecter(); // Initialisation de la connexion à la base de données
    }

    // Méthode pour obtenir un produit par son ID
    public function obtenirProduitParId($idProduit) {
        $requete = "
            SELECT idProduit, designation, prix 
            FROM produit 
            WHERE idProduit = :idProduit
        ";
        $stmt = $this->db->prepare($requete);
        $stmt->bindParam(':idProduit', $idProduit, \PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch();
    }

    // Méthode pour obtenir toutes les catégories avec leurs produits
    public function obtenirToutesCategoriesAvecProduits() {
        $requete = "
            SELECT c.idCategorie, c.designation AS categorie_designation, p.idProduit, p.designation, p.prix 
            FROM categorie c
            LEFT JOIN produit p ON c.idCategorie = p.idCategorie
            ORDER BY c.idCategorie, p.idProduit
        ";
        $resultat = $this->db->query($requete);
    
        $categories = [];
        while ($row = $resultat->fetch()) {
            $categories[$row['categorie_designation']][] = [
                'idProduit' => $row['idProduit'],
                'designation' => $row['designation'],
                'prix' => $row['prix']
            ];
        }
    
        return $categories;
    }
    
}