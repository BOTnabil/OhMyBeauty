<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- favicon -->
    <link rel="icon" href="favicon.ico" type="image/x-icon" />
    <!-- css -->
    <link rel="stylesheet" type="text/css" href="./public/css/style.css?<?php echo time(); ?>" />
    <!-- fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200..700&display=swap" rel="stylesheet">
    <!-- fontawesome -->
    <script src="https://kit.fontawesome.com/c94beabf6d.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- js -->
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
        <a href="index.php?action=home"><img src="./public/img/logo_header.png" class="logoNav" alt="image logo Oh My Beauty"></a>
        <div id="mySidenav" class="sidenav">
            <ul>
                <li><a href="index.php?action=prestations">Prestations</a></li>
                <li><a href="index.php?action=boutique">Boutique</a></li>
                <li><a href="index.php?action=aPropos">À propos</a></li>
                <li><a href="index.php?action=contact">Contact</a></li>
            </ul>
        </div>
        <nav id="myLinks">
            <a href="index.php?action=prestations">Prestations</a>
            <a href="index.php?action=boutique">Boutique</a>
            <a href="index.php?action=aPropos">À propos</a>
            <a href="index.php?action=contact">Contact</a>
        </nav>
        <div class="user">
            <a href="#"><i class="fa-regular fa-user fa-xl" style="color: #ffffff;"></i></a>
        </div>

        <!-- Menu utilisateur -->
        <div class="user-menu">
            <?php
                // si l'utilisateur est connecté 
                if (isset($_SESSION['user_id'])) {
                    ?>
                    <div class="user-menu-item">
                        <h3 class="toggle-form"><a href="index.php?action=deconnexion">Se déconnecter</a></h3>
                        <h3 class="toggle-form"><a href="index.php?action=recap">Votre espace</a></h3>
                    </div>
                    <?php
                } else {
                    ?>
                    <div class="user-menu-item">
                        <a href='index.php?action=inscription'>S'inscrire</a>
                    </div>

                    <div class="user-menu-item">
                        <a href='index.php?action=connexion'>Se connecter</a>
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
