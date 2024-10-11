<?php

ob_start();

use Model\Managers\CommandeManager;
use Model\Managers\ReservationManager;
use Controller\ReservationController;

$commandeManager = new CommandeManager();
$reservationManager = new ReservationManager();
$reservationController = new ReservationController();

// Supprimer les réservations passées avant d'afficher les données
$reservationController->supprimerReservationsPassees();

// Récupération de l'ID de l'utilisateur depuis la session
$id_utilisateur = $_SESSION['user_id']; 

// Récupération de toutes les commandes de l'utilisateur
$commandes = $commandeManager->obtenirCommandesParUtilisateur($id_utilisateur);

// Récupération de toutes les réservations de l'utilisateur
$reservations = $reservationManager->obtenirReservationsParUtilisateur($id_utilisateur);
?>

<div class="titre-user">
    <h1>Bienvenue dans votre espace</h1>
</div>

<!-- Gérer commandes -->
<section class="section-commandes">
    <h2>Vos commandes</h2>

    <?php if (!empty($commandes)) { ?>
        <table class="table-commandes">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Numero commande</th>
                    <th>Prix Total</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($commandes as $commande) { ?>
                    <tr>
                        <td><?= $commande['dateCommande']; ?></td>
                        <td><?= $commande['numeroCommande']; ?></td>
                        <td><?= $commande['prixTotal']; ?> €</td>
                        <td><a href="#" class="details-link" onclick="toggleDetails(this)">Détails</a></td>
                        <!-- <td>telecharger facture</td> -->
                    </tr>
                    <tr class="details-text" style="display: none;">
                        <td colspan="4"><?= $commande['infosCommande']; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <p>Vous n'avez aucune commande.</p>
    <?php } ?>
</section>
<!-- fin de commandes -->


<!-- Gérer RDV -->
<section class="section-rendezvous">
    <h2>Vos rendez-vous</h2>

    <?php if (!empty($reservations)) { ?>
        <table class="table-rendezvous">
            <thead>
                <tr>
                    <th>Date et Heure</th>
                    <th>Prestation</th>
                </tr>
            </thead>
            <tbody>
                <?php 

                if (isset($_SESSION['MAJrdv'])) {
                    echo '<p class="rdv">' . $_SESSION['MAJrdv'] . '</p>';
                    unset($_SESSION['MAJrdv']); // Supprimer la MAJ après l'affichage
                }

                foreach ($reservations as $reservation) { 
                    // Appel de la méthode estAnnulable pour vérifier si la réservation peut être annulée
                    $estAnnulable = $reservationController->estAnnulable($reservation['datePrestation']);
                    ?>
                    <tr>
                        <td><?= date('d/m/Y H:i', strtotime($reservation['datePrestation'])); ?></td>
                        <td><?= $reservation['designation']; ?></td>
                        <td>
                            <?php if ($estAnnulable) { ?>
                            <form method="post" action="index.php?action=annulerReservation">
                                <input type="hidden" name="id_reservation" value="<?= $reservation['id_reservation']; ?>">
                                <input type="hidden" name="source" value="recapUtilisateur">
                                <button type="submit" onclick="return confirm('Êtes-vous sûr de vouloir annuler cette réservation ?');">Annuler</button>
                            </form>
                            <?php } else { ?>
                            <span>Non annulable</span>
                            <?php } ?>
                        </td>
                        <td><a href="#" class="details-link" onclick="toggleDetails(this)">Détails</a></td>
                    </tr>
                    <tr class="details-text" style="display: none;">
                        <td colspan="4"><?= $reservation['infosReservation']; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <p>Vous n'avez aucun rendez-vous.</p>
    <?php } ?>
</section>
<!-- fin des RDV -->

    <script>
        function toggleDetails(element) {
            const detailsRow = element.closest('tr').nextElementSibling;
            detailsRow.style.display = detailsRow.style.display === 'none' ? 'table-row' : 'none';
        }
    </script>

<?php
$contenu = ob_get_clean();
$titre = "Votre espace - Oh My Beauty";
require "template.php";
