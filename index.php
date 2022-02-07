<?php
//http://localhost/forum_php/index.php : c'est la page qui sera toujours affichée, et qu'il faut appeler pour lancer le site
//le changement de vue se fera avec un paramètre ?p=nomdelavue qui définira la vue

// si on clique sur un lien : "index.php?p=compte", on récupère "compte" dans $p
    if (isset($_GET['p'])) {
        $p = $_GET['p'];
    } 
//si aucun paramètre, la page home est chargée par défaut
    else {
        $p = 'home';
    }
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
    } 
//si pas de paramètre id, ben voilà
    else {
        $id = '';
    } //écrire le lien : "index.php?p=sujet&id=5"


    ob_start();
    
    include('Connect/connect.php');
    include('Connect/utils.php');

    //démarrage de session
    session_start();

    //vérification connexion
    if(isset($_SESSION['login'])){
        $besoinCreation = '<li id="deConnCompte" class="liens">Se déconnecter</li><li><a href="index.php?p=compte">Mon compte</a></li>';
        $message = "<p>Connecté comme ".$_SESSION['login']."</p>";
        echo "<script type='text/javascript'>let session='".$_SESSION['login']."'; console.log(session);</script>";
    }
    else{
        $besoinCreation = '<li id="creaCompte" class="liens">Créer un compte</li>
        <li id="connCompte" class="liens">Se connecter</li>';
        $message =  '<p>Bonjour visiteur inconnu</p>';
    }

    $resultCreerArticle = "";

    //on appelle les controlers
    include('Controlers/connexion_controler.php');
    include('Controlers/deconnexion_controler.php');
    require 'Controlers/'.$p.'_controler.php';

    //qu'on stocke dans le $content avant d'être effacé
    $content = ob_get_clean();

//on appelle le template, qui remplacera $content par la vue obtenue par le controler
require 'Views/templates/template.php';
?>