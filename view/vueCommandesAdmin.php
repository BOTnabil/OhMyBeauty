<?php
ob_start();

// Vérifier si l'utilisateur est admin
if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'ADMIN') {
    header("Location: index.php?action=connexion");
    exit;
}
?>

<h1>Liste des commandes</h1>

<?php if (!empty($commandes)) { ?>
    <table>
        <thead>
            <tr>
                <th>Date</th>
                <th>Client</th>
                <th>Prix Total</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($commandes as $commande) { ?>
                <tr>
                    <td><?= htmlspecialchars($commande['dateCommande']); ?></td>
                    <td><?= htmlspecialchars($commande['email']); ?></td>
                    <td><?= $commande['infosCommande']; ?> €</td>
                    <td><?= htmlspecialchars($commande['prixTotal']); ?> €</td>
                    <td>
                        <form method="post" action="index.php?action=annulerCommande">
                            <input type="hidden" name="id_commande" value="<?= $commande['id_commande']; ?>">
                            <button type="submit" onclick="return confirm('Êtes-vous sûr de vouloir annuler cette commande ?');">Annuler</button>
                        </form>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
<?php } else { ?>
    <p>Aucune commande trouvée.</p>
<?php } ?>

<?php
$titre = "Commandes - Oh My Beauty (Admin)";
$contenu = ob_get_clean();
require "template.php";
