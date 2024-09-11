<?php
namespace Model\Managers;

use App\Connect;

class PrestationManager {
    
    private $db;

    public function __construct() {
        $this->db = Connect::seConnecter(); // Initialisation de la connexion à la base de données
    }

    // Méthode pour récupérer une prestation par son ID
    public function obtenirPrestationParId($idPrestation) {
        $requete = "
            SELECT idPrestation, designation, description, duree, prix
            FROM prestation
            WHERE idPrestation = :idPrestation
        ";
        $stmt = $this->db->prepare($requete);
        $stmt->bindParam(':idPrestation', $idPrestation, \PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    // Méthode pour obtenir toutes les catégories avec leurs prestations
    public function obtenirToutesCategoriesAvecPrestations() {
        $requete = "
            SELECT c.idCategorie, c.designation AS categorie_designation, p.idPrestation, p.designation, p.description, p.duree, p.prix 
            FROM categorie c
            LEFT JOIN prestation p ON c.idCategorie = p.idCategorie
            ORDER BY c.designation, p.designation
        ";
        $resultat = $this->db->query($requete);

        $categories = [];
        while ($row = $resultat->fetch()) {
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
