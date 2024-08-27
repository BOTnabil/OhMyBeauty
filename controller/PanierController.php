<?php

namespace Controller;

session_start();

use Model\Managers\ProduitManager;
// use Model\Managers\CommandeManager;

class PanierController {
    private $produitManager;

    public function __construct() {
        $this->produitManager = new ProduitManager();
        // $this->commandeManager = new commandeManager();
    }

    public function addToCart($idProduit) {
        $productData = $this->produitManager->getProduitById($idProduit);

        if ($productData) {
            $name = $productData['designation'];
            $price = $productData['prix'];
            $qtt = 1;
            $productExists = false;
            $product = [
                "id" => $idProduit,
                "name" => $name,
                "price" => $price,
                "qtt" => $qtt,
                "total" => $price * $qtt
            ];
            
            foreach ($_SESSION['products'] as &$existingProduct) {
                if ($existingProduct['id'] === $idProduit) {
                    $existingProduct['qtt'] += $qtt;
                    $existingProduct['total'] = $existingProduct['price'] * $existingProduct['qtt'];
                    $productExists = true;
                    break;
                }
            }

            if (!$productExists) {
                $_SESSION['products'][] = $product;
            }

            $_SESSION['MAJindex'] = "Article ajouté(s)";
        
        } 
             header("Location:index.php?action=shop");
    
    } 

    public function removeFromCart($id) {
        unset($_SESSION['products'][$id]);
        $_SESSION['MAJrecap'] = "L'article a bien été supprimé";
        header("Location:index.php?action=shop");
    }

    public function clearCart() {
        unset($_SESSION['products']);
        $_SESSION['MAJrecap'] = "Tous les articles ont été supprimés";
        header("Location:index.php?action=shop");
    }

    public function increaseQuantity($id) {
        if (isset($_SESSION['products'][$id])) {
            $_SESSION['products'][$id]['qtt']++;
            $_SESSION['products'][$id]['total'] = $_SESSION['products'][$id]['price'] * $_SESSION['products'][$id]['qtt'];
        }
        header("Location:index.php?action=shop");
    }

    public function decreaseQuantity($id) {
        if (isset($_SESSION['products'][$id]) && $_SESSION['products'][$id]['qtt'] > 0) {
            $_SESSION['products'][$id]['qtt']--;
            $_SESSION['products'][$id]['total'] = $_SESSION['products'][$id]['price'] * $_SESSION['products'][$id]['qtt'];
            if ($_SESSION['products'][$id]['qtt'] == 0) {
                unset($_SESSION['products'][$id]);
                $_SESSION['MAJrecap'] = "L'article a bien été supprimé";
            }
        }
        header("Location:index.php?action=shop");

        }

    }