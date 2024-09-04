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
        $stmt = $this->db->prepare('
        INSERT INTO Utilisateur (nom, prenom, email, motDePasse, role) 
        VALUES (:nom, :prenom, :email, :motDePasse, :role)');
        return $stmt->execute(['nom' => $nom, 'prenom' => $prenom, 'email' => $email, 'motDePasse' => $motDePasse, 'role' => $role]);
    }

    // Vérifier si l'utilisateur existe déjà
    public function verifierUtilisateurExistant($email) {
        $stmt = $this->db->prepare('
        SELECT COUNT(*) 
        FROM Utilisateur 
        WHERE email = :email');
        $stmt->execute(['email' => $email]);
        return $stmt->fetchColumn() > 0;
    }

    // Obtenir un utilisateur par son adresse email
    public function obtenirUtilisateurParEmail($email) {
        $stmt = $this->db->prepare('
        SELECT * 
        FROM Utilisateur 
        WHERE email = :email');
        $stmt->execute(['email' => $email]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

}
