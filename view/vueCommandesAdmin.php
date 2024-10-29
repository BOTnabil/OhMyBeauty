<?php
ob_start();

// Vérifier si l'utilisateur est admin
if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'ADMIN') {
    header("Location: index.php?action=connexion");
    exit;
}

?>
<div class="titre-commande-admin">
    <h1>Liste des commandes</h1>
</div>

<?php
// Organiser les commandes par date
$commandesParJour = [];
foreach ($commandes as $commande) {
    // Extraire la date de la commande
    $date = date('d/m/Y', strtotime($commande['dateCommande']));
    $commandesParJour[$date][] = $commande; // Grouper les commandes par jour
}
?>

<div class="commande-container">
    <?php if (!empty($commandesParJour)) { ?>
        <?php foreach ($commandesParJour as $date => $commandesList) { ?>
            <div class="jour-section">
                <h3><?= $date; ?></h3>
                <table class="commande-admin">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Numéro commande</th>
                            <th>Prix Total</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($commandesList as $commande) { ?>
                            <tr>
                                <td><?= $commande['dateCommande']; ?></td>
                                <td><?= $commande['numeroCommande']; ?></td>
                                <td><?= $commande['prixTotal']; ?> €</td>
                                <td><a href="#" class="details-link" onclick="toggleDetails(this)">Détails</a></td>
                                <td>
                                    <form method="post" action="index.php?action=annulerCommande">
                                        <input type="hidden" name="id_commande" value="<?= $commande['id_commande']; ?>">
                                        <button type="submit" aria-label="annuler commande" onclick="return confirm('Êtes-vous sûr de vouloir annuler cette commande ?');">Annuler</button>
                                    </form>
                                </td>
                            </tr>
                            <tr class="details-text" style="display: none;">
                                <td colspan="5"><?= $commande['infosCommande']; ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        <?php } ?>
    <?php } else { ?>
        <p>Aucune commande trouvée.</p>
    <?php } ?>

    <div class="pagination">
        <?php 
        $pagesVisibles = 5; // Nombre de pages visibles autour de la page actuelle
        $debut = max(1, $pageActuelle - floor($pagesVisibles / 2));
        $fin = min($nombrePages, $pageActuelle + floor($pagesVisibles / 2));

        // Bouton "Première page"
        if ($pageActuelle > 1) {
            echo '<a href="index.php?action=afficherCommandes&page=1"> &laquo; </a>';
        }

        // Pagination limitée autour de la page actuelle
        for ($i = $debut; $i <= $fin; $i++) {
            echo '<a href="index.php?action=afficherCommandes&page=' . $i . '" class="' . ($i == $pageActuelle ? 'active' : '') . '"> ' . $i . ' </a>';
        }

        // Bouton "Dernière page"
        if ($pageActuelle < $nombrePages) {
            echo '<a href="index.php?action=afficherCommandes&page=' . $nombrePages . '"> &raquo; </a>';
        }
        ?>
    </div>

</div>

<script>
    function toggleDetails(element) {
        const detailsRow = element.closest('tr').nextElementSibling;
        detailsRow.style.display = detailsRow.style.display === 'none' ? 'table-row' : 'none';
    }
</script>

<?php
$titre = "Commandes - Oh My Beauty";
$contenu = ob_get_clean();
require "template.php";
