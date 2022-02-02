<?php

    include("Models/categorie_model.php");
    $cat = new Categorie();
    include("Models/sujet_model.php");
    $sujet = new Sujet();
    include("Models/appartenir.php");
    $catsujet = new CatSujet();

    date_default_timezone_set('Europe/Paris');
    $dates = "";

    $aff = $cat->getAllCategorie();
    $options="";
    while ($donnees = $aff->fetch()) {
        $options .= "<option value=" . $donnees['id_categorie'] . ">" . $donnees['nom_cat']."</option>";
    }
    
    //vérification de l'existence des champs
    if (isset($_POST['nom_sujet']) && isset($_POST['contenu_sujet'])) {
        
        //stockage des valeurs rentrées par l'utilisateur
        $name = $_POST['nom_sujet'];
        $contenu = $_POST['contenu_sujet'];
        $dates = date('y-m-d G:i:s');

        if (isset($_POST['cat_sujet'])){
            $id_categorie = $_POST['cat_sujet'];
        }

        // include("Models/creerArticle_model.php");

        
            //on ne veut pas de trolls
    if ($name != "" && $contenu != ""){
        //on tente l'insertion
        try {
        //insertion dans la table article
            //via une requête préparée
            $req = $sujet->createSujet($name,$contenu,$dates,$_SESSION['id']);

            $id_sujet = $sujet->connect->lastInsertId();
            //si l'insertion est réussie
            if ($req) {
                //on suce le développeur
                $resultCreerArticle = "L'enregistrement s'est passé à merveille ! Bravo !!!";

//TODO retour à la page d'accueil avec le nouveau sujet qui est apparu

            } 
            else {
                //sinon on blame le serveur
                $resultCreerArticle =  "Erreur lors de l'enregistrement";
            }

        //insertion dans la table d'association "appartenir"
            $catsujet->setIdCat($id_categorie);
            $catsujet->setIdSujet($id_sujet);
            $req = $catsujet->createAppart();

            // $req = $bdd->prepare("INSERT INTO appartenir SET id_sujet = :id_sujet, id_categorie = :id_categorie");

            // $okinsert = $req->execute(
            //     array(
            //         'id_sujet' => $id_sujet,
            //         'id_categorie' => $id_categorie
            //         )
            //     );
                //si l'insertion est réussie
                if ($req) {
                    $resultCreerArticle = "L'enregistrement s'est passé à merveille ! Bravo !!!";
                } 
                else {
                    $resultCreerArticle =  "Erreur lors de l'enregistrement";
                }

        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }
    else{
        //pour dire qu'on nous prend pas pour des cons
        $resultCreerArticle = "Veuillez remplir tous les champs SVP";
    }
    }  
    
    //affichage de la vue
    include("Views/creerArticle_view.php");
