<?php
namespace Model\Managers;

use App\Connect;

class ReservationManager {
    
    private $db;

    public function __construct() {
        $this->db = Connect::seConnecter(); // Initialisation de la connexion à la base de données
    }

    public function createReservation($idUtilisateur, $idPrestation, $datePrestation) {
        $query = "
            INSERT INTO reservation (idUtilisateur, idPrestation, datePrestation) 
            VALUES (:idUtilisateur, :idPrestation, :datePrestation)
        ";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':idUtilisateur', $idUtilisateur, \PDO::PARAM_INT);
        $stmt->bindParam(':idPrestation', $idPrestation, \PDO::PARAM_INT);
        $stmt->bindParam(':datePrestation', $datePrestation, \PDO::PARAM_STR);
        $stmt->execute();
    }

    public function getReservedSlotsByDate($idPrestation, $datePrestation) {
        $query = "
            SELECT TIME(datePrestation) as timeSlot 
            FROM reservation 
            WHERE idPrestation = :idPrestation 
            AND DATE(datePrestation) = :datePrestation
        ";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':idPrestation', $idPrestation, \PDO::PARAM_INT);
        $stmt->bindParam(':datePrestation', $datePrestation, \PDO::PARAM_STR);
        $stmt->execute();
    
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);  // Renvoie les heures sous forme de tableau associatif
    }    

    // Méthode pour récupérer les réservations d'un utilisateur spécifique
    public function getReservationsByUtilisateur($idUtilisateur) {
        $query = "
            SELECT r.idPrestation, r.datePrestation, p.designation, p.prix, p.duree, c.designation AS categorie
            FROM reservation r
            JOIN prestation p ON r.idPrestation = p.idPrestation
            JOIN categorie c ON p.idCategorie = c.idCategorie
            WHERE r.idUtilisateur = :idUtilisateur
            ORDER BY r.datePrestation
        ";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':idUtilisateur', $idUtilisateur, \PDO::PARAM_INT);
        $stmt->execute();
    
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    // Méthode pour annuler une réservation
    public function cancelReservation($idPrestation) {
        $query = "
            DELETE FROM reservation 
            WHERE idPrestation = :idPrestation
        ";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':idPrestation', $idPrestation, \PDO::PARAM_INT);
        $stmt->execute();
    }
}
