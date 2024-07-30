import './bootstrap.js';
/*
 * Welcome to your app's main JavaScript file!
 *
 * This file will be included onto the page via the importmap() Twig function,
 * which should already be in your base.html.twig.
 */
import './styles/app.css';

// Fonctionnement du menu burger

var sidenav = document.getElementById("mySidenav");
var openBtn = document.getElementById("openBtn");
var closeBtn = document.getElementById("closeBtn");

openBtn.onclick = openNav;
closeBtn.onclick = closeNav;

function openNav(){
    sidenav.classList.add("active");
}

function closeNav(){
    sidenav.classList.remove("active");
}

console.log('This log comes from assets/app.js - welcome to AssetMapper! 🎉');
