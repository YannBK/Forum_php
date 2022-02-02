<?php

include('Connect/utils.php');

if(isset($_POST['deconnect'])){
    echo '<META HTTP-EQUIV="Refresh" Content="0; URL=index.php">';
    session_unset();
    session_destroy();
    $message =  '<p>Bonjour visiteur inconnu</p>';

}

