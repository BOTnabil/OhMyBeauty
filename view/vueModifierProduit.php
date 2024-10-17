<?php

ob_start();

use Model\Managers\CategorieManager;

// Vérifier si l'utilisateur est admin
if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'ADMIN') {
    header("Location: index.php?action=connexion");
    exit;
}

// Récupérer les catégories depuis la BDD
$categorieManager = new CategorieManager();
$categories = $categorieManager->obtenirToutesLesCategories();
?>
<div class="titre-modification">
    <h1>Modification de produit</h1>
</div>
<form class= "modifier-produit" action="index.php?action=modifierProduit&id_produit=<?= $produit['id_produit'] ?>" method="POST" enctype="multipart/form-data">
    <label for="designation">Désignation :</label><br>
    <input type="text" id="designation" name="designation" value="<?= $produit['designation'] ?>" required><br><br>
    
    <label for="prix">Prix :</label><br>
    <input type="number" id="prix" name="prix" step="0.01" value="<?= $produit['prix'] ?>" required><br><br>
    
    <label for="description">Description :</label><br>
    <textarea id="description" name="description" required><?= $produit['description'] ?></textarea><br><br>
    
    <label for="categorie">Catégorie :</label><br>
    <select name="id_categorie" id="categorie" required>
        <?php foreach ($categories as $categorie) { ?>
            <option value="<?= $categorie['id_categorie'] ?>" <?= $produit['id_categorie'] == $categorie['id_categorie'] ? 'selected' : '' ?>>
                <?= $categorie['designation'] ?>
            </option>
        <?php } ?>
    </select><br><br>
    
    <label for="image">Image du produit (laisser vide pour ne pas changer) :</label><br>
    <input type="file" id="image" name="image"><br><br>

    <button type="submit" name="submit">Enregistrer les modifications</button>
</form>

<?php

// Message de confirmation ou d'erreur après l'ajout
if (isset($_SESSION['MAJproduit'])) {
    echo '<p>' . $_SESSION['MAJproduit'] . '</p>';
    unset($_SESSION['MAJproduit']);  // Supprimer le message après l'affichage
}

$titre = "Modifier un produit - Oh My Beauty";
$contenu = ob_get_clean();
require "template.php";
?>
