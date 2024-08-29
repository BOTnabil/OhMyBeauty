<?php
ob_start(); 

use Model\Managers\CommandeManager;

$commandeManager = new CommandeManager();

$idUtilisateur = $_SESSION['user_id'];
$nomUtilisateur = $_SESSION['user_name'];

$commandes = $commandeManager->getCommandesByUtilisateur($idUtilisateur);
?>

<h1>Bonjour <?= $nomUtilisateur; ?> !</h1>

<h2>Historique de vos commandes</h2>

<?php if (!empty($commandes)) { ?>
    <table>
        <thead>
            <tr>
                <th>Date</th>
                <th>Prix Total</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($commandes as $commande) { ?>
                <tr>
                    <td><?= $commande['dateCommande']; ?></td>
                    <td><?= $commande['prixTotal']; ?> €</td>
                    <td>
                        <a href="index.php?action=downloadReceipt&idCommande=<?= $commande['idCommande']; ?>">Télécharger le reçu</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
<?php } else { ?>
    <p>Vous n'avez aucune commande.</p>
<?php } ?>

<?php
$titre = "Espace utilisateur - Oh My Beauty";
$contenu = ob_get_clean();
require "template.php";
?>