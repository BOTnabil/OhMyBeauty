<?php
namespace Model\Managers;

use App\Connect;

class UtilisateurManager{
    
    // Se connecter a la BDD
    private $db;

    public function __construct() {
        $this->db = Connect::seConnecter();
    }

    public function createUtilisateur($nom, $prenom, $email, $motDePasse, $role) {
        $stmt = $this->db->prepare('
        INSERT INTO Utilisateur (nom, prenom, email, motDePasse, role) 
        VALUES (:nom, :prenom, :email, :motDePasse, :role)');
        return $stmt->execute(['nom' => $nom, 'prenom' => $prenom, 'email' => $email, 'motDePasse' => $motDePasse, 'role' => $role]);
    }

    // Cherche si l'utilisateur existe deja
    public function checkUserExists($email) {
        $stmt = $this->db->prepare('
        SELECT COUNT(*) 
        FROM Utilisateur 
        WHERE email = :email');
        $stmt->execute(['email' => $email]);
        return $stmt->fetchColumn() > 0;
    }

    public function getUtilisateurByEmail($email) {
        $stmt = $this->db->prepare('
        SELECT * 
        FROM Utilisateur 
        WHERE email = :email');
        $stmt->execute(['email' => $email]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

}