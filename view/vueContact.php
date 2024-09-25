<?php
ob_start();

if (!isset($_SESSION['MAJcontact'])) {
    $_SESSION['MAJcontact'] = "";
} 
?>

<!-- bannière -->
<section class="wrapperContact">

    <h1>CONTACTEZ-NOUS</h1>
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
<!-- fin de bannière -->

    <p> <?php echo $_SESSION['MAJcontact'] ?> </p>

<!-- Formulaire de contact -->
    <form action="index.php?action=envoyerMail" method="POST">
        <label for="email">EMAIL :</label><br>
        <input type="email" id="email" name="email" required><br><br>

        <label for="sujet">SUJET :</label><br>
        <input type="text" id="sujet" name="sujet" required><br><br>

        <label for="message">MESSAGE :</label><br>
        <textarea id="message" name="message" rows="5" required></textarea><br><br>

        <input type="submit" value="Envoyer">
    </form>
<!-- fin du formulaire de contact -->
</section>

<?php
$titre = "Contact - Oh My Beauty";
$contenu = ob_get_clean();
require "template.php";
?>
