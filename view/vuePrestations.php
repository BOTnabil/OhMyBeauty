<?php

ob_start(); 

use Model\Managers\PrestationManager;
use Model\Managers\ReservationManager;

$prestationManager = new PrestationManager();
$reservationManager = new ReservationManager();

// Récupération de toutes les catégories avec leurs prestations
$categoriesAvecPrestations = $prestationManager->obtenirToutesCategoriesAvecPrestations();

?>


<div class="prestations-container">
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
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    <?php } ?>
</div>

<?php
$titre = "Prestations - Oh My Beauty";
$contenu = ob_get_clean();
require "template.php";
