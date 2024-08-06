<?php
namespace Controller;

use Model\Managers\UtilisateurManager;

class SecurityController {
    private $utilisateurManager;

    public function __construct() {
        $this->utilisateurManager = new UtilisateurManager();
    }

    public function register($nom, $prenom, $email, $motDePasse, $role = 'user') {
        if(isset($_POST["submit"])) {
            $nom = filter_input(INPUT_POST, "nom", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $prenom = filter_input(INPUT_POST, "prenom", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_VALIDATE_EMAIL);
            $motDePasse1 = filter_input(INPUT_POST, "motDePasse1", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $motDePasse2 = filter_input(INPUT_POST, "motDePasse2", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            if ($this->utilisateurManager->checkUserExists($email)) {
                // Rediriger ou afficher un message d'erreur si l'utilisateur existe déjà
                header("Location: ");
            } else if($nom && $prenom && $email && $motDePasse1 && $motDePasse2){
                    if($motDePasse1 == $motDePasse2 && strlen($motDePasse1 >= 8)) {
                        // Hash le mot de passe avant de le stocker
                        $hashedPassword = password_hash($motDePasse1, PASSWORD_BCRYPT);
                        $this->utilisateurManager->createUtilisateur($nom, $prenom, $email, $hashedPassword, $role);
                        header("Location: ");
                    }
                }
            }
    }

    public function login() {

        $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_VALIDATE_EMAIL);
        $motDePasse = filter_input(INPUT_POST, "motDePasse", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        $utilisateur = $this->utilisateurManager->getUtilisateurByEmail($email);

        if($email && $motDePasse){
            if ($utilisateur && password_verify($motDePasse, $utilisateur['motDePasse'])) {
                // Lancer une session et stocker les informations de l'utilisateur
                session_start();
                $_SESSION['user_id'] = $utilisateur['idUtilisateur'];
                $_SESSION['user_email'] = $utilisateur['email'];
                header("Location: ");
            } else {
                // Rediriger ou afficher un message d'erreur si les informations sont incorrectes
                header("Location: ");
            }
        }
    }

    public function logout() {
        session_start();
        session_unset();
        session_destroy();
        header("Location: ");
    }

}