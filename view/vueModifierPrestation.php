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
 
<h1>Modification de prestation</h1>

<form action="index.php?action=modifierPrestation&id_prestation=<?= $prestation['id_prestation'] ?>" method="POST" enctype="multipart/form-data">
    <label for="designation">Désignation :</label><br>
    <input type="text" id="designation" name="designation" value="<?= htmlspecialchars($prestation['designation']) ?>" required><br><br>
    
    <label for="prix">Prix :</label><br>
    <input type="number" id="prix" name="prix" step="0.01" value="<?= htmlspecialchars($prestation['prix']) ?>" required><br><br>

    <label for="duree">Durée (moins de 60 min) :</label><br>
    <input type="text" id="duree" name="duree" value="<?= htmlspecialchars($prestation['duree']) ?>" required><br><br>
    
    <label for="description">Description :</label><br>
    <textarea id="description" name="description" required><?= htmlspecialchars($prestation['description']) ?></textarea><br><br>
    
    <label for="categorie">Catégorie :</label><br>
    <select name="id_categorie" id="categorie" required>
        <?php foreach ($categories as $categorie) { ?>
            <option value="<?= $categorie['id_categorie'] ?>" <?= $prestation['id_categorie'] == $categorie['id_categorie'] ? 'selected' : '' ?>>
                <?= htmlspecialchars($categorie['designation']) ?>
            </option>
        <?php } ?>
    </select><br><br>

    <button type="submit" name="submit">Enregistrer les modifications</button>
</form>

<?php
// Message de confirmation ou d'erreur après l'ajout
if (isset($_SESSION['MAJprestation'])) {
    echo '<p>' . $_SESSION['MAJprestation'] . '</p>';
    unset($_SESSION['MAJprestation']);  // Supprimer le message après l'affichage
}

$titre = "Administration - Oh My Beauty";
$contenu = ob_get_clean();
require "template.php";
?>
