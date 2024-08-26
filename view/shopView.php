<?php

ob_start(); 

use Model\Managers\ProduitManager;
use Controller\PanierController;

$produitManager = new ProduitManager();

// Récupération de toutes les catégories avec leurs services
$categoriesWithProduits = $produitManager->getAllCategoriesWithProduits();
?>

<?php 
    if(!isset($_SESSION['products']) || empty($_SESSION['products'])){
        echo "<p>Aucun produit en session...</p>";
    }
    else{
        echo "<table class='table'>",
                "<thead>",
                    "<tr>",
                        "<th>#</th>",
                        "<th>Nom</th>",
                        "<th>Prix</th>",
                        "<th>Quantité</th>",
                        "<th>Total</th>",
                    "</tr>",
                "<thead>",
                "<tbody>";
        $totalGeneral = 0;
        foreach($_SESSION['products'] as $index => $product){
            echo "<tr>",
                    "<td>".$index."</td>",
                    "<td>".$product['name']."</td>",
                    "<td>".number_format($product['price'], 2, ",", "&nbsp;")."&nbsp;€</td>",
                    "<td><a href='traitement.php?action=down-qtt&id=$index'>-</a>".$product['qtt']."<a href='traitement.php?action=up-qtt&id=$index'>+</a></td>",
                    "<td>".number_format($product['total'], 2, ",", "&nbsp;")."&nbsp;€</td>",
                    "<td>
                       <a href='traitement.php?action=delete&id=$index'>Supp</a>
                    </td>",
                "</tr>";
                $totalGeneral+= $product['total']*$product['qtt'];
        }

        $totalQtt = 0;
        foreach($_SESSION['products'] as $index => $product){
            $totalQtt += $product['qtt'];
        }
        echo "<tr>",
                "<td colspan=3>Quantité totale d'articles : </td>",
                "<td>$totalQtt</td>",
            "</tr>",
            "<tr>",
                "<td colspan=4>Total général : </td>",
                "<td><strong>".number_format($totalGeneral, 2, ",", "&nbsp;")."&nbsp;€</strong></td>",
            "</tr>",
            "</tbody>",
            "</table>";
            
    }
    echo $_SESSION['MAJrecap'];
?>

    <a href="traitement.php?action=clear">Vider le panier</a>

<div class="services-container">
    <?php foreach ($categoriesWithProduits as $categorieNom => $produits) { ?>
        <div class="category">
            <h2><?= $categorieNom; ?></h2>
            <div class="services-list">
                <?php foreach ($produits as $produit) { ?>
                    <div class="service">
                        <div class="service-details">
                            <h3><?= $produit["designation"]; ?></h3>
                            <span><?= $produit["prix"]; ?> €</span>
                        </div>
                        <div class="service-actions">
                            <button>Choisir</button>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    <?php } ?>
</div>

    <?php
$titre = "Shop - Oh My Beauty";
$contenu = ob_get_clean();
require "template.php";
?>