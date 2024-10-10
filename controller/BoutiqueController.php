<?php

namespace Controller;

use Model\Managers\CategorieManager;
use Model\Managers\ProduitManager;

class BoutiqueController {

    private $categorieManager;
    private $produitManager;

    // Constructeur pour initialiser les managers
    public function __construct() {
        $this->categorieManager = new CategorieManager();
        $this->produitManager = new ProduitManager();
    }

    // Méthode pour afficher les catégories
    public function afficherCategories() {
        $categories = $this->categorieManager->obtenirToutesLesCategories(); // Récupère toutes les catégories
        require 'view/vueCategories.php'; // Charger la vue des catégories
    }

    // Méthode pour afficher les articles par catégorie
    public function voirArticlesParCategorie() {
        if (isset($_GET['id_categorie'])) {
            $id_categorie = $_GET['id_categorie'];
            $articles = $this->produitManager->obtenirArticlesParCategorie($id_categorie); // Récupère les articles par catégorie
            $categorieNom = $this->categorieManager->obtenirNomCategorie($id_categorie);  // Récupère le nom de la catégorie
            require 'view/vueArticlesCategorie.php'; // Charger la vue des articles
        } else {
            header('Location: index.php?action=categorie'); // Rediriger si pas de catégorie
        }
    }

    public function voirArticle() {
        if (isset($_GET['id_produit'])) {
            $id_produit = $_GET['id_produit'];
            $article = $this->produitManager->obtenirProduitParId($id_produit); // Récupère les informations de l'article
            require 'view/vueArticle.php'; // Charger la vue de l'article
        }
    }
    
}
