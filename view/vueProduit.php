<?php
ob_start();
?>

<!-- panneau articles -->
<section class="produit-container">



</section>
<!-- Fin de la vue -->

<?php
$titre = "[nom de l'article] - Oh My Beauty";
$contenu = ob_get_clean();
require "template.php";
?>
