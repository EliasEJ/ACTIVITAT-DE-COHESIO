<?php

require_once("../Vista/index_professor.php");
require_once("../Model/model_activitat.php");

function guardarActividad(){
    try{
        if ($_SERVER["REQUEST_METHOD"] == "POST"){
            $idAct = $_POST['idAct'];
            $nameAct = $_POST['nomAct'];
            $descriptAct = $_POST['descripcioAct'];
           
            actualizarActividad($idAct, $nameAct, $descriptAct);
        }

    }catch(PDOException $e){
        echo "Error guardarActividad: " . $e->getMessage();
    }
    
}

guardarActividad(); ?>
<script> location.replace("../Vista/index_professor.php") </script>