<?php
    // création de compte utilisateur

    //  ajout du paramètre de connexion
    include('Connect/connect.php');

    // récupération des données pour

    if(isset($_POST['pseudo-crea']) && !empty($_POST['pseudo-crea']) && isset($_POST['email-crea']) && !empty($_POST['email-crea']) && isset($_POST['dateN']) && !empty($_POST['dateN']) && isset($_POST['mdp-crea']) && !empty($_POST['mdp-crea'])){
    


        function valid_donnees($donnees){
            $donnees = trim($donnees);
            $donnees = stripslashes($donnees);
            $donnees = htmlspecialchars($donnees);
            return $donnees;
        }

        $login = valid_donnees($_POST['pseudo-crea']);
        $date = valid_donnees($_POST['dateN']);
        $mail = valid_donnees($_POST['email-crea']);
        $mdp = valid_donnees($_POST['mdp-crea']);

        // fonction de validation des données afin de vérifier
        
        $crypt = password_hash($mdp, PASSWORD_BCRYPT);
        $mdp = $crypt;
        
        // grosse moulinette de check des infos entrée par l'utilisateur login et mail
        if(strlen($login) <= 20 
            && preg_match("/^[A-Za-z '-]+$/",$login)
            && filter_var($mail, FILTER_VALIDATE_EMAIL)
        ){

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
        } else{
            echo '<p>Ca serait bien de pas trop se foutre de notre gueule !</p>';
        }
        

    } 
    


?>