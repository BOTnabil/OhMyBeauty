<?php

use Controller\AccueilController;
use Controller\SecuriteController;
use Controller\PanierController;
use Controller\ReservationController;
use Model\Managers\CommandeManager;

spl_autoload_register(function($nom_classe){
    include $nom_classe . '.php';
});

$ctrlAccueil = new AccueilController();
$ctrlSecurite = new SecuriteController();
$ctrlPanier = new PanierController();
$ctrlReservation = new ReservationController();
$commandeManager = new CommandeManager();

$id = isset($_GET["id"]) ? $_GET["id"] : null;

if(isset($_GET["action"])){
    switch ($_GET["action"]) {
        // Changement de vues
        case "vueParDefaut" : $ctrlAccueil->afficherParDefaut(); break;
        case "aPropos" : $ctrlAccueil->afficherAPropos(); break;
        case "prestations" : $ctrlAccueil->afficherPrestations(); break;
        case "contact" : $ctrlAccueil->afficherContact(); break;
        case "boutique" : $ctrlAccueil->afficherBoutique(); break;
        case "recap": $ctrlAccueil->afficherRecap(); break;
        // Envoi de mail
        case "envoyerContact": $ctrlAccueil->envoyerContact(); break;
        // Sécurité
        case "deconnexion": $ctrlSecurite->deconnexion(); break;
        case "inscription": $ctrlSecurite->inscription(); break;
        case "connexion": $ctrlSecurite->connexion(); break;
        // Panier
        case 'ajouterAuPanier':
            if (isset($_GET['idProduit'])) {
                $ctrlPanier->ajouterAuPanier($_GET['idProduit']);
            }
            break;
        case 'supprimerDuPanier':
            if (isset($_GET['id'])) {
                $ctrlPanier->supprimerDuPanier($_GET['id']);
            }
            break;
        case 'viderPanier':
            $ctrlPanier->viderPanier();
            break;
        case 'augmenterQttProduit':
            if (isset($_GET['id'])) {
                $ctrlPanier->augmenterQttProduit($_GET['id']);
            }
            break;
        case 'diminuerQttProduit':
            if (isset($_GET['id'])) {
                $ctrlPanier->diminuerQttProduit($_GET['id']);
            }
            break;
        case 'validerCommande':
            if (isset($_POST['idUtilisateur'])) { 
                $ctrlPanier->validerCommande($_POST['idUtilisateur']);
            }
            break;
        case 'telechargerRecu':
            if (isset($_GET['idCommande'])) {
                $detailsCommande = $commandeManager->obtenirDetailsCommande($_GET['idCommande']);
                $ctrlAccueil->genererRecuPDF($detailsCommande);
            }
            break;
        // Réservation
        case 'reservation': $ctrlReservation->Reservation(); break;
        case 'choisirCreneau': $ctrlReservation->choisirCreneau(); break;
        case 'annulerReservation': $ctrlReservation->AnnulerReservation(); break;
    } 
} else {
    // Si aucun paramètre "action" n'est défini, afficher la vue par défaut
    $ctrlAccueil->afficherParDefaut();
}
