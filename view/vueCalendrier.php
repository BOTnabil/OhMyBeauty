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
                                
                                <button type="submit" aria-label="annuler reservation" onclick="return confirm('Êtes-vous sûr de vouloir annuler cette réservation ?');">Annuler</button>
                            </form>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        <?php } ?>
    <?php } else { ?>
        <p>Aucun rendez-vous pour les prestations sélectionnées.</p>
    <?php } 
    
    if ($nombrePages > 1){ ?>

    <div class="pagination">
        <?php 
        $pagesVisibles = 5; // Nombre de pages visibles autour de la page actuelle
        $debut = max(1, $pageActuelle - floor($pagesVisibles / 2));
        $fin = min($nombrePages, $pageActuelle + floor($pagesVisibles / 2));

        // Récupérer toutes les prestations sélectionnées pour les ajouter à l'URL
        $prestationsParam = '';
        if (!empty($_GET['prestations'])) {
            foreach ($_GET['prestations'] as $prestation) {
                $prestationsParam .= '&prestations[]=' . urlencode($prestation);
            }
        }

        // Bouton "Première page"
        if ($pageActuelle > 1) {
            echo '<a href="index.php?action=voirRendezVous&page=1' . $prestationsParam . '"> &laquo; </a>';
        }

        // Pagination limitée autour de la page actuelle
        for ($i = $debut; $i <= $fin; $i++) {
            echo '<a href="index.php?action=voirRendezVous&page=' . $i . $prestationsParam . '" class="' . ($i == $pageActuelle ? 'active' : '') . '"> ' . $i . ' </a>';
        }

        // Bouton "Dernière page"
        if ($pageActuelle < $nombrePages) {
            echo '<a href="index.php?action=voirRendezVous&page=' . $nombrePages . $prestationsParam . '"> &raquo; </a>';
        }
        ?>
    </div>
    <?php } ?>

</div>

<?php
$contenu = ob_get_clean();
$titre = "Rendez-vous - Oh My Beauty";
require "template.php";
