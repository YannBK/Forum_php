<?php

    try {
        $query = $bdd->prepare("SELECT login_user 
                                FROM users 
                                WHERE login_user = :login_user
                                " );

        // execution de la requête
        $query->execute(
            array(
                'login_user' => $login
                // 'mdp_user' => $mdp
                )
            );

            //si il y a au moins un résultat
            if ($query->fetch()) {
                $result = '<p style="color:red;">Votre compte ' . $login . ' existe !! Félicitation et bienvenue !</p>';
//TODO retour à la page d'accueil et connexion au compte
            } 
            else {
                $result =  '<p style="color:red;">Votre compte ' . $login . ' n\'existe pas !! Veuillez essayer à nouveau</p>';
            }

    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }


?>
