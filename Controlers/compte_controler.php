<?php


// include('Connect/connect.php');

// include('Models/compte_model.php');


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



include('Views/compte_view.php');