<?php

    try {
        $query = $bdd->prepare("SELECT                  
                                login_user, mdp_user 
                                FROM users 
                                WHERE login_user = :login_user
                                " );
        // execution de la requête
        $query->execute(
            array(
                'login_user' => $login
                )
            );

            //si il y a au moins un résultat
            while ($aaa = $query->fetch()) {
                if(password_verify($mdp,$aaa['mdp_user'])==true){
                    $result = '<p style="color:red;">Votre compte ' . $login . ' existe !! Félicitation et bienvenue !</p>';
                }
                else{
                    $result =  '<p style="color:red;">Les données renseignées ne sont pas valides !! Veuillez essayer à nouveau</p>';
                }

//TODO changement de droits du visiteur => utilisateur connecté
            } 

    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }

?>
