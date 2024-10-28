<?php

ob_start();

use Model\Managers\CategorieManager;
use Model\Managers\PrestationManager;
use Model\Managers\ReservationManager;

// Vérifier si l'utilisateur est admin
if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'ADMIN') {
    header("Location: index.php?action=connexion");
    exit;
}

$categorieManager = new CategorieManager();
$prestationManager = new PrestationManager();
$reservationManager = new ReservationManager();

// Récupérer les catégories depuis la BDD
$categories = $categorieManager->obtenirToutesLesCategories();
// Récupérer toutes les catégories avec leurs prestations
$categoriesAvecPrestations = $prestationManager->obtenirToutesCategoriesAvecPrestations();

?>
<div class="titre-admin">
    <h1>Administration</h1>   
</div>

<section class="gestion-rdv">
    <form class="presta-form" method="get" action="index.php">
        <h2>Sélectionner les prestations à afficher</h2>
        <div class="categories-admin">
            <?php foreach ($categoriesAvecPrestations as $categorieNom => $prestations) { ?>
                <div class="categorie-admin">
                    <h3><?= $categorieNom; ?></h3>
                    <?php foreach ($prestations as $prestation) { ?>
                        <label>
                            <input type="checkbox" name="prestations[]" value="<?= $prestation['id_prestation']; ?>">
                            <?= $prestation['designation']; ?>
                        </label>
                    <?php } ?>
                </div>
            <?php } ?>
        </div>
        <input type="hidden" name="action" value="voirRendezVous">
        <input class="submit-btn" type="submit" value="Voir les rendez-vous">
    </form>
</section>

<section class="ajouter-prestation">
    <h2>Ajouter une prestation <span class="toggle-btn" id="toggle-prestation">+</span></h2>
    <form id="prestation-form" action= "index.php?action=ajouterPrestation" method="POST" enctype="multipart/form-data" style="display: none;">
        <div class="form-group">
            <label for="designation">Désignation :</label>
            <input type="text" name="designation" required><br>
        </div>
        <div class="form-group">
            <label for="description">Description :</label>
            <textarea name="description" required></textarea><br>
        </div>
        <div class="form-group">
            <label for="duree">Durée (moins de 60min) :</label>
            <input type="text" name="duree"><br>
        </div>
        <div class="form-group">
            <label for="prix">Prix :</label>
            <input type="number" step="0.01" name="prix" required ><br>
        </div>
        <div class="form-group">
            <label for="categorie">Catégorie :</label>
            <select name="id_categorie" required>
                <?php foreach ($categories as $categorie): ?>
                    <option value="<?= $categorie['id_categorie'] ?>" <?= isset($produit['id_categorie']) && $produit['id_categorie'] == $categorie['id_categorie'] ? 'selected' : ''; ?>>
                        <?= $categorie['designation'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <input class="submit-btn" type="submit" name="submit" value="Ajouter une prestation">
    </form>
</section>

<section class="ajouter-produit">
    <h2>Ajouter un produit <span class="toggle-btn" id="toggle-produit">+</span></h2>
    <form id="produit-form" action= "index.php?action=ajouterProduit" method="POST" enctype="multipart/form-data" style="display: none;">
        <div class="form-group">
            <label for="designation">Désignation :</label>
            <input type="text" name="designation" required>
        </div>
        <div class="form-group">
            <label for="description">Description :</label>
            <textarea name="description" required></textarea>
        </div>
        <div class="form-group">
            <label for="prix">Prix :</label>
            <input type="number" step="0.01" name="prix" required>
        </div>
        <div class="form-group">
            <label for="categorie">Catégorie :</label>
            <select name="id_categorie" required>
                <?php foreach ($categories as $categorie): ?>
                    <option value="<?= $categorie['id_categorie'] ?>" <?= isset($produit['id_categorie']) && $produit['id_categorie'] == $categorie['id_categorie'] ? 'selected' : ''; ?>>
                        <?= $categorie['designation'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <label for="image">Image :</label><br><br>
        <input type="file" name="image"><br><br>
        <input class="submit-btn" type="submit" name="submit" value="Ajouter un produit">
    </form>
</section>

<div class="voir-commandes">
    <h2><a href="index.php?action=afficherCommandes">Voir les commandes</a><h2>
</div> 

<?php
// Message de confirmation ou d'erreur après l'ajout
if (isset($_SESSION['MAJadmin'])) {
    echo "<p class = 'MAJ'>" . $_SESSION['MAJadmin'] . "</p>";
    unset($_SESSION['MAJadmin']);  // Supprimer le message après l'affichage
}
?>

<?php
$titre = "Administration - Oh My Beauty";
$contenu = ob_get_clean();
require "template.php";
?>