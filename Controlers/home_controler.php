
<?php
    //récupération de la connection à la bdd
    // include("Connect/connect.php");
    include("Models/categorie_model.php");
    $cat = new Categorie();
    include('Models/sujet_model.php');
    $sujet = new Sujet();
    include("Models/commentaire_model.php");
    $com = new Commentaire();

    //on tente l'insertion
    try {
        //récupération des catégories
        $req = $cat->getAllCategorie();
        //création liste des catégories
        $catListe = "";
        while ($donnees = $req->fetch()) {
            $catListe .= "<p>
                            <a 
                                href=\"index.php?p=categorie&id=" . $donnees['nom_cat'] . "\" >
                                " . ucwords($donnees['nom_cat']) . "
                            </a>
                        </p>";
        }
        //récupération des articles
        $req = $sujet->getAllSujets();
        $sujetListe = "";
        $nbRep = 0; //TODO le nombre de commentaires liés à l'article
        while ($donnees = $req->fetch()) {
            $apercu = substr($donnees['contenu_sujet'],0,50) . "<a href=\"index.php?p=sujet&id=" .$donnees['id_sujet'] . "\"> ... ... ... </a>";
            //formatege de la date
            $ladate = date('d-m-y à H:i',strtotime($donnees['date_sujet']));
            //récupération de l'id du sujet
            $com->setIdSujetCom($donnees['id_sujet']);
            //comptage du nombre de commentaires
            $nbRep = $com->count();
            //récupération de la valeur
            $donnees2 = $nbRep->fetch();
            //création des cartes de sujet
            $sujetListe .= 
                "<div>
                    <h3>
                        <a href=\"index.php?p=sujet&id=" .$donnees['id_sujet'] . "\">
                            " . $donnees['nom_sujet'] . "
                        </a>
                    </h3>
                    <p>
                        <strong>" . $donnees['login_user'] . "  </strong>
                        dans <strong>".ucwords($donnees['nom_cat'])."</strong> le 
                        " . $ladate . "
                        Réponses : ".$donnees2[0]."
                    </p>
                    <p>" . $apercu . "</p>
                </div>";
        }
        $cardSujetActif = "";
    $req = $com->sujetActif();
    while ($donnees3 = $req->fetch()) {
        $cardSujetActif .= 
        "<div>
            <p>
                <a href=\"index.php?p=sujet&id=" .$donnees3['id_sujet'] . "\">
                    " . $donnees3['nom_sujet'] . "
                </a>, 
                    <strong>" . $donnees3['login_user'] . "  </strong>
                    dans <strong>".ucwords($donnees3['nom_cat'])."</strong> 
                Réponses : ".$donnees3['rep']."
            </p>
        </div>";
    }
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
        
    //affichage de la vue
    include("Views/home_view.php");
