<?php

        //on tente l'insertion
        try {
            //récupération des catégories
            $req = $bdd->prepare("SELECT * FROM categorie");

            $okselect = $req->execute();

            $catListe = "";
            while ($donnees = $req->fetch()) {
                $catListe .= "<p>
                                <a 
                                    href='index.php?p=categorie&id=" . $donnees['id_categorie'] . "' >
                                    " . $donnees['nom_cat'] . "
                                </a>
                            </p>";
            }//TODO le lien doit renvoyer sur la page catégorie concernée
            //si l'insertion est réussie
            if (!$okselect) {
                $result =  "Erreur lors de la récupération des données";
            }


            //récupération des articles
            $req = $bdd->prepare("SELECT * FROM sujet ORDER BY id_sujet DESC");

            $okselect = $req->execute();
            $sujetListe = "";
            $nbRep = 0;
            while ($donnees = $req->fetch()) {
                $ladate = date('d-m-y à H:i',strtotime($donnees['date_sujet']));

                //TODO formatter la date => jj-mm-aa hh:mm
                $sujetListe .= 
                    "<div>
                        <h3>
                            <a href=\"index.php?p=sujet&id=" .$donnees['id_sujet'] . "\">
                                " . $donnees['nom_sujet'] . "
                            </a>
                        </h3>
                        <p>
                            <a href=\"#\">
                                Auteur 
                            </a>  
                            " . $ladate . "
                            Réponses : $nbRep
                        </p>
                    </div>";
            }//TODO Auteur doit être remplacé par le nom de l'auteur, si si !
            //si l'insertion est réussie
            if (!$okselect) {
                $result =  "Erreur lors de la récupération des données";
            }


        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }

?>