<?php
ob_start();
?>

<!-- liste categorie -->
<section class="categorie-container">



</section>
<!-- Fin de la liste -->

<?php
$titre = "Catégories d'article - Oh My Beauty";
$contenu = ob_get_clean();
require "template.php";
?>
