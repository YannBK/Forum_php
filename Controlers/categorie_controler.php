
<?php
    include('Models/commentaire_model.php');
    $com = new Commentaire();
    include("Models/categorie_model.php");
    $cat = new Categorie();
    include('Models/sujet_model.php');
    $sujet = new Sujet();

        //on tente l'insertion
        try {
            //récupération de la catégorie
            $url = $_GET['id'];
            // titre de la page 
            $titreCat = ucwords($url);

            //aside liste des catégories
            $req = $cat->getAllCategorie();
            $catListe = "";
            while ($donnees = $req->fetch()) {
                $catListe .= "<p>
                                <a 
                                    href=\"index.php?p=categorie&id=" . $donnees['nom_cat'] . "\" >
                                    " . ucwords($donnees['nom_cat']) . "
                                </a>
                            </p>";
            }

            // affichage sujets
            $req = $sujet->getAllSujetsByCategorie($url);
            $sujetListe = "";
            while ($donnees = $req->fetch()) {
                //aperçu du sujet
                $apercu = substr($donnees['contenu_sujet'],0,50) . " ...";

                //formatage de la date
                $ladate = date('d-m-y à H:i',strtotime($donnees['date_sujet']));

                //nombre de commentaire
                $com->setIdSujetCom($donnees['id_sujet']);
                $nbRep = $com->count();
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
                        <a href=\"#\">
                        <strong>" . $donnees['login_user'] . "</strong>
                    </a>  dans <strong>".ucwords($donnees['nom_cat'])."</strong> le
                            " . $ladate . "
                            Réponses : ".$donnees2[0]."
                        </p>
                        <p>" . $apercu . "</p>
                    </div>";
            }

            //aside sujets actifs
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
        } 
        catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
        
    //affichage de la vue
    include("Views/categorie_view.php");
