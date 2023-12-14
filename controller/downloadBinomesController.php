<?php
    if ( $_SERVER["SCRIPT_FILENAME"] == __FILE__ ){
        $racine="..";
    }

    $title = "Accueil";

    include_once "$racine/model/binomesModel.php";

    if (isset($_POST['download_binomes'])) {
        $currentBinomes = getBinomes();

        if (count($currentBinomes) == 0) {
            $downloadBinomesError = "Il n'y a pas de binômes à télécharger.";
        } else {
            downloadBinomes();

            $downloadBinomesSuccess = "Le fichier de binômes a été téléchargé avec succès.";
        }
    }
    
    include "$racine/view/headerView.php";
    include "$racine/view/navbarView.php";
    include "$racine/view/binomesView.php";
    include "$racine/view/footerView.php";
?>