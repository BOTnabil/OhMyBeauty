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

<!-- banderole -->
<section class="home">

    <p class="citation">QU'EST CE QUI VOUS FERAIT PLAISIR ?</p>

</section>
<!-- fin de la banderole -->

<!-- services -->
<section class="services">

    <a href="index.php?action=prestations" class="link1-4"><img class="img1-4" src="./public/img/service_1.jpg" alt=""><img class="plus1" src="./public/img/plus-symbol.png" alt="symbole plus"></a>
    <a href="index.php?action=prestations" class="link1-4"><img class="img1-4" src="./public/img/service_2.jpg" alt=""><img class="plus2" src="./public/img/plus-symbol.png" alt="symbole plus"></a>
    <a href="index.php?action=prestations" class="link1-4"><img class="img1-4" src="./public/img/service_3.jpg" alt=""><img class="plus3" src="./public/img/plus-symbol.png" alt="symbole plus"></a>
    <a href="index.php?action=prestations" class="link1-4"><img class="img1-4" src="./public/img/service_4.jpg" alt=""><img class="plus4" src="./public/img/plus-symbol.png" alt="symbole plus"></a>   

</section>
<!-- fin des services -->

<!-- à propos -->
<section class="about-us">

    <div class="about-us-content">
        <div class="box-about-us">
            <h2 class="about-us-heading">Nouveauté</h1>
            <div class="underline">
                <div class="small-underline"></div>
                <div class="big-underline"></div>
            </div>
            <h3 class="sub-heading">Oh My Shopping</h3>
            <p class="about-us-paragraph">Lorem ipsum dolor sit amet consectetur adipisicing elit. Delectus accusantium exercitationem qui quis perspiciatis totam dolores. Numquam inventore temporibus recusandae? Eos eaque quia eius culpa nulla vitae, cumque enim voluptates!</p>
            <button class="about-us-btn">
                Read More
                <i class="fas fa-angle-double-right btn-arrow"></i>
            </button>
        </div>
    </div>
    <div class="about-us-images">
        <img src="https://res.cloudinary.com/dddptppkn/image/upload/v1668256640/myfolder/mysubfolder/about-us-img-1_nasbqv.jpg" class="image image-1">
        <img src="https://res.cloudinary.com/dddptppkn/image/upload/v1668256649/myfolder/mysubfolder/about-us-img-2_cgi093.jpg" class="image image-2">
        <img src="https://res.cloudinary.com/dddptppkn/image/upload/v1668256656/myfolder/mysubfolder/about-us-img-3_g49ide.jpg" class="image image-3">
        <img src="https://res.cloudinary.com/dddptppkn/image/upload/v1668256661/myfolder/mysubfolder/about-us-img-4_nph5wc.jpg" class="image image-4">
    </div>

</section>
<!-- fin du à propos -->

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
