<?php
    if ( $_SERVER["SCRIPT_FILENAME"] == __FILE__ ){
        $racine="..";
    }

    $title = "Erreur";
    
    include "$racine/view/headerView.php";
    include "$racine/view/navbarView.php";
    include "$racine/view/errorView.php";
    include "$racine/view/footerView.php";
?>