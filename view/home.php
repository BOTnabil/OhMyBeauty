<?php
ob_start(); 
?>

<!-- Bannière -->
<section>
    <div class="banner">
        <img src="./public/img/img1.jpg" alt="image avec ecrit OH MY BEAUTY" class="img-logo"/> 
        <div class="logo">
            <h1>OH MY BEAUTY</h1>
        </div>
    </div>
</section>

<section class="header-info">
    <div class="container-home">
        <p>Notre service de reservation</p>
        <h2>Prenez soin de vous</h2>
        <div class="intro-text">
            <p>Lorem ipsum odor amet, consectetur adipiscing elit. Fusce elementum cubilia faucibus vel ante tristique non, magnis?</p>
            <p>Nunc scelerisque erat suscipit habitant ornare nisi ridiculus volutpat. Semper consequat per fringilla senectus a felis.</p>
        </div>
    </div>
</section>

<section class="services">
    <div class="container-home">
        <div class="service">
            <h3>01.</h3>
            <h4>Choisissez</h4>
            <p>Lorem ipsum odor amet, consectetur adipiscing elit. Fusce elementum cubilia faucibus vel ante.</p>
        </div>
        <div class="service">
            <h3>02.</h3>
            <h4>Renseignez</h4>
            <p>Lorem ipsum odor amet, consectetur adipiscing elit. Fusce elementum cubilia faucibus vel ante.</p>
        </div>
        <div class="service">
            <h3>03.</h3>
            <h4>Profitez</h4>
            <p>Lorem ipsum odor amet, consectetur adipiscing elit. Fusce elementum cubilia faucibus vel ante.</p>
        </div>
    </div>
</section>

<section class="app-design">
    <div class="container-home">
        <p>Nos valeurs</p>
        <h2>Notre excellence provient<br>de votre bien-être</h2>
        <p>Lorem ipsum odor amet, consectetur adipiscing elit. Fusce elementum cubilia faucibus vel ante tristique non, magnis?
        Nunc scelerisque erat suscipit habitant ornare nisi ridiculus volutpat. Semper consequat per fringilla senectus a felis.</p>
    </div>
</section>

<section class="creative-heads">
    <div class="container-home">
        <p>Notre catalogue chez vous</p>
        <h2>Une large gamme de produits</h2>
        <p>Lorem ipsum odor amet, consectetur adipiscing elit. Fusce elementum cubilia faucibus vel ante tristique non, magnis?</p>
    </div>

    <div class="gallery-container">
        <div class="div1"><img src="./public/img/grid_1.jpg" alt="Image 1"></div>
        <div class="div2"><img src="./public/img/grid_2.jpg" alt="Image 1"></div>
        <div class="div3"><img src="./public/img/grid_3.jpg" alt="Image 1"></div>
        <div class="div4"><img src="./public/img/grid_4.jpg" alt="Image 1"></div>
        <div class="div5"><img src="./public/img/grid_5.jpg" alt="Image 1"></div>
        <div class="div6"><img src="./public/img/grid_6.jpg" alt="Image 1"></div>
        <div class="div7"><img src="./public/img/grid_7.jpg" alt="Image 1"></div>
        <div class="div8"><img src="./public/img/grid_8.jpg" alt="Image 1"></div>
    </div>
</section>



<?php

$titre = "Accueil - Oh My Beauty";
$contenu = ob_get_clean();
require "template.php";
?>
