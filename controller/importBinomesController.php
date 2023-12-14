<?php
    if ( $_SERVER["SCRIPT_FILENAME"] == __FILE__ ){
        $racine="..";
    }

    $title = "Accueil";

    include_once "$racine/model/studentsModel.php";
    include_once "$racine/model/binomesModel.php";

    $importStudentError = NULL;
    $importStudentSuccess = NULL;

    if (isset($_FILES['student_list'])) {
        if ($_FILES['student_list']['type'] !== 'text/csv') {
            $importStudentError = "Le fichier n'est pas au format CSV.";
        }else if ($_FILES['student_list']['size'] > 1000000) {
            $importStudentError = "Le fichier est trop volumineux.";
        }else if ($_FILES['student_list']['size'] == 0) {
            $importStudentError = "Le fichier est vide.";
        }else if ($_FILES['student_list']['error'] !== UPLOAD_ERR_OK) {
            $importStudentError = "Erreur lors du téléchargement du fichier.";
        }else {
            $students = importStudentList($_FILES['student_list']['tmp_name'], isset($_POST['has_header']));

            if (isset($students['error'])) {
                $importStudentError = $students['error'];
            } else {
                setStudents($students);
                setBinomes(generateBinomes(getStudents()));

                $importStudentSuccess = "Le fichier a été importé avec succès et des binômes se sont générés.";
            }
        }
    }else {
        $importStudentError = "Le fichier est vide.";
    }

    include "$racine/view/headerView.php";
    include "$racine/view/navbarView.php";
    include "$racine/view/binomesView.php";
    include "$racine/view/footerView.php";
?>