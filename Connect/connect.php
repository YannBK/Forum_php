<?php

    // fichier de connexion à la BDD 'forum'
    $bdd = new PDO('mysql:host=localhost;dbname=forum','root','', 
    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

    $bdd-> exec("set names utf8");

?>