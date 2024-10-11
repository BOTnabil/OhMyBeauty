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

//test