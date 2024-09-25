<?php

ob_start(); 

use Model\Managers\ProduitManager;
use Controller\PanierController;

$produitManager = new ProduitManager();
$panierController = new PanierController();

// Récupérer toutes les catégories avec leurs produits
$categoriesAvecProduits = $produitManager->obtenirToutesCategoriesAvecProduits();

?>
<!-- Boutique -->
<div class="boutique-container">
    <div class="prestations-container">
        <?php foreach ($categoriesAvecProduits as $categorieNom => $produits) { ?>
            <div class="categorie">
                <h2><?= $categorieNom; ?></h2>
                <div class="liste-prestations">
                    <?php foreach ($produits as $produit) { ?>
                        <div class="prestation">
                            <div class="details-prestation">
                                <h3><?= $produit["designation"]; ?></h3>
                                <span><?= $produit["prix"]; ?> €</span>
                            </div>
                            <div class="actions-prestation">
                                <form method="get" action="index.php">
                                    <input type="hidden" name="action" value="ajouterAuPanier">
                                    <input type="hidden" name="id_produit" value="<?= $produit['id_produit']; ?>">
                                    <button type="submit">Ajouter au panier</button>
                                </form>

                                <?php if (\App\Session::estAdmin()) { ?>
                                    <!-- Bouton de suppression visible uniquement pour les admins -->
                                    <form method="post" action="index.php?action=supprimerProduit">
                                        <input type="hidden" name="id_produit" value="<?= $produit['id_produit']; ?>">
                                        <button type="submit" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce produit ?');">X</button>
                                    </form>
                                <?php } ?>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        <?php } ?>
    </div>
</div>
<!-- fin boutique -->

<?php
$titre = "Boutique - Oh My Beauty";
$contenu = ob_get_clean();
require "template.php";
?>
