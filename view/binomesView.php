<body>
    <div class="container">
        <div class="d-flex justify-content-around text-center">
            <h1>Importation des étudiants</h1>
            <h1>Liste des étudiants</h1>
        </div>

        <div class="row mb-3">
            <div class="col-6">
                <form action="./?action=importBinomes" method="post" enctype="multipart/form-data">
                    <div class="mb-5">
                        <div class="card text-center border border-primary shadow-0">
                            <div class="card-body">
                                <div class="card-text">
                                    <div class="form-group">
                                        <label for="student_list">Fichier en format (CSV) :</label>
                                        <input type="file" class="form-control" name="student_list" id="student_list">
                                    </div>

                                    <div class="mt-3">
                                        <input type="checkbox" class="form-check-input" name="has_header" id="has_header" checked>
                                        <label class="form-check-label" for="has_header">Contient-il une en-tête ?</label>
                                    </div>

                                </div>
                            </div>

                            <?php
                                if (isset($importStudentError)) {
                                    echo '<button type="button" class="btn btn-danger">' . $importStudentError . '</button>';
                                } else if (isset($importStudentSuccess)) {
                                    echo '<button type="button" class="btn btn-success">' . $importStudentSuccess . '</button>';
                                }
                            ?>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-warning">Importer</button></form>

                                <form class="mt-2" action="./?action=reset" method="post" enctype="multipart/form-data">
                                    <input type="hidden" name="reset_students" value="reset_students">
                                    <button type="submit" class="btn btn-danger">Réinitialiser la liste</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="col-6">
                <table class="text-center table table-hover table-sm table-bordered border-primary">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Prénom</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                            $students = $_SESSION['students'] ?? array();

                            if (count($students) == 0) {
                                echo '<tr>';
                                echo '<td colspan="4" class="text-center bg-danger text-white">Aucun étudiant n\'a été importé.</td>';
                                echo '</tr>';
                            }else {
                                foreach ($students as $student) {
                                    echo '<tr>';
                                    echo '<td>' . $student['nom'] . '</td>';
                                    echo '<td>' . $student['prenom'] . '</td>';
                                    echo '</tr>';
                                }
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

        <hr>

        <div class="d-flex justify-content-around text-center mt-5">
            <div class="col-4">
                <form action="./?action=generateBinomes" method="post">
                    <input type="hidden" name="generate_binomes" value="generate_binomes">
                    <button type="submit" class="btn btn-success">Générer les binômes</button>
                </form>
            </div>

            <div class="col-4">
                <form action="./?action=reset" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="reset_binomes" value="reset_binomes">
                    <button type="submit" class="btn btn-danger">Réinitialiser les binômes</button>
                </form>
            </div>

            <div class="col-4">
                <form action="./?action=downloadBinomes" method="post">
                    <input type="hidden" name="download_binomes" value="download_binomes">
                    <button type="submit" class="btn btn-primary">Télécharger les binômes (CSV)</button>
                </form>
            </div>
        </div>
        
        <div class="card text-center border-primary shadow-0 mt-3">
            <div class="row">
                <?php
                    if (isset($_SESSION['binomes'])) {
                        $binomes = $_SESSION['binomes'];
                        foreach ($binomes as $binome) {

                            if ($binome && isset($binome[0]) && isset($binome[1])) {
                                echo '<div class="col-md-4">';
                                    echo '<div class="card m-2 bg-info">';
                                        echo '<div class="card-body">';
                                
                                            echo '<h5 class="card-title">' . (isset($binome[0]['prenom'], $binome[0]['nom']) ? $binome[0]['prenom'] . ' ' . $binome[0]['nom'] : 'Etudiant Fictif') . '</h5>';
                                            echo '<h5 class="card-title">' . (isset($binome[1]['prenom'], $binome[1]['nom']) ? $binome[1]['prenom'] . ' ' . $binome[1]['nom'] : 'Etudiant Fictif') . '</h5>';
                                
                                        echo '</div>';
                                    echo '</div>';
                                echo '</div>';
                            }
                        }                        
                    }else {
                        echo '<div class="col-md-12">';
                            echo '<div class="card m-2 bg-danger text-white">';
                                echo '<div class="card-body">';
                                    echo '<h5 class="card-title">Aucun binôme n\'a été généré.</h5>';
                                echo '</div>';
                            echo '</div>';
                        echo '</div>';
                    }
                ?>
            </div>
        </div>
    </div>

    <?php
        if (isset($downloadBinomesSuccess)) {
            echo '<script>alert("' . $downloadBinomesSuccess . '");</script>';
        } else if (isset($downloadBinomesError)) {
            echo '<script>alert("' . $downloadBinomesError . '");</script>';
        }
    ?>
</body>