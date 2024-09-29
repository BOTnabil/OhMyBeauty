<?php
ob_start();
?>

<h2>Rendez-vous pour les prestations sélectionnées</h2>

<table>
    <thead>
        <tr>
            <th>Réservation</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($rendezVous)) { ?>
            <?php foreach ($rendezVous as $rdv) { ?>
                <tr>
                    <td><?= htmlspecialchars($rdv['infosReservation']); ?></td>
                    <td>
                        <form method="post" action="index.php?action=annulerReservation">
                            <input type="hidden" name="id_reservation" value="<?= $rdv['id_reservation']; ?>">
                            <input type="hidden" name="source" value="vueCalendrier">
                            
                            <?php foreach ($_GET['prestations'] as $prestation) { ?>
                                <input type="hidden" name="prestations[]" value="<?= $prestation; ?>">
                            <?php } ?>
                            
                            <button type="submit" onclick="return confirm('Êtes-vous sûr de vouloir annuler cette réservation ?');">Annuler</button>
                        </form>
                    </td>
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
