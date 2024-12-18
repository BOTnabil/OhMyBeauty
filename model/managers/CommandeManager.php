<?php
namespace Model\Managers;

use App\Connect;

class CommandeManager {
    
    private $db;

    public function __construct() {
        $this->db = Connect::seConnecter(); // Initialisation de la connexion à la base de données
    }

    public function obtenirCommandeParId($id_commande) {
        $requete = "
            SELECT c.id_commande, c.numeroCommande, c.dateCommande, c.prixTotal, c.infosCommande, u.id_utilisateur
            FROM commande c
            JOIN utilisateur u ON c.id_utilisateur = u.id_utilisateur
            WHERE c.id_commande = :id_commande
        ";
        $stmt = $this->db->prepare($requete);
        $stmt->bindParam(':id_commande', $id_commande, \PDO::PARAM_INT);
        $stmt->execute();
    
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }
    

    // Méthode pour créer une nouvelle commande
    public function creerCommande($prixTotal, $id_utilisateur, $infosCommande, $numeroCommande) {
        $requete = "
            INSERT INTO commande (dateCommande, prixTotal, id_utilisateur, infosCommande, numeroCommande) 
            VALUES (NOW(), :prixTotal, :id_utilisateur, :infosCommande, :numeroCommande)
        ";
        $stmt = $this->db->prepare($requete);
        $stmt->bindParam(':prixTotal', $prixTotal);
        $stmt->bindParam(':id_utilisateur', $id_utilisateur, \PDO::PARAM_INT);
        $stmt->bindParam(':infosCommande', $infosCommande);
        $stmt->bindParam(':numeroCommande', $numeroCommande);
        $stmt->execute();
    
        return $this->db->lastInsertId(); // Retourne l'ID de la nouvelle commande
    }
    

    // Méthodes pour obtenir les commandes d'un utilisateur spécifique
    public function obtenirNombreCommandesUtilisateur($id_utilisateur) {
        $requete = "
        SELECT COUNT(*) 
        FROM commande 
        WHERE id_utilisateur = :id_utilisateur";
        $stmt = $this->db->prepare($requete);
        $stmt->bindParam(':id_utilisateur', $id_utilisateur, \PDO::PARAM_INT);
        $stmt->execute();
    
        return $stmt->fetchColumn();
    }
    
    public function obtenirCommandesUtilisateurAvecPagination($id_utilisateur, $offset, $limit) {
        $requete = "
        SELECT * FROM commande 
        WHERE id_utilisateur = :id_utilisateur 
        ORDER BY dateCommande DESC 
        LIMIT :offset, :limit";
        $stmt = $this->db->prepare($requete);
        $stmt->bindParam(':id_utilisateur', $id_utilisateur, \PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, \PDO::PARAM_INT);
        $stmt->bindParam(':limit', $limit, \PDO::PARAM_INT);
        $stmt->execute();
    
        return $stmt->fetchAll();
    }
    

    // Récupérer toutes les commandes pour admin
    public function obtenirCommandesParPage($offset, $limit) {
        $requete = "
            SELECT id_commande, dateCommande, numeroCommande, prixTotal, infosCommande
            FROM commande
            ORDER BY dateCommande DESC
            LIMIT :offset, :limit
        ";
        $stmt = $this->db->prepare($requete);
        $stmt->bindParam(':offset', $offset, \PDO::PARAM_INT);
        $stmt->bindParam(':limit', $limit, \PDO::PARAM_INT);
        $stmt->execute();
    
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
    
    public function obtenirNombreTotalCommandes() {
        $requete = "SELECT COUNT(*) FROM commande";
        $stmt = $this->db->query($requete);
        return $stmt->fetchColumn();
    }
    
    // Annuler une commande
    public function annulerCommande($id_commande) {
    $requete = "
            DELETE FROM commande 
            WHERE id_commande = :id_commande
        ";
        $stmt = $this->db->prepare($requete);
        $stmt->bindParam(':id_commande', $id_commande, \PDO::PARAM_INT);
        $stmt->execute();
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

    public function rendreUtilisateurNullDansCommandes($id_utilisateur) {
        $requete = "
            UPDATE commande
            SET id_utilisateur = NULL
            WHERE id_utilisateur = :id_utilisateur
        ";
        $stmt = $this->db->prepare($requete);
        $stmt->bindParam(':id_utilisateur', $id_utilisateur, \PDO::PARAM_INT);
        $stmt->execute();
    }
    
}
