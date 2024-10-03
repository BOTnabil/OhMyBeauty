<?php
ob_start();
?>



<?php
$titre = "Commandes - Oh My Beauty";
$contenu = ob_get_clean();
require "template.php";
?>
