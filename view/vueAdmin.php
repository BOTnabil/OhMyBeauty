<?php
ob_start();
?>

<!-- liste categorie -->
<section class="ajout-container">



</section>
<!-- Fin de la liste -->

<?php
$titre = "Administration - Oh My Beauty";
$contenu = ob_get_clean();
require "template.php";
?>
