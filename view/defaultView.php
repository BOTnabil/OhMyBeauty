<?php 
ob_start(); 
?>
<section class="home">
    <img src="./public/img/banniere.jpg" class="fond1" alt="fond d'institut avec logo oh my beauty">
    <p class="citation">BIENVENUE CHEZ OH MY BEAUTY, L'INSTITUT QUI SAIT PRENDRE SOIN DE VOUS</p>
</section>

<section class="services">
    <a href="#" class="link1-4" ><img class="img1-4" src="./public/img/service_1.jpg" alt=""><img class="plus1" src="./public/img/plus-symbol.png" alt="symbole plus"></a>
    <a href="#" class="link1-4" ><img class="img1-4" src="./public/img/service_2.jpg" alt=""><img class="plus2" src="./public/img/plus-symbol.png" alt="symbole plus"></a>
    <a href="#" class="link1-4" ><img class="img1-4" src="./public/img/service_3.jpg" alt=""><img class="plus3" src="./public/img/plus-symbol.png" alt="symbole plus"></a>
    <a href="#" class="link1-4" ><img class="img1-4" src="./public/img/service_4.jpg" alt=""><img class="plus4" src="./public/img/plus-symbol.png" alt="symbole plus"></a>   
</section>

<section class="aPropos1">
    <div class="boxLeftTop">
        <h1>UN SAVOIR FAIRE</h1>
        <h2>Un mot d'ordre : "qualifié"</h2>
        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Consequuntur et natus 
        consectetur iste sunt, commodi quis veritatis laboriosam ex? </p>
        <a href="">EN SAVOIR PLUS</a>
    </div>
    <img src="./public/img/a_propos_1.png" class="imgOMBaPropos1" alt="">
</section>

<section class="aPropos2">
    <img src="./public/img/a_propos_2.png" class="imgOMBaPropos2" alt="">
    <div class="boxRightBot">
        <h1>NOTRE HISTOIRE</h1>
        <h2>Oh My Beauty, un rêve devenu réalité</h2>
        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Consequuntur et natus 
        consectetur iste sunt, commodi quis veritatis laboriosam ex?</p>
        <a href="">EN SAVOIR PLUS</a>
    </div>
</section>

<section class="contact">
    <h2>CONTACTEZ NOUS</h2>
    <div class="logos">
        <div class="logos-footer">
            <a href="#"><i class="fa-brands fa-facebook-f"></i> </a>
        </div>
        <div class="logos-footer">
            <a href="#"><i class="fa-brands fa-x-twitter"></i> </a>
        </div>
        <div class="logos-footer">
        <a href="#"> <i class="fa-brands fa-tiktok"></i> </a>
        </div>
        <div class="logos-footer">
        <a href="#"> <i class="fa-solid fa-p"></i> </a>
        </div>
    </div>
    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Praesentium deleniti magni placeat dolorum</p>
</section>

<section class="sectionMap">
    <a href=""><img src="./public/img/pin.png" alt="image pin emplacement"></a>
    <div class="map">
        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d3140.3288561760487!2d7.74721977462807!3d48.5583074823629!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sfr!2sfr!4v1713959051080!5m2!1sfr!2sfr" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
</section>

<?php

$titre = "Accueil - Oh My Beauty";
$contenu = ob_get_clean();
require "template.php";