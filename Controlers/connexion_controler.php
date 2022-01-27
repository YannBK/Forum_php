<?php
    // création de compte utilisateur

    //  ajout du paramètre de connexion
    include('Connect/connect.php');

    // récupération des données pour

    if(isset($_POST['pseudo-connect']) && !empty($_POST['pseudo-connect']) && isset($_POST['mdp-connect']) && !empty($_POST['mdp-connect'])){

        $login = $_POST['pseudo-connect'];
        $mdp = $_POST['mdp-connect'];

        // insertion dans la classe
        include('Models/connexion_model.php');

    } else{
        //TODO lui trouver la bonne place
        $notif = "<p>Erreur veuillez remplir tous les champs !</p>";
    }
    
    


?>