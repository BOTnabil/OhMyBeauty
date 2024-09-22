<?php
ob_start();
?>

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

<?php
$titre = "Contact - Oh My Beauty";
$contenu = ob_get_clean();
require "template.php";
?>
