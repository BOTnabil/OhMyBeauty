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

    public function ajouterAuPanier($idProduit) {
        $productData = $this->produitManager->obtenirProduitParId($idProduit);

        if ($productData) {
            $nom = $productData['designation'];
            $prix = $productData['prix'];
            $qtt = 1;
            $produitExiste = false;
            $produit = [
                "id" => $idProduit,
                "nom" => $nom,
                "prix" => $prix,
                "qtt" => $qtt,
                "total" => $prix * $qtt
            ];
            
            foreach ($_SESSION['products'] as &$produitExistant) {
                if ($produitExistant['id'] === $idProduit) {
                    $produitExistant['qtt'] += $qtt;
                    $produitExistant['total'] = $produitExistant['prix'] * $produitExistant['qtt'];
                    $produitExiste = true;
                    break;
                }
            }

            if (!$produitExiste) {
                $_SESSION['products'][] = $produit;
            }

            $_SESSION['MAJtxt'] = "Article ajouté(s)";
        
        } 
        header("Location:index.php?action=boutique");
    
    } 

    public function supprimerDuPanier($id) {
        unset($_SESSION['products'][$id]);
        $_SESSION['MAJrecap'] = "L'article a bien été supprimé";
        header("Location:index.php?action=boutique");
    }

    public function viderPanier() {
        unset($_SESSION['products']);
        $_SESSION['MAJtxt'] = "Tous les articles ont été supprimés";
        header("Location:index.php?action=boutique");
    }

    public function augmenterQttProduit($id) {
        if (isset($_SESSION['products'][$id])) {
            $_SESSION['products'][$id]['qtt']++;
            $_SESSION['products'][$id]['total'] = $_SESSION['products'][$id]['prix'] * $_SESSION['products'][$id]['qtt'];
        }
        header("Location:index.php?action=boutique");
    }

    public function diminuerQttProduit($id) {
        if (isset($_SESSION['products'][$id]) && $_SESSION['products'][$id]['qtt'] > 0) {
            $_SESSION['products'][$id]['qtt']--;
            $_SESSION['products'][$id]['total'] = $_SESSION['products'][$id]['prix'] * $_SESSION['products'][$id]['qtt'];
            if ($_SESSION['products'][$id]['qtt'] == 0) {
                unset($_SESSION['products'][$id]);
                $_SESSION['MAJtxt'] = "L'article a bien été supprimé";
            }
        }
        header("Location:index.php?action=boutique");

    }

    public function validerCommande() {
        if (isset($_SESSION['user_id'])) {
            if (!empty($_SESSION['products'])) {
                $prixTotal = 0;
                $idUtilisateur = $_SESSION['user_id'];

                // Calcul du prix total
                foreach ($_SESSION['products'] as $produit) {
                    $prixTotal += $produit['total'];
                }

                // Créer la commande
                $idCommande = $this->commandeManager->creerCommande($prixTotal, $idUtilisateur);

                // Ajouter les produits dans la commande
                foreach ($_SESSION['products'] as $produit) {
                    $this->contenirManager->ajouterProduitACommande($idCommande, $produit['id'], $produit['qtt']);
                }

                // Vider le panier
                unset($_SESSION['products']);
                $_SESSION['MAJtxt'] = "Commande validée avec succès!";

                header("Location:index.php?action=boutique");
            }
        } else {
            $_SESSION['MAJtxt'] = "Une erreur est survenue";
        }
    }
}
