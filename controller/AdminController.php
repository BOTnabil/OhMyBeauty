<?php

namespace Controller;

use Model\Managers\ProduitManager;
use Model\Managers\ReservationManager;
use Model\Managers\ContenirManager;
use Model\Managers\CategorieManager;
use App\Session;

class AdminController {
    private $produitManager;
    private $reservationManager;
    private $contenirManager;
    private $categorieManager;
    

    public function __construct() {
        $this->produitManager = new ProduitManager();
        $this->reservationManager = new ReservationManager();
        $this->contenirManager = new ContenirManager();
        $this->contenirManager = new CategorieManager();
    } 

// Méthodes

//upload d'image sécurise
public function uploadImage($file) {
    // Types de fichiers autorisés
    $allowedExtensions = ['jpg', 'jpeg', 'png'];
    $maxFileSize = 5 * 1024 * 1024; // 5 MB

    // Vérifie si un fichier a été téléchargé
    if ($file['error'] === UPLOAD_ERR_OK) {
        // Vérifie la taille du fichier
        if ($file['size'] > $maxFileSize) {
            return "Erreur : la taille du fichier dépasse la limite autorisée.";
        }

        // Récupère l'extension du fichier
        $fileExtension = pathinfo($file['name'], PATHINFO_EXTENSION);

        // Vérifie l'extension du fichier
        if (!in_array(strtolower($fileExtension), $allowedExtensions)) {
            $_SESSION['MAJadmin'] = "Seuls les formats JPG JPEG et PNG sont autorisés.";
            header("Location: index.php?action=admin");
        }

        // Renomme le fichier avec un identifiant unique
        $newFileName = uniqid() . '.' . $fileExtension;

        // Déplace le fichier dans le dossier de destination sécurisé
        $uploadDirectory = './public/img/'; // Chemin où stocker l'image
        $uploadPath = $uploadDirectory . $newFileName;

        if (move_uploaded_file($file['tmp_name'], $uploadPath)) {
            return $newFileName;
        } else {
            $_SESSION['MAJadmin'] = "Echec du téléchargement du fichier.";
            header("Location: index.php?action=admin");
        }
    } else {
        $_SESSION['MAJadmin'] = "Erreur lors du téléchargement.";
        header("Location: index.php?action=admin");
    }
}

//Redirection
public function afficherAdmin() {
    // Charger et afficher la vue admin
    require "view/vueAdmin.php";
}

public function afficherCalendrier() {
    // Charger et afficher la vue calendrier
    require "view/vueCalendrier.php";
}

//Afficher la vue du formulaire de modification
public function afficherModifierProduit() {
    if (isset($_GET['id_produit'])) {
        $id_produit = filter_input(INPUT_GET, 'id_produit', FILTER_SANITIZE_NUMBER_INT);

        // Récupérer les informations actuelles du produit
        $produit = $this->produitManager->obtenirProduitParId($id_produit);

        // Charger la vue avec les informations du produit
        require 'view/vueModifierProduit.php';
    }
}

//Afficher la vue des rdv
public function voirRendezVous() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['prestations'])) {
        $prestationsSelectionnees = $_POST['prestations']; // Contient les id des prestations sélectionnées

        // Récupérer les rendez-vous pour les prestations sélectionnées
        $rendezVous = $this->reservationManager->obtenirRendezVousParPrestations($prestationsSelectionnees);

        // Afficher le calendrier avec les rendez-vous filtrés
        require 'view/vueCalendrier.php';
    } else {
        $_SESSION['MAJadmin'] = "Veuillez sélectionner au moins une prestation.";
        header("Location: index.php?action=admin");
    }
}


//Suppression
    //Produit
    public function supprimerProduitProcess() {
        // Vérifier que l'utilisateur est administrateur
        if (!Session::estAdmin()) {
            $_SESSION['error'] = "Vous n'êtes pas autorisé à effectuer cette action.";
            header("Location: index.php?action=boutique");
            exit;
        }

        // Récupérer l'ID du produit
        if (isset($_POST['id_produit'])) {
            $id_produit = $_POST['id_produit'];

            // Supprimer toutes les lignes contenant ce produit dans la table "contenir"
            $this->contenirManager->supprimerProduitDeContenir($id_produit);

            // Supprimer le produit de la table "produit"
            $this->produitManager->supprimerProduit($id_produit);

            $_SESSION['MAJpanier'] = "Le produit a été supprimé avec succès.";
            header("Location: index.php?action=boutique");
        }
    }

//Ajout
    //Produit
    public function ajouterProduitProcess() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $designation = filter_input(INPUT_POST, 'designation', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $prix = filter_input(INPUT_POST, 'prix', FILTER_VALIDATE_FLOAT);
            $categorie = filter_input(INPUT_POST, 'id_categorie', FILTER_VALIDATE_INT);
    
            // Vérification des champs obligatoires
            if ($designation && $description && $prix && $categorie && isset($_FILES['image'])) {
                // Appel de la méthode d'upload sécurisée
                $uploadResult = $this->uploadImage($_FILES['image']);
                
                if (strpos($uploadResult, 'Erreur') === false) {
                    // Si l'upload est réussi, on ajoute le produit avec les données
                    $this->produitManager->ajouterProduit($designation, $description, $prix, $uploadResult, $categorie);
                    $_SESSION['MAJadmin'] = "Produit ajouté avec succès!";
                } else {
                    // Si l'upload échoue, afficher le message d'erreur
                    $_SESSION['MAJadmin'] = $uploadResult;
                }
            } else {
                $_SESSION['MAJadmin'] = "Veuillez remplir tous les champs.";
            }
    
            header("Location: index.php?action=admin");
            exit;
        }
    }


//Modifications
    //Produit
    public function modifierProduitProcess($id_produit) {
        if (isset($_POST['submit'])) {
            $designation = filter_input(INPUT_POST, 'designation', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $prix = filter_input(INPUT_POST, 'prix', FILTER_VALIDATE_FLOAT);
            $id_categorie = filter_input(INPUT_POST, 'id_categorie', FILTER_VALIDATE_INT);
            
            // Vérification des champs obligatoires
            if ($designation && $description && $prix && $id_categorie) {
                // Vérifier si un fichier image a été uploadé
                if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                    // Appel de la méthode d'upload sécurisée
                    $uploadResult = $this->uploadImage($_FILES['image']);
    
                    if (strpos($uploadResult, 'Erreur') === false) {
                        // Si l'upload est réussi, mise à jour du produit avec la nouvelle image
                        $this->produitManager->modifierProduit($id_produit, $designation, $description, $prix, $id_categorie, $uploadResult);
                        $_SESSION['MAJproduit'] = "Produit modifié avec succès!";
                    } else {
                        $_SESSION['MAJproduit'] = $uploadResult;
                    }
                } else {
                    // Si pas d'image uploadée, on ne modifie pas l'image
                    $this->produitManager->modifierProduit($id_produit, $designation, $description, $prix, $id_categorie, null);
                    $_SESSION['MAJproduit'] = "Produit modifié avec succès (sans changer l'image)!";
                }
            } else {
                $_SESSION['MAJproduit'] = "Veuillez remplir tous les champs.";
            }
    
            header("Location: index.php?action=afficherModifierProduit&id_produit=$id_produit");
            exit;
        }
    }
    
}