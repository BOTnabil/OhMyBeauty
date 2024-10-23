<?php
ob_start();
?>

    <div class="product-detail-container">
        <div class="product-image">
            <img src="./public/img/<?= $article['image']; ?>" alt="Image du produit">
        </div>
        <div class="product-info">
            <div class="product-category">
                <h2><?= $article['nom_categorie']; ?></h2>
                <div class="edit-icons">
                    <!-- Si l'utilisateur est admin, afficher les boutons supplémentaires -->
                    <?php if (\App\Session::estAdmin()) { ?>
                            <!-- Bouton Modifier le produit -->
                            <form method="get" action="index.php">
                                <input type="hidden" name="action" value="afficherModifierProduit">
                                <input type="hidden" name="id_produit" value="<?= $article['id_produit']; ?>">
                                <button type="submit" aria-label="modifier produit"><i class="fa-solid fa-pen-to-square"></i></button>
                            </form>

                            <!-- Bouton Supprimer le produit -->
                            <form method="post" action="index.php?action=supprimerProduit">
                                <input type="hidden" name="id_produit" value="<?= $article['id_produit']; ?>">
                                <input type="hidden" name="id_categorie" value="<?= $article['id_categorie']; ?>">
                                <button type="submit" aria-label="supprimer produit" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce produit ?');"><i class="fa-solid fa-trash"></i></button>
                            </form>
                    <?php } ?>
                </div>
            </div>
            <h1><?= $article['designation']; ?></h1>
            <p class="product-price"><?= htmlspecialchars($article['prix']); ?> €</p>

            <div class="product-purchase">
                <form method="get" action="index.php">
                    <input type="hidden" name="action" value="ajouterAuPanier">
                    <input type="hidden" name="id_produit" value="<?= $article['id_produit']; ?>">
                    <input type="number" id="quantite" name="quantite" value="1" min="1" required>
                    <button class="add-to-cart" aria-label="ajouter au panier" type="submit">Ajouter au panier</button>
                </for>
            </div>

            <div class="product-description">
                <h3>DESCRIPTION</h3>
                <p>Lorem ipsum odor amet, consectetur adipiscing elit. Fusce elementum cubilia faucibus vel ante tristique non.</p>
                <p>Nunc scelerisque erat suscipit habitant ornare nisi ridiculus volutpat. Semper consequat per fringilla senectus a felis.</p>
            </div>
        </div>
    </div>

<?php
$titre = $article['designation']. " - Oh My Beauty";
$contenu = ob_get_clean();
require "template.php";
