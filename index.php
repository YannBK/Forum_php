<?php

if (isset($_GET['p'])) {
    $p = $_GET['p'];
} else {
    $p = 'home';
}

ob_start();

require 'Views/'.$p.'_view.php';
$content = ob_get_clean();
$titre = $p;
require 'Views/templates/template.php';
?>