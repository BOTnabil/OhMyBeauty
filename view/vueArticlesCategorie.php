<?php
ob_start();
?>

<div class="titre-articles-categorie">
    <h1><?= $categorieNom; ?></h1>
</div>

<div class="produits-container">
    <?php foreach ($articles as $index => $produit) { ?>
        <div class="produit">
            <a href="index.php?action=voirArticle&id_produit=<?= $produit['id_produit']; ?>">
                <div class="produit-image">
                    <img src="./public/img/<?= $produit['image']; ?>" alt="<?= $produit['designation']; ?>">
                </div>
                <div class="produit-details">
                    <h3><?= $produit['designation']; ?></h3>
                    <p><?= htmlspecialchars($produit['prix']); ?> €</p>
                </div>
            </a>
        </div>
    <?php } ?>
</div>


<?php
$titre = $categorieNom ."- Oh My Beauty";
$contenu = ob_get_clean();
require "template.php";
?>

