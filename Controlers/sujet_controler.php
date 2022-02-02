<?php
    //récupération de la connection à la bdd
    include("Connect/connect.php");

    //récupération du modele
    include("Models/sujet_model.php");
    $sujet = new Sujet();


    try {   
        //liste catégories
        $req = $bdd->prepare("SELECT * FROM categorie");
        $okselect = $req->execute();

        $catListe = "";
        while ($donnees = $req->fetch()) {
            $catListe .= "<p><a href=\"#\" value=\" " .
            $donnees['id_categorie'] . " \">" . $donnees['nom_cat'] . "</a></p>";
        }//TODO le lien doit renvoyer sur la page catégorie concernée
        //si l'insertion est réussie
        if (!$okselect) {
            $result =  "Erreur lors de la récupération des données";
        }

        //sujet à afficher

        //récupération de l'id du sujet via l'url
        $url = $_GET['id'];

        $res = $sujet->getSingleSujet($url);
        // $req = $bdd->prepare("SELECT * FROM sujet WHERE id_sujet=:id_sujet");
        // $req->execute(array(':id_sujet'=>$url));

        $cardSujet;
        while($donnees = $req->fetch()){
            $cardSujet = "<div><h2>".$donnees['nom_sujet']."</h2></div><info><p>".$donnees['id_users']."</p><p>".$donnees['date_sujet']."</p></info><div><p>".$donnees['contenu_sujet']."</p></div>";
        }

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