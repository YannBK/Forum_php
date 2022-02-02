<?php


// include('Connect/connect.php');

// include('Models/compte_model.php');


if(isset($_SESSION['login'])){
    $log = $_SESSION['login'];
    $mail = $_SESSION['mail'];
    $date = $_SESSION['date'];

    $articleCompte = 
        "<h3>Vos informations :</h3>
        <div><p>Votre login : </p><p> $log </p></div>
        <div><p>Votre mail : </p><p> $mail  </p></div>
        <div><p>Votre date : </p><p> $date </p></div>";
}
else{
    $articleCompte = "<h3>Veuillez vous <span id='conn2'>connecter</span> ou <span id='crea2'>créer un compte</span></h3>";
}



include('Views/compte_view.php');