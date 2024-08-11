<p?php
ob_start(); 
?>

<div class="wrapperContact">

    <h1>CONTACTEZ-NOUS</h1>
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

    <div id="notification"></div>

    <form action="index.php?action=contactSubmit" method="POST">
        <label for="nom">NOM :</label><br>
        <input type="text" id="nom" name="nom" required><br><br>
        <label for="email">EMAIL:</label><br>
        <input type="email" id="email" name="email" required><br><br>
        <label for="sujet">SUJET :</label><br>
        <input type="text" id="sujet" name="sujet" required><br><br>
        <label for="message">MESSAGE :</label><br>
        <textarea id="message" name="message" rows="5" required></textarea><br><br>
        <input type="submit" value="Envoyer">
    </form>

</div>
<?php
$titre = "Contact - Oh My Beauty";
$contenu = ob_get_clean();
require "template.php";
?>