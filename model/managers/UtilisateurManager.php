<?php
namespace Model\Managers;

use App\Connect;

class UtilisateurManager{
    
    // Se connecter à la base de données
    private $db;

    public function __construct() {
        $this->db = Connect::seConnecter();
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
}
