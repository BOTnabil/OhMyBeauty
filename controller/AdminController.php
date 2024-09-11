<?php

namespace Controller;

use Model\Managers\ProduitManager;
use Model\Managers\ReservationManager;
use Model\Managers\ContenirManager;
use App\Session;

class AdminController {
    private $produitManager;
    private $reservationManager;
    private $contenirManager;
    

    public function __construct() {
        $this->produitManager = new ProduitManager();
        $this->reservationManager = new ReservationManager();
        $this->contenirManager = new ContenirManager();
    } 

    public function supprimerProduit() {
        // Vérifier que l'utilisateur est administrateur
        if (!Session::estAdmin()) {
            $_SESSION['error'] = "Vous n'êtes pas autorisé à effectuer cette action.";
            header("Location: index.php?action=boutique");
            exit;
        }

        // Récupérer l'ID du produit
        if (isset($_POST['idProduit'])) {
            $idProduit = $_POST['idProduit'];

            // Supprimer toutes les lignes contenant ce produit dans la table "contenir"
            $this->contenirManager->supprimerProduitDeContenir($idProduit);

            // Supprimer le produit de la table "produit"
            $this->produitManager->supprimerProduit($idProduit);

            $_SESSION['MAJpanier'] = "Le produit a été supprimé avec succès.";
            header("Location: index.php?action=boutique");
        }
    }
}