<?php
ob_start();

// Vérifier si l'utilisateur est admin
if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'ADMIN') {
    header("Location: index.php?action=connexion");
    exit;
}

?>

<div class="titre-calendrier">
    <h1>Rendez-vous pour les prestations sélectionnées</h1>
</div>

<?php
// Organiser les rendez-vous par date
$rendezVousParJour = [];
foreach ($rendezVous as $rdv) {
    // Extraire la date de la réservation
    $date = date('d/m/Y', strtotime($rdv['datePrestation']));
    $rendezVousParJour[$date][] = $rdv; // Grouper les rendez-vous par jour
}
?>

<div class="calendrier-container">
    <?php if (!empty($rendezVousParJour)) { ?>
        <?php foreach ($rendezVousParJour as $date => $rendezVousList) { ?>
            <div class="jour-section">
                <h3><?= $date; ?></h3>
                <ul class="liste-rendez-vous">
                    <?php foreach ($rendezVousList as $rdv) { ?>
                        <li>
                            <span><?= $rdv['infosReservation']; ?></span>
                            <form method="post" action="index.php?action=annulerReservation">
                                <input type="hidden" name="id_reservation" value="<?= $rdv['id_reservation']; ?>">
                                <input type="hidden" name="source" value="vueCalendrier">
                                
                                <?php foreach ($_GET['prestations'] as $prestation) { ?>
                                    <input type="hidden" name="prestations[]" value="<?= $prestation; ?>">
                                <?php } ?>
                                
                                <button type="submit" onclick="return confirm('Êtes-vous sûr de vouloir annuler cette réservation ?');">Annuler</button>
                            </form>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        <?php } ?>
    <?php } else { ?>
        <p>Aucun rendez-vous pour les prestations sélectionnées.</p>
    <?php } ?>
</div>

<?php
$contenu = ob_get_clean();
$titre = "Calendrier des rendez-vous - Oh My Beauty";
require "template.php";
