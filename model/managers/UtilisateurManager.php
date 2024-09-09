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
    public function creerUtilisateur($nom, $prenom, $email, $motDePasse, $role) {
        $requete = "
            INSERT INTO Utilisateur (nom, prenom, email, motDePasse, role) 
            VALUES (:nom, :prenom, :email, :motDePasse, :role)
        ";
        $stmt = $this->db->prepare($requete);
        $stmt->bindParam(':nom', $nom, \PDO::PARAM_STR);
        $stmt->bindParam(':prenom', $prenom, \PDO::PARAM_STR);
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
}
