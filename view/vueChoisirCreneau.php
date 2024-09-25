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
    }, $creneauxReserves
);

// Récupérer les créneaux réservés par l'utilisateur sous forme d'un tableau simple
$creneauxReservesUtilisateur = array_map(
    function($creneau) {
        return substr($creneau['creneauHoraire'], 0, 5);  // Prendre seulement les 5 premiers caractères ("HH:MM")
    }, $creneauxReservesUtilisateur
);

// Filtrer les créneaux horaires déjà réservés (par tous les utilisateurs et par l'utilisateur lui-même)
$creneauxDisponibles = array_diff($creneauxHoraires, $creneauxReserves, $creneauxReservesUtilisateur);

// Date et heure actuelles
date_default_timezone_set('Europe/Paris');

$dateActuelle = date('Y-m-d');
$heureActuelle = date('H:i');
?>

<!-- form et créneaux -->
<h1>Choisir un créneau horaire pour le <?= date('d/m/Y', strtotime($datePrestation)); ?></h1>

<?php 
if (!empty($creneauxDisponibles)) { ?>
    <!-- Foumulaire nom prenom -->
    <form method="post" action="index.php?action=reserver">
        <input type="hidden" name="id_prestation" value="<?= $id_prestation; ?>">
        <input type="hidden" name="datePrestation" value="<?= $datePrestation; ?>">
        
        <label for="nom">Nom :</label>
        <input type="text" id="nom" name="nom" required><br><br>
    
        <label for="prenom">Prénom :</label>
        <input type="text" id="prenom" name="prenom" required><br><br>
    
        <div class="boutons-creneau-horaire">
            <!-- Affichage des créneaux -->
            <?php foreach ($creneauxDisponibles as $creneau) { 
                // Si la date de prestation est aujourd'hui, comparer les heures
                if ($datePrestation == $dateActuelle && $creneau <= $heureActuelle) {
                    continue; // Ne pas afficher les créneaux déjà passés
                } ?>
                <button type="submit" name="creneauHoraire" value="<?= $creneau; ?>"><?= $creneau; ?></button>
            <?php } ?>
        </div>
    </form>
<?php } else { ?>
    <p>Aucun créneau horaire disponible pour cette date.</p>
<?php } ?>
<!-- fin de form et créneaux -->

<?php
$contenu = ob_get_clean();
$titre = "Choisir un créneau horaire";
require "template.php";
?>