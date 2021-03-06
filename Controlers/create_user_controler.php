<?php
///////////////////////////////////////////////////////////////////////////////
                        // création de compte utilisateur //
///////////////////////////////////////////////////////////////////////////////
    // include_once('./Connect/connect.php');
    include_once('./Models/user_model.php');
    include_once('./Models/role_model.php');
    
    $utils = new Utils;

    $success = 0;
    $msg = "Une erreur est survenue dans le php";
    $data = [];
// création de la variable de display info, laissé vide au start pour éviter des erreurs
    $log = "";

// récupération du fuseau horaire

    date_default_timezone_set('Europe/Paris');

// création de variables venant limiter la selection de l'age de l'utilisateur 

        $min = intval(date("Y")) - 18; //date retourne en string l'année actuelle que je transforme en entier pour l'additionner avec l'age mini de l'utilisateur.
        $max = intval(date("Y")) - 100;

        // Ici je retransforme en string les entiers stockés dans les variables min et max
        $minA = (string)$min; 
        $minSP = $minA . '-' . date("m-j");
        $maxA = (string)$max;

// On vérifie ici la présence de chaque élément avant de lancer l'opération
    if(isset($_POST['pseudo-crea']) 
        && isset($_POST['email-crea']) 
        && isset($_POST['dateN']) 
        && isset($_POST['mdp-crea']) 
        && isset($_POST['confirmMdp-crea']) 
        && isset($_POST['condUtilisat'])) {
    
        
// fonction de vérification limitant l'utilisation des espaces et caractères spéciaux
// on déclare en amon le mdp et le mdp de confirmation
        $mdp = $_POST['mdp-crea'];
        $mdp1 = $_POST['confirmMdp-crea'];

//  qu'on réutilise de suite pour les vérifier
        if($mdp === $mdp1){
            
// on déclare les différentes variables auxquelles on applique les fonctions de validations + le hash du mot de passe
// grosse moulinette de check des infos entrées par l'utilisateur login et mail
            $login = $utils->valid_donnees($_POST['pseudo-crea']);
            $date = $utils->valid_donnees($_POST['dateN']);
            $mail = $utils->valid_donnees($_POST['email-crea']);
            $mdp = $utils->valid_donnees(password_hash($_POST['mdp-crea'], PASSWORD_BCRYPT));
            $cond = $_POST['condUtilisat'];

// Avec cette condition on vérifie bien que tout correspond avant d'effectuer les checks au niveau du serveur
            if(strlen($login) <= 20 
                && preg_match("^[a-zA-Z0-9_]*$^",$login)
                && filter_var($mail, FILTER_VALIDATE_EMAIL)
            ){
// si la condition est respectée on va pouvoir déclarer deux nouvelles classes
                $newUser = new Users();
                $newRole = new Role();
                
//  ici nous allons set les éléments déclarés précédemment
                $newUser->setLoginUser($login);
                $newUser->setMdpUser($mdp);
                $newUser->setMailUser($mail);
                $newUser->setNaissanceUser($date);
                $newUser->setIdRoleUser($newUser->getIdRoleUser());
                
                
                $checkUser = $newUser->verifyPseudoAndMail();
                

                $nbrUser = $checkUser->rowCount();
                

                    if($nbrUser > 0) {
                        
                            echo '<script language="javascript">';
                            echo 'alert("Pseudo ou Mail déjà utlisé, veuillez renouveler votre demande avec d\'autres informations");';
                            echo '</script>';
                            
                        $log = "Pseudo ou Mail déjà utlisé, veuillez renouveler votre demande avec d'autres informations";
                    } else {
                        if($newUser->createUser()){
                            $myReturn = $newUser->getSingleUser();
                            $nbrUsers = $myReturn->rowCount();

                            if($nbrUsers == 0){
                                $log = "error enregistrement !!!";
                                

                            } else if($nbrUsers >1){

                                
                                $log ="Pseudo ou Mail déjà utlisé, veuillez renouveler votre demande avec d\'autres informations";
                                

                            } else if ($nbrUsers == 1) {

                                echo '<script language="javascript">';
                                echo 'alert("C\'est bon frer le boss t\'es là où il faut.");';
                                echo '</script>';
                                
                                while($rowUser = $myReturn->fetch()){
                                    extract($rowUser);
                                    $newRole->setIdRole($rowUser['id_role']);
                                    $returnRole = $newRole->getSingleRole();
                                    $id_role;

                                    while($rowRole = $returnRole->fetch()){
                                        extract($rowRole);
                                        $id_role = intval($rowRole['id_role'], 10);
                                        $nom_role = $rowRole['nom_role'];
                                    }

                                    $success = 1;
                                    $msg = "Utilisateur créé avec succès";
                                    $data['id_users'] = intval($rowUser['id_users'], 10);
                                    $data['login_user'] = $rowUser['login_user'];
                                    $data['id_role'] = $id_role;
                                    $data['nom_role'] = $nom_role;
                                }
                            }
                        }else {
                            
                            $log = "erreur lors de l\'enregistrement putain;";
                            
                        }
                    }
            
                }
            } else {
                
                $log ="Les mots de passe ne correspondent pas veuillez les entrer à nouveau;";
                
            }
        } 
        
        if($success == 1){
            
// condition connectant un compte utilisateur qui vient d'être créé 
            include_once('./Connect/utils.php');
            
            $user->setLoginUser($login);
            $need = $user->getSingleUser();

            $connexion = $need->fetch();

                if($connexion == true){

                    $_SESSION['id'] = $connexion['id_users'];
                    $_SESSION['login'] = $connexion['login_user'];

                    echo '<META HTTP-EQUIV="Refresh" Content="0; URL=' . $utils->getUrl() . '">';
                }
                else{
                echo '<script language="javascript">';
                echo 'alert("Une erreur s\'est produite et nous n\'avons pas pu vous connecter");';
                echo '</script>';
                }
        } 


?>