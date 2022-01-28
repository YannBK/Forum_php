<?php

include('Connect/utils.php');

//TODO ne marche pas
if(isset($_POST['Deconnect'])){
    $_SESSION = array();
    session_destroy();
    echo '<META HTTP-EQUIV="Refresh" Content="0; URL=' . $currentPageUrl . '">';
}
//TODO le bouton "je reste" => en JS clodemodal()