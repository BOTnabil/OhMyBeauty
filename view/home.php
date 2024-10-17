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
        <p>Basic info about OMB</p>
        <h2>OMB - Lorem ipsum otorquent</h2>
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
            <h4>Website design</h4>
            <p>Lorem ipsum odor amet, consectetur adipiscing elit. Fusce elementum cubilia faucibus vel ante.</p>
        </div>
        <div class="service">
            <h3>01.</h3>
            <h4>Website design</h4>
            <p>Lorem ipsum odor amet, consectetur adipiscing elit. Fusce elementum cubilia faucibus vel ante.</p>
        </div>
        <div class="service">
            <h3>01.</h3>
            <h4>Website design</h4>
            <p>Lorem ipsum odor amet, consectetur adipiscing elit. Fusce elementum cubilia faucibus vel ante.</p>
        </div>
    </div>
</section>

<section class="app-design">
    <div class="container-home">
        <p>Basic info about OMB</p>
        <h2>Most reliable application<br>Mobile App Design</h2>
        <p>Lorem ipsum odor amet, consectetur adipiscing elit. Fusce elementum cubilia faucibus vel ante tristique non, magnis?</p>
        <p>Nunc scelerisque erat suscipit habitant ornare nisi ridiculus volutpat. Semper consequat per fringilla senectus a felis.</p>
    </div>
</section>

<section class="creative-heads">
    <div class="container-home">
        <p>Basic info about OMB</p>
        <h2>Creative Heads</h2>
        <p>Lorem ipsum odor amet, consectetur adipiscing elit. Fusce elementum cubilia faucibus vel ante tristique non, magnis?</p>
        <p>Nunc scelerisque erat suscipit habitant ornare nisi ridiculus volutpat. Semper consequat per fringilla senectus a felis.</p>
    </div>
</section>




<?php

$titre = "Accueil - Oh My Beauty";
$contenu = ob_get_clean();
require "template.php";
?>
