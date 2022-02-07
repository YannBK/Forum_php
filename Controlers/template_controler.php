<?php

// include('Models/sujet_model.php');

$utils = new Utils();
$sujet = new Sujet();

    if (isset($_GET['search']) && $_GET['search'] != ""){
        $recherche = $utils->valid_donnees($_GET['search']);
        $recherche = strtolower($recherche);
        $req = $sujet->getAllSujetsBySearch($recherche, 'nom_sujet');
        $nbResult = $req->rowCount();
        if($nbResult === 0){
            echo '<script language="javascript">';
                echo 'alert("Rien trouvé");';
                echo '</script>';
        }
        else{
            while ($donnees = $req->fetch()){
                var_dump($donnees);
            }

        }
    }


?>