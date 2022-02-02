//récupérer les modales
var crea = document.querySelector("#modal-creation");
var conn = document.querySelector("#modal-connexion");
var deconn = document.querySelector("#modal-deconnexion");
var changeLogin = document.querySelector("#modal-changelogin");
var changeMail = document.querySelector("#modal-changemail");

//récupérer le bouton d'ouverture de la page
var openCrea = document.getElementById("creaCompte");
var openConn = document.getElementById("connCompte");
var openCrea2 = document.getElementById("crea2");
var openConn2 = document.getElementById("conn2");
var openDeConn = document.getElementById("deConnCompte");
var openChangeLogin = document.getElementById("changelogin");
var openChangeMail = document.getElementById("changemail");

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
//fonction de fermeture
function closeModal(elt){
    elt.style.animation = "slideOut 0.6s forwards";

    setTimeout(function(){
        elt.style.display = "none";
    }, 500);
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
//ouverture de la modale création
if(openCrea2){
    openCrea2.addEventListener("click", function() {
        openModal(crea);
        closeModal(conn)
    });
}
//ouverture de la modale connection
if(openConn2){
    openConn2.addEventListener("click", function() {
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
//ouverture changement de login
if(openChangeLogin){
    openChangeLogin.addEventListener("click", function() {
        openModal(changeLogin);
        });
}
//ouverture changement de mail
if(openChangeMail){
    openChangeMail.addEventListener("click", function() {
        openModal(changeMail);
        });
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
        else if(changeLogin.style.display=="flex"){
            closeModal(changeLogin);
        }
        else if(changeMail.style.display=="flex"){
            closeModal(changeMail);
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
    console.log(event.target)
    if (event.target == crea) {
        closeModal(crea);
    }
    else if (event.target == conn) {
        closeModal(conn);
    }
    else if (event.target == deconn) {
        closeModal(deconn);
    }
    else if (event.target == changeLogin) {
        closeModal(changeLogin);
    }
    else if (event.target == changeMail) {
        closeModal(changeMail);
    }
})

