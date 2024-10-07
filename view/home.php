<?php
ob_start(); 
?>

<!-- slider -->
<section class="wrapper-slider">

    <div class="slider">
        <img src="./public/img/img1.jpg" alt="img1" class="img__slider active"/> 
        <img src="./public/img/img2.jpg" alt="img2" class="img__slider"/>
        <img src="./public/img/img3.jpg" alt="img3" class="img__slider"/>
        <div class="suivant">
            <i class="fas fa-chevron-circle-right"></i>
        </div>
        <div class="precedent">
            <i class="fas fa-chevron-circle-left"></i>
        </div>
    </div>

</section>
<!-- fin du slider -->

<!-- services -->
<section class="services">

    <a href="index.php?action=prestations" class="link1-4"><img class="img1-4" src="./public/img/service_1.jpg" alt=""><img class="plus1" src="./public/img/plus-symbol.png" alt="symbole plus"></a>
    <a href="index.php?action=prestations" class="link1-4"><img class="img1-4" src="./public/img/service_2.jpg" alt=""><img class="plus2" src="./public/img/plus-symbol.png" alt="symbole plus"></a>
    <a href="index.php?action=prestations" class="link1-4"><img class="img1-4" src="./public/img/service_3.jpg" alt=""><img class="plus3" src="./public/img/plus-symbol.png" alt="symbole plus"></a>
    <a href="index.php?action=prestations" class="link1-4"><img class="img1-4" src="./public/img/service_4.jpg" alt=""><img class="plus4" src="./public/img/plus-symbol.png" alt="symbole plus"></a>   

</section>
<!-- fin des services -->


<!-- contact -->
<section class="contact">

    <h2>CONTACTEZ-NOUS</h2>
    <div class="logos">
        <div class="logos-contact">
            <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
        </div>
        <div class="logos-contact">
            <a href="#"><i class="fa-brands fa-x-twitter"></i></a>
        </div>
        <div class="logos-contact">
            <a href="#"><i class="fa-brands fa-tiktok"></i></a>
        </div>
        <div class="logos-contact">
            <a href="#"><i class="fa-solid fa-p"></i></a>
        </div>
    </div>
    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Praesentium deleniti magni placeat dolorum.</p>

</section>
<!-- fin de contact -->

<?php

$titre = "Accueil - Oh My Beauty";
$contenu = ob_get_clean();
require "template.php";
?>
