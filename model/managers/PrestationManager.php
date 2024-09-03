<?php
namespace Model\Managers;

use App\Connect;

class PrestationManager {
    
    private $db;

    public function __construct() {
        $this->db = Connect::seConnecter(); // Initialisation de la connexion à la base de données
    }

    // Méthode pour obtenir toutes les catégories avec leurs services
    public function getAllCategoriesWithServices() {
        $query = "
            SELECT c.idCategorie, c.designation AS categorie_designation, p.idPrestation, p.designation, p.description, p.duree, p.prix 
            FROM categorie c
            LEFT JOIN prestation p ON c.idCategorie = p.idCategorie
            ORDER BY c.designation, p.designation
        ";
        $result = $this->db->query($query);

        $categories = [];
        while ($row = $result->fetch()) {
            $categories[$row['categorie_designation']][] = [
                'idPrestation' => $row['idPrestation'],
                'designation' => $row['designation'],
                'description' => $row['description'],
                'duree' => $row['duree'],
                'prix' => $row['prix']
            ];
        }

        return $categories;
    }
}
