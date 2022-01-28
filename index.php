<?php
//http://localhost/forum_php/index.php : c'est la page qui sera toujours affichée, et qu'il faut appeler pour lancer le site
//le changement de vue se fera avec un paramètre ?p=nomdelavue qui définira la vue

session_start();

// si on clique sur un lien : "index.php?p=compte", on récupère "compte" dans $p
if (isset($_GET['p'])) {
    $p = $_GET['p'];
} 
//si aucun paramètre, la page home est chargée par défaut
else {
    $p = 'home';
}
if (isset($_GET['id'])) {
    $id = $_GET['id'];
} 
//si pas de paramètre id, ben voilà
else {
    $id = '';
} //écrire le lien : "index.php?p=sujet&id=5"


<<<<<<< HEAD
$result = "";
=======
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}
//si aucun paramètre, la page home est chargée par défaut
else {
    $id='';
}

>>>>>>> c0718da4478adc6793db27a9db139cd325da138f
//on créer un objet temporaire
ob_start();

//qui est construit avec le controler
include('Controlers/connexion_controler.php');
require 'Controlers/'.$p.'_controler.php';
// require 'Controlers/'.$p.'_controler.php';

//qu'on stocke dans le $content avant d'être effacé
$content = ob_get_clean();

//on appelle le template, qui remplacera $content par la vue obtenue par le controler
require 'Views/templates/template.php';
?>