<?php ob_start(); 
if (!isset($_SESSION['MAJlogin'])) {
    $_SESSION['MAJlogin'] = "";
}
?>

<div class="connexion-container">
    <h1>Connexion à votre compte</h1>

    <form method="POST" action="index.php?action=connexionProcess">
        <label for="email">Email :</label><br>
        <input type="email" id="email" name="email" required><br><br>
        <label for="motDePasse">Mot de passe :</label><br>
        <input type="password" id="motDePasse" name="motDePasse" required><br><br>
        <p> <?php echo $_SESSION['MAJlogin'] ?> </p>
        <input type="submit" name="submit" value="Se connecter">
    </form>

    <p>Pas encore de compte ? <a href="index.php?action=inscription">Inscrivez-vous ici</a></p>
</div>

<?php 
$titre = "Connexion - Oh My Beauty";
$contenu = ob_get_clean();
require "template.php";
?>
