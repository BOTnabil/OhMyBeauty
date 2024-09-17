<?php ob_start(); ?>

<div class="inscription-container">
    <h1>Créer un nouveau compte</h1>

    <form method="POST" action="index.php?action=inscriptionProcess">
        <label for="email">Email :</label><br>
        <input type="email" id="email" name="email" required><br><br>
        <label for="motDePasse1">Mot de passe :</label><br>
        <input type="password" id="motDePasse1" name="motDePasse1" required><br><br>
        <label for="motDePasse2">Confirmez le mot de passe :</label><br>
        <input type="password" id="motDePasse2" name="motDePasse2" required><br><br>
        <input type="submit" name="submit" value="S'inscrire">
    </form>

    <p>Déjà inscrit ? <a href="index.php?action=connexion">Connectez-vous ici</a></p>
</div>

<?php 
$titre = "Inscription - Oh My Beauty";
$contenu = ob_get_clean();
require "template.php";
?>
