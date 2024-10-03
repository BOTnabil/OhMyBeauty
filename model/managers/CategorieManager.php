<?php
namespace Model\Managers;

use App\Connect;

class CategorieManager {
    
    private $db;

    public function __construct() {
        $this->db = Connect::seConnecter(); // Initialisation de la connexion à la base de données
    }

    //Méthode pour obtenir les noms et les id de toutes les catégories
    public function obtenirToutesLesCategories() {
        $requete = "
            SELECT id_categorie, designation
            FROM categorie
        ";
        $stmt = $this->db->query($requete);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function obtenirNomCategorie($id_categorie) {
        $requete = "
            SELECT designation
            FROM categorie
            WHERE id_categorie = :id_categorie
        ";
        $stmt = $this->db->prepare($requete);
        $stmt->bindParam(':id_categorie', $id_categorie, \PDO::PARAM_INT);
        $stmt->execute();
        
        return $stmt->fetchColumn();  // Retourne le nom de la catégorie
    }    
}
