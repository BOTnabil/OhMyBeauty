<?php
namespace Model\Managers;

use App\Connect;

class PrestationManager {
    
    private $db;

    public function __construct() {
        $this->db = Connect::seConnecter(); // Initialisation de la connexion à la base de données
    }

    // Méthode pour obtenir tous les services d'une catégorie spécifique
    public function getServicesByCategorie($idCategorie) {
        $query = "
            SELECT p.designation, p.description, p.duree, p.prix 
            FROM prestation p
            INNER JOIN categorie c ON c.idCategorie = p.idCategorie
            WHERE c.idCategorie = $idCategorie
        ";
        $result = $this->db->query($query);

        return $result->fetchAll(); // Assuming fetchAll is a custom method in your database connection class
    }

    // Méthode pour obtenir toutes les catégories avec leurs services
    public function getAllCategoriesWithServices() {
        $query = "
            SELECT c.idCategorie, c.designation AS categorie_designation, p.designation, p.description, p.duree, p.prix 
            FROM categorie c
            LEFT JOIN prestation p ON c.idCategorie = p.idCategorie
            ORDER BY c.designation, p.designation
        ";
        $result = $this->db->query($query);

        $categories = [];
        while ($row = $result->fetch()) { // Assuming fetch is a custom method in your database connection class
            $categories[$row['categorie_designation']][] = [
                'designation' => $row['designation'],
                'description' => $row['description'],
                'duree' => $row['duree'],
                'prix' => $row['prix']
            ];
        }

        return $categories;
    }
}
