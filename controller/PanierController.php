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

    public function ajouterAuPanier($id_produit) {
        $productData = $this->produitManager->obtenirProduitParId($id_produit);

        if ($productData) {
            $nom = $productData['designation'];
            $prix = $productData['prix'];
            $qtt = 1;
            $produitExiste = false;
            $produit = [
                "id" => $id_produit,
                "nom" => $nom,
                "prix" => $prix,
                "qtt" => $qtt,
                "total" => $prix * $qtt
            ];
            
            foreach ($_SESSION['products'] as &$produitExistant) {
                if ($produitExistant['id'] === $id_produit) {
                    $produitExistant['qtt'] += $qtt;
                    $produitExistant['total'] = $produitExistant['prix'] * $produitExistant['qtt'];
                    $produitExiste = true;
                    break;
                }
            }

            if (!$produitExiste) {
                $_SESSION['products'][] = $produit;
            }

            $_SESSION['MAJpanier'] = "Article ajouté";
        } 
        header("Location:index.php?action=boutique");
    
    } 

    public function supprimerDuPanier($id) {
        unset($_SESSION['products'][$id]);
        $_SESSION['MAJpanier'] = "L'article a bien été supprimé";
        header("Location:index.php?action=panier");
    }

    public function viderPanier() {
        unset($_SESSION['products']);
        $_SESSION['MAJpanier'] = "Tous les articles ont été supprimés";
        header("Location:index.php?action=panier");
    }

    public function augmenterQttProduit($id) {
        if (isset($_SESSION['products'][$id])) {
            $_SESSION['products'][$id]['qtt']++;
            $_SESSION['products'][$id]['total'] = $_SESSION['products'][$id]['prix'] * $_SESSION['products'][$id]['qtt'];
        }
        header("Location:index.php?action=panier");
    }

    public function diminuerQttProduit($id) {
        if (isset($_SESSION['products'][$id]) && $_SESSION['products'][$id]['qtt'] > 0) {
            $_SESSION['products'][$id]['qtt']--;
            $_SESSION['products'][$id]['total'] = $_SESSION['products'][$id]['prix'] * $_SESSION['products'][$id]['qtt'];
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
    
                // Calcul du prix total et génération des informations de la commande
                $infosCommande = $this->genererInfosCommandeTexte($_SESSION['products']);
                
                foreach ($_SESSION['products'] as $produit) {
                    $prixTotal += $produit['total'];
                }
    
                // Créer la commande avec infosCommande initialisé
                $id_commande = $this->commandeManager->creerCommande($prixTotal, $id_utilisateur, $infosCommande);
    
                // Ajouter les produits dans la commande
                foreach ($_SESSION['products'] as $produit) {
                    $this->contenirManager->ajouterProduitACommande($id_commande, $produit['id'], $produit['qtt']);
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
    private function genererInfosCommandeTexte($produits) {
        $infos = '';
        foreach ($produits as $produit) {
            $sousTotal = $produit['qtt'] * $produit['prix'];

            if ($produit['qtt'] > 1) {  // Affiche le sous-total uniquement si la quantité est supérieure à 1
                $infos .= $produit['nom'] . " (Quantité : " . $produit['qtt'] . ", Prix unitaire : " . $produit['prix'] . " €).<br> Sous-total : " . $sousTotal . " €.<br>";
            } else {
                $infos .= $produit['nom'] . " (Quantité : " . $produit['qtt'] . ", Prix unitaire : " . $produit['prix'] . " €)<br>";
            }
        }
        return rtrim($infos, '<br>');  // Supprime le dernier <br> s'il y en a un
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
