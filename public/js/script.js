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
