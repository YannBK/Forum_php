<?php
    // création de compte utilisateur

    //  ajout du paramètre de connexion
    include('Connect/connect.php');
    // Ou on va récupérer les informations

    // include('Views/templates/template.php');
    // récupération des données pour

    if(isset($_POST['pseudo-crea']) && !empty($_POST['pseudo-crea']) && isset($_POST['email-crea']) && !empty($_POST['email-crea']) && isset($_POST['dateN']) && !empty($_POST['dateN']) && isset($_POST['mdp-crea']) && !empty($_POST['mdp-crea'])){

        $login = $_POST['pseudo-crea'];
        $date = $_POST['dateN'];
        $mail = $_POST['email-crea'];
        $mdp = $_POST['mdp-crea'];

        $checkUser = $bdd->prepare("SELECT * From users where login_user=?");

        $checkUser->execute([$login]);
        $user = $checkUser->fetch();

        $checkMail = $bdd->prepare("SELECT * From users where mail_user=?");

        $checkMail->execute([$mail]);
        $mailUser = $checkMail->fetch();
        
        if(!$user && !$mailUser){
                include('Models/create_user_model.php');
            
        } else {
            echo "<p> Ce login ou ce mail sont déjà utilisé</p>";
        }
        
        

    } 
    


?>