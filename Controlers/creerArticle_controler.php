<?php

    include("Models/categorie_model.php");
    $cat = new Categorie();
    include("Models/sujet_model.php");
    $sujet = new Sujet();
    include("Models/appartenir.php");
    $catsujet = new CatSujet();
    // include("Connect/utils.php");
    $utils = new Utils;

    date_default_timezone_set('Europe/Paris');

    if (!isset($_SESSION['login'])) {
        $contentCreerSujet = "<h3>Pour créer un sujet, veuillez vous <span id='conn2' class='liens'>connecter</span> ou <span id='crea2' class='liens'>créer un compte</span></h3>";
    }
    else{
        $dates="";
        $resultCreerArticle="";
        
        
        
        $aff = $cat->getAllCategorie();
        $options="";
        
        while ($donnees = $aff->fetch()) {
            $options .= "<option value=" . $donnees['id_categorie'] . ">" . $donnees['nom_cat']."</option>";
        }
        
        //vérification de l'existence des champs
        if (isset($_POST['nom_sujet']) && isset($_POST['contenu_sujet'])) {
            
            //stockage des valeurs rentrées par l'utilisateur
            $name = $utils->valid_donnees($_POST['nom_sujet']);
            $contenu = $utils->valid_donnees($_POST['contenu_sujet']);

            $dates = date('y-m-d G:i:s');

            if (isset($_POST['cat_sujet'])){
                $id_categorie = $_POST['cat_sujet'];
            }
    
                //on ne veut pas de trolls
            if ($name != "" && $contenu != ""){
                try {
                //insertion dans la table article
                    $req = $sujet->createSujet($name,$contenu,$dates,$_SESSION['id']);

                    $id_sujet = $sujet->connect->lastInsertId();
                    //si l'insertion est réussie
                    if ($req) {
                        //on suce le développeur
                        $resultCreerArticle = "L'enregistrement s'est passé à merveille ! Bravo !!!";
                    } 
                    else {
                        //sinon on blame le serveur
                        $resultCreerArticle =  "Erreur lors de l'enregistrement dans la table sujet";
                    }

                //insertion dans la table d'association "appartenir"
                    $catsujet->setIdCat(intval($id_categorie));
                    $catsujet->setIdSujet(intval($id_sujet));

                    $req = $catsujet->createAppart();

                        //si l'insertion est réussie
                        if ($req) {
                            $resultCreerArticle = "L'enregistrement s'est passé à merveille ! Bravo !!!";
                        } 
                        else {
                            $resultCreerArticle =  "Erreur lors de l'enregistrement dans la table appartenir";
                        }

                } catch (Exception $e) {
                    die('Erreur : ' . $e->getMessage());
                }

                //retour à la page d'accueil
                echo '<META HTTP-EQUIV="Refresh" Content="0; URL=index.php">';
            }
            else{
                //pour dire qu'on nous prend pas pour des cons
                $resultCreerArticle = "Veuillez remplir tous les champs SVP";
            }
        }  
        $contentCreerSujet = "<form action='' method='POST'>
        <label for='nom_sujet'>Nom du sujet</label>
        <input type='text' name='nom_sujet' min='2' max='50'>
        <label for='cat_sujet'>Catégorie</label>
        <select name='cat_sujet' id='cat_sujet'>
            $options 
        </select>
        <label for='contenu_sujet'>Votre magnifique texte ici :</label>
        <textarea name='contenu_sujet' cols='80' rows='20' style='margin-top:10px;'></textarea>
        <input type='submit' name='CreaSujet' value='Poster l'article'>
        <p> $resultCreerArticle </p>
        <p> $dates </p>
        </form>";
    }
    
    //affichage de la vue
    include("Views/creerArticle_view.php");
