<?php 
ob_start(); 
?>

<!-- Team -->
<article id="team">

    <h1>OH MY BEAUTY ? <br> UN RÊVE DEVENU RÉALITÉ</h1>
    <p class="titre-team">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Consequuntur et natus consectetur iste sunt <br>  
    Lorem ipsum, dolor sit amet consectetur adipisicing elit. Consequuntur et natus consectetur iste sunt Lorem ipsum dolor, sit amet <br> 
    consectetur adipisicing elit. Rem nostrum tempore, debitis officiis repellat obcaecati quasi necessitatibus pariatur fuga atque, <br> 
    cupiditate reiciendis maiores a nihil eos ex expedita modi cumque !</p>

    <div class="equipe">
        <div class="cards-2">    
            <strong>54 établissements</strong> <br> <p>ouverts en France</p>
            <div class="cards-2-header">
                <img src="./public/img/person1.jpeg" alt="Jolyne Cujoh">
            </div>
            <h3>Jolyne Q. Joh</h3>
            <p>Gérante</p>
        </div>

        <div class="cards-2">   
            <strong>10 ans d'expérience</strong> <br> <p>dans les mains</p>
            <div class="cards-2-header">
                <img src="./public/img/person2.png" alt="Godrick D. Grafted">
            </div>
            <h3>Godrick D. Grafted</h3>
            <p>Coiffeur</p>
        </div>

        <div class="cards-2">       
            <strong>9k+ manucures</strong> <br> <p>réalisées dans sa carrière</p>
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
            <p>Esthéticien</p>
        </div>
    </div>

</article>
<!-- fin de team -->

<!-- Features cards -->
<article class="features">

    <div class="containerFeatures">
        <h1>NOS VALEURS ET PRINCIPES</h1>
        <p class="titre">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Consequuntur et natus consectetur iste sunt</p>
    </div>
    <div id="container">
        <div class="cards-1">
            <i class="fa-solid fa-crown"></i>
            <div class="cards-1-text">
                <h2>Excellence</h2>
                <p>Offrir des soins de haute qualité en utilisant des produits et des techniques de pointe.</p>
            </div>
        </div>
        <div class="cards-1">
            <i class="fa-solid fa-face-smile"></i>
            <div class="cards-1-text">
                <h2>Bien-être</h2>
                <p>Mettre le bien-être du client au cœur des services, favorisant le repos et la détente.</p>
            </div>
        </div>
        <div class="cards-1">
            <i class="fa-solid fa-tree"></i>
            <div class="cards-1-text">
                <h2>Éthique</h2>
                <p>S'engager à utiliser des produits respectueux de l'environnement, non testés sur les animaux.</p>
            </div>
        </div>
    </div>

</article>
<!-- fin de features -->

<!-- MAP -->
<section class="sectionMap">
    <div class="map">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2639.2003929882485!2d7.692440012735459!3d48.58686177117689!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4796b73599eb8f55%3A0x64d5ef90b3ac93ce!2sOhmybeauty!5e0!3m2!1sfr!2sfr!4v1723337507434!5m2!1sfr!2sfr" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
</section>
<!-- fin de map -->

<?php

$titre = "À propos - Oh My Beauty";
$contenu = ob_get_clean();
require "template.php";
