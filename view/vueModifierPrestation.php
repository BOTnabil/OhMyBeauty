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
    <h1>Modification de prestation</h1>
</div>

<form class= "modifier-presta" action="index.php?action=modifierPrestation&id_prestation=<?= $prestation['id_prestation'] ?>" method="POST" enctype="multipart/form-data">
    <label for="designation">Désignation :</label><br>
    <input type="text" id="designation" name="designation" value="<?= $prestation['designation'] ?>" required><br><br>
    
    <label for="prix">Prix :</label><br>
    <input type="number" id="prix" name="prix" step="0.01" min="1" value="<?= $prestation['prix'] ?>" required><br><br>

    <label for="duree">Durée (en min) :</label><br>
    <input type="number" id="duree" name="duree" step="1" min="1" max="60" value="<?= $prestation['duree'] ?>" required><br><br>
    
    <label for="description">Description :</label><br>
    <textarea id="description" name="description" required><?= $prestation['description'] ?></textarea><br><br>
    
    <label for="categorie">Catégorie :</label><br>
    <select name="id_categorie" id="categorie" required>
        <?php foreach ($categories as $categorie) { ?>
            <option value="<?= $categorie['id_categorie'] ?>" <?= $prestation['id_categorie'] == $categorie['id_categorie'] ? 'selected' : '' ?>>
                <?= $categorie['designation'] ?>
            </option>
        <?php } ?>
    </select><br><br>

    <button type="submit" name="submit">Enregistrer les modifications</button>
</form>

<?php
// Message de confirmation ou d'erreur après l'ajout
if (isset($_SESSION['MAJprestation'])) {
    echo "<p class = 'MAJ'>" . $_SESSION['MAJprestation'] . "</p>";
    unset($_SESSION['MAJprestation']);  // Supprimer le message après l'affichage
}

$titre = "Modifier une prestation - Oh My Beauty";
$contenu = ob_get_clean();
require "template.php";
?>
