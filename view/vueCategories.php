<?php
ob_start();
?>

<div class="titre-categories">
    <h1>Nos Catégories</h1>
</div>

<div class="categories-container">
    <?php foreach ($categories as $categorie) { ?>
        <div class="categorie">
            <a href="index.php?action=voirArticlesParCategorie&id_categorie=<?= $categorie['id_categorie']; ?>">
                <?= $categorie['designation']; ?>
            </a>
        </div>
    <?php } ?>
</div>

<?php
$titre = "Catégories - Oh My Beauty";
$contenu = ob_get_clean();
require "template.php";
?>
