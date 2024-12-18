<?php

ob_start();

use Model\Managers\CommandeManager;
use Model\Managers\ReservationManager;
use Controller\ReservationController;
use Controller\BoutiqueController;

$commandeManager = new CommandeManager();
$reservationManager = new ReservationManager();
$reservationController = new ReservationController();
$boutiqueController = new BoutiqueController();

// Supprimer les réservations passées avant d'afficher les données
$reservationController->supprimerReservationsPassees();

// Récupération de l'ID de l'utilisateur depuis la session
$id_utilisateur = $_SESSION['user_id']; 

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
                    <th>Date et heure</th>
                    <th>Numero commande</th>
                    <th>Prix Total</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($commandes as $commande) { ?>
                    <tr>
                        <td><?= date('d/m/Y H:i', strtotime($commande['dateCommande'])) ?></td>
                        <td><?= $commande['numeroCommande']; ?></td>
                        <td><?= $commande['prixTotal']; ?> €</td>
                        <td><a href="#!" class="details-link" onclick="toggleDetails(this)">Détails</a></td>
                    </tr>
                    <tr class="details-text" style="display: none;">
                        <td colspan="4"><?= $commande['infosCommande']; ?><br>
                            <form action="index.php?action=telechargerFacture" method="POST">
                                <input type="hidden" name="id_commande" value="<?= $commande['id_commande']; ?>">
                                <button type="submit" aria-label="télécharger facture">Télécharger le recapitulatif</button>
                            </form>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <p>Vous n'avez aucune commande.</p>
    <?php } 
    
    if ($nombrePages > 1){ ?>

    <!-- Pagination -->
    
    <div class="pagination">
        <?php 
        $pagesVisibles = 5; // Nombre de pages visibles autour de la page actuelle
        $debut = max(1, $pageActuelle - floor($pagesVisibles / 2));
        $fin = min($nombrePages, $pageActuelle + floor($pagesVisibles / 2));

        // Bouton "Première page"
        if ($pageActuelle > 1) {
            echo '<a href="index.php?action=recap&page=1"> &laquo; </a>';
        }

        // Pagination limitée autour de la page actuelle
        for ($i = $debut; $i <= $fin; $i++) {
            echo '<a href="index.php?action=recap&page=' . $i . '" class="' . ($i == $pageActuelle ? 'active' : '') . '"> ' . $i . ' </a>';
        }

        // Bouton "Dernière page"
        if ($pageActuelle < $nombrePages) {
            echo '<a href="index.php?action=recap&page=' . $nombrePages . '"> &raquo; </a>';
        }
        ?>
    </div>

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
                    <th>Date et heure</th>
                    <th>Prestation</th>
                </tr>
            </thead>
            <tbody>
                <?php 

                if (isset($_SESSION['MAJrdv'])) {
                    echo '<p class="MAJ">' . $_SESSION['MAJrdv'] . '</p>';
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
                                <button type="submit" aria-label="annuler reservation" onclick="return confirm('Êtes-vous sûr de vouloir annuler cette réservation ?');">Annuler</button>
                            </form>
                            <?php } else { ?>
                            <span>Non annulable</span>
                            <?php } ?>
                        </td>
                        <td><a href="#!" class="details-link" onclick="toggleDetails(this)">Détails</a></td>
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

<!-- Modifier infos -->
<section class="section-modification">

    <h2>Modifier mes informations</h2>

    <h3>Modifier mon adresse email</h3>
    <form method="POST" action="index.php?action=modifierMailProcess">

    <label for="email">Email :</label><br>
    <input type="email" id="email" name="email" required><br><br>

    <input type="submit" name="submit" value="Modifier mon mail">

    </form><br>

    <h3>Modifier mon mot de passe</h3>
    <form method="POST" action="index.php?action=modifierMDPProcess">

    <label for="motDePasseActuel">Mot de passe actuel :</label><br>
    <input type="password" name="motDePasseActuel" id="motDePasseActuel" required><br><br>

    <label for="nouveauMotDePasse">Nouveau mot de passe :</label><br>
    <input type="password" name="nouveauMotDePasse" id="nouveauMotDePasse" required><br>
    <small>
        Au moins 12 caractères, <br>
        une majuscule, <br>
        une minuscule, <br>
        un chiffre, <br>
        un caractère spécial.
    </small><br><br>

    <label for="confirmationMotDePasse">Confirmer mot de passe :</label><br>
    <input type="password" name="confirmationMotDePasse" id="confirmationMotDePasse" required><br><br>

    <input type="submit" name="submit" value="Modifier mon mot de passe">

    </form>

    <?php
    // Message de confirmation ou d'erreur
    if (isset($_SESSION['MAJmodif'])) {
        echo "<p class = 'MAJ'>" . $_SESSION['MAJmodif'] . "</p>";
        unset($_SESSION['MAJmodif']);  // Supprimer le message après l'affichage
    } ?>
</section>

<div class="supprimer-compte">
    <a href="index.php?action=supprimerUtilisateur" onclick="return confirm('Supprimer votre compte ? Vos rendez-vous et commandes ne seront pas annulés');">Supprimer mon compte</a>
</div>
<!-- Fin modifier infos -->


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
