<?php

include('Models/sujet_model.php');
include("Models/commentaire_model.php");
$com = new Commentaire();
include("Models/categorie_model.php");
$cat = new Categorie();

$utils = new Utils();
$sujet = new Sujet();
$sujetListe = "";
$catListe = "";

function affichage($req, $com, $sujetListe) {
        while ($donnees = $req->fetch()){
            $ladate = date('d-m-y à H:i',strtotime($donnees['date_sujet']));

            $apercu = substr($donnees['contenu_sujet'],0,50) . "<a href=\"index.php?p=sujet&id=" .$donnees['id_sujet'] . "\"> ... ... ... </a>";

            $com->setIdSujetCom($donnees['id_sujet']);
            $nbRep = $com->count();
            $donnees2 = $nbRep->fetch();

            $sujetListe .= "<div>
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
        return $sujetListe;
    }

    $recherche = $utils->valid_donnees($_SESSION['recherche']);
    $recherche = strtolower($recherche);
    $req = $sujet->getAllSujetsBySearch($recherche, 'sujet.nom_sujet');

    $nbResult = $req->rowCount();

    if($nbResult === 0){
        $req = $sujet->getAllSujetsBySearch($recherche, 'users.login_user');
        $nbResult = $req->rowCount();
        if($nbResult === 0){
            $sujetListe = "La recherche n'a rien donné, essayez autre chose.";
        }
        else{
            $sujetListe = affichage($req, $com, $sujetListe);
        }
    }
    else{
        $sujetListe = affichage($req, $com, $sujetListe);
    }

    $req = $cat->getAllCategorie();
        //création liste des catégories
        while ($donnees = $req->fetch()) {
            $catListe .= "<p>
                            <a 
                                href=\"index.php?p=categorie&id=" . $donnees['nom_cat'] . "\" >
                                " . ucwords($donnees['nom_cat']) . "
                            </a>
                        </p>";
        }

    include("Views/search_view.php");
    
?>