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

<h1>Bonjour !</h1>
<h2>Historique de vos commandes</h2>

<?php if (!empty($commandes)) { ?>
    <table>
        <thead>
            <tr>
                <th>Date</th>
                <th>Prix Total</th>
                <th>Action</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($commandes as $commande) { ?>
                <tr>
                    <td><?= $commande['dateCommande']; ?></td>
                    <td><?= $commande['prixTotal']; ?> €</td>
                    <td>
                        <a href="javascript:void(0);" class="voir-details" data-id="<?= $commande['id_commande']; ?>">Voir les détails</a>
                    </td>
                    <td class="details-commande" id="details-commande-<?= $commande['id_commande']; ?>" style="display:none;">
                        <p><strong>Détails de la commande :<br></strong> <?= $commande['infosCommande'] ?? 'Aucun détail disponible.'; ?></p>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
<?php } else { ?>
    <p>Vous n'avez aucune commande.</p>
<?php } ?>

<h2>Vos rendez-vous</h2>

<?php if (!empty($reservations)) { ?>
    <table>
        <thead>
            <tr>
                <th>Date et Heure</th>
                <th>Prestation</th>
                <th>Catégorie</th>
                <th>Durée</th>
                <th>Prix</th>
                <th>Action</th>
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
                    <td><?= htmlspecialchars($reservation['designation']); ?></td>
                    <td><?= htmlspecialchars($reservation['categorie']); ?></td>
                    <td><?= htmlspecialchars($reservation['duree']); ?></td>
                    <td><?= htmlspecialchars($reservation['prix']); ?> €</td>
                    <td>
                        <?php if ($estAnnulable) { ?>
                            <form method="post" action="index.php?action=annulerReservation">
                                <input type="hidden" name="id_prestation" value="<?= $reservation['id_prestation']; ?>">
                                <button type="submit" onclick="return confirm('Êtes-vous sûr de vouloir annuler cette réservation ?');">Annuler</button>
                            </form>
                        <?php } else { ?>
                            <span>Non annulable</span>
                        <?php } ?>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
<?php } else { ?>
    <p>Vous n'avez aucun rendez-vous.</p>
<?php } ?>

<?php
$contenu = ob_get_clean();
$titre = "Récapitulatif des commandes et rendez-vous - Oh My Beauty";
require "template.php";
