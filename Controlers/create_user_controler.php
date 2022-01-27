<?php
    // création de compte utilisateur

    //  ajout du paramètre de connexion
    include('Connect/connect.php');

    // récupération des données pour

    if(isset($_POST['pseudo-crea']) && !empty($_POST['pseudo-crea']) && isset($_POST['email-crea']) && !empty($_POST['email-crea']) && isset($_POST['dateN']) && !empty($_POST['dateN']) && isset($_POST['mdp-crea']) && !empty($_POST['mdp-crea'])){

        $login = $_POST['pseudo-crea'];
        $date = $_POST['dateN'];
        $mail = $_POST['email-crea'];
        $mdp = $_POST['mdp-crea'];
        var_dump($login);
        // insertion dans la classe
        include('Models/create_user_model.php');

    } else{
        $notif =  "<p>Erreur veuillez remplir tous les champs !</p>";
    }
    
    


?>