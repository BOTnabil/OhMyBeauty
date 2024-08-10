<?php
session_start();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./public/css/style.css?<?php echo time(); ?>" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200..700&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/c94beabf6d.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="./public/js/script.js" defer></script>
    <title><?= $titre ?></title>
</head>
<body>
    <header>
        <a href="#" id="openBtn">
            <span class="burger-icon">
                <span><i class="fa-solid fa-bars fa-2xl" style="color: #ffffff;"></i></span>
            </span>
        </a>
        <img src="./public/img/logo_header.png" class="logoNav" alt="image logo Oh My Beauty">
        <div id="mySidenav" class="sidenav">
            <ul>
                <li><a href="index.php?action=defaultView">Accueil</a></li>
                <li><a href="#">Services</a></li>
                <li><a href="index.php?action=aPropos">À propos</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
        </div>
        <nav id="myLinks">
            <a href="index.php?action=defaultView">Accueil</a>
            <a href="#">Services</a>
            <a href="index.php?action=aPropos">À propos</a>
            <a href="#">Contact</a>
        </nav>
        <div class="user">
            <a href="#"><i class="fa-regular fa-user fa-xl" style="color: #ffffff;"></i></a>
        </div>

        <!-- Menu utilisateur -->
        <div class="user-menu">
            <?php
                // si l'utilisateur est connecté 
                if (isset($_SESSION['user_id'])){
                    ?>
                    <div class="user-menu-item">
                        <h3 class="toggle-form"><a href="index.php?action=logout">Se déconnecter</a></h3>
                    </div>
                    <?php
                } else {
                    ?>
                    <div class="user-menu-item">
                        <h3 class="toggle-form">S'inscrire</h3>
                        <form class="user-form" action="index.php?action=register" method="POST">
                            <input type="text" name="nom" placeholder="Nom">
                            <input type="text" name="prenom" placeholder="Prénom">
                            <input type="email" name="email" placeholder="Email">
                            <input type="password" name="motDePasse1" placeholder="Mot de passe">
                            <input type="password" name="motDePasse2" placeholder="Confirmez le mot de passe">
                            <input type="submit" name="submit" value="S'inscrire">
                        </form>
                    </div>

                    <div class="user-menu-item">
                        <h3 class="toggle-form">Se connecter</h3>
                        <form class="user-form" action="index.php?action=login" method="POST">
                            <input type="email" name="email" placeholder="Email">
                            <input type="password" name="motDePasse" placeholder="Mot de passe">
                            <input type="submit" name="submit" value="Se connecter">
                        </form>
                    </div>
                <?php
                }
            ?>
        </div>
    </header>

    <div id="wrapper">
        <main>
            <div id="contenu">
                <?= $contenu ?>
            </div>
        </main>
    </div>
    <footer>
        <img src="./public/img/logo_footer.png" alt="logo ohmybeauty">
    </footer>
</body>
</html>