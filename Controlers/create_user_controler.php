<?php
///////////////////////////////////////////////////////////////////////////////
                        // création de compte utilisateur //
///////////////////////////////////////////////////////////////////////////////

    //  ajout du paramètre de connexion à la BDD
    // include('Connect/connect.php');

    // création de la variable de display info, laissé vide au start pour éviter des erreurs
    $log = "";

    // récupération du fuseau horaire

    date_default_timezone_set('Europe/Paris');

    // création de variables venant limiter la selection de l'age de l'utilisateur 

        $min = intval(date("Y")) -18; //date retourne en string l'année actuelle que je transforme en entier pour l'additionner avec l'age mini de l'utilisateur.
        $max = intval(date("Y"))-100;

        // Ici je retransforme en string les entiers stockés dans les variables min et max
        $minA = (string)$min; 
        $minSP = $minA . '-' . date("m-j");
        $maxA = (string)$max;


    if(isset($_POST['pseudo-crea']) && !empty($_POST['pseudo-crea']) && isset($_POST['email-crea']) && !empty($_POST['email-crea']) && isset($_POST['dateN']) && !empty($_POST['dateN']) && isset($_POST['mdp-crea']) && !empty($_POST['mdp-crea']) && isset($_POST['confirmMdp-crea']) && !empty($_POST['confirmMdp-crea']) && isset($_POST['condUtilisat'])){
    
        

        function valid_donnees($donnees){
            $donnees = trim($donnees);
            $donnees = stripslashes($donnees);
            $donnees = htmlspecialchars($donnees);
            return $donnees;
        }
        $mdp = $_POST['mdp-crea'];
        $mdp1 = $_POST['confirmMdp-crea'];



        if($mdp === $mdp1){

        
        

        // fonction de validation des données afin de vérifier les charactères utilisés
        $login = valid_donnees($_POST['pseudo-crea']);
        $date = valid_donnees($_POST['dateN']);
        $mail = valid_donnees($_POST['email-crea']);
        $mdp = valid_donnees(password_hash($_POST['mdp-crea'], PASSWORD_BCRYPT));
        $cond = $_POST['condUtilisat'];

        
        // grosse moulinette de check des infos entrées par l'utilisateur login et mail


        // TODO vérifier si le premier et le deuxième mot de passe sont identiques
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
                if($cond === 'on'){
                    include('Models/create_user_model.php');
                } else{
                    $log = '<p style="color:red;">Veuillez accepter les termes d\'utilisation !</p>';
                }  
                
            } else {
                $log = "<p> Ce login ou ce mail sont déjà utilisés</p>";
            }
        } else{
            $log = '<p>Ca serait bien de pas trop se foutre de notre gueule !</p>';
        }
        
    } else{
        echo '<script language="javascript">';
        echo 'alert("Les mots de passe ne correspondent pas");';
        echo '</script>';
    }
    } 
    


?>