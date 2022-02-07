<?php

<<<<<<< HEAD
=======
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
            $content = "";
            while ($donnees = $req->fetch()){
                $content .= "<div>
                <h3>
                    <a href=\"index.php?p=sujet&id=" .$donnees['id_sujet'] . "\">
                        " . $donnees['nom_sujet'] . "
                    </a>
                </h3>
                <p>
                    <a href=\"#\">
                        <strong>" . $donnees['login_user'] . "  </strong>
                    </a>  
                      dans <strong>".ucwords($donnees['nom_cat'])."</strong> le 
                    " . $ladate . "
                    Réponses : ".$donnees2[0]."
                </p>
                <p>" . $apercu . "</p>
            </div>";
            }

        }
    }
>>>>>>> fcaeecc9ece49524f4992b201a310d50e9fdea5c


?>