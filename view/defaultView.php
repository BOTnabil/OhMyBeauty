<?php 
ob_start(); 
?>
<section class="home">
            <img src="./public/img/h5-revolution-img-1.jpg" class="fond1" alt="fond d'institut avec logo oh my beauty">
            <p class="citation">BIENVENUE CHEZ OH MY BEAUTY, L'INSTITUT QUI SAIT PRENDRE SOIN DE VOUS</p>
            </section>
        <section class="galerie">
            <a href="#" class="link1-4" ><img class="img1-4" src="./public/img/h5-gallery-img-1-477x477.jpg" alt="image du bar"><img class="plus1" src="./public/img/plus-symbol.png" alt="symbole plus"></a>
            <a href="#" class="link1-4" ><img class="img1-4" src="./public/img/h5-gallery-img-2-477x477.jpg" alt="image deux pintes de bierre"><img class="plus2" src="./public/img/plus-symbol.png" alt="symbole plus"></a>
            <a href="#" class="link1-4" ><img class="img1-4" src="./public/img/h5-gallery-img-3-477x477.jpg" alt="image des alcools du bar"><img class="plus3" src="./public/img/plus-symbol.png" alt="symbole plus"></a>
            <a href="#" class="link1-4" ><img class="img1-4" src="./public/img/h5-gallery-img-4-477x477.jpg" alt="trois personnes assises à une table du bar"><img class="plus4" src="./public/img/plus-symbol.png" alt="symbole plus"></a>   
        </section>
        <section class="tradition1">
            <div class="boxLeftTop">
                <h1>UN SAVOIR FAIRE</h1>
                <h2>Un mot d'ordre : "qualifié"</h2>
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Consequuntur et natus 
                consectetur iste sunt, commodi quis veritatis laboriosam ex? </p>
                <a href="">EN SAVOIR PLUS</a>
            </div>
            <img src="./public/img/h5-holder-image-1.png" class="logoBeerTradition" alt="tonneau 'best beer tradition for you'">
        </section>
        <section class="tradition2">
            <img src="./public/img/h5-holder-image-2.png" class="logoPubStory" alt="image chope de bierre">
            <div class="boxRightBot">
                <h1>NOTRE HISTOIRE</h1>
                <h2>Oh My Beauty, un rêve devenu réalité</h2>
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Consequuntur et natus 
                consectetur iste sunt, commodi quis veritatis laboriosam ex?</p>
                <a href="">EN SAVOIR PLUS</a>
            </div>
        </section>
        <section class="services">
            <div class="box1">
                <div class="imgBox1">
                    <img src="./public/img/h5-icon-1.png" alt="icone raisin">
                </div>
                <h2 class="h2_1">SETCH IS THE FIRST</h2>
                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Saepe eos deleniti veritatis </p>
            </div>
            <div class="box2">
                <div class="imgBox2">
                    <img class="test1"src="./public/img/h5-icon-2.png" alt="image icone fut">
                </div>
                <h2 class="h2_2">SECOND CHANCE</h2>
                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Saepe eos deleniti veritatis </p>
            </div>
            <div class="box3">
                <div class="imgBox3">
                    <img src="./public/img/h5-icon-3.png" alt="image icone vin">
                </div>
                <h2 class="h2_3">TEST IT ALL</h2>
                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Saepe eos deleniti veritatis </p>
            </div>
            <div class="box4">
                <div class="imgBox4">
                    <img src="./public/img/h5-icon-4.png" alt="image icone alcool">
                </div>
                <h2 class="h2_4">REFRESH YOUR TIME</h2>
                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Saepe eos deleniti veritatis </p>
            </div>
        </section>
        <section class="parallaxe">
            <!-- <img src="img/h5-parallax-img-2.jpg" alt="image parallaxe de bar"> -->
            <h2>THIS IS OUR OFFER</h2>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Praesentium deleniti magni placeat dolorum</p>
        </section>
        <section class="sectionMap">
            <a href=""><img src="./public/img/h1-pin.png" alt="image pin emplacement"></a>
            <div class="map">
                <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d3140.3288561760487!2d7.74721977462807!3d48.5583074823629!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sfr!2sfr!4v1713959051080!5m2!1sfr!2sfr" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </section>

<?php

$titre = "Accueil - Oh My Beauty";
$contenu = ob_get_clean();
require "template.php";