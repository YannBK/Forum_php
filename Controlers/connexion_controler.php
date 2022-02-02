<?php

    include('Connect/utils.php');

    // include('Connect/connect.php');
    include('Models/user_model.php');
    // $user = new Users();

    $nomlogin = ""; //login afficher sous "MON COMPTE"
    
    // récupération des données
    if(isset($_POST['pseudo-connect']) && !empty($_POST['pseudo-connect']) && isset($_POST['mdp-connect']) && !empty($_POST['mdp-connect'])){

        $login = $_POST['pseudo-connect'];
        $mdp = $_POST['mdp-connect'];
 


        //TODO ici remplacer par méthode de la class User
        try {
            $query = $bdd->prepare("SELECT                  
                                    * 
                                    FROM users 
                                    WHERE login_user = :login_user
                                    " );
            // execution de la requête
            $query->execute(
                array(
                    'login_user' => $login
                    )
                );
    
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }



        $aaa = $query->fetch();
        //vérification que le login existe
        if($aaa==true){
            //vérification que le mdp correspond
                if(password_verify($mdp,$aaa['mdp_user'])==true){
                    $nomlogin = $aaa['login_user'];
                    // paramètrage de la session
                    $_SESSION['id'] = $aaa['id_users'];
                    $_SESSION['login'] = $aaa['login_user'];
                    $_SESSION['mail'] = $aaa['mail_user'];
                    $_SESSION['date'] = $aaa['date_user'];
                    $_SESSION['mdp'] = $aaa['mdp_user']; //TODO à ne pas stocker
                    
                    //actualisation de la page = prise en compte de la connection
                    // var_dump($_SESSION);
                    echo '<META HTTP-EQUIV="Refresh" Content="0; URL=' . $currentPageUrl . '">';
                }
                
                else{
                    $notif =  '<p style="color:red;">Les données renseignées ne sont pas valides !! Veuillez essayer à nouveau</p>';
                }
            }
            else{
                $notif =  '<p style="color:red;">Les données renseignées ne sont pas valides !! Veuillez essayer à nouveau</p>';
            }
    } else{
        //TODO lui trouver la bonne place
        $notif = "";
    }
    


?>