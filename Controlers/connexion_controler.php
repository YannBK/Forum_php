<?php


include('Models/user_model.php');
    $user = new Users();
    $utils = new Utils();

    $nomlogin = ""; //login afficher sous "MON COMPTE"
    
    // récupération des données
    if(isset($_POST['pseudo-connect']) && !empty($_POST['pseudo-connect']) && isset($_POST['mdp-connect']) && !empty($_POST['mdp-connect'])){
        //validation des données
        $login = $utils->valid_donnees($_POST['pseudo-connect']);
        $mdp = $utils->valid_donnees($_POST['mdp-connect']);
        try {
            $user->setLoginUser($login);
            $req = $user->getSingleUser();
            // var_dump($req);
    
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }

        $aaa = $req->fetch();
        //vérification que le login existe
        if($aaa==true){
            //vérification que le mdp correspond
                if(password_verify($mdp,$aaa['mdp_user'])==true){
                    $nomlogin = $aaa['login_user'];
                    // paramètrage de la session
                    $_SESSION['id'] = $aaa['id_users'];
                    $_SESSION['login'] = $aaa['login_user'];
                    
                    //actualisation de la page = prise en compte de la connection
                    echo '<META HTTP-EQUIV="Refresh" Content="0; URL=' . $utils->getUrl() . '">';
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