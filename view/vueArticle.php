<?php
ob_start();
?>

<h1><?= $article['designation']; ?></h1>

<img src="./public/img/<?= $article['image']; ?>" alt="image de l'article">

<div class="article-details">
    <p>Prix : <?= htmlspecialchars($article['prix']); ?> €</p>
    <p>Description : <?= $article['description']; ?></p>
    
    <!-- Bouton Ajouter au panier -->
    <form method="get" action="index.php">
        <input type="hidden" name="action" value="ajouterAuPanier">
        <input type="hidden" name="id_produit" value="<?= $article['id_produit']; ?>">
        <button type="submit">Ajouter au panier</button>
    </form>

    <!-- Si l'utilisateur est admin, afficher les boutons supplémentaires -->
    <?php if (\App\Session::estAdmin()) { ?>
        <div class="admin-actions">
            <!-- Bouton Modifier le produit -->
            <form method="get" action="index.php">
                <input type="hidden" name="action" value="afficherModifierProduit">
                <input type="hidden" name="id_produit" value="<?= $article['id_produit']; ?>">
                <button type="submit">Modifier le produit</button>
            </form>

            <!-- Bouton Supprimer le produit -->
            <form method="post" action="index.php?action=supprimerProduit">
                <input type="hidden" name="id_produit" value="<?= $article['id_produit']; ?>">
                <button type="submit" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce produit ?');">Supprimer le produit</button>
            </form>
        </div>
    <?php } ?>
</div>

<?php
$titre = "Détails du produit - " . htmlspecialchars($article['designation']);
$contenu = ob_get_clean();
require "template.php";
