<!DOCTYPE html>
<html lang="fr">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- SEO meta description -->
    <meta name="description" content="Oh My Beauty - Institut de beauté offrant des prestations de soin et une boutique en ligne. Découvrez nos services et produits.">
    <!-- favicon -->
    <link rel="icon" href="favicon.ico" type="image/x-icon" />
    <!-- css -->
    <link rel="stylesheet" type="text/css" href="./public/css/style.css?<?php echo time(); ?>" />
    <!-- fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rufina:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Oxygen:wght@300;400;700&display=swap" rel="stylesheet">
    <!-- fontawesome -->
    <script src="https://kit.fontawesome.com/c94beabf6d.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- js -->
    <script src="./public/js/script.js" defer></script>
    <title><?= $titre ?></title>

</head>

<body>
    <header>

        <!-- Menu burger -->
        <button id="openBtn" aria-label="burger">
                <i class="fa-solid fa-bars fa-xl"></i>
        </button>
        <a href="index.php?action=home" class="logoNav"><img src="./public/img/logo_header.webp"  alt="image logo Oh My Beauty"></a>
        <div id="mySidenav" class="sidenav">
            <ul>
                <li><a href="index.php?action=prestations">Prestations</a></li>
                <li><a href="index.php?action=categorie">Boutique</a></li>
                <li><a href="index.php?action=aPropos">À propos</a></li>
                <li><a href="index.php?action=contact">Contact</a></li>
            </ul>
        </div>
        <nav id="myLinks">
            <a href="index.php?action=prestations">Prestations</a>
            <a href="index.php?action=categorie">Boutique</a>
            <a href="index.php?action=aPropos">À propos</a>
            <a href="index.php?action=contact">Contact</a>
        </nav>
        <!-- fin du menu burger -->

        <!-- Panier bouton -->
        <div class="header-cart-toggle">
            <button id="toggleCartBtn" aria-label="panier">
                <i class="fa-solid fa-cart-shopping fa-l"></i>
                <?php 
                // Calcul du nombre total d'articles dans le panier (en tenant compte des quantités)
                $totalItems = 0;
                if (!empty($_SESSION['products'])) {
                    foreach ($_SESSION['products'] as $produit) {
                        $totalItems += $produit['qtt']; // Ajoute la quantité de chaque produit au total
                    }
                }
                ?>
                <?php if ($totalItems > 0) { ?>
                    <span class="cart-count"><?= $totalItems; ?></span>
                <?php } ?>
            </button>
        </div>
        <!-- fin du panier bouton -->

        <!-- Menu utilisateur bouton -->
        <div class="user">
            <button aria-label="user">
                <i class="fa-solid fa-user fa-l"></i>
            </button>
        </div>
        <!-- fin du menu utilisateur bouton -->

        <!-- Menu utilisateur -->
        <div class="user-menu">
            <?php
                // si l'utilisateur est connecté 
                if (isset($_SESSION['user_id'])) {
                    ?>
                    <ul class="user-menu-item">
                        <li><a href="index.php?action=recap">Votre espace</a></li>
                        <?php if (\App\Session::estAdmin()) { ?>
                        <li><a href="index.php?action=admin">Espace admin</a> <?php } ?></li>
                        <li><a href="index.php?action=deconnexion">Se déconnecter</a></li>
                    </ul>
                    <?php
                } else {
                    ?>
                    <ul class="user-menu-item">
                        <li><a href='index.php?action=connexion'>Se connecter</a></li>
                        <li><a href='index.php?action=inscription'>S'inscrire</a></li>
                    </ul>
                <?php
                }
            ?>
        </div>
        <!-- fin du menu utilisateur -->

        <!-- Panier Container -->
        <div id="cartContainer" class="cart-container" style="display:none;">
            <h2>Votre Panier</h2>
            <?php if (!empty($_SESSION['products'])) { ?>
                <table>
                    <thead>
                        <tr>
                            <th>Article</th>
                            <th>Prix Unitaire</th>
                            <th>Quantité</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($_SESSION['products'] as $index => $produit) { ?>
                            <tr>
                                <td><?= $produit['nom']; ?></td>
                                <td><?= $produit['prix']; ?> €</td>
                                <td><?= $produit['qtt']; ?></td>
                                <td><?= $produit['total']; ?> €</td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <div class="cart-summary">
                    <p><strong>Total Général: </strong> 
                    <?php 
                        $totalGeneral = 0;
                        foreach ($_SESSION['products'] as $produit) {
                            $totalGeneral += $produit['total'];
                        }
                        echo $totalGeneral . " €";
                    ?>
                    </p>
                    <a href="index.php?action=panier" class="btn-gerer-panier">Gérer le panier</a>
                </div>
            <?php } else { ?>
                <p>Votre panier est vide.</p>
            <?php } ?>
        </div>
        <!-- fin du panier container -->

    </header>

    <!-- Contenu de la page -->
    <main>
        <div id="contenu">
            <?= $contenu ?>
        </div>
    </main>
    <!-- fin du contenu -->

    <!-- Footer -->
    <footer class="section bg-footer">

        <div class="container">
            <div>
            <h3 class="footer-heading text-uppercase text-white">Informations</h3>
            <ul class="footer-link mt-4">
                <li><a href="index.php?action=aPropos">Notre institut</a></li>
                <li><a href="#!">Conditions de vente</a></li>
                <li><a href="#!">Conditions d'utilisations</a></li>
            </ul>
            </div>
            <div>
            <h3 class="footer-heading text-uppercase text-white">Aide</h3>
            <ul class="footer-link mt-4">
                <li><a href="index.php?action=inscription">Inscription</a></li>
                <li><a href="index.php?action=connexion">Connexion</a></li>
                <li><a href="index.php?action=prestations">Prestations</a></li>
                <li><a href="index.php?action=categorie">Boutique</a></li>
            </ul>
            </div>
            <div class="footer-link">
            <h3 class="footer-heading text-uppercase text-white">Contactez-nous</h3>
            <p class="contact-info mt-4">Besoin d'aide ?</p>
            <p class="contact-info">+XX XX-XX-XX-XX-XX</p>
            <div>
                <ul class="list-inline">
                <li class="list-inline-item"><a href="#!"><i class="fab facebook footer-social-icon fa-facebook-f"></i></a></li>
                <li class="list-inline-item"><a href="#!"><i class="fab twitter footer-social-icon fa-twitter"></i></a></li>
                <li class="list-inline-item"><a href="#!"><i class="fab instagram footer-social-icon fa-instagram"></i></a></li>
                </ul>
            </div>
            </div>
        </div>
        <div class="text-center mt-5">
            <img src="./public/img/logo_footer.webp" alt="logo ohmybeauty">
            <p class="footer-alt">2024 © OHMYBEAUTY, Tout droits réservés</p>
        </div>

    </footer>
    <!-- fin du footer -->
</body>
</html>