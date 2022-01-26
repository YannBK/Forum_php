<?php
    //récupération de la connection à la bdd
    include("Connect/connect.php");

    //petit message de succès/échec qui s'affichera
    $result = "";

    //vérification de l'existence des champs
    if (isset($_POST['nom_sujet']) && isset($_POST['contenu_sujet'])) {

        //stockage des valeurs rentrées par l'utilisateur
        $name = $_POST['nom_sujet'];
        $content = $_POST['contenu_sujet'];

        //on ne veut pas de trolls
        if ($name != "" && $content != ""){
            //on tente l'insertion
            try {
                //via une requête préparée
                $req = $bdd->prepare("INSERT INTO sujet SET id_sujet=null, nom_sujet = :nom_sujet, contenu_sujet = :contenu_sujet, date_sujet='2022-01-17'");
                //ne reste plus qu'à récupérer la date formatée au bon format

                $okinsert = $req->execute(
                    array(
                        'nom_sujet' => $name,
                        'contenu_sujet' => $content
                        )
                    );

                    //si l'insertion est réussie
                    if ($okinsert) {
                        //on suce le développeur
                        $result = "L'enregistrement s'est passé à merveille ! Bravo !!!";
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
            $result =  "Veuillez remplir tous les champs SVP";
        }
    }  


?>