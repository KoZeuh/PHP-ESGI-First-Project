<?php
    function principalController($action){
        $actions = array("default","importBinomes","generateBinomes","downloadBinomes", "reset");
        
        if (in_array ($action ,$actions )){
            return $action."Controller.php";
        }

        return "errorController.php";
    }
?>