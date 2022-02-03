<?php

ini_set("xdebug.var_display_max_children", '-1');
ini_set("xdebug.var_display_max_data", '-1');
ini_set("xdebug.var_display_max_depth", '-1');
// include('./Models/user_model.php');
include('./Models/sujet_model.php');
include('./Models/commentaire_model.php');

$user = new Users();
$utils = new Utils();
$sujet = new Sujet();
$comm = new Commentaire();


$derniers = "";



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
    //TODO

    //affichage des sujets
        if (isset($_POST['comptesuj'])) {
            $articleCompte = "";

            $req = $sujet->getAllSujetsByUser($aaa['id_users']);

            $nbRep = 0; //TODO le nombre de commentaires liés à l'article
            while ($donnees = $req->fetch()) {
                $apercu = substr($donnees['contenu_sujet'], 0, 50) . " ...";

                //formatage de la date
                $ladate = date('d-m-y à H:i', strtotime($donnees['date_sujet']));

                //création des cartes de sujet
                $articleCompte .=
                    "<div>
                        <h3>
                            <a href=\"index.php?p=sujet&id=" . $donnees['id_sujet'] . "\">
                                " . $donnees['nom_sujet'] . "
                            </a>
                        </h3>
                        <p>
                            <a href=\"#\">
                                <strong>" . $donnees['login_user'] . "</strong>
                            </a>  dans <strong>" . ucwords($donnees['nom_cat']) . "</strong> le 
                            " . $ladate . "
                            Réponses : $nbRep
                        </p>
                        <p>" . $apercu . "</p>
                    </div>";
            }
        }

        //affichage des commentaires
        //TODO
        if (isset($_POST['comptecomm'])) {
            $articleCompte = "";

            $req = $comm->getComsU(intval($user->getIdUser()));

            var_dump($req);
            while ($donnees = $req->fetch()) {
                // $apercu = substr($donnees['contenu_com'], 0, 50) . " ...";
                var_dump($donnees);

                //formatage de la date
                $ladate = date('d-m-y à H:i', strtotime($donnees['date_com']));

                //création des cartes de sujet
                $articleCompte .=
                    "<div>
                        <h3>
                            <a href=\"index.php?p=sujet&id=" . $donnees['id_commentaire'] . "\">
                                " . $donnees['nom_com'] . "
                            </a>
                        </h3>
                        <p>
                            <a href=\"#\">
                                <strong>" . $aaa['login_user'] . "</strong>
                            </a>  dans <strong>" . ucwords($donnees['nom_cat']) . "</strong> le 
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
    } 
    else {
        $articleCompte = "<h3>Veuillez vous <span id='conn2' class='liens'>connecter</span> ou <span id='crea2' class='liens'>créer un compte</span></h3>";
        $log = "";
        $disabled = "disabled";
    }

include('Views/compte_view.php');
