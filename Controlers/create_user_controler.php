<?php
///////////////////////////////////////////////////////////////////////////////
                        // création de compte utilisateur //
///////////////////////////////////////////////////////////////////////////////
    include_once('./Connect/connect.php');
    include_once('./Models/user_model.php');
    include_once('./Models/role_model.php');
    


    $success = 0;
    $msg = "Une erreur est survenue dans le php";
    $data = [];
    // création de la variable de display info, laissé vide au start pour éviter des erreurs
    $log = "";

    // récupération du fuseau horaire

    date_default_timezone_set('Europe/Paris');

    // création de variables venant limiter la selection de l'age de l'utilisateur 

        $min = intval(date("Y")) -18; //date retourne en string l'année actuelle que je transforme en entier pour l'additionner avec l'age mini de l'utilisateur.
        $max = intval(date("Y"))-100;

        // Ici je retransforme en string les entiers stockés dans les variables min et max
        $minA = (string)$min; 
        $minSP = $minA . '-' . date("m-j");
        $maxA = (string)$max;


    if(isset($_POST['pseudo-crea']) 
        && isset($_POST['email-crea']) 
        && isset($_POST['dateN']) 
        && isset($_POST['mdp-crea']) 
        && isset($_POST['confirmMdp-crea']) 
        && isset($_POST['condUtilisat'])) {
    
        

        function valid_donnees($donnees){
            $donnees = trim($donnees);
            $donnees = stripslashes($donnees);
            $donnees = htmlspecialchars($donnees);
            return $donnees;
        }
        $mdp = $_POST['mdp-crea'];
        $mdp1 = $_POST['confirmMdp-crea'];



        if($mdp === $mdp1){

        // fonction de validation des données afin de vérifier les charactères utilisés
        $login = valid_donnees($_POST['pseudo-crea']);
        $date = valid_donnees($_POST['dateN']);
        $mail = valid_donnees($_POST['email-crea']);
        $mdp = valid_donnees(password_hash($_POST['mdp-crea'], PASSWORD_BCRYPT));
        $id_role;
        $cond = $_POST['condUtilisat'];

        
        // grosse moulinette de check des infos entrées par l'utilisateur login et mail


        // TODO vérifier si le premier et le deuxième mot de passe sont identiques
            if(strlen($login) <= 20 
                && preg_match("/^[A-Za-z '-]+$/",$login)
                && filter_var($mail, FILTER_VALIDATE_EMAIL)
            ){

                $newUser = new Users();
                $newRole = new Role();
                
                $newUser->setLoginUser($login);
                $newUser->setMdpUser($mdp);
                $newUser->setMailUser($mail);
                $newUser->setNaissanceUser($date);
                // $newUser->setIdRoleUser($id_role);
                
                $checkUser = $newUser->verifyPseudoAndMail();
                

                $nbrUser = $checkUser->rowCount();
                
                

                    if($nbrUser > 0) {
                        
                            echo '<script language="javascript">';
                            echo 'alert("Pseudo ou Mail déjà utlisé, veuillez renouveler votre demande avec d\'autres informations");';
                            echo '</script>';
                        // $log = "Pseudo ou Mail déjà utlisé, veuillez renouveler votre demande avec d'autres informations";
                    } else {
                        if($newUser->createUser()){
                            $myReturn = $newUser->getSingleUser();
                            $nbrUsers = $myReturn->rowCount();
                            var_dump($nbrUsers);

                            if($nbrUsers == 0){
                                $log = "error 'enregistrement !!!";
                                

                            } else if($nbrUsers >1){

                                echo '<script language="javascript">';
                                echo 'alert("Pseudo ou Mail déjà utlisé, veuillez renouveler votre demande avec d\'autres informations");';
                                echo '</script>';

                            } else if ($nbrUsers == 1) {

                                echo '<script language="javascript">';
                                echo 'alert("C\'est bon frer le boss t\'es là où il faut.");';
                                echo '</script>';

                                while($rowUser = $myReturn->fetch()){
                                    var_dump($rowUser);
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
                            echo '<script language="javascript">';
                            echo 'alert("erreur lors de l\'enregistrement putain");';
                            echo '</script>';
                        }
                    }
            
                }
            } 
        } else{
        // echo '<script language="javascript">';
        // echo 'alert("Les mots de passe ne correspondent pas");';
        // echo '</script>';
        }
        if($success == 1){
            // je crée un tableau qui contiendra le success, un msg et de la data
            $res = ["success" => $success, "msg" => $msg, "data" => $data];
            // puis j'encode le tout en json pour le retourner
            echo json_encode($res);
        } else {
            // sinon je retourne seulement un tableau contenant success et msg
            // $res = ["success" => $success, "msg" => $msg];
            // echo json_encode($res);
        }
    
    


?>