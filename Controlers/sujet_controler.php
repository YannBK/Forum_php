<?php
    
    //récupération du modèle et des catégories
    include("Models/categorie_model.php");
    $cat = new Categorie();
    include("Models/sujet_model.php");
    $sujet = new Sujet();


    try {   
        //liste catégories
        $req = $cat->getAllCategorie();

        $catListe = "";
        while ($donnees = $req->fetch()) {
            $catListe .= 
                        "<p>
                            <a href=\"#\" value=\" ".$donnees['id_categorie'] ." \">". ucwords($donnees['nom_cat']) ."</a>
                        </p>";
        }//TODO le lien doit renvoyer sur la page catégorie concernée
        //si l'insertion est réussie
        if (!$req) {
            $result =  "Erreur lors de la récupération des données";
        }

        //sujet à afficher

        //récupération de l'id du sujet via l'url
        $url = $_GET['id'];

        $req = $sujet->getSingleSujet($url);
        $donnees = $req->fetch();
        $nbRep = 0; //TODO le nombre de commentaires liés à l'article
        //formatege de la date
        $ladate = date('d-m-y à H:i',strtotime($donnees['date_sujet']));

        //création des cartes de sujet
        $cardSujet = 
            "<div>
                <h3>
                    <a href=\"index.php?p=sujet&id=" .$donnees['id_sujet'] . "\">
                        " . $donnees['nom_sujet'] . "
                    </a>
                </h3>
                <p>
                    <a href=\"#\">
                        <strong>" . $donnees['login_user'] . "  </strong>
                    </a>  
                    " . $ladate . "
                    Réponses : $nbRep
                </p>
                <p>" . $donnees['contenu_sujet'] . "</p>
            </div>";

        /*$req = $bdd->prepare("SELECT * FROM commentaire WHERE id_sujet=$donnees");
        $req->execute();


        $listeCom;
        while($donnees = $req->fetch()){
            $listeCom .= "<div><h3>".$donnees['id_users']."</h3><p>".$donnees['date_com']."</p><p>".$donnees['contenu_com']."</p></div>";
        }*/
    } catch(Exception $e) {
        die('Erreur : ' .$e->getMessage());
    }



    //recupération de la vue
    include('Views/sujet_view.php')
?>