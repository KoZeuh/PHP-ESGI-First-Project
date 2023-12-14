<?php
    function getStudents(): array {
        return isset($_SESSION['students']) ? $_SESSION['students'] : array();
    };

    function setStudents($students): void {
        $_SESSION['students'] = $students;
    };

    function resetStudents(): void {
        unset($_SESSION['students']);
        
        resetBinomes();
    };
    
    function importStudentList($file, $hasHeader): array {
        $students = array();
    
        if (($handle = fopen($file, "r")) !== FALSE) {
            if ($hasHeader) {
                $header = fgetcsv($handle);
                if ($header === false) {
                    fclose($handle);
                    return ['error' => 'Erreur lors de la lecture de l\'en-tête. Assurez-vous que le fichier est au format CSV.'];
                }
            }
    
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                $student = array();
                if ($hasHeader) {
                    if (count($header) != count($data)) {
                        fclose($handle);
                        return ['error' => 'Le nombre de colonnes dans le fichier CSV ne correspond pas à l\'en-tête.'];
                    }
                    foreach ($header as $index => $columnName) {
                        $student[$columnName] = $data[$index];
                    }
                } else {
                    $student['nom'] = $data[0];
                    $student['prenom'] = $data[1];
                }

                $students[] = $student;
            }

            fclose($handle);
        } else {
            return ['error' => 'Le fichier CSV ne peut pas être ouvert. Assurez-vous qu\'il existe et que vous avez les permissions nécessaires.'];
        }
    
        return $students;
    };
    

?>


