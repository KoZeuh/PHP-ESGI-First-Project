<?php
    include "getRacine.php";
    include "$racine/principalController.php";

    if (isset($_GET["action"])){
        $action = $_GET["action"];
    }
    else{
        $action = "default";
    }

    session_start();
    
    $fichier = principalController($action);

    include "$racine/controller/$fichier";
?>