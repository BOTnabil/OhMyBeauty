<?php
namespace Model\Managers;

use App\Connect;

class UtilisateurManager{
    
    // Se connecter à la base de données
    private $db;

    public function __construct() {
        $this->db = Connect::seConnecter();
    }

    public function obtenirUtilisateurParId($id_utilisateur) {
        $requete = "
            SELECT id_utilisateur, email, motDePasse
            FROM utilisateur
            WHERE id_utilisateur = :id_utilisateur
        ";
        $stmt = $this->db->prepare($requete);
        $stmt->bindParam(':id_utilisateur', $id_utilisateur, \PDO::PARAM_INT);
        $stmt->execute();
    
        return $stmt->fetch(\PDO::FETCH_ASSOC); // Récupère les informations de l'utilisateur
    }

    // Créer un nouvel utilisateur
    public function creerUtilisateur($email, $motDePasse, $role) {
        $requete = "
            INSERT INTO Utilisateur (email, motDePasse, role) 
            VALUES (:email, :motDePasse, :role)
        ";
        $stmt = $this->db->prepare($requete);
        $stmt->bindParam(':email', $email, \PDO::PARAM_STR);
        $stmt->bindParam(':motDePasse', $motDePasse, \PDO::PARAM_STR);
        $stmt->bindParam(':role', $role, \PDO::PARAM_STR);
        return $stmt->execute();
    }

    // Vérifier si l'utilisateur existe déjà
    public function verifierUtilisateurExistant($email) {
        $requete = "
            SELECT COUNT(*) 
            FROM Utilisateur 
            WHERE email = :email
        ";
        $stmt = $this->db->prepare($requete);
        $stmt->bindParam(':email', $email, \PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchColumn() > 0;
    }

    // Obtenir un utilisateur par son adresse email
    public function obtenirUtilisateurParEmail($email) {
        $requete = "
            SELECT * 
            FROM Utilisateur 
            WHERE email = :email
        ";
        $stmt = $this->db->prepare($requete);
        $stmt->bindParam(':email', $email, \PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function supprimerUtilisateur($id_utilisateur) {
        $requete = "
            DELETE FROM utilisateur
            WHERE id_utilisateur = :id_utilisateur
        ";
        $stmt = $this->db->prepare($requete);
        $stmt->bindParam(':id_utilisateur', $id_utilisateur, \PDO::PARAM_INT);
        $stmt->execute();
    }

    public function modifierMail($email, $id_utilisateur) {
        $requete = "
            UPDATE utilisateur
            SET email = :email
            WHERE id_utilisateur = :id_utilisateur
        ";
        $stmt = $this->db->prepare($requete);
        $stmt->bindParam(':email', $email, \PDO::PARAM_STR);
        $stmt->bindParam(':id_utilisateur', $id_utilisateur, \PDO::PARAM_INT);
        $stmt->execute();
    }

    public function modifierMDP($motDePasseHash, $id_utilisateur) {
        $requete = "
            UPDATE utilisateur
            SET motDePasse = :motDePasse
            WHERE id_utilisateur = :id_utilisateur
        ";
        $stmt = $this->db->prepare($requete);
        $stmt->bindParam(':motDePasse', $motDePasseHash, \PDO::PARAM_STR);
        $stmt->bindParam(':id_utilisateur', $id_utilisateur, \PDO::PARAM_INT);
        $stmt->execute();
    }
}
