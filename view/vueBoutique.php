<?php

ob_start(); 

use Model\Managers\ProduitManager;
use Controller\PanierController;

$produitManager = new ProduitManager();
$panierController = new PanierController();

// Récupérer toutes les catégories avec leurs produits
$categoriesAvecProduits = $produitManager->obtenirToutesCategoriesAvecProduits();

?>

<div class="boutique-container">
    <div class="panier-container">
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
                    <?php foreach ($_SESSION['products'] as $index => $produit) { ?>
                        <tr>
                            <td><?= $produit['nom']; ?></td>
                            <td><?= $produit['prix']; ?> €</td>
                            <td><?= $produit['qtt']; ?></td>
                            <td><?= $produit['total']; ?> €</td>
                            <td>
                                <a href="index.php?action=augmenterQttProduit&id=<?= $index; ?>">+</a>
                                <a href="index.php?action=diminuerQttProduit&id=<?= $index; ?>">-</a>
                                <a href="index.php?action=supprimerDuPanier&id=<?= $index; ?>">Supprimer</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <div class="resume-panier">
                <p><strong>Total Général : </strong> 
                <?php 
                    $totalGeneral = 0;
                    foreach ($_SESSION['products'] as $produit) {
                        $totalGeneral += $produit['total'];
                    }
                    echo $totalGeneral . " €";
                ?>
                </p>
                    <form method="post" action="index.php?action=validerCommande">
                        <input type="hidden" name="id_utilisateur" value="1"> <!-- Supposons que l'ID de l'utilisateur soit 1 pour l'instant -->
                        <button type="submit">Valider la commande</button>
                    </form>
                <form method="get" action="index.php">
                    <input type="hidden" name="action" value="viderPanier">
                    <button type="submit">Vider le panier</button>
                </form>
            </div>
        <?php } else { ?>
            <p>Votre panier est vide.</p>
        <?php } 

            if (isset($_SESSION['MAJpanier'])) {
                echo '<p class="MAJpanier">' . $_SESSION['MAJpanier'] . '</p>';
                unset($_SESSION['MAJpanier']); // Supprimer la MAJ après l'affichage
            }
        ?>

    </div>

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

<?php
$titre = "Boutique - Oh My Beauty";
$contenu = ob_get_clean();
require "template.php";
?>
