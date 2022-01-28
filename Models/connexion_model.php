<?php

    try {
        $query = $bdd->prepare("SELECT                  
                                * 
                                FROM users 
                                WHERE login_user = :login_user
                                " );
        // execution de la requête
        $query->execute(
            array(
                'login_user' => $login
                )
            );

    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }

?>
