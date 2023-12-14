<?php
    if ( $_SERVER["SCRIPT_FILENAME"] == __FILE__ ){
        $racine="..";
    }

    $title = "Accueil";

    include_once "$racine/model/studentsModel.php";
    include_once "$racine/model/binomesModel.php";

    if (isset($_POST['generate_binomes']) && isset($_SESSION['students'])) {
        setBinomes(generateBinomes(getStudents()));
    }
    
    include "$racine/view/headerView.php";
    include "$racine/view/navbarView.php";
    include "$racine/view/binomesView.php";
    include "$racine/view/footerView.php";
?>