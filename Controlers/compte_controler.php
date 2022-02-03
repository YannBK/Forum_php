<?php
include('./Models/user_model.php');

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
        <div><p>Votre mail :  $mail  </p><input id='changemail' type='button' value='Changer'></div>
        <div><p>Votre date de naissance :  $date </p></div>";
    }
    else{
        $articleCompte = "<h3>Veuillez vous <span id='conn2'>connecter</span> ou <span id='crea2'>créer un compte</span></h3>";
    }

//changement de pseudo
    $user->setLoginUser($log);

    $user->getSingleUser();

    if(isset($_POST['newlogin']) && isset($_POST['mdp-newlogin'])) {

    $newlogin = $utils->valid_donnees($_POST['newlogin']);
    $mdp = $_POST['mdp-newlogin'];

    if(!password_verify($mdp,$aaa['mdp_user'])){
        echo '<script language="javascript">';
        echo 'alert("Etes-vous sûr d\'être celui(celle) que vous prétendez? Le mot de passe ne correspond pas.");';
        echo '</script>';
    }
    else{
        
    }






    include('Views/compte_view.php');