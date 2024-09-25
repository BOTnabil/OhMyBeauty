<?php
namespace Model\Managers;

use App\Connect;

class ProduitManager {
    
    private $db;

    public function __construct() {
        $this->db = Connect::seConnecter(); // Initialisation de la connexion à la base de données
    }

    // Méthode pour obtenir un produit par son ID
    public function obtenirProduitParId($id_produit) {
        $requete = "
            SELECT id_produit, designation, prix 
            FROM produit 
            WHERE id_produit = :id_produit
        ";
        $stmt = $this->db->prepare($requete);
        $stmt->bindParam(':id_produit', $id_produit, \PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch();
    }

    // Méthode pour obtenir toutes les catégories avec leurs produits
    public function obtenirToutesCategoriesAvecProduits() {
        $requete = "
            SELECT c.id_categorie, c.designation AS categorie_designation, p.id_produit, p.designation, p.prix 
            FROM categorie c
            LEFT JOIN produit p ON c.id_categorie = p.id_categorie
            ORDER BY c.id_categorie, p.id_produit
        ";
        $resultat = $this->db->query($requete);
    
        $categories = [];
        while ($row = $resultat->fetch()) {
            $categories[$row['categorie_designation']][] = [
                'id_produit' => $row['id_produit'],
                'designation' => $row['designation'],
                'prix' => $row['prix']
            ];
        }
    
        return $categories;
    }

    //On supprime la ligne du produit ayant l'id visé.
    public function supprimerProduit($id_produit) {
        $requete = "
            DELETE FROM produit 
            WHERE id_produit = :id_produit
        ";
        $stmt = $this->db->prepare($requete);
        $stmt->bindParam(':id_produit', $id_produit, \PDO::PARAM_INT);
        $stmt->execute();
    }
    
    
}