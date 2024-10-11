<?php
namespace Model\Managers;

use App\Connect;

class ProduitManager {
    
    private $db;

    public function __construct() {
        $this->db = Connect::seConnecter(); // Initialisation de la connexion à la base de données
    }

    // Méthode pour obtenir un produit par son ID ou par sa categorie
    public function obtenirProduitEtSaCategorieParId($id_produit) {
        $requete = "
            SELECT p.id_produit, p.designation, p.prix, p.description, p.image, p.id_categorie, c.designation AS nom_categorie
            FROM produit p
            JOIN categorie c ON p.id_categorie = c.id_categorie
            WHERE p.id_produit = :id_produit
        ";
        $stmt = $this->db->prepare($requete);
        $stmt->bindParam(':id_produit', $id_produit, \PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function obtenirArticlesParCategorie($id_categorie) {
        $requete = "
            SELECT id_produit, designation, prix, image 
            FROM produit
            WHERE id_categorie = :id_categorie
        ";
        $stmt = $this->db->prepare($requete);
        $stmt->bindParam(':id_categorie', $id_categorie, \PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
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
    
    public function ajouterProduit($designation, $description, $prix, $image, $id_categorie) {
        $requete = "
            INSERT INTO produit (designation, prix, description, image, id_categorie)
            VALUES (:designation, :prix, :description, :image, :id_categorie)
        ";
        $stmt = $this->db->prepare($requete);
        $stmt->bindParam(':designation', $designation, \PDO::PARAM_STR);
        $stmt->bindParam(':prix', $prix);
        $stmt->bindParam(':description', $description, \PDO::PARAM_STR);
        $stmt->bindParam(':image', $image, \PDO::PARAM_STR);
        $stmt->bindParam(':id_categorie', $id_categorie, \PDO::PARAM_INT);
        $stmt->execute();
    }

    public function modifierProduit($id_produit, $designation, $description, $prix, $id_categorie, $image = null) {
        // Si une nouvelle image est fournie, on met à jour aussi le champ image
        $requete = "
            UPDATE produit 
            SET designation = :designation, description = :description, prix = :prix, id_categorie = :id_categorie
        ";
    
        if ($image !== null) {
            $requete .= ", image = :image";
        }
    
        $requete .= " WHERE id_produit = :id_produit";
    
        $stmt = $this->db->prepare($requete);
        $stmt->bindParam(':designation', $designation);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':prix', $prix);
        $stmt->bindParam(':id_categorie', $id_categorie);
    
        if ($image !== null) {
            $stmt->bindParam(':image', $image);
        }
    
        $stmt->bindParam(':id_produit', $id_produit);
        $stmt->execute();
    }
    
}