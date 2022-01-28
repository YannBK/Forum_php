<?php

// var_dump(session_status());

// if (session_status() != PHP_SESSION_NONE) {
//     echo "une session active";
//     var_dump($_SESSION);
// }
// else{
//     echo "pas de session";
// }
include('Connect/connect.php');

include('Models/compte_model.php');

include('Views/compte_view.php');