<?php

use Controller\AccueilController;
use Controller\SecuriteController;
use Controller\PanierController;
use Controller\ReservationController;
use Controller\AdminController;
use Model\Managers\CommandeManager;

spl_autoload_register(function($nom_classe){
    include $nom_classe . '.php';
});

$ctrlAccueil = new AccueilController();
$ctrlSecurite = new SecuriteController();
$ctrlPanier = new PanierController();
$ctrlReservation = new ReservationController();
$ctrlAdmin = new AdminController();
$commandeManager = new CommandeManager();

$id = isset($_GET["id"]) ? $_GET["id"] : null;

if(isset($_GET["action"])){
    switch ($_GET["action"]) {
        // Changement de vues
        case "home" : $ctrlAccueil->afficherHome(); break;
        case "aPropos" : $ctrlAccueil->afficherAPropos(); break;
        case "prestations" : $ctrlAccueil->afficherPrestations(); break;
        case "contact" : $ctrlAccueil->afficherContact(); break;
        case "boutique" : $ctrlAccueil->afficherBoutique(); break;
        case "recap": $ctrlAccueil->afficherRecap(); break;
        case "inscription": $ctrlAccueil->afficherInscription(); break;
        case "connexion": $ctrlAccueil->afficherConnexion(); break;
        case "panier": $ctrlAccueil->afficherPanier(); break;
        // Envoi de mail
        case "envoyerMail": $ctrlAccueil->envoyerMail(); break;
        // Sécurité
        case "deconnexion": $ctrlSecurite->deconnexion(); break;
        case "inscriptionProcess": $ctrlSecurite->inscription(); break;
        case "connexionProcess": $ctrlSecurite->connexion(); break;
        case "supprimerUtilisateur": $ctrlSecurite->supprimerUtilisateurProcess(); break;
        // Panier
        case 'ajouterAuPanier':
            if (isset($_GET['id_produit'])) {
                $ctrlPanier->ajouterAuPanier($_GET['id_produit']);
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
            if (isset($_POST['id_utilisateur'])) { 
                $ctrlPanier->validerCommande();
            }
            break;
        case 'telechargerRecu':
            if (isset($_GET['id_commande'])) {
                $detailsCommande = $commandeManager->obtenirDetailsCommande($_GET['id_commande']);
                $ctrlAccueil->genererRecuPDF($detailsCommande);
            }
            break;
        // Réservation
        case 'reserver': $ctrlReservation->reserver(); break;
        case 'choisirCreneau': $ctrlReservation->choisirCreneau(); break;
        case 'annulerReservation': $ctrlReservation->annulerReservationProcess(); break;
        // Admin
            //ajout
        case 'ajouterProduit': $ctrlAdmin->ajouterProduitProcess(); break;
        case 'ajouterPrestation': $ctrlAdmin->ajouterPrestationProcess(); break;
            //suppression
        case 'supprimerProduit': $ctrlAdmin->supprimerProduitProcess(); break;
        case 'supprimerPrestation': $ctrlAdmin->supprimerPrestationProcess(); break;
            //modiffications
        case 'afficherModifierProduit': $ctrlAdmin->afficherModifierProduit(); break;
        case 'modifierProduit': $ctrlAdmin->modifierProduitProcess($_GET['id_produit']); break;
        case 'afficherModifierPrestation': $ctrlAdmin->afficherModifierPrestation(); break;
        case 'modifierPrestation': $ctrlAdmin->modifierPrestationProcess($_GET['id_prestation']); break;
            //affichage
        case 'admin': $ctrlAdmin->afficherAdmin(); break;
        case 'voirRendezVous': $ctrlAdmin->voirRendezVous(); break;
        }
} else {
    // Si aucun paramètre "action" n'est défini, afficher la vue par défaut
    $ctrlAccueil->afficherHome();
}
