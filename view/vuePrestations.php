<?php

ob_start(); 

use Model\Managers\PrestationManager;
use Model\Managers\ReservationManager;

$prestationManager = new PrestationManager();
$reservationManager = new ReservationManager();

// Récupération de toutes les catégories avec leurs prestations
$categoriesAvecPrestations = $prestationManager->obtenirToutesCategoriesAvecPrestations();

if (isset($_SESSION['erreur'])) {
    echo '<p class="erreur">' . $_SESSION['erreur'] . '</p>';
    unset($_SESSION['erreur']); // Supprimer l'erreur après l'affichage
}

if (!isset($_SESSION['user_id'])) { ?>
    <p>Veuillez vous connecter afin de pouvoir réserver</p>
<?php } ?>


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
                            // Vérifier si l'utilisateur a déjà réservé cette prestation dans le futur
                            if (isset($_SESSION['user_id'])) {  
                                if ($reservationManager->verifierReservationExistante($_SESSION['user_id'], $prestation['idPrestation'])) { ?>
                                    <p>Préstation déjà réservée</p> 
                                <?php } else { ?>
                                    <form method="post" action="index.php?action=choisirCreneau">
                                        <input type="hidden" name="idPrestation" value="<?= $prestation['idPrestation']; ?>">
                                        <label for="datePrestation">Choisir une date :</label>
                                        <input type="date" name="datePrestation" required min="<?= date('Y-m-d'); ?>">
                                        <button type="submit">Valider la date</button>
                                    </form>
                                <?php }
                            } ?>
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
