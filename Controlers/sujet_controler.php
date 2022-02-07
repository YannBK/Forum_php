<?php
    
    //récupération des modèles et des catégories
    include("Models/categorie_model.php");
    $cat = new Categorie();
    include("Models/sujet_model.php");
    $sujet = new Sujet();
    include("Models/commentaire_model.php");
    $com = new Commentaire();

    $cardCom="";
    try {   
        //liste catégories
        $req = $cat->getAllCategorie();
        $catListe = "";
        while ($donnees = $req->fetch()) {
            $catListe .= 
                        "<p>
                            <a href=\"index.php?p=categorie&id=" . $donnees['nom_cat'] . "\">". ucwords($donnees['nom_cat']) ."</a>
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

        $com->setIdSujetCom($url);
        $nbRep = $com->count();
        $donnees2 = $nbRep->fetch();

        //formatage de la date
        $ladate = date('d-m-y à H:i',strtotime($donnees['date_sujet']));
        $alert = "";
        //création des cartes de sujet
        $cardSujet = 
            "<div>
                <h3>
                    " . $donnees['nom_sujet'] . "
                </h3>
                <p>
                    <strong>" . $donnees['login_user'] . "  </strong>
                    " . $ladate . "
                    Réponses : ".$donnees2[0]."
                </p>
                <p>" . $donnees['contenu_sujet'] . "</p>
            </div>";

        $cardSujetActif = "";
        $req = $com->sujetActif();
        while ($donnees3 = $req->fetch()) {
            $cardSujetActif .= 
            "<div>
            <p>
                <a href=\"index.php?p=sujet&id=" .$donnees3['id_sujet'] . "\">
                    " . $donnees3['nom_sujet'] . "
                </a>, 
                <a href=\"#\">
                    <strong>" . $donnees3['login_user'] . "  </strong>
                </a>  
                    dans <strong>".ucwords($donnees3['nom_cat'])."</strong> 
                Réponses : ".$donnees3['rep']."
            </p>
        </div>";
        }

    } catch(Exception $e) {
        die('Erreur : ' .$e->getMessage());
    }

    if (!isset($_SESSION['login'])) {
        $formCom = "<h3>Pour commenter, veuillez vous <span id='conn2' class='liens'>connecter</span> ou <span id='crea2' class='liens'>créer un compte</span></h3>";
    }
    else{
        if (isset($_POST['commentaire'])) {
            //stockage des valeurs
            $contenu = $_POST['commentaire'];
            $date = date('y-m-d G:i:s');
            $idSujetCom = $donnees['id_sujet'];
            //vérif présence contenu dans le com
            if($contenu != ""){
                //insertion dans la bdd
                try {
                    $req = $com->createCom($contenu, $date, $_SESSION['id'], $idSujetCom);
                    echo '<META HTTP-EQUIV="Refresh" Content="0; URL=' . $utils->getUrl() . '">';
                    if(!$req) {
                        $alert = "La publication du commentaire a échouée, veuillez réssayer.";
                    }
                    else{
                        $alert = "C'est cool.";
                    }
                } catch(Exception $e) {
                    die('Erreur : ' .$e->getMessage());
                }
            }
        }
        $req = $com->getComsS();
        $cardCom = "";
        while ($donnees = $req->fetch()) {
            $cardCom .= 
                "<div>
                    <p>
                        <strong>" . $donnees['login_user'] . "  </strong>
                        " . $ladate . "
                    </p>
                    <p>" . $donnees['contenu_com'] . "</p>
                </div>";
        }//TODO le lien doit renvoyer sur la page catégorie concernée

        //si l'insertion est réussie
        if (!$req) {
            $result =  "Erreur lors de la récupération des données";
        }
        $formCom = "<CreaCom>
                        <form action='' method='POST'>
                            <p>Votre commentaire :</p>
                            <div>
                                <textarea name='commentaire' cols='100' rows='10'></textarea>
                            </div>
                            <div>
                                <input type='submit' name='publier' value='Publier votre commentaire'>
                            </div>
                        </form>
                    </CreaCom> 
                    <p> $alert </p>
                    $cardCom ";
    }
    //recupération de la vue
    include('Views/sujet_view.php')
?>