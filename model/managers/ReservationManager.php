<?php
namespace Model\Managers;

use App\Connect;

class ReservationManager {
    
    private $db;

    public function __construct() {
        $this->db = Connect::seConnecter(); // Initialisation de la connexion à la base de données
    }

    // Méthode pour créer une nouvelle réservation
    public function creerReservation($idUtilisateur, $idPrestation, $datePrestation) {
        $requete = "
            INSERT INTO reservation (idUtilisateur, idPrestation, datePrestation) 
            VALUES (:idUtilisateur, :idPrestation, :datePrestation)
        ";
        $stmt = $this->db->prepare($requete);
        $stmt->bindParam(':idUtilisateur', $idUtilisateur, \PDO::PARAM_INT);
        $stmt->bindParam(':idPrestation', $idPrestation, \PDO::PARAM_INT);
        $stmt->bindParam(':datePrestation', $datePrestation, \PDO::PARAM_STR);
        $stmt->execute();
    }

    // Méthode pour récupérer les créneaux horaires réservés à une date donnée
    public function obtenirCreneauxReservesParDate($idPrestation, $datePrestation) {
        $requete = "
            SELECT TIME(datePrestation) as creneauHoraire 
            FROM reservation 
            WHERE idPrestation = :idPrestation 
            AND DATE(datePrestation) = :datePrestation
        ";
        $stmt = $this->db->prepare($requete);
        $stmt->bindParam(':idPrestation', $idPrestation, \PDO::PARAM_INT);
        $stmt->bindParam(':datePrestation', $datePrestation, \PDO::PARAM_STR);
        $stmt->execute();
    
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);  // Renvoie les créneaux sous forme de tableau associatif
    }    

    // Méthode pour récupérer les réservations d'un utilisateur spécifique
    public function obtenirReservationsParUtilisateur($idUtilisateur) {
        $requete = "
            SELECT r.idPrestation, r.datePrestation, p.designation, p.prix, p.duree, c.designation AS categorie
            FROM reservation r
            JOIN prestation p ON r.idPrestation = p.idPrestation
            JOIN categorie c ON p.idCategorie = c.idCategorie
            WHERE r.idUtilisateur = :idUtilisateur
            ORDER BY r.datePrestation
        ";
        $stmt = $this->db->prepare($requete);
        $stmt->bindParam(':idUtilisateur', $idUtilisateur, \PDO::PARAM_INT);
        $stmt->execute();
    
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    // Méthode pour annuler une réservation
    public function annulerReservation($idPrestation) {
        $requete = "
            DELETE FROM reservation 
            WHERE idPrestation = :idPrestation
        ";
        $stmt = $this->db->prepare($requete);
        $stmt->bindParam(':idPrestation', $idPrestation, \PDO::PARAM_INT);
        $stmt->execute();
    }

    public function verifierReservationExistante($idUtilisateur, $idPrestation) {
        $requete = "
            SELECT COUNT(*) 
            FROM reservation 
            WHERE idUtilisateur = :idUtilisateur 
            AND idPrestation = :idPrestation 
            AND datePrestation >= NOW()
        ";
        $stmt = $this->db->prepare($requete);
        $stmt->bindParam(':idUtilisateur', $idUtilisateur, \PDO::PARAM_INT);
        $stmt->bindParam(':idPrestation', $idPrestation, \PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchColumn() > 0;
    }

    // Méthode pour vérifier si l'utilisateur a déjà une réservation pour ce créneau
    public function verifierReservationPourCreneau($idUtilisateur, $datePrestation) {
        $requete = "
            SELECT COUNT(*) 
            FROM reservation 
            WHERE idUtilisateur = :idUtilisateur 
            AND datePrestation = :datePrestation
        ";
        $stmt = $this->db->prepare($requete);
        $stmt->bindParam(':idUtilisateur', $idUtilisateur);
        $stmt->bindParam(':datePrestation', $datePrestation);
        $stmt->execute();
        return $stmt->fetchColumn() > 0;
    }

    // Supprimer automatiquement les réservations passées
    public function supprimerReservationsPassees() {
        $requete = "
            DELETE FROM reservation 
            WHERE datePrestation < NOW()
        ";
        $stmt = $this->db->prepare($requete);
        $stmt->execute();
    }
}
