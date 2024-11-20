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
            SELECT id_prestation, designation, description, duree, prix, id_categorie
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

    public function modifierPrestation($id_prestation, $designation, $description, $duree, $prix, $id_categorie) {
        // Si une nouvelle image est fournie, on met à jour aussi le champ image
        $requete = "
            UPDATE prestation 
            SET designation = :designation, description = :description, prix = :prix, id_categorie = :id_categorie, duree = :duree
            WHERE id_prestation = :id_prestation
        ";

        $stmt = $this->db->prepare($requete);
        $stmt->bindParam(':designation', $designation);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':prix', $prix);
        $stmt->bindParam(':duree', $duree);
        $stmt->bindParam(':id_categorie', $id_categorie);
        $stmt->bindParam(':id_prestation', $id_prestation);
        $stmt->execute();
    }

    public function ajouterPrestation($designation, $description, $prix, $duree, $id_categorie) {
        $requete = "
            INSERT INTO prestation (designation, prix, description, duree, id_categorie)
            VALUES (:designation, :prix, :description, :duree, :id_categorie)
        ";
        $stmt = $this->db->prepare($requete);
        $stmt->bindParam(':designation', $designation, \PDO::PARAM_STR);
        $stmt->bindParam(':prix', $prix);
        $stmt->bindParam(':description', $description, \PDO::PARAM_STR);
        $stmt->bindParam(':duree', $duree, \PDO::PARAM_INT);
        $stmt->bindParam(':id_categorie', $id_categorie, \PDO::PARAM_INT);
        $stmt->execute();
    }

    public function supprimerPrestation($id_prestation) {
        $requete = "
            DELETE FROM prestation
            WHERE id_prestation = :id_prestation
        ";
        $stmt = $this->db->prepare($requete);
        $stmt->bindParam(':id_prestation', $id_prestation, \PDO::PARAM_INT);
        $stmt->execute();
    }
}
