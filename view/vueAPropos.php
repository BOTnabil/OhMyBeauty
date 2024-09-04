<?php 
ob_start(); 
?>

<section id="team">
    <h2>OH MY BEAUTY ? <br> UN RÊVE DEVENU RÉALITÉ</h2>
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
</section>

<section id="features">
    <div class="containerFeatures">
        <h2>NOS VALEURS ET PRINCIPES</h2>
        <p class="titre">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Consequuntur et natus consectetur iste sunt</p>
    </div>
    <div id="container">
        <div class="cards-1">
            <i class="fa-solid fa-crown"></i>
            <div class="cards-1-text">
                <h3>Excellence</h3>
                <p>Offrir des soins de haute qualité en utilisant des produits et des techniques de pointe.</p>
            </div>
        </div>
        <div class="cards-1">
            <i class="fa-solid fa-face-smile"></i>
            <div class="cards-1-text">
                <h3>Bien-être</h3>
                <p>Mettre le bien-être du client au cœur des services, favorisant le repos et la détente.</p>
            </div>
        </div>
        <div class="cards-1">
            <i class="fa-solid fa-tree"></i>
            <div class="cards-1-text">
                <h3>Éthique</h3>
                <p>S'engager à utiliser des produits respectueux de l'environnement, non testés sur les animaux.</p>
            </div>
        </div>
    </div>
</section>

<?php

$titre = "À propos - Oh My Beauty";
$contenu = ob_get_clean();
require "template.php";
