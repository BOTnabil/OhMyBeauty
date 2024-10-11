<?php
ob_start(); 
?>

<!-- Bannière -->
<section>

    <div class="banner">
        <img src="./public/img/img1.jpg" alt="img1" class="img-logo"/> 
        <div class="logo">
            <h1>OH MY BEAUTY</h1>
        </div>
    </div>

</section>



<?php

$titre = "Accueil - Oh My Beauty";
$contenu = ob_get_clean();
require "template.php";
?>
