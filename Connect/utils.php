<?php

class Utils {

    public function getUrl(){
        $currentPageUrl = 'http://' . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
        return $currentPageUrl;
    }

    public function valid_donnees($donnees){
        $donnees = trim($donnees);
        $donnees = stripslashes($donnees);
        $donnees = htmlspecialchars($donnees);
        return $donnees;
    }

    public function creerNav($idDeconn, $idCrea, $idConn){
        if(isset($_SESSION['login'])){
            $besoinCreation = '<li id='.$idDeconn.' class="liens">Se déconnecter</li><li><a href="index.php?p=compte">Mon compte</a></li>';
        }
        else{
            $besoinCreation = '<li id='.$idCrea.' class="liens">Créer un compte</li>
            <li id='.$idConn.' class="liens">Se connecter</li>';
        }
        return $besoinCreation;
    }

    public function messageConnection(){
        if(isset($_SESSION['login'])){
            $message = "<p>Connecté comme ".$_SESSION['login']."</p>";
        }
        else{
            $message =  '<p>Bonjour visiteur inconnu</p>';
        }
        return $message;
    }
}

?>




