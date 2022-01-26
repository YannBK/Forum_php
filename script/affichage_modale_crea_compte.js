//récupérer la page de connexion
var crea = document.querySelector(".modal")

//récupérer le bouton d'ouverture de la page
var open = document.getElementById("creaCompte");

//récupérer le bouton de fermeture de la page
var close = document.getElementById("close");

//ouverture de la page avec le bouton
open.addEventListener("click", function() {
    crea.style.display = "flex";
    crea.style.animation = "slideTop 0.5s";
})

//fermeture de la page avec le bouton
close.addEventListener("click", function() {
    crea.style.animation = "slideOut 0.5s";
    crea.style.display = "none";
})

//fermeture de la page avec le background
window.addEventListener("click", function(event) {
    if (event.target == crea) {
        crea.style.animation = "slideOut 0.5s";
        crea.style.display = "none";
    }
})