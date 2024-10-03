<?php
ob_start(); 
?>

<h1>Articles de la catégorie <?= htmlspecialchars($categorieNom); ?></h1>
<div class="articles-container">
    <?php foreach ($articles as $article) { ?>
        <div class="article">
            <a href="index.php?action=voirArticle&id_article=<?= $article['id_produit']; ?>">
                <h3><?= htmlspecialchars($article['designation']); ?></h3>
                <p>Prix : <?= $article['prix']; ?> €</p>
            </a>
        </div>
    <?php } ?>
</div>


<?php
$titre = "Boutique - Oh My Beauty";
$contenu = ob_get_clean();
require "template.php";
?>
