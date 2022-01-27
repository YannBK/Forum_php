
<?php
    //récupération de la connection à la bdd
    include("Connect/connect.php");
    // include("Models/categorie_model.php");

    //petit message de succès/échec qui s'affichera
    $result = "";

    include("Models/home_model.php");
    
    //affichage de la vue
    include("Views/home_view.php");
