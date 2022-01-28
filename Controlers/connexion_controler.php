<?php
    // création de compte utilisateur

    //  ajout du paramètre de connexion
    include('Connect/connect.php');
    // récupération des données pour
    $message = "";
    $nomlogin = "";

    $loginsession = "";
    $mailsession = "";
    $datesession = "";
    $mdpsession = "";

    if(isset($_POST['pseudo-connect']) && !empty($_POST['pseudo-connect']) && isset($_POST['mdp-connect']) && !empty($_POST['mdp-connect'])){

        $login = $_POST['pseudo-connect'];
        $mdp = $_POST['mdp-connect'];
 
        // insertion dans la classe
        include('Models/connexion_model.php');
        $aaa = $query->fetch();
        if($aaa==true){
                if(password_verify($mdp,$aaa['mdp_user'])==true){
                    $nomlogin = $aaa['login_user'];
                    // session_start();
                    $_SESSION['id'] = $aaa['id_users'];
                    $_SESSION['login'] = $aaa['login_user'];
                    $_SESSION['mail'] = $aaa['mail_user'];
                    $_SESSION['date'] = $aaa['date_user'];
                    $_SESSION['mdp'] = $aaa['mdp_user'];
                    // var_dump($_SESSION);
                }

                else{
                    $message =  '<p style="color:red;">Les données renseignées ne sont pas valides !! Veuillez essayer à nouveau</p>';
                }
        }
        else{
            $message =  '<p style="color:red;">Les données renseignées ne sont pas valides !! Veuillez essayer à nouveau</p>';
        }
        $loginsession = $aaa['login_user'];
        $mailsession = $aaa['mail_user'];
        $datesession = $aaa['date_user'];
        $mdpsession = $aaa['mdp_user'];
    } else{
        //TODO lui trouver la bonne place
        $notif = "<p>Erreur veuillez remplir tous les champs !</p>";
    }
    
    


?>