<?php ob_start(); 
if (!isset($_SESSION['MAJregister'])) {
    $_SESSION['MAJregister'] = "";
}?>

<div class="inscription-container">
    <h1>Créer un nouveau compte</h1>

    <form method="POST" action="index.php?action=inscriptionProcess">
        <label for="email">Email :</label><br>
        <input type="email" id="email" name="email" required><br><br>
        
        <label for="motDePasse1">Mot de passe :</label><br>
        <input type="password" id="motDePasse1" name="motDePasse1" required><br>
        <small>Le mot de passe doit contenir au moins 8 caractères, une majuscule, une minuscule, un chiffre et un caractère spécial.</small><br><br>
    

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
        
        <p> <?php echo $_SESSION['MAJregister'] ?> </p>
        <input type="submit" name="submit" value="S'inscrire">
    </form>

    <p>Déjà inscrit ? <a href="index.php?action=connexion">Connectez-vous ici</a></p>
</div>

<?php 
$titre = "Inscription - Oh My Beauty";
$contenu = ob_get_clean();
require "template.php";
?>
