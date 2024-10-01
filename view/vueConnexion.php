<?php ob_start(); ?>

<!-- formulaire de connexion -->
<section class="connexion-container">

    <h1>Connexion à votre compte</h1>

    <form method="POST" action="index.php?action=connexionProcess">

        <label for="email">Email :</label><br>
        <input type="email" id="email" name="email" required><br><br>

        <label for="motDePasse">Mot de passe :</label><br>
        <input type="password" id="motDePasse" name="motDePasse" required><br><br>

        <?php
        // Message de confirmation ou d'erreur après l'ajout
        if (isset($_SESSION['MAJlogin'])) {
            echo '<p>' . $_SESSION['MAJlogin'] . '</p>';
            unset($_SESSION['MAJlogin']);  // Supprimer le message après l'affichage
        } ?>

        <input type="submit" name="submit" value="Se connecter">
        
    </form>

    <p>Pas encore de compte ? <a href="index.php?action=inscription">Inscrivez-vous ici</a></p>
    
</section>
<!-- fin de formulaire de connexion -->

<?php 
$titre = "Connexion - Oh My Beauty";
$contenu = ob_get_clean();
require "template.php";
?>
