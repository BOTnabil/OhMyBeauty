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
            <span class="bruger-icon">
                <span><i class="fa-solid fa-bars fa-2xl" style="color: #ffffff;"></i></span>
            </span>
        </a>
        <img src="./public/img/logo_header.png" class="logoNav" alt="image logo Oh My Beauty">
        <div id="mySidenav" class="sidenav">
            <a id="closeBtn" href="#" class="close">x</a>
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