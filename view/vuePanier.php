<?php
ob_start();
?>

<!-- Panier -->
<section class="cart-container">
        <h2>Votre Panier</h2>
        <?php if (!empty($_SESSION['products'])) { ?>
            <table>
                <thead>
                    <tr>
                        <th>Article</th>
                        <th>Prix Unitaire</th>
                        <th>Quantité</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($_SESSION['products'] as $index => $produit) { ?>
                        <tr>
                            <td >
                                <div class="identite-article">
                                <img class="image-article-panier" src="./public/img/<?= $produit['image']; ?>" alt="image de l'article">
                                    <div class="nom-article">
                                        <?= $produit['nom']; ?>
                                    </div>
                                </div>
                            </td>
                            <td><?= $produit['prix']; ?> €</td>
                            <td>
                            <a class="action-panier" href="index.php?action=diminuerQttProduit&id=<?= $index; ?>">-</a>
                            <?= $produit['qtt']; ?>
                            <a class="action-panier" href="index.php?action=augmenterQttProduit&id=<?= $index; ?>">+</a>
                            </td>
                            <td><?= $produit['total']; ?> €</td>
                            <td>
                                <a class="action-panier" href="index.php?action=supprimerDuPanier&id=<?= $index; ?>">X</a>
                            </td>
                            <td></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <div class="cart-summary">
                <p><strong>Total Général : </strong> 
                <?php 
                    $totalGeneral = 0;
                    foreach ($_SESSION['products'] as $produit) {
                        $totalGeneral += $produit['total'];
                    }
                    echo $totalGeneral . " €";
                ?>
                </p>
                <form method="get" action="index.php">
                    <input type="hidden" name="action" value="viderPanier">
                    <button class="vider-panier" aria-label="vider panier" type="submit">Vider le panier</button>
                </form>
                <form method="post" action="index.php?action=validerCommande">
                    <input type="hidden" name="id_utilisateur" value="1"> <!-- Supposons que l'ID de l'utilisateur soit 1 pour l'instant -->
                    <button class="valider-panier" aria-label="valider panier" type="submit">Valider la commande</button>
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

</section>
<!-- Fin du panier -->

<?php
$titre = "Panier - Oh My Beauty";
$contenu = ob_get_clean();
require "template.php";
?>
