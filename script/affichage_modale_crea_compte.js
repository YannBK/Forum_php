//récupérer les modales
var crea = document.querySelector("#modal-creation");
var conn = document.querySelector("#modal-connexion");
var deconn = document.querySelector("#modal-deconnexion");

//récupérer le bouton d'ouverture de la page
var openCrea = document.getElementById("creaCompte");
var openConn = document.getElementById("connCompte");
var openDeConn = document.getElementById("deConnCompte");

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

//ouverture de la modale création
if(openCrea){
    openCrea.addEventListener("click", function() {
        openModal(crea);
        closeModal(conn)
    });
}
//ouverture de la modale connection
if(openConn){
    openConn.addEventListener("click", function() {
        openModal(conn);
        closeModal(crea)
    });
}
//ouverture de la modale déconnection
if(openDeConn){
    openDeConn.addEventListener("click", function() {
    openModal(deconn);
    });
}


//fonction de fermeture
function closeModal(elt){
    elt.style.animation = "slideOut 0.6s forwards";

    setTimeout(function(){
        elt.style.display = "none";
    }, 500);
}

//fermeture de la page avec le bouton
close.forEach(el => {
    el.addEventListener("click", function() {
        if(crea.style.display=="flex"){
            closeModal(crea);
        }
        else if(conn.style.display=="flex"){
            closeModal(conn);
        }
        else if(deconn.style.display=="flex"){
            closeModal(deconn);
        }
    });
});

//switcher d'une modale à une autre
allerConn.addEventListener('click',function(){
    openModal(conn);
    closeModal(crea);
})

allerCrea.addEventListener('click',function(){
    openModal(crea);
    closeModal(conn);
})


//fermeture de la page avec le background
window.addEventListener("mousedown", function(event) {
    if (event.target == crea) {
        closeModal(crea);
    }
    else if (event.target == conn) {
        closeModal(conn);
    }
    else if (event.target == deconn) {
        closeModal(deconn);
    }
})

