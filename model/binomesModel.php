<?php
    function getBinomes(): array {
        return isset($_SESSION['binomes']) ? $_SESSION['binomes'] : array();
    };

    function setBinomes($binomes): void {
        $_SESSION['binomes'] = $binomes;
    };

    function resetBinomes(): void {
        unset($_SESSION['binomes']);
        unset($_SESSION['binomes_already_generated']);
    };

    function generateBinomes($students) {
        $resultArray = [];
        $numOfStudents = count($students);

        if ($numOfStudents % 2 !== 0) {
            $students[] = ["", ""];
        }

        $_SESSION['currentRound'] = isset($_SESSION['currentRound']) ? $_SESSION['currentRound'] + 1 : 0;
        $currentRound = $_SESSION['currentRound'];
    
        for ($round = 0; $round < $numOfStudents - 1; $round++) {
            foreach ($students as $key => $participant) {
                if ($key >= $numOfStudents / 2) break;
                $partnerKey = $numOfStudents - $key - 1;
                $resultArray[$round][] = [$students[$key], $students[$partnerKey]];
            }
    
            $first = array_shift($students);
            array_unshift($students, array_pop($students));
            array_unshift($students, $first);
        }
    
        return $resultArray[$currentRound % ($numOfStudents - 1)];
    }
    
    
    function downloadBinomes(): void {
        $binomes = getBinomes();
        $file = fopen('CSV_Files/export_binomes.csv', 'w');
    
        // En-tête du fichier
        $header = array('nom_1', 'prenom_1', 'nom_2', 'prenom_2');
        fputcsv($file, $header);
    
        if ($file) {
            foreach ($binomes as $binome) {
                $row = array(
                    isset($binome[0]['nom']) ? $binome[0]['nom'] : '',
                    isset($binome[0]['prenom']) ? $binome[0]['prenom'] : '',
                    isset($binome[1]['nom']) ? $binome[1]['nom'] : '',
                    isset($binome[1]['prenom']) ? $binome[1]['prenom'] : ''
                );
                fputcsv($file, $row);
            }
    
            fclose($file);
    
            if (file_exists('CSV_Files/export_binomes.csv')) {
                header('Content-Type: application/csv');
                header('Content-Disposition: attachment; filename="export_binomes.csv"');
                readfile('CSV_Files/export_binomes.csv');

                exit;
            } else {
                echo 'Le fichier de binômes n\'a pas été correctement créé.';
            }
        } else {
            echo 'Impossible d\'ouvrir le fichier pour l\'écriture.';
        }
    }
    
    
?>


