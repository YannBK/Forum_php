
<?php
    //récupération de la connection à la bdd
    // include("Connect/connect.php");
    include("Models/categorie_model.php");
    $cat = new Categorie();
    include('Models/sujet_model.php');
    $sujet = new Sujet();

        //on tente l'insertion
        try {
            //récupération des catégories
            $req = $cat->getAllCategorie();

            //création liste des catégories
            $catListe = "";
            while ($donnees = $req->fetch()) {
                $catListe .= "<p>
                                <a 
                                    href=\"index.php?p=categorie&id=" . $donnees['id_categorie'] . "\" >
                                    " . $donnees['nom_cat'] . "
                                </a>
                            </p>";
            }

            //récupération des articles
            $req = $sujet->getAllSujets();

            $sujetListe = "";
            $nbRep = 0; //TODO le nombre de commentaires liés à l'article
            while ($donnees = $req->fetch()) {
                //formatege de la date
                $ladate = date('d-m-y à H:i',strtotime($donnees['date_sujet']));

                //création des cartes de sujet
                $sujetListe .= 
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
                    </div>";
            }
            // echo session_status();
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
        
    //affichage de la vue
    include("Views/home_view.php");
