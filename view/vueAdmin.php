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

<h1>Ajouter un produit</h1>

<form action= "index.php?action=ajouterProduit" method="POST" enctype="multipart/form-data">
    <label for="designation">Désignation :</label>
    <input type="text" name="designation" required value="<?= $produit['designation'] ?? ''; ?>"><br>

    <label for="description">Description :</label>
    <textarea name="description" required><?= $produit['description'] ?? ''; ?></textarea><br>

    <label for="prix">Prix :</label>
    <input type="number" step="0.01" name="prix" required value="<?= $produit['prix'] ?? ''; ?>"><br>

    <label for="categorie">Catégorie :</label>
    <select name="id_categorie" required>
        <?php foreach ($categories as $categorie): ?>
            <option value="<?= $categorie['id_categorie'] ?>" <?= isset($produit['id_categorie']) && $produit['id_categorie'] == $categorie['id_categorie'] ? 'selected' : ''; ?>>
                <?= $categorie['designation'] ?>
            </option>
        <?php endforeach; ?>
    </select><br>

    <label for="image">Image :</label>
    <input type="file" name="image"><br>

    <input type="submit" name="submit" value="Enregistrer">
</form>

<h1>Gestion des rendez-vous</h1>

<form method="post" action="index.php?action=voirRendezVous">
    <h2>Sélectionner les prestations à afficher</h2>
    
    <?php foreach ($categoriesAvecPrestations as $categorieNom => $prestations) { ?>
        <div class="categorie">
            <h3><?= $categorieNom; ?></h3>
            <?php foreach ($prestations as $prestation) { ?>
                <label>
                    <input type="checkbox" name="prestations[]" value="<?= $prestation['id_prestation']; ?>">
                    <?= $prestation['designation']; ?>
                </label><br>
            <?php } ?>
        </div>
    <?php } ?>
    
    <input type="submit" value="Voir les rendez-vous">
</form>

<?php
// Message de confirmation ou d'erreur après l'ajout
if (isset($_SESSION['MAJadmin'])) {
    echo '<p>' . $_SESSION['MAJadmin'] . '</p>';
    unset($_SESSION['MAJadmin']);  // Supprimer le message après l'affichage
}
?>

<?php
$titre = "Administration - Oh My Beauty";
$contenu = ob_get_clean();
require "template.php";
?>
