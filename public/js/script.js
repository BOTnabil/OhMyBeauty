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

// affichage de coté sur home
const boxes = document.querySelectorAll('.box-about-us');

window.addEventListener('scroll', checkBoxes);

checkBoxes();

function checkBoxes() {
	const triggerBottom = window.innerHeight / 5 * 4;
	boxes.forEach((box, idx) => {
		const boxTop = box.getBoundingClientRect().top;
		
		if(boxTop < triggerBottom) {
			box.classList.add('show');
		} else {
			box.classList.remove('show');
		}
	});
}

// Slider homepage
let img__slider = document.getElementsByClassName('img__slider');

let etape = 0;

let nbr__img = img__slider.length;

let precedent = document.querySelector('.precedent');
let suivant = document.querySelector('.suivant')

function enleverActiveImage() {
    for(let i = 0 ; i < nbr__img ; i++){
        img__slider[i].classList.remove('active');
    }
}

suivant.addEventListener('click', function() {
    etape++;
    if(etape >= nbr__img) {
        etape = 0;
    }
    enleverActiveImage();
    img__slider[etape].classList.add('active');
})

precedent.addEventListener('click', function() {
    etape--;
    enleverActiveImage();
    if(etape < 0) {
        etape = nbr__img - 1;
    }
    img__slider[etape].classList.add('active');
})

//test