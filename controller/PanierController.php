<?php

namespace Controller;

session_start();

use Model\Managers\ProduitManager;
use Model\Managers\CommandeManager;
use Model\Managers\ContenirManager;

class PanierController {
    private $produitManager;
    private $commandeManager;
    private $contenirManager;
    

    public function __construct() {
        $this->produitManager = new ProduitManager();
        $this->commandeManager = new CommandeManager();
        $this->contenirManager = new ContenirManager();
    }

// Méthodes
public function ajouterAuPanier($id_produit) {
    // Récupère les données du produit et de sa catégorie
    $produitDonnees = $this->produitManager->obtenirProduitEtSaCategorieParId($id_produit);
    
    // Définit la quantité par défaut à 1 si non spécifiée
    $quantite = isset($_GET['quantite']) ? (int)$_GET['quantite'] : 1;

    // Si les données ont bien été récupérées
    if ($produitDonnees) {
        // Préparation des données du produit
        $nom = $produitDonnees['designation'];
        $prix = $produitDonnees['prix'];
        $image = $produitDonnees['image'];
        $produitExiste = false;

        // Structure du produit
        $produit = [
            "id" => $id_produit,
            "nom" => $nom,
            "prix" => $prix,
            "image" => $image,
            "qtt" => $quantite,
            "total" => $prix * $quantite
        ];

        // Vérifie si le produit est déjà dans le panier
        foreach ($_SESSION['products'] as &$produitExistant) {
            if ($produitExistant['id'] === $id_produit) {
                // Si oui, met à jour la quantité et le total
                $produitExistant['qtt'] += $quantite;
                $produitExistant['total'] = $produitExistant['prix'] * $produitExistant['qtt'];
                $produitExiste = true;
                break;
            }
        }

        // Si le produit n'existe pas, on l'ajoute au panier
        if (!$produitExiste) {
            $_SESSION['products'][] = $produit;
        }

        // Message de confirmation pour mise à jour
        $_SESSION['MAJpanier'] = "Article ajouté au panier.";
    }

    // Redirige vers la page du produit
    header("Location:index.php?action=voirArticle&id_produit=" . $id_produit);
}


    public function supprimerDuPanier($id) {
        //On supprime l'article en session par son ID
        unset($_SESSION['products'][$id]);
        $_SESSION['MAJpanier'] = "L'article a bien été supprimé";
        header("Location:index.php?action=panier");
    }

    public function viderPanier() {
        //On vide entièrement le panier en session
        unset($_SESSION['products']);
        $_SESSION['MAJpanier'] = "Tous les articles ont été supprimés";
        header("Location:index.php?action=panier");
    }

    public function augmenterQttProduit($id) {
        //Pour un produit existant qu'on aura identifié par ID, on ajoute une qtt
        if (isset($_SESSION['products'][$id])) {
            $_SESSION['products'][$id]['qtt']++;

            //on re calcule le prix total
            $_SESSION['products'][$id]['total'] = $_SESSION['products'][$id]['prix'] * $_SESSION['products'][$id]['qtt'];
        }
        header("Location:index.php?action=panier");
    }

    public function diminuerQttProduit($id) {
        //Pour un produit existant qu'on aura identifié par ID, on diminue de 1 la qtt
        if (isset($_SESSION['products'][$id]) && $_SESSION['products'][$id]['qtt'] > 0) {
            $_SESSION['products'][$id]['qtt']--;
            $_SESSION['products'][$id]['total'] = $_SESSION['products'][$id]['prix'] * $_SESSION['products'][$id]['qtt'];

            //si après diminution la qtt est à 0, on supprime le produit
            if ($_SESSION['products'][$id]['qtt'] == 0) {
                unset($_SESSION['products'][$id]);
                $_SESSION['MAJpanier'] = "L'article a bien été supprimé";
            }
        }
        header("Location:index.php?action=panier");
    }

    public function validerCommande() {
        // Vérification si l'utilisateur est connecté
        if (isset($_SESSION['user_id'])) {
            if (!empty($_SESSION['products'])) {
                $prixTotal = 0;
                $id_utilisateur = $_SESSION['user_id'];
        
                // Génération du numéro de commande unique
                $numeroCommande = $this->genererNumeroCommande();
        
                // Calcul du prix total et génération des informations de la commande
                $infosCommande = $this->genererInfosCommandeTexte($_SESSION['products'], $numeroCommande);
                
                foreach ($_SESSION['products'] as $produit) {
                    $prixTotal += $produit['total'];
                }
    
                // Vérification que tous les produits existent encore dans la base de données
                foreach ($_SESSION['products'] as $produit) {
                    // Vérifie si le produit existe encore en base de données
                    $produitExistant = $this->produitManager->obtenirProduitEtSaCategorieParId($produit['id']);
                    if (!$produitExistant) {
                        // Si le produit n'existe plus, annuler la commande
                        $_SESSION['MAJpanier'] = "Le produit '" . $produit['nom'] . "' n'existe plus. Veuillez mettre à jour votre panier.";
                        header("Location: index.php?action=panier");
                        exit;
                    }
                }
    
                // Si tous les produits sont valides, créer la commande avec le numéro de commande
                $id_commande = $this->commandeManager->creerCommande($prixTotal, $id_utilisateur, $infosCommande, $numeroCommande);
    
                // lier les produits et la commande avec les qtt dans Contenir
                foreach ($_SESSION['products'] as $produit) {
                    $this->contenirManager->lierProduitACommande($id_commande, $produit['id'], $produit['qtt']);
                }
        
                // Vider le panier
                unset($_SESSION['products']);
                $_SESSION['MAJpanier'] = "Commande validée avec succès!";
                header("Location:index.php?action=recap");
            }
        } else {
            header("Location: index.php?action=connexion");
        }
    }
    

    // génère les informations sur la commande sous forme de texte
    private function genererInfosCommandeTexte($produits, $numeroCommande) {
        $infos = '';
        foreach ($produits as $produit) {
            $sousTotal = $produit['qtt'] * $produit['prix'];

            if ($produit['qtt'] > 1) {  // Affiche le sous-total uniquement si la quantité est supérieure à 1
                $infos .= $produit['nom'] . " (Quantité : " . $produit['qtt'] . ", Prix unitaire : " . $produit['prix'] . " €).<br>
                 Sous-total : " . $sousTotal . " €.<br>";
            } else {
                $infos .= $produit['nom'] . " (Quantité : " . $produit['qtt'] . ", Prix unitaire : " . $produit['prix'] . " €)<br>";
            }
        }
        return rtrim($infos, '<br>');  // Supprime le dernier <br> s'il y en a un
    }

    private function genererNumeroCommande() {

        // Utilise la date et l'heure actuelles
        date_default_timezone_set('Europe/Paris');
        $dateHeure = date('Hisdmy'); // Format HHMMSSDDMMYY
    
        // Génère un nombre aléatoire pour garantir l'unicité
        $random = rand(100, 999);
    
        // Combine la date, l'heure et le nombre aléatoire
        $numeroCommande = $dateHeure . $random;
    
        return $numeroCommande;
    }
    

    public function voirDetailsCommande() {
        if (isset($_GET['id_commande'])) {
            $id_commande = $_GET['id_commande'];
    
            // Récupérer les informations de la commande, y compris infosCommande
            $commandeDetails = $this->commandeManager->obtenirDetailsCommande($id_commande);
    
            // Charger la vue avec les informations de la commande
            require 'view/recapUtilisateurView.php';
        }
    }
}
