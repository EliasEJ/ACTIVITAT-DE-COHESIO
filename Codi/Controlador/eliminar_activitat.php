<?php 

require_once("../Vista/index_professor.php");
require_once("../Model/model_activitat.php");

function eliminarActividad(){
    try{

        $idAct = $_GET['idAct'];
        eliminarActivitat($idAct);

    }catch(PDOException $e){
        echo "Error eliminarActividad: " . $e->getMessage();
    }
    
}

eliminarActividad();
header("Location: ") ?>
<script> 
alert("Activitat eliminat");
location.replace("../Vista/index_professor.php") </script>