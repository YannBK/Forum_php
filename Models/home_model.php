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
                                    href=\"#\" 
                                    value=\" " . $donnees['id_categorie'] . " \">
                                    " . $donnees['nom_cat'] . "
                                </a>
                            </p>";
            }//TODO le lien doit renvoyer sur la page catégorie concernée
            //si l'insertion est réussie
            if (!$okselect) {
                $result =  "Erreur lors de la récupération des données";
            }


            //récupération des articles
            $req = $bdd->prepare("SELECT * FROM sujet");

            $okselect = $req->execute();
            $sujetListe = "";
            $nbRep = 0;
            while ($donnees = $req->fetch()) {
                //TODO formatter la date => jj-mm-aa hh:mm
                $sujetListe .= "<div>
                                    <h3>
                                        <a href=\"#\" value=\" " . $donnees['id_sujet'] . "\">" . $donnees['nom_sujet'] . "</a>
                                    </h3>
                                    <p>
                                        <a href=\"#\"> Auteur </a>  
                                        <a href=\"#\">" . $donnees['date_sujet'] . "</a>
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