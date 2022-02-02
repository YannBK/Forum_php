<?php
// include('Models/user_model.php');
// $user = new Users();

//affichage des informations de la session
if(isset($_SESSION['login'])){
    $log = $_SESSION['login'];
    $mail = $_SESSION['mail'];
    $date = $_SESSION['date'];

    $articleCompte = 
        "<h3>Vos informations :</h3>
        <div><p>Votre login :  $log </p><input id='changelogin' type='button' value='Changer'></div>
        <div><p>Votre mail :  $mail  </p><input id='changemail' type='button' value='Changer'></div>
        <div><p>Votre date de naissance :  $date </p></div>";
}
else{
    $articleCompte = "<h3>Veuillez vous <span id='conn2'>connecter</span> ou <span id='crea2'>créer un compte</span></h3>";
}

// validation du nouveau pseudo
if(isset($_POST['newloginok']) 
    && isset($_POST['newlogin']) 
    && isset($_POST['mdp-newlogin']) ) {

    $req = $user->getSingleUser();
    $aaa = $req->fetch();

    function valid_donnees($donnees){
        $donnees = trim($donnees);
        $donnees = stripslashes($donnees);
        $donnees = htmlspecialchars($donnees);
        return $donnees;
    }
    $newlogin = valid_donnees($_POST['newlogin']);
    $mdp = valid_donnees($_POST['mdp-newlogin']);

    if(!password_verify($mdp,$aaa['mdp_user'])==true){
        echo '<script language="javascript">';
        echo 'alert("Mot de passe erroné, veuillez recommencer");';
        echo '</script>';
    }
    else{
        $user->updateUserForLogin($newlogin,$_SESSION['id']);
    }
}

include('Views/compte_view.php');