<?php

        //on tente l'insertion
        try {
            //récupération des catégories
            $req = $bdd->prepare("SELECT * FROM categorie");

            $okselect = $req->execute();

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
            $req = $bdd->prepare("SELECT id_sujet, nom_sujet, date_sujet, contenu_sujet, login_user FROM sujet INNER JOIN users ON users.id_users=sujet.id_users ORDER BY id_sujet DESC");
            //TODO ici inner join pour le nom d'auteur

            $okselect = $req->execute();
            $sujetListe = "";
            $nbRep = 0;
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

        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }

?>