<?php

ob_start(); 

use Model\Managers\ProduitManager;
use Controller\PanierController;

$produitManager = new ProduitManager();
$panierController = new PanierController();

// Fetch all des categories avec leurs produits
$categoriesWithProduits = $produitManager->getAllCategoriesWithProduits();
?>

<div class="shop-container">
<div class="cart-container">
        <h2>Votre Panier</h2>
        <?php if (!empty($_SESSION['products'])) { ?>
            <table>
                <thead>
                    <tr>
                        <th>Produit</th>
                        <th>Prix Unitaire</th>
                        <th>Quantité</th>
                        <th>Total</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($_SESSION['products'] as $index => $product) { ?>
                        <tr>
                            <td><?= $product['name']; ?></td>
                            <td><?= $product['price']; ?> €</td>
                            <td><?= $product['qtt']; ?></td>
                            <td><?= $product['total']; ?> €</td>
                            <td>
                                <a href="index.php?action=up-qtt&id=<?= $index; ?>">+</a>
                                <a href="index.php?action=down-qtt&id=<?= $index; ?>">-</a>
                                <a href="index.php?action=delete&id=<?= $index; ?>">Supprimer</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <div class="cart-summary">
                <p><strong>Total Général: </strong> 
                <?php 
                    $totalGeneral = 0;
                    foreach ($_SESSION['products'] as $product) {
                        $totalGeneral += $product['total'];
                    }
                    echo $totalGeneral . " €";
                ?>
                </p>
                <form method="post" action="index.php?action=validate">
                    <input type="hidden" name="idUtilisateur" value="1"> <!-- Assuming user ID is 1 for now -->
                    <button type="submit">Valider la commande</button>
                </form>
                <form method="get" action="index.php">
                    <input type="hidden" name="action" value="clear">
                    <button type="submit">Vider le panier</button>
                </form>
            </div>
        <?php } else { ?>
            <p>Votre panier est vide.</p>
        <?php } ?>
    </div>
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
                                <form method="get" action="index.php">
                                    <input type="hidden" name="action" value="add">
                                    <input type="hidden" name="idProduit" value="<?= $produit['idProduit']; ?>">
                                    <button type="submit">Ajouter au panier</button>
                                </form>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        <?php } ?>
    </div>
</div>

<?php
$titre = "Shop - Oh My Beauty";
$contenu = ob_get_clean();
require "template.php";
?>