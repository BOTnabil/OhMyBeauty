<?php
namespace Model\Managers;

use App\Connect;

class CommandeManager {
    
    private $db;

    public function __construct() {
        $this->db = Connect::seConnecter(); // Initialisation de la connexion à la base de données
    }

    // Méthode pour créer une nouvelle commande
    public function creerCommande($prixTotal, $id_utilisateur, $infosCommande = '') {
        $requete = "
            INSERT INTO commande (dateCommande, prixTotal, id_utilisateur, infosCommande) 
            VALUES (NOW(), :prixTotal, :id_utilisateur, :infosCommande)
        ";
        $stmt = $this->db->prepare($requete);
        $stmt->bindParam(':prixTotal', $prixTotal);
        $stmt->bindParam(':id_utilisateur', $id_utilisateur, \PDO::PARAM_INT);
        $stmt->bindParam(':infosCommande', $infosCommande, \PDO::PARAM_STR);
        $stmt->execute();
    
        return $this->db->lastInsertId(); // Retourne l'ID de la nouvelle commande
    }

    // Méthode pour obtenir les commandes d'un utilisateur spécifique
    public function obtenirCommandesParUtilisateur($id_utilisateur) {
        $requete = "
            SELECT id_commande, dateCommande, prixTotal, infosCommande
            FROM commande
            WHERE id_utilisateur = :id_utilisateur
            ORDER BY dateCommande DESC
        ";
        $stmt = $this->db->prepare($requete);
        $stmt->bindParam(':id_utilisateur', $id_utilisateur, \PDO::PARAM_INT);
        $stmt->execute();
    
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
    
    // Méthode pour obtenir les infos d'une commande
    public function obtenirInfosParCommande($id_utilisateur) {
        $requete = "
            SELECT infosCommande, dateCommande, prixTotal
            FROM commande
            WHERE id_utilisateur = :id_utilisateur AND id_commande = :id_commande
            ORDER BY dateCommande DESC
        ";
        $stmt = $this->db->prepare($requete);
        $stmt->bindParam(':id_utilisateur', $id_utilisateur, \PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    // Méthode pour obtenir les détails d'une commande spécifique
    public function obtenirDetailsCommande($id_commande) {
        $requete = "
            SELECT p.designation, c.quantite, p.prix, (c.quantite * p.prix) as total
            FROM contenir c
            INNER JOIN produit p ON c.id_produit = p.id_produit
            WHERE c.id_commande = :id_commande
        ";
        $stmt = $this->db->prepare($requete);
        $stmt->bindParam(':id_commande', $id_commande, \PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll();
    }
}
