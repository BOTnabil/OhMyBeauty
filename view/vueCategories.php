<?php
ob_start();
?>

<h1>Nos Catégories</h1>
<div class="categories-container">
    <?php foreach ($categories as $categorie) { ?>
        <div class="categorie">
            <a href="index.php?action=voirArticlesParCategorie&id_categorie=<?= $categorie['id_categorie']; ?>">
                <?= htmlspecialchars($categorie['designation']); ?>
            </a>
        </div>
    <?php } ?>
</div>

<?php
$titre = "Catégories - Oh My Beauty";
$contenu = ob_get_clean();
require "template.php";
?>
