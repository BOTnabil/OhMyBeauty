<?php

use Controller\HomeController;
use Controller\SecurityController;
use Controller\PanierController;
use Model\Managers\CommandeManager;

spl_autoload_register(function($class_name){
    include $class_name . '.php';
});

$ctrlHome = new HomeController();
$ctrlSecurity = new SecurityController();
$ctrlPanier = new PanierController();
$commandeManager = new CommandeManager();

$id = isset($_GET["id"]) ? $_GET["id"] : null;

if(isset($_GET["action"])){
    switch ($_GET["action"]) {
        // Changement de views
        case "defaultView" : $ctrlHome->defaultView(); break;
        case "aPropos" : $ctrlHome->aPropos(); break;
        case "services" : $ctrlHome->services(); break;
        case "contact" : $ctrlHome->contact(); break;
        case "shop" : $ctrlHome->shop(); break;
        case "recap": $ctrlHome->recap(); break;
        // Envoie de mail
        case "contactSubmit": $ctrlHome->contactSubmit(); break;
        // Security
        case "logout": $ctrlSecurity->logout(); break;
        case "register": $ctrlSecurity->register(); break;
        case "login": $ctrlSecurity->login(); break;
        // Panier
        case 'add':
            if (isset($_GET['idProduit'])) {
                $ctrlPanier->addToCart($_GET['idProduit']);
            }
            break;
        case 'delete':
            if (isset($_GET['id'])) {
                $ctrlPanier->removeFromCart($_GET['id']);
            }
            break;
        case 'clear':
            $ctrlPanier->clearCart();
            break;
        case 'up-qtt':
            if (isset($_GET['id'])) {
                $ctrlPanier->increaseQuantity($_GET['id']);
            }
            break;
        case 'down-qtt':
            if (isset($_GET['id'])) {
                $ctrlPanier->decreaseQuantity($_GET['id']);
            }
            break;
        case 'validate':
            if (isset($_POST['idUtilisateur'])) { 
                $ctrlPanier->validateCommande($_POST['idUtilisateur']);
            }
            break;
        case 'downloadReceipt':
            if (isset($_GET['idCommande'])) {
                $commandeDetails = $commandeManager->getCommandeDetails($_GET['idCommande']);
                $ctrlHome->generateReceiptPDF($commandeDetails);
            }
            break;
        //
    } 
} else {
    // Si aucun paramètre "action" n'est défini, afficher la vue par défaut
    $ctrlHome->defaultView();
}