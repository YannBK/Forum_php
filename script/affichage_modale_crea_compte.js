
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

//ouverture de la modale création par la nav
//ouverture de la modale connection par la nav
const crea = document.querySelector("#modal-creation");
const conn = document.querySelector("#modal-connexion");
const openCrea = document.getElementById("creaCompte");
const openConn = document.getElementById("connCompte");

if(openCrea){
    openCrea.addEventListener("click", function() {
        openModal(crea);
        closeModal(conn)
    });
}
if(openConn){
    openConn.addEventListener("click", function() {
        openModal(conn);
        closeModal(crea)
    });
}


//ouverture de la modale création par la page compte si non connecté
//ouverture de la modale connection par la page compte si non connecté
const openCrea2 = document.getElementById("crea2");
const openConn2 = document.getElementById("conn2");

if(openCrea2){
    openCrea2.addEventListener("click", function() {
        openModal(crea);
        closeModal(conn)
    });
}
if(openConn2){
    openConn2.addEventListener("click", function() {
        openModal(conn);
        closeModal(crea)
    });
}


//ouverture de la modale déconnection
const deconn = document.querySelector("#modal-deconnexion");
const openDeConn = document.getElementById("deConnCompte");

if(openDeConn){
    openDeConn.addEventListener("click", function() {
    openModal(deconn);
    });
}


//ouverture changement de login => page compte
const changeLogin = document.querySelector("#modal-changelogin");
const openChangeLogin = document.getElementById("changelogin");

if(openChangeLogin){
    openChangeLogin.addEventListener("click", function() {
        openModal(changeLogin);
        });
}


//ouverture changement de mail => page compte
const changeMail = document.querySelector("#modal-changemdp");
const openChangeMail = document.getElementById("changemdp");
if(openChangeMail){
    openChangeMail.addEventListener("click", function() {
        openModal(changeMail);
        });
}


//fermeture des modales avec la croix
const close = document.querySelectorAll(".close");
const modal = document.querySelectorAll(".modal");
 
close.forEach(el => {
    el.addEventListener("click", function() {
        modal.forEach(mod => {
            if(mod.style.display=="flex"){
                closeModal(mod);
            }
        })
    });
});


//switcher d'une modale à une autre, entre création et connection
let allerConn = document.getElementById('allerConn');
let allerCrea = document.getElementById('allerCrea');

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
    modal.forEach(mod => {
        if(event.target == mod){
            closeModal(mod);
        }
    })
})

