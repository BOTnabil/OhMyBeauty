<?php
namespace Model\Managers;

use App\Connect;

class PrestationManager {
    
    private $db;

    public function __construct() {
        $this->db = Connect::seConnecter(); // Initialisation de la connexion à la base de données
    }

    // Méthode pour récupérer une prestation par son ID
    public function obtenirPrestationParId($id_prestation) {
        $requete = "
            SELECT id_prestation, designation, description, duree, prix
            FROM prestation
            WHERE id_prestation = :id_prestation
        ";
        $stmt = $this->db->prepare($requete);
        $stmt->bindParam(':id_prestation', $id_prestation, \PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    // Méthode pour obtenir toutes les catégories avec leurs prestations
    public function obtenirToutesCategoriesAvecPrestations() {
        $requete = "
            SELECT c.id_categorie, c.designation AS categorie_designation, p.id_prestation, p.designation, p.description, p.duree, p.prix 
            FROM categorie c
            LEFT JOIN prestation p ON c.id_categorie = p.id_categorie
            ORDER BY c.designation, p.designation
        ";
        $resultat = $this->db->query($requete);

        $categories = [];
        while ($row = $resultat->fetch()) {
            $categories[$row['categorie_designation']][] = [
                'id_prestation' => $row['id_prestation'],
                'designation' => $row['designation'],
                'description' => $row['description'],
                'duree' => $row['duree'],
                'prix' => $row['prix']
            ];
        }

        return $categories;
    }
}
