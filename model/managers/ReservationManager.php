<?php
namespace Model\Managers;

use App\Connect;

class ReservationManager {
    
    private $db;

    public function __construct() {
        $this->db = Connect::seConnecter(); // Initialisation de la connexion à la base de données
    }

    // Méthode pour créer une nouvelle réservation
    public function creerReservation($id_utilisateur, $id_prestation, $datePrestation, $infosReservation) {
        $requete = "
            INSERT INTO reservation (id_utilisateur, id_prestation, datePrestation, infosReservation) 
            VALUES (:id_utilisateur, :id_prestation, :datePrestation, :infosReservation)
        ";
        $stmt = $this->db->prepare($requete);
        $stmt->bindParam(':id_utilisateur', $id_utilisateur, \PDO::PARAM_INT);
        $stmt->bindParam(':id_prestation', $id_prestation, \PDO::PARAM_INT);
        $stmt->bindParam(':datePrestation', $datePrestation, \PDO::PARAM_STR);
        $stmt->bindParam(':infosReservation', $infosReservation, \PDO::PARAM_STR);
        $stmt->execute();
    }

    // Méthode pour récupérer les créneaux horaires réservés à une date donnée
    public function obtenirCreneauxReservesParDate($id_prestation, $datePrestation) {
        $requete = "
            SELECT TIME(datePrestation) as creneauHoraire 
            FROM reservation 
            WHERE id_prestation = :id_prestation 
            AND DATE(datePrestation) = :datePrestation
        ";
        $stmt = $this->db->prepare($requete);
        $stmt->bindParam(':id_prestation', $id_prestation, \PDO::PARAM_INT);
        $stmt->bindParam(':datePrestation', $datePrestation, \PDO::PARAM_STR);
        $stmt->execute();
    
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);  // Renvoie les créneaux sous forme de tableau associatif
    }    

    // Méthode pour récupérer les réservations d'un utilisateur spécifique
    public function obtenirReservationsParUtilisateur($id_utilisateur) {
        $requete = "
            SELECT r.id_prestation, r.datePrestation, r.infosReservation
            FROM reservation r
            WHERE r.id_utilisateur = :id_utilisateur
            ORDER BY r.datePrestation
        ";
        $stmt = $this->db->prepare($requete);
        $stmt->bindParam(':id_utilisateur', $id_utilisateur, \PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }


    // Méthode pour récupérer tous les créneaux réservés par l'utilisateur
    public function obtenirCreneauxReservesUtilisateur($id_utilisateur) {
        $requete = "
            SELECT datePrestation 
            FROM reservation 
            WHERE id_utilisateur = :id_utilisateur
        ";
        $stmt = $this->db->prepare($requete);
        $stmt->bindParam(':id_utilisateur', $id_utilisateur, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }

    // Méthode pour annuler une réservation
    public function annulerReservation($id_prestation) {
        $requete = "
            DELETE FROM reservation 
            WHERE id_prestation = :id_prestation
        ";
        $stmt = $this->db->prepare($requete);
        $stmt->bindParam(':id_prestation', $id_prestation, \PDO::PARAM_INT);
        $stmt->execute();
    }

    //Vérifie si un utilisateur possede une reservation active sur une préstation
    public function verifierReservationExistante($id_utilisateur, $id_prestation) {
        $requete = "
            SELECT COUNT(*) 
            FROM reservation 
            WHERE id_utilisateur = :id_utilisateur 
            AND id_prestation = :id_prestation 
            AND datePrestation >= NOW()
        ";
        $stmt = $this->db->prepare($requete);
        $stmt->bindParam(':id_utilisateur', $id_utilisateur, \PDO::PARAM_INT);
        $stmt->bindParam(':id_prestation', $id_prestation, \PDO::PARAM_INT);
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

    // Récupérer les créneaux réservés par un utilisateur à une date
    public function obtenirCreneauxReservesUtilisateurParDate($id_utilisateur, $datePrestation) {
        $requete = "
            SELECT TIME(datePrestation) as creneauHoraire 
            FROM reservation 
            WHERE id_utilisateur = :id_utilisateur 
            AND DATE(datePrestation) = :datePrestation
        ";
        $stmt = $this->db->prepare($requete);
        $stmt->bindParam(':id_utilisateur', $id_Utilisateur, \PDO::PARAM_INT);
        $stmt->bindParam(':datePrestation', $datePrestation, \PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);  // Renvoie les créneaux sous forme de tableau associatif
    }
}