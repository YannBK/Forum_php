<?php

    //on tente l'insertion
    try {
        //via une requête préparée
        $query = $bdd->prepare("INSERT INTO 
                                    users 
                                SET 
                                    date_user = :date_user, 
                                    mail_user = :mail_user,
                                    login_user = :login_user,
                                    mdp_user = :mdp_user"
                                    );
        // execution de la requête
        $insert = $query->execute(
            array(
                'date_user' =>$date,
                'mail_user' => $mail,
                'login_user' => $login,
                'mdp_user' => $mdp
                )
            );
            //condition de succés
            if ($insert) {
                //retour d'un résultat
                $log = '<p style="color:red;">Votre compte a bien été créé !! Félicitation et bienvenue !</p>';
//TODO retour à la page d'accueil et connexion au compte
            } 
            else {
                //sinon on blame le serveur
                $log =  '<p style="color:red;">Erreur lors de l\'enregistrement veuillez essayer à nouveau</p>';

            }

    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }


?>

