<?php
ob_start();
?>

<div class="titre-categories">
    <h1>Nos Catégories</h1>
</div>

<section class="categories-articles">
    <?php foreach ($categories as $categorie) { ?>
        <a href="index.php?action=voirArticlesParCategorie&id_categorie=<?= $categorie['id_categorie']; ?>" class="link-categorie">
            <div class="categorie-absolute">
                <h2><?= $categorie['designation']; ?></h2>
            </div>
            <img class="img-categorie" src="./public/img/<?= $categorie['designation']; ?>.webp" alt="categorie d'articles">
            </a>
    <?php } ?>
</section>


<?php
$titre = "Catégories - Oh My Beauty";
$contenu = ob_get_clean();
require "template.php";
?>
