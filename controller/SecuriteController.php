<?php
namespace Controller;

use Model\Managers\UtilisateurManager;

class SecuriteController {
    private $utilisateurManager;

    public function __construct() {
        $this->utilisateurManager = new UtilisateurManager();
    }

    public function inscription($role = 'user') {
        if (isset($_POST["submit"])) {
            $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_VALIDATE_EMAIL);
            $motDePasse1 = filter_input(INPUT_POST, "motDePasse1", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $motDePasse2 = filter_input(INPUT_POST, "motDePasse2", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $accepterConditions = isset($_POST['accepterConditions']);  // Récupère si la case est cochée ou non
    
            // Regex pour valider le mot de passe (min. 8 caractères, majuscule, minuscule, specialchar et chiffre)
            $regexMotDePasse = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/';
    
            // Vérifie si l'utilisateur existe déjà
            if ($this->utilisateurManager->verifierUtilisateurExistant($email)) {
                $_SESSION['MAJregister'] = 'Un utilisateur utilise déjà cet email.';
                header("Location: index.php?action=inscription");
                exit;
            }
    
            // Vérifie si tous les champs sont remplis, si la case est cochée et si les mots de passe correspondent
            if ($email && $motDePasse1 && $motDePasse2 && $accepterConditions) {
                // Vérifie la correspondance des mots de passe et si le mot de passe respecte les critères
                if ($motDePasse1 === $motDePasse2 && preg_match($regexMotDePasse, $motDePasse1)) {
                    // Hash le mot de passe avant de le stocker
                    $hashedPassword = password_hash($motDePasse1, PASSWORD_BCRYPT);
                    $this->utilisateurManager->creerUtilisateur($email, $hashedPassword, $role);
                    header("Location: index.php?action=connexion");
                    exit;
                } else {
                    // Mots de passe ne correspondent pas ou ne respectent pas les critères de sécurité
                    $_SESSION['MAJregister'] = 'Les mots de passe doivent être identiques et respecter les critères de sécurité (min. 8 caractères, majuscule, minuscule et chiffre).';
                    header("Location: index.php?action=inscription");
                    exit;
                }
            } else {
                // Gérer les cas où l'email, le mot de passe ou la case à cocher ne sont pas valides
                if (!$accepterConditions) {
                    $_SESSION['MAJregister'] = 'Vous devez accepter les conditions d\'utilisation.';
                } else {
                    $_SESSION['MAJregister'] = 'Veuillez remplir tous les champs correctement.';
                }
                header("Location: index.php?action=inscription");
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
