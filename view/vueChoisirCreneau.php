<?php

ob_start();

$creneauxHoraires = [
    '09:00', '10:00', '11:00', '12:00', '13:00',
    '14:00', '15:00', '16:00', '17:00', '18:00'
];

// Récupérer les créneaux réservés sous forme d'un tableau simple
$creneauxReserves = array_map( 
    function($creneau) {
        return substr($creneau['creneauHoraire'], 0, 5);  // Prendre seulement les 5 premiers caractères ("HH:MM")
    }, $creneauxReserves);

// Filtrer les créneaux horaires déjà réservés
$creneauxDisponibles = array_diff($creneauxHoraires, $creneauxReserves);

// Date et heure actuelles
date_default_timezone_set('Europe/Paris');

$dateActuelle = date('Y-m-d');
$heureActuelle = date('H:i');

?>

<h2>Choisir un créneau horaire pour le <?= date('d/m/Y', strtotime($datePrestation)); ?></h2>

<?php 

if (!empty($creneauxDisponibles)) { ?>
    <form method="post" action="index.php?action=reserver">
        <input type="hidden" name="idPrestation" value="<?= htmlspecialchars($idPrestation); ?>">
        <input type="hidden" name="datePrestation" value="<?= htmlspecialchars($datePrestation); ?>">
        
        <div class="boutons-creneau-horaire">
            <?php foreach ($creneauxDisponibles as $creneau) { 
                // Si la date de prestation est aujourd'hui, comparer les heures
                if ($datePrestation == $dateActuelle && $creneau <= $heureActuelle) {
                    continue; // Ne pas afficher les créneaux déjà passés
                }
            ?>
                <button type="submit" name="creneauHoraire" value="<?= $creneau; ?>"><?= $creneau; ?></button>
            <?php } ?>
        </div>
    </form>
<?php } else { ?>
    <p>Aucun créneau horaire disponible pour cette date.</p>
<?php } ?>

<?php
$contenu = ob_get_clean();
$titre = "Choisir un créneau horaire";
require "template.php";
?>