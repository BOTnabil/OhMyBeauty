<?php
ob_start();
?>

<div class="wrapperContact">

<!-- contact -->
    <section class="contact">

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
        <adress>
        Adresse : 123 Rue de la Beauté, 75001 Paris<br>
        Horaires d'ouverture : Tout les jours de 9h à 18h<br>
        </adress>
    </section>
<!-- fin de contact -->

    <?php
    // Message de confirmation ou d'erreur après l'ajout
    if (isset($_SESSION['MAJcontact'])) {
        echo '<p>' . $_SESSION['MAJcontact'] . '</p>';
        unset($_SESSION['MAJcontact']);  // Supprimer le message après l'affichage
    } ?>

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
</div>

<?php
$titre = "Contact - Oh My Beauty";
$contenu = ob_get_clean();
require "template.php";
?>
