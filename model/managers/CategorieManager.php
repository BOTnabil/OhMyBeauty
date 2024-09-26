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
}
