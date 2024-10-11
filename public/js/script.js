var sidenav = document.getElementById("mySidenav");
var openBtn = document.getElementById("openBtn");

openBtn.onclick = function() {
    sidenav.classList.toggle("active");
};

var userMenu = document.querySelector(".user-menu");
var userIcon = document.querySelector(".user i");

userIcon.onclick = function() {
    userMenu.classList.toggle("active");
};

// toggle 
    //toggle panier
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

    // Toggle Formulaires
        document.getElementById('toggle-prestation').addEventListener('click', function() {
            var form = document.getElementById('prestation-form');
            if (form.style.display === 'none') {
                form.style.display = 'block';
                this.textContent = '×';
            } else {
                form.style.display = 'none';
                this.textContent = '+';
            }
        });

        document.getElementById('toggle-produit').addEventListener('click', function() {
            var form = document.getElementById('produit-form');
            if (form.style.display === 'none') {
                form.style.display = 'block';
                this.textContent = '×';
            } else {
                form.style.display = 'none';
                this.textContent = '+';
            }
        });

//test

