<?php 
ob_start(); 
?>

<section id="team">

<h2>We're dynamic team of talented people of <br> innovative & marketing expert</h2>
<p class="titre-team">To achieve this, it would be necessary to have uniform grammar, pronunciation <br>  and more common words. If several languages of the resulting language</p>
    <div class="equipe">
        <div class="cards-2">    
            <strong>54 etablissements</strong> <br> <p>ouverts en France</p>
                <div class="cards-2-header">
                    <img src="./public/img/person1.jpeg" alt="Jolyne Cujoh">
                </div>
            <h3>Jolyne Cujoh</h3>
            <p>Gérante</p>
        </div>

        <div class="cards-2">   
            <strong>10 ans d'experience</strong>  <br> <p>dans les mains</p>
                <div class="cards-2-header">
                    <img src="./public/img/person2.png" alt="Godrick D. Grafted">
                </div>
            <h3>Godrick D. Grafted</h3>
            <p>Coiffeur</p>
        </div>

        <div class="cards-2">       
            <strong>9k+ manucure</strong> <br> <p>dans sa carrière</p>
                <div class="cards-2-header">
                    <img src="./public/img/person3.png" alt="Shaw T. Slay">
                </div>
            <h3>Shaw T. Slay</h3>
            <p>Prothésiste ongulaire</p>
        </div>

        <div class="cards-2">
            <strong>Son talent</strong> <br> <p>vous rendra aussi beau que lui</p>
                <div class="cards-2-header">
                    <img src="./public/img/person4.png" alt="Jig A. Chad">
                </div>
            <h3>Jig A. Chad</h3>
            <p>Estheticien</p>
        </div>
    </div>
</section>

<section id="features">
    <h2>Products Features</h2>
    <p class="titre">It is a long established fact that a reader will be of a page when <br> established fact looking at its layout</p>
    <div id="container">
        <div class="cards-1">
            <i class="fa-solid fa-globe"></i>
            <div class="cards-1-text">
                <h3>Digital Design</h3>
                <p>Some quick example text to build on the card title and make up the bulk of the card the platform. </p>
            </div>
        </div>
        <div class="cards-1">
            <i class="fa-solid fa-brush"></i>
                <div class="cards-1-text">
                    <h3>Unlimited Colors</h3>
                    <p>Credibly brand stanaads compliant user exteible services College Anibh ocean euismad tincidunt laoreet </p>
                </div>
        </div>

        <div class="cards-1">
            <i class="fa-solid fa-chess"></i>
                <div class="cards-1-text">
                    <h3>Strategy Solutions</h3>
                    <p>Seperated they live in Bookmarks grove right at the coast of the Semantics, a large ocean regelialia. </p>
                </div>
        </div>
    </div>
</section>

<?php

$titre = "A propos - Oh My Beauty";
$contenu = ob_get_clean();
require "template.php";