<?php
    //on ne veut pas de trolls
    if ($name != "" && $contenu != ""){
        //on tente l'insertion
        try {
            //via une requête préparée
            $req = $bdd->prepare("INSERT INTO sujet SET nom_sujet = :nom_sujet, contenu_sujet = :contenu_sujet, date_sujet= :date_sujet");
            //ne reste plus qu'à récupérer l'id_user de l'utilisateur écrivain
            $okinsert = $req->execute(
                array(
                    'nom_sujet' => $name,
                    'contenu_sujet' => $contenu,
                    'date_sujet' => $dates
                    )
                );
                //si l'insertion est réussie
                if ($okinsert) {
                    //on suce le développeur
                    $result = "L'enregistrement s'est passé à merveille ! Bravo !!!";
//TODO retour à la page d'accueil avec le nouveau sujet qui est apparu
                } 
                else {
                    //sinon on blame le serveur
                    $result =  "Erreur lors de l'enregistrement";
                }

        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }
    else{
        //pour dire qu'on nous prend pas pour des cons
        $result = "Veuillez remplir tous les champs SVP";
    }
?>