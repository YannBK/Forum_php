<?php
    //récupération de la connection à la bdd
    include("Connect/connect.php");
    include("Models/categorie_model.php");

    date_default_timezone_set('Europe/Paris');
    //petit message de succès/échec qui s'affichera
    $result = "";
    $dates = "";
    $options = Categorie::displayCat();
    
    //vérification de l'existence des champs
    if (isset($_POST['nom_sujet']) && isset($_POST['contenu_sujet'])) {
        
        //stockage des valeurs rentrées par l'utilisateur
        $name = $_POST['nom_sujet'];
        $contenu = $_POST['contenu_sujet'];
        $dates = date('y-m-d G:i:s');

        if (isset($_POST['cat_sujet'])){
            $id_categorie = $_POST['cat_sujet'];
        }
        //appel du modèle qui va faire la requête et retourner la valeur de $result
        include("Models/creerArticle_model.php");
    }  
    
    //affichage de la vue
    include("Views/creerArticle_view.php");

?>