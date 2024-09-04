<?php

ob_start();

use Model\Managers\CommandeManager;
use Model\Managers\ReservationManager;

$commandeManager = new CommandeManager();
$reservationManager = new ReservationManager();

// Récupération de l'ID de l'utilisateur depuis la session
$idUtilisateur = $_SESSION['user_id']; 
$nomUtilisateur = $_SESSION['user_name'];

// Récupération de toutes les commandes de l'utilisateur
$commandes = $commandeManager->obtenirCommandesParUtilisateur($idUtilisateur);

// Récupération de toutes les réservations de l'utilisateur
$reservations = $reservationManager->obtenirReservationsParUtilisateur($idUtilisateur);
?>

<h1>Bonjour, <?= htmlspecialchars($nomUtilisateur); ?> !</h1>
<h2>Historique de vos commandes</h2>

<?php if (!empty($commandes)) { ?>
    <table>
        <thead>
            <tr>
                <th>Date</th>
                <th>Prix Total</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($commandes as $commande) { ?>
                <tr>
                    <td><?= $commande['dateCommande']; ?></td>
                    <td><?= $commande['prixTotal']; ?> €</td>
                    <td>
                        <a href="index.php?action=downloadReceipt&idCommande=<?= $commande['idCommande']; ?>">Télécharger le reçu</a>
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
                <th>Action</th> <!-- Nouvelle colonne pour l'action -->
            </tr>
        </thead>
        <tbody>
            <?php foreach ($reservations as $reservation) { ?>
                <tr>
                    <td><?= date('d/m/Y H:i', strtotime($reservation['datePrestation'])); ?></td>
                    <td><?= htmlspecialchars($reservation['designation']); ?></td>
                    <td><?= htmlspecialchars($reservation['categorie']); ?></td>
                    <td><?= htmlspecialchars($reservation['duree']); ?></td>
                    <td><?= htmlspecialchars($reservation['prix']); ?> €</td>
                    <td>
                        <form method="post" action="index.php?action=annulerReservation">
                            <input type="hidden" name="idPrestation" value="<?= $reservation['idPrestation']; ?>">
                            <button type="submit" onclick="return confirm('Êtes-vous sûr de vouloir annuler cette réservation ?');">Annuler</button>
                        </form>
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
