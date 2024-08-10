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

// Ajouter un événement de clic pour chaque section
formToggles.forEach(function(toggle) {
    toggle.addEventListener("click", function() {
        var form = this.nextElementSibling;
        form.style.display = (form.style.display === "block") ? "none" : "block";
    });
});