<?php

ob_start();

$timeSlots = [
    '09:00', '10:00', '11:00', '12:00', '13:00',
    '14:00', '15:00', '16:00', '17:00', '18:00'
];

// Récupérer les heures réservées sous forme d'un tableau simple
$reservedSlots = array_map(function($slot) {
    return substr($slot['timeSlot'], 0, 5);  // Prend seulement les 5 premiers caractères ("HH:MM")
}, $reservedSlots);

// Filtrer les créneaux horaires pour retirer ceux qui sont déjà réservés
$availableSlots = array_diff($timeSlots, $reservedSlots);

?>

<h2>Choisir un créneau horaire pour le <?= date('d/m/Y', strtotime($datePrestation)); ?></h2>

<?php if (!empty($availableSlots)) { ?>
    <form method="post" action="index.php?action=reservation">
        <input type="hidden" name="idPrestation" value="<?= htmlspecialchars($idPrestation); ?>">
        <input type="hidden" name="datePrestation" value="<?= htmlspecialchars($datePrestation); ?>">
        
        <div class="time-slot-buttons">
            <?php foreach ($availableSlots as $slot) { ?>
                <button type="submit" name="timeSlot" value="<?= $slot; ?>"><?= $slot; ?></button>
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
