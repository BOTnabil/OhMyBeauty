<?php
ob_start();
?>

<h1><?= htmlspecialchars($article['designation']); ?></h1>
<div class="article-details">
    <img src="./public/img/<?= $article['image']; ?>" alt="Image de <?= htmlspecialchars($article['designation']); ?>">
    <p><strong>Prix :</strong> <?= $article['prix']; ?> €</p>
    <p><strong>Description :</strong> <?= htmlspecialchars($article['description']); ?></p>
    
    <form method="post" action="index.php?action=ajouterAuPanier">
        <input type="hidden" name="id_produit" value="<?= $article['id_produit']; ?>">
        <button type="submit">Ajouter au panier</button>
    </form>
</div>

<?php
$titre = $article['designation'] ."- Oh My Beauty";
$contenu = ob_get_clean();
require "template.php";
?>
