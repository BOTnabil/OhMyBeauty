<?php

ob_start(); 

use Model\Managers\PrestationManager;
use Model\Managers\ReservationManager;

$prestationManager = new PrestationManager();
$reservationManager = new ReservationManager();

// Récupération de toutes les catégories avec leurs services
$categoriesWithServices = $prestationManager->getAllCategoriesWithServices();

?>

<div class="services-container">
    <?php foreach ($categoriesWithServices as $categorieNom => $services) { ?>
        <div class="category">
            <h2><?= $categorieNom; ?></h2>
            <div class="services-list">
                <?php foreach ($services as $service) { ?>
                    <div class="service">
                        <div class="service-details">
                            <h3><?= $service["designation"]; ?></h3>
                            <p><?= $service["description"]; ?></p>
                            <span><?= $service["duree"]; ?> • <?= $service["prix"]; ?> €</span>
                        </div>
                        <div class="service-actions">
                            <form method="post" action="index.php?action=chooseTimeSlot">
                                <input type="hidden" name="idPrestation" value="<?= $service['idPrestation']; ?>">
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
$titre = "Services - Oh My Beauty";
$contenu = ob_get_clean();
require "template.php";
