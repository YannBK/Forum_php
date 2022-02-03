<?php
// include('./Models/user_model.php');

$user = new Users();
$utils = new Utils();

//affichage
if(isset($_SESSION['login'])){
    $log = $_SESSION['login'];
    $mail = $_SESSION['mail'];
    $date = $_SESSION['date'];

    $articleCompte = 
        "<h3>Vos informations :</h3>
        <div><p>Votre login :  $log </p><input id='changelogin' type='button' value='Changer'></div>
        <div><p>Votre mail :  $mail  </p></div>
        <div><p>Votre date de naissance :  $date </p></div>";
    }
    else{
        $articleCompte = "<h3>Veuillez vous <span id='conn2'>connecter</span> ou <span id='crea2'>créer un compte</span></h3>";
    }


//changement de pseudo
    $user->setLoginUser($log);
    $myuser = $user->getSingleUser();
    $aaa = $myuser->fetch();

    if(isset($_POST['newlogin']) && isset($_POST['mdp-newlogin'])) {

        $newlogin = $utils->valid_donnees($_POST['newlogin']);
        $mdp = $_POST['mdp-newlogin'];

        if(!password_verify($mdp,$aaa['mdp_user'])){
            echo '<script language="javascript">';
            echo 'alert("Etes-vous sûr d\'être celui(celle) que vous prétendez? Le mot de passe ne correspond pas.");';
            echo '</script>';
        }
        else{
            if($aaa==true){
                $user->setIdUser($aaa['id_users']);
                $user->setLoginUser($newlogin);
                $user->setMailUser($aaa['mail_user']);
                $user->setMdpUser($aaa['mdp_user']);
            }
            $user->updateUser();

            $_SESSION['login'] = $newlogin;
            echo '<META HTTP-EQUIV="Refresh" Content="0; URL=' . $utils->getUrl() . '">';
        }
    }

// changement de mot de passe
    if(isset($_POST['newmdp']) && isset($_POST['mdp-newmdp'])) {

        $newmdp = $_POST['newmdp'];
        $mdp = $_POST['mdp-newmdp'];

        if(!password_verify($mdp,$aaa['mdp_user'])){
            echo '<script language="javascript">';
            echo 'alert("Etes-vous sûr d\'être celui(celle) que vous prétendez? Le mot de passe ne correspond pas.");';
            echo '</script>';
        }
        else{
            if($aaa==true){
                $user->setIdUser($aaa['id_users']);
                $user->setLoginUser($aaa['login_user']);
                $user->setMailUser($aaa['mail_user']);
                $user->setMdpUser(password_hash($newmdp, PASSWORD_BCRYPT));
            }
            $user->updateUser();

            // $_SESSION['login'] = $newlogin;
        }
    }

    include('Views/compte_view.php');