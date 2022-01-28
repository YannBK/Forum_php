//récupérer la page de connexion
var crea = document.querySelector("#modal-creation")
var conn = document.querySelector("#modal-connexion")

//récupérer le bouton d'ouverture de la page
var openCrea = document.getElementById("creaCompte");
var openConn = document.getElementById("connCompte");

//récupérer le bouton de fermeture de la page
var close = document.querySelectorAll(".close");

//les liens si on n'est pas sur la bonne modale
let allerConn = document.getElementById('allerConn');
let allerCrea = document.getElementById('allerCrea');

//fonction pour ouvrir une modale
function openModal(elt){
    elt.style.display = "flex";
    elt.style.animation = "slideTop 0.5s";
}
//ouverture de la page avec le bouton
openCrea.addEventListener("click", function() {
    openModal(crea);
})
//ouverture de la page avec le bouton
openConn.addEventListener("click", function() {
    openModal(conn);
})

function closeModal(elt){
    elt.style.animation = "slideOut 0.5s";
    elt.style.display = "none";
}
//fermeture de la page avec le bouton
close.forEach(el => {
    el.addEventListener("click", function() {
        if(crea.style.display=="flex"){
            crea.style.animation = "slideOut 0.5s";
            crea.style.display = "none";
        }
        else if(conn.style.display=="flex"){
            conn.style.animation = "slideOut 0.5s";
            conn.style.display = "none";
        }
})
})

//switcher d'une modale à une autre
allerConn.addEventListener('click',function(){
    openModal(conn);
    crea.style.animation = "slideOut 0.5s";
    crea.style.display = "none";
})

allerCrea.addEventListener('click',function(){
    openModal(crea);
    conn.style.animation = "slideOut 0.5s";
    conn.style.display = "none";
})

//fermeture de la page avec le background
window.addEventListener("mousedown", function(event) {
    if (event.target == crea) {
        crea.style.animation = "slideOut 0.6s forwards";
        setTimeout(function(){
            crea.style.display = "none";
        }, 500);
    }
    else if (event.target == conn) {
        conn.style.animation = "slideOut 0.6s forwards";
        setTimeout(function(){
            conn.style.display = "none";
        }, 500);
    }
})

