<?php
//c'est la page qui sera toujours affichée, avec des paramètres ("?p=") qui définissent la vue

// exemple si le lien cliqué = "index.php?p=compte", on récupère le "compte"
if (isset($_GET['p'])) {
    $p = $_GET['p'];
} 
//si aucun paramètre, la page home est chargée par défaut
else {
    $p = 'home';
}

//on créer un objet temporaire
ob_start();
//qui est construit avec la vue voulue
require 'Views/'.$p.'_view.php';
//qu'on stocke dans le $content avant d'être effacé
$content = ob_get_clean();

//on appelle le template, qui remplacera $content par la vue voulue
require 'Views/templates/template.php';
?>