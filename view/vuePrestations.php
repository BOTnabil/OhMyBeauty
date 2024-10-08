<?php

ob_start(); 

use Model\Managers\PrestationManager;
use Model\Managers\ReservationManager;

$prestationManager = new PrestationManager();
$reservationManager = new ReservationManager();

// Récupération de toutes les catégories avec leurs prestations
$categoriesAvecPrestations = $prestationManager->obtenirToutesCategoriesAvecPrestations();

?>

<div class="presta-titre">
    <h1> Prestations </h1>
</div>

<!-- affichage des prestations -->
<section class="prestations-container">
    <?php foreach ($categoriesAvecPrestations as $categorieNom => $prestations) { ?>
        <div class="categorie">
            <h2><?= $categorieNom; ?></h2>
            <div class="liste-prestations">
                <?php foreach ($prestations as $prestation) { ?>
                    <div class="prestation">
                        <div class="details-prestation">
                            <h3><?= $prestation["designation"]; ?></h3>
                            <p><?= $prestation["description"]; ?></p>
                            <span><?= $prestation["duree"]; ?> • <?= $prestation["prix"]; ?> €</span>
                        </div>
                        <div class="actions-prestation">
                            <?php
                            $aDejaReserve = false;
                            if (isset($_SESSION['user_id'])) {
                                $aDejaReserve = $reservationManager->verifierReservationExistante($_SESSION['user_id'], $prestation['id_prestation']);
                            }
                            ?>
                            
                            <?php if ($aDejaReserve) { ?>
                                <p>Prestation déjà réservée</p>
                            <?php } ?>

                            <!-- Afficher le formulaire pour tout le monde -->
                            <form method="post" action="index.php?action=choisirCreneau">
                                <input type="hidden" name="id_prestation" value="<?= $prestation['id_prestation']; ?>">
                                <label for="datePrestation">Choisir une date :</label>
                                <input type="date" name="datePrestation" required min="<?= date('Y-m-d'); ?>">
                                <button type="submit">Valider la date</button>
                            </form>
                            <?php if (\App\Session::estAdmin()) { ?>
                                    <!-- Bouton de suppression visible uniquement pour les admins -->
                                    <form method="post" action="index.php?action=supprimerPrestation">
                                        <input type="hidden" name="id_prestation" value="<?= $prestation['id_prestation']; ?>">
                                        <button type="submit" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette prestation ?');"><i class="fa-solid fa-trash"></i></button>
                                    </form>

                                    <!-- Bouton de modification visible uniquement pour les admins -->
                                    <form method="get" action="index.php">
                                        <input type="hidden" name="action" value="afficherModifierPrestation">
                                        <input type="hidden" name="id_prestation" value="<?= $prestation['id_prestation']; ?>">
                                        <button type="submit"><i class="fa-solid fa-pen-to-square"></i></button>
                                    </form>
                                <?php } ?>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    <?php } ?>
</section>
<!-- fin de l'affichage des prestations -->

<?php
$titre = "Prestations - Oh My Beauty";
$contenu = ob_get_clean();
require "template.php";
