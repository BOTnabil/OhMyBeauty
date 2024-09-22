var sidenav = document.getElementById("mySidenav");
var openBtn = document.getElementById("openBtn");
var userMenu = document.querySelector(".user-menu");
var userIcon = document.querySelector(".user i");
var formToggles = document.querySelectorAll(".toggle-form");

openBtn.onclick = function() {
    sidenav.classList.toggle("active");
};

userIcon.onclick = function() {
    userMenu.classList.toggle("active");
};

// toggle panier
    document.addEventListener("DOMContentLoaded", function() {
        var toggleCartBtn = document.getElementById("toggleCartBtn");
        var cartContainer = document.getElementById("cartContainer");

        toggleCartBtn.addEventListener("click", function() {
            if (cartContainer.style.display === "none" || cartContainer.style.display === "") {
                cartContainer.style.display = "block";
            } else {
                cartContainer.style.display = "none";
            }
        });

        // Cacher le panier quand on clique en dehors de celui-ci
        window.addEventListener("click", function(e) {
            if (!cartContainer.contains(e.target) && !toggleCartBtn.contains(e.target)) {
                cartContainer.style.display = "none";
            }
        });
    });

// deroulantCommande
document.addEventListener('DOMContentLoaded', function () {
    const detailsLinks = document.querySelectorAll('.voir-details');
    
    detailsLinks.forEach(link => {
        link.addEventListener('click', function () {
            const commandeId = this.getAttribute('data-id');
            const detailsRow = document.getElementById('details-commande-' + commandeId);
            
            // Toggle l'affichage des détails de la commande
            if (detailsRow.style.display === 'none') {
                detailsRow.style.display = 'table-row'; // Afficher les détails
            } else {
                detailsRow.style.display = 'none'; // Masquer les détails
            }
        });
    });
});