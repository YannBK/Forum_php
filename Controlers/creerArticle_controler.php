<?php
    //récupération de la connection à la bdd
    include("Connect/connect.php");
    
    date_default_timezone_set('Europe/Paris');
    //petit message de succès/échec qui s'affichera
    $result = "";
    $dates = "";
    
    //vérification de l'existence des champs
    if (isset($_POST['nom_sujet']) && isset($_POST['contenu_sujet'])) {
        
        //stockage des valeurs rentrées par l'utilisateur
        $name = $_POST['nom_sujet'];
        $content = $_POST['contenu_sujet'];
        $dates = date('y-m-d G:i:s');

        //appel du modèle qui va faire la requête et retourner la valeur de $result
        include("Models/creerArticle_model.php");
    }  

    //affichage de la vue
    include("Views/creerArticle_view.php");

?>