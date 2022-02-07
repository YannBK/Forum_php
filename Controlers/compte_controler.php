<?php

include('./Models/sujet_model.php');
include('./Models/commentaire_model.php');

$user = new Users();
$utils = new Utils();
$sujet = new Sujet();
$comm = new Commentaire();

$derniers = "";
$datasujet = "";

if (isset($_SESSION['login'])) {
    //variable pour désactiver les boutons si non connecté
    $disabled = "";

    //récupération de l'utilisateur
    $log = $_SESSION['login'];

    $user->setLoginUser($log);
    $myuser = $user->getSingleUser();
    $aaa = $myuser->fetch();

    $user->setIdUser($aaa['id_users']);
    $user->setLoginUser($aaa['login_user']);
    $user->setMailUser($aaa['mail_user']);
    $user->setNaissanceUser($aaa['date_user']);
    $user->setMdpUser($aaa['mdp_user']);

    //affichage des informations du compte
    $articleCompte =
        "<h3>Vos informations :</h3>
        <div><p>Votre login :  ".$user->getLoginUser()." </p><input id='changelogin' type='button' value='Changer'></div>
        <div><p>Votre mail :  ".$user->getMailUser()." </p></div>
        <div><p>Votre date de naissance :  ".$user->getNaissanceUser()." </p></div>";

    //affichage des dernières interventions
        $req = $user->getDerniereParoles();

        while ($donnees = $req->fetch()) {
            //formatage de la date
            $ladate = date('d-m-y à H:i', strtotime($donnees['date_sujet']));

            //création des cartes de sujet
            $derniers .=
                "<div>
                    <h3>
                        <a href=\"index.php?p=sujet&id=" . $donnees['id_sujet'] . "\">
                            " . $donnees['nom_sujet'] . "
                        </a>
                    </h3>
                    <p> 
                        Le " . $ladate . "
                    </p>                  
                </div>";
        }

    //affichage des sujets
        if (isset($_POST['comptesuj'])) {
            $articleCompte = ""; 

            $req = $sujet->getAllSujetsBySearch($aaa['id_users'], 'sujet.id_users');

            while ($donnees = $req->fetch()) {
                $apercu = substr($donnees['contenu_sujet'], 0, 50) . " ...";

                //formatage de la date
                $ladate = date('d-m-y à H:i', strtotime($donnees['date_sujet']));

                //nombre de commentaires du sujet
                $com = new Commentaire();
                $com->setIdSujetCom($donnees['id_sujet']);
                $nbRep = $com->count();
                $donnees2 = $nbRep->fetch();

                //création des cartes de sujet
                $articleCompte .=
                    "<div>
                        <h3>
                            <a href=\"index.php?p=sujet&id=" . $donnees['id_sujet'] . "\">
                                " . $donnees['nom_sujet'] . "
                            </a>
                        </h3>
                            <a id='suppr' href=\"index.php?p=compte&id=".$donnees['id_sujet']."\">Supprimer</a>
                        <p>
                            <strong>" . $donnees['login_user'] . "</strong>
                            dans <strong>" . ucwords($donnees['nom_cat']) . "</strong> le 
                            " . $ladate . "
                            Réponses : ".$donnees2[0]."
                        </p>
                        <p>" . $apercu . "</p>
                    </div>";
            }
        }

        //affichage des commentaires
        if (isset($_POST['comptecomm'])) {
            $articleCompte = "";

            $comm->setIdUserCom($user->getIdUser());
            $req = $comm->getComsU();

            while ($donnees = $req->fetch()) {

                //formatage de la date
                $ladate = date('d-m-y à H:i', strtotime($donnees['date_com']));

                //création des cartes de commentaires
                $articleCompte .=
                    "<div>
                        <h3>
                            <a href=\"index.php?p=sujet&id=" . $donnees['id_sujet'] . "\">
                                " . $donnees['nom_sujet'] . "
                            </a>
                        </h3>
                        <a id='suppr' href=\"index.php?p=compte&com=".$donnees['id_commentaire']."\">Supprimer</a>
                        <p>
                            <strong>" . $aaa['login_user'] . "</strong>
                            le 
                            " . $ladate . "
                        </p>
                        <p>" . $donnees['contenu_com'] . "</p>
                    </div>";
            }
        }

        //changement de pseudo
        if (isset($_POST['newlogin']) && isset($_POST['mdp-newlogin'])) {

            $newlogin = $utils->valid_donnees($_POST['newlogin']);
            $mdp = $_POST['mdp-newlogin'];

            if (!password_verify($mdp, $aaa['mdp_user'])) {
                echo '<script language="javascript">';
                echo 'alert("Etes-vous sûr d\'être celui(celle) que vous prétendez? Le mot de passe ne correspond pas.");';
                echo '</script>';
            } else {
                if ($aaa == true) {
                    $user->setLoginUser($newlogin);
                }
                $user->updateUser();

                $_SESSION['login'] = $newlogin;
                echo '<META HTTP-EQUIV="Refresh" Content="0; URL=' . $utils->getUrl() . '">';
            }
        }

        // changement de mot de passe => sans confirmation par mail car localhost
        if (isset($_POST['newmdp']) && isset($_POST['mdp-newmdp'])) {

            $newmdp = $_POST['newmdp'];
            $mdp = $_POST['mdp-newmdp'];

            if (!password_verify($mdp, $aaa['mdp_user'])) {
                echo '<script language="javascript">';
                echo 'alert("Etes-vous sûr d\'être celui(celle) que vous prétendez? Le mot de passe ne correspond pas.");';
                echo '</script>';
            } else {
                if ($aaa == true) {
                    $user->setMdpUser(password_hash($newmdp, PASSWORD_BCRYPT));
                }
                $user->updateUser();
            }
        }

        //suppression d'un sujet
        if (isset($_GET['id'])){
            $sujet->setIdSujet(intval($_GET['id']));

            //suppression foreign key table association
            include('Models/appartenir.php');
            $appartenir = new CatSujet();
            $appartenir->setIdSujet(intval($_GET['id']));
            $heho = $appartenir->deleteAppartSujet();

            //suppression commentaires
            $comsujet = new Commentaire();
            $comsujet->setIdSujetCom(intval($_GET['id']));
            $exist = $comsujet->getComsS();
            $nbexist = $exist->rowCount();
            if($nbexist!=0){
                $foreign = $comsujet->deleteCom();
            }

            //suppression article
            $req = $sujet->deleteSujet();

            echo '<META HTTP-EQUIV="Refresh" Content="0; URL=index.php?p=compte">';
        }

        //suppression d'un commentaire
        if (isset($_GET['com'])){
            $comsujet = new Commentaire();
            $comsujet->setIdCom(intval($_GET['com']));
            var_dump($comsujet);
            $foreign = $comsujet->deleteComById();
            var_dump($foreign);
            echo '<META HTTP-EQUIV="Refresh" Content="0; URL=index.php?p=compte">';
        }
    } 

    else {
        $articleCompte = "<h3>Veuillez vous <span id='conn2' class='liens'>connecter</span> ou <span id='crea2' class='liens'>créer un compte</span></h3>";
        $log = "";
        $disabled = "disabled";
    }

include('Views/compte_view.php');

