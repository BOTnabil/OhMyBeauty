<?php ob_start(); ?>

<!-- Formulaire d'inscription -->
<section class="inscription-container">
    
    <h1>Créer un nouveau compte</h1>

    <form method="POST" action="index.php?action=inscriptionProcess">
        <label for="email">Email :</label><br>
        <input type="email" id="email" name="email" required><br><br>
        
        <label for="motDePasse1">Mot de passe :</label><br>
        <input type="password" id="motDePasse1" name="motDePasse1" required><br>
        <small>Au moins 8 caractères, une majuscule, une minuscule, un chiffre et un caractère spécial.</small><br><br>
    

        <label for="motDePasse2">Confirmez le mot de passe :</label><br>
        <input type="password" id="motDePasse2" name="motDePasse2" required><br><br>
        
        <!-- Case à cocher pour accepter les conditions d'utilisation -->
        <label for="accepterConditions">
            <input type="checkbox" name="accepterConditions" id="accepterConditions" required>
            J'accepte les <a href="#">conditions d'utilisation</a>.
        </label><br>

        <div style="display:none;">
            <label for="honeypot">Si vous êtes humain ignorez ce champ :</label>
            <input type="text" id="honeypot" name="honeypot" value="">
        </div>
        
        <?php
        // Message de confirmation ou d'erreur après l'ajout
        if (isset($_SESSION['MAJregister'])) {
            echo '<p>' . $_SESSION['MAJregister'] . '</p>';
            unset($_SESSION['MAJregister']);  // Supprimer le message après l'affichage
        } ?>
        <input type="submit" name="submit" value="S'inscrire">
    </form>

    <!-- lien pour si user a déjà un compte -->
    <p>Déjà inscrit ? <a href="index.php?action=connexion">Connectez-vous ici</a></p>

</section>
<!-- Fin du formulaire d'inscription -->

<?php 
$titre = "Inscription - Oh My Beauty";
$contenu = ob_get_clean();
require "template.php";
?>
