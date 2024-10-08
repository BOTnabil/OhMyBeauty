<?php
namespace Controller;

use Model\Managers\UtilisateurManager;
use Model\Managers\CommandeManager;
use Model\Managers\ReservationManager;

class SecuriteController {
    private $utilisateurManager;
    private $commandeManager;
    private $reservationManager;

    public function __construct() {
        $this->utilisateurManager = new UtilisateurManager();
        $this->commandeManager = new CommandeManager();
        $this->reservationManager = new ReservationManager();
    }

    public function inscription($role = 'user') {
        if (isset($_POST["submit"])) {
            $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_VALIDATE_EMAIL);
            $motDePasse1 = filter_input(INPUT_POST, "motDePasse1", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $motDePasse2 = filter_input(INPUT_POST, "motDePasse2", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $honeypot = filter_input(INPUT_POST, "honeypot", FILTER_SANITIZE_FULL_SPECIAL_CHARS);  // Récupère la valeur du champ honeypot
            $accepterConditions = isset($_POST['accepterConditions']);  // Récupère si la case est cochée ou non
    
            // Vérifie si le honeypot est vide (un bot remplirait ce champ)
            if (!empty($honeypot)) {
                // Un bot a probablement rempli le formulaire
                $_SESSION['MAJregister'] = 'Bot detecté';
                header("Location: index.php?action=inscription");
                exit;
            }
    
            // Vérifie si l'utilisateur existe déjà
            if ($this->utilisateurManager->verifierUtilisateurExistant($email)) {
                $_SESSION['MAJregister'] = 'Un utilisateur utilise déjà cet email.';
                header("Location: index.php?action=inscription");
                exit;
            }
    
            // Vérifie si tous les champs sont remplis, si la case est cochée et si les mots de passe correspondent
            if ($email && $motDePasse1 && $motDePasse2 && $accepterConditions) {
                if ($motDePasse1 === $motDePasse2 && preg_match('/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!%*?&#])[A-Za-z\d@$!%*?&#]{8,}$/', $motDePasse1)) {
                    // Hash le mot de passe avant de le stocker
                    $hashedPassword = password_hash($motDePasse1, PASSWORD_BCRYPT);
                    $this->utilisateurManager->creerUtilisateur($email, $hashedPassword, $role);
                    header("Location: index.php?action=connexion");
                    exit;
                } else {
                    // Mots de passe ne correspondent pas ou ne respectent pas les exigences
                    $_SESSION['MAJregister'] = 'Les deux mots de passe ne sont pas identiques ou ne respectent pas les exigences.';
                    header("Location: index.php?action=inscription");
                    exit;
                }
            } else {
                // Gérer les cas où l'email, le mot de passe ou la case à cocher ne sont pas valides
                if (!$accepterConditions) {
                    $_SESSION['MAJregister'] = 'Vous devez accepter les conditions d\'utilisation.';
                    header("Location: index.php?action=inscription");
                } else {
                    $_SESSION['MAJregister'] = 'Veuillez remplir tous les champs correctement.';
                    header("Location: index.php?action=inscription");
                }
            }
        }
    }
    
    
    
    

    public function connexion() {
        if(isset($_POST["submit"])) {
            $email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
            $motDePasse = filter_input(INPUT_POST, "motDePasse", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        
            if($email && $motDePasse){
                $utilisateur = $this->utilisateurManager->obtenirUtilisateurParEmail($email);
        
                if ($utilisateur && password_verify($motDePasse, $utilisateur['motDePasse'])) {
                    // Lancer une session et stocker les informations de l'utilisateur
                    session_start();
                    $_SESSION['user'] = $utilisateur;
                    $_SESSION['user_id'] = $utilisateur['id_utilisateur'];
                    $_SESSION['user_email'] = $utilisateur['email'];
                    $_SESSION['user_role'] = $utilisateur['role'];
                    $_SESSION['MAJlogin'] = "";
                    header("Location: index.php?action=home");
                } else {
                    // Rediriger ou afficher un message d'erreur si les informations sont incorrectes
                    $_SESSION['MAJlogin'] = "L'email ou le mot de passe est erroné.";
                    header("Location: index.php?action=connexion");
                }
            }
        }
    }

    public function deconnexion() {
        session_start();
        session_unset();
        session_destroy();
        header("Location: index.php?action=home");
    }

    public function supprimerUtilisateurProcess() {
        $id_utilisateur = $_SESSION['user_id'];
        
        // Rendre l'ID utilisateur null dans les commandes et réservations
        $this->commandeManager->rendreUtilisateurNullDansCommandes($id_utilisateur);
        $this->reservationManager->rendreUtilisateurNullDansReservations($id_utilisateur);
        
        // Supprimer l'utilisateur
        $this->utilisateurManager->supprimerUtilisateur($id_utilisateur);
        
        // Détruire la session
        session_destroy();
        
        // Redirection après suppression
        header("Location: index.php?action=home");
    }
}
