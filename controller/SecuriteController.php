<?php
namespace Controller;

use Model\Managers\UtilisateurManager;

class SecuriteController {
    private $utilisateurManager;

    public function __construct() {
        $this->utilisateurManager = new UtilisateurManager();
    }

    public function inscription( $role = 'user') {
        if(isset($_POST["submit"])) {
            $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_VALIDATE_EMAIL);
            $motDePasse1 = filter_input(INPUT_POST, "motDePasse1", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $motDePasse2 = filter_input(INPUT_POST, "motDePasse2", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            if ($this->utilisateurManager->verifierUtilisateurExistant($email)) {
                // Refresh et affiche un message d'erreur si l'utilisateur existe déjà
                $_SESSION['MAJregister'] = 'Un utilisateur utilise déjà cet email.';
                header("Location: index.php?action=inscription");

            } else if($email && $motDePasse1 && $motDePasse2){
                    if($motDePasse1 == $motDePasse2 && strlen($motDePasse1 >= 8)) {
                        // Hash le mot de passe avant de le stocker
                        $hashedPassword = password_hash($motDePasse1, PASSWORD_BCRYPT);
                        $this->utilisateurManager->creerUtilisateur($email, $hashedPassword, $role);
                        header("Location: index.php?action=connexion");
                    } else {
                    // Refresh et affiche un message d'erreur si les deux mdp ne correspondent pas
                    $_SESSION['MAJregister'] = 'Les deux mots de passe ne sont pas identiques.';
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

}
