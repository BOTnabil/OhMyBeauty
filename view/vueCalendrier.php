<?php
ob_start();
?>

<h2>Rendez-vous pour les prestations sélectionnées</h2>

<table>
    <thead>
        <tr>
            <th>Date et Heure</th>
            <th>Prestation</th>
            <th>Catégorie</th>
            <th>Détails</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($rendezVous)) { ?>
            <?php foreach ($rendezVous as $rdv) { ?>
                <tr>
                    <td><?= date('d/m/Y H:i', strtotime($rdv['datePrestation'])); ?></td>
                    <td><?= htmlspecialchars($rdv['designation']); ?></td>
                    <td><?= htmlspecialchars($rdv['categorie']); ?></td>
                    <td><?= htmlspecialchars($rdv['infosReservation']); ?></td>
                </tr>
            <?php } ?>
        <?php } else { ?>
            <tr><td colspan="4">Aucun rendez-vous pour les prestations sélectionnées.</td></tr>
        <?php } ?>
    </tbody>
</table>

<?php
$contenu = ob_get_clean();
$titre = "Calendrier des rendez-vous - Oh My Beauty";
require "template.php";
