<?php
    //on ne veut pas de trolls
    if ($name != "" && $contenu != ""){
        //on tente l'insertion
        try {
        //insertion dans la table article
            //via une requête préparée
            $req = $bdd->prepare("INSERT INTO sujet SET nom_sujet = :nom_sujet, contenu_sujet = :contenu_sujet, date_sujet= :date_sujet");

//TODO ne reste plus qu'à récupérer l'id_user de l'utilisateur écrivain

            $okinsert = $req->execute(
                array(
                    'nom_sujet' => $name,
                    'contenu_sujet' => $contenu,
                    'date_sujet' => $dates
                )
            );
            $id_sujet=$bdd->lastInsertId();
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


        //insertion dans la table d'association "appartenir"
            $req = $bdd->prepare("INSERT INTO appartenir SET id_sujet = :id_sujet, id_categorie = :id_categorie");

            $okinsert = $req->execute(
                array(
                    'id_sujet' => $id_sujet,
                    'id_categorie' => $id_categorie
                    )
                );
                //si l'insertion est réussie
                if ($okinsert) {
                    $result = "L'enregistrement s'est passé à merveille ! Bravo !!!";
                } 
                else {
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