<?php

// ex lien : "index.php?p=compte", $p définit le controleur appelé
    if (isset($_GET['p'])) {
        $p = $_GET['p'];
    } 
    else $p = 'home';

// ex lien : "index.php?p=sujet&id=42"
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
    } 
    else $id = '';


    ob_start();
    
    include('Connect/connect.php');
    include('Connect/utils.php');
    //démarrage de session
    session_start();

    $resultCreerArticle = "";

    //sauvegarde du terme recherché
    if (isset($_POST['search'])){
        $_SESSION['recherche'] = $_POST['search'];
    }

    //on appelle les controlers
    include('Controlers/connexion_controler.php');
    include('Controlers/deconnexion_controler.php');
    require ('Controlers/'.$p.'_controler.php');

    //qu'on stocke dans le $content avant d'être effacé
    $content = ob_get_clean();
    //template
    require 'Views/templates/template.php';
?>