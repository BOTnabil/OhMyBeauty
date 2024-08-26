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

// Afficher notification mail



// Navigation image defaultView

var slideIndex = 0;

function showSlides() {
    var slides = document.getElementsByClassName("slide");
    for (var i = 0; i < slides.length; i++) {
        slides[i].className = slides[i].className.replace(" active-slide", ""); // Retirer la classe active-slide
        slides[i].style.opacity = 0;  // Mettre l'opacité à 0
    }

    slideIndex++;
    if (slideIndex > slides.length) {
        slideIndex = 1; // Si on dépasse le nombre de slides, retourner au premier
    }

    slides[slideIndex - 1].style.opacity = 1; // Définir l'opacité à 1 pour le slide actuel
    slides[slideIndex - 1].className += " active-slide"; // Ajouter la classe active-slide

    setTimeout(showSlides, 7000); // Changer le slide toutes les 5 secondes
}

document.addEventListener('DOMContentLoaded', function() {
    showSlides(); // Appeler showSlides à la fin du chargement de la page
});
