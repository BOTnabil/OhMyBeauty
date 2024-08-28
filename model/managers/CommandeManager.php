<?php
namespace Model\Managers;

use App\Connect;

class CommandeManager {
    
    private $db;

    public function __construct() {
        $this->db = Connect::seConnecter(); // Initialisation de la connexion à la base de données
    }

    // Méthode
    public function createCommande($prixTotal, $idUtilisateur) {
        $query = "
            INSERT INTO commande (dateCommande, prixTotal, idUtilisateur) 
            VALUES (NOW(), :prixTotal, :idUtilisateur)
        ";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':prixTotal', $prixTotal);
        $stmt->bindParam(':idUtilisateur', $idUtilisateur);
        $stmt->execute();

        return $this->db->lastInsertId(); // Return le nouvel ID
    }
}
