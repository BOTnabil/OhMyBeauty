<?php

ob_start(); 

use Model\Managers\PrestationManager;

$prestationManager = new PrestationManager();

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
                            <button>Choisir</button>
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
?>